<?php

return function (string $path, string $suffix = '.php') {
    $path = path($path);

    static $imported = [];

    if (isset($imported[$path.$suffix])) {
        return $imported[$path.$suffix];
    }

    $basePath = getenv('IMPORT_BASE_PATH');

    if (empty($basePath)) {
        $basePath = getcwd();
    }

    $path .= $suffix;

    /*
     * REMOTE DEPENDENCY ↓
     */

    preg_match('/https?:\/\/([^?#]+)(?:[?#]\S*)?/', $path, $matches);

    if (count($matches)) {
        $newPath = $basePath.'/dependencies/'.$matches[1];

        if (file_exists($newPath)) {
            return include $newPath;
        }

        $ch = curl_init();

        /*
         * Temporarily disabling until we have proper TLS handling ↓
         */
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if (empty($path)) {
            throw import('exceptions/missing-import-path')();
        }

        curl_setopt($ch, CURLOPT_URL, $path);
        $data = (string) curl_exec($ch);
        curl_close($ch);

        /*
         * Rewrite local imports to remote imports ↓
         */
        $data = preg_replace_callback('/import\((["\'])(.*?)\1\)/', function ($matches) use ($path) {
            // it's already remote, do nothing!
            if (preg_match('/^https?:\/\//i', $matches[2])) {
                return 'import('.$matches[1].$matches[2].$matches[1].')';
            }

            // it is local, let's change it to remote
            preg_match('/^(.*)\/[^\/]+$/', $path, $relativeMatches);

            if (count($relativeMatches) > 0) {
                return 'import('.$matches[1].$relativeMatches[1].'/'.$matches[2].$matches[1].')';
            }
        }, $data);

        $folder = dirname($newPath);

        if (! file_exists($folder)) {
            mkdir($folder, recursive: true);
        }

        file_put_contents($newPath, $data);
        $imported[$path.$suffix] = include $newPath;

        return $imported;
    }

    /*
     * LOCAL DEPENDENCY ↓
     */

    $backtrace = debug_backtrace(limit: 2);
    $target = $backtrace[0];

    if (isset($backtrace[0]['file']) && str_ends_with($backtrace[0]['file'], 'dependencies/publish.php')) {
        $target = $backtrace[1];
    }

    if (!isset($target['file'])) {
        throw import('exceptions/missing-file-reference')();
    }

    $filePath = dirname($target['file']);

    if (str_starts_with($path, '/')) {
        $imported[$path.$suffix] = include $path;
    } else {
        $imported[$path.$suffix] = require $filePath.'/'.$path;
    }

    return $imported[$path.$suffix];
};
