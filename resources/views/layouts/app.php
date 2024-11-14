<!doctype html>
<html lang="en">
    <head>
        <link href="/app.css" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    </head>
    <body>
        <div class="container mx-auto">
            <?php print $this->include('includes/nav') ?>
        </div>
        <div class="container mx-auto">
            <?php print $this->get('slot'); ?>
        </div>
    </body>
</html>
