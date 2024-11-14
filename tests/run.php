<?php

require __DIR__ . '/../vendor/autoload.php';

path(from: 'b', to: __DIR__ . '/../libraries');

$attempt = import('b/support/1.x/attempt');

$assertions = 0;

$assert = function ($assertion) use (&$assertions) {
    $assertions++;
    assert($assertion);
};

$libraries = [
    'libraries/dependencies/1.x' => [
        // TODO
    ],
    'libraries/http/1.x' => [
        // TODO
    ],
    'libraries/support/1.x' => [
        'support/1.x/type/boolean',
        'support/1.x/type/list',
        'support/1.x/type/string',
        'support/1.x/type',
    ],
    'libraries/validation/1.x' => [
        'validation/1.x/rules/accepted',
        'validation/1.x/rules/after-date',
        'validation/1.x/rules/after-or-equal-to-date',
        'validation/1.x/rules/alpha',
        'validation/1.x/rules/alpha-numeric',
        'validation/1.x/rules/alpha-numeric-dash',
        'validation/1.x/rules/array',
        'validation/1.x/rules/ascii',
        'validation/1.x/rules/before-date',
        'validation/1.x/rules/before-or-equal-to-date',
        'validation/1.x/rules/between',
        'validation/1.x/rules/boolean',
        'validation/1.x/rules/confirmed',
        'validation/1.x/rules/date',
        'validation/1.x/rules/decimal',
        'validation/1.x/rules/declined',
        'validation/1.x/rules/different',
        'validation/1.x/rules/digits',
        'validation/1.x/rules/digits-between',
        'validation/1.x/rules/email',
        'validation/1.x/rules/ends-with',
        'validation/1.x/rules/ends-without',
        'validation/1.x/rules/greater-than-or-equal-to-size',
        'validation/1.x/rules/greater-than-size',
        'validation/1.x/rules/hex-color',
        'validation/1.x/rules/in',
        'validation/1.x/rules/integer',
        'validation/1.x/rules/ip',
        'validation/1.x/rules/ipv4',
        'validation/1.x/rules/ipv6',
        'validation/1.x/rules/json',
        'validation/1.x/rules/less-than-or-equal-to-size',
        'validation/1.x/rules/less-than-size',
        'validation/1.x/rules/lowercase',
        'validation/1.x/rules/mac-address',
        'validation/1.x/rules/max',
        'validation/1.x/rules/max-digits',
        'validation/1.x/rules/min',
        'validation/1.x/rules/min-digits',
        'validation/1.x/rules/missing',
        'validation/1.x/rules/multiple-of',
        'validation/1.x/rules/not-in',
        'validation/1.x/rules/not-regex',
        'validation/1.x/rules/numeric',
        'validation/1.x/rules/object',
        'validation/1.x/rules/present',
        'validation/1.x/rules/prohibited',
        'validation/1.x/rules/prohibits',
        'validation/1.x/rules/regex',
        'validation/1.x/rules/required',
        'validation/1.x/rules/required-keys',
        'validation/1.x/rules/same',
        'validation/1.x/rules/starts-with',
        'validation/1.x/rules/starts-without',
        'validation/1.x/rules/string',
        'validation/1.x/rules/timezone',
        'validation/1.x/rules/ulid',
        'validation/1.x/rules/uppercase',
        'validation/1.x/rules/url',
        'validation/1.x/rules/uuid',
        'validation/1.x/validate',
    ],
];

$coverages = [];

foreach ($libraries as $library => $cases) {
    xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);

    foreach ($cases as $case) {
        [$exception] = $attempt(fn () => import($case)($assert));

        if ($exception) {
            throw $exception;
        }
    }

    xdebug_stop_code_coverage(false);

    $coverage = [];

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($library));
    $files = array();

    /** @var SplFileInfo $file */
    foreach ($iterator as $file) {
        if ($file->isDir()) {
            continue;
        }

        if (str_starts_with($file->getFilename(), '.')) {
            continue;
        }

        $coverage[realpath($file->getPathname())] = [0, []];
    }

    foreach (xdebug_get_code_coverage() as $file => $lines) {
        if (str_contains($file, $library)) {
            $covered = count(array_filter($lines, fn ($line) => $line == 1));
            $uncovered = count(array_filter($lines, fn ($line) => $line == -1));

            $coverage[realpath($file)] = [
                round(100 - ($uncovered / ($covered + $uncovered) * 100), 2),
                array_keys(array_filter($lines, fn ($line) => $line == -1)),
            ];
        }
    }

    // sort without extensions to mimic filesystem order
    uksort($coverage, function ($a, $b) {
        $a = explode('.', $a);
        $b = explode('.', $b);

        return $a <=> $b;
    });

    foreach ($coverage as $file => [$coverage, $uncovered]) {
        $formatted = $library . explode($library, $file)[1];

        $coverages[] = $coverage;

        print "{$formatted} ({$coverage}%)" . PHP_EOL;

        if (count($uncovered ?? [])) {
            print '  → ' . join(', ', $uncovered) . PHP_EOL;
        }
    }
}

$average = round(array_sum($coverages) / count($coverages), 2);
print "assertions: {$assertions}" . PHP_EOL;
print "average: {$average}%" . PHP_EOL;
