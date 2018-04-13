<?php

include 'header.php';

require_once dirname(dirname(__DIR__)) . '/templates/layouts/autoload.php';

register_shutdown_function(function () {
    include 'footer.php';
});
