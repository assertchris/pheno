<?php

return export(default: function (int $code) {
    http_response_code($code);
    exit;
});
