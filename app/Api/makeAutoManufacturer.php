<?php

require_once dirname(dirname(__DIR__)) . '/templates/layouts/autoload.php';

use app\Classes\AutoManufacturer as autoMake;
use app\Common\CommonHelpers;
(new autoMake())->create($_POST[ 'manufacturer']);
return !CommonHelpers::checkIfEmpty($_POST[ 'manufacturer']) ? (new autoMake())->create($_POST[ 'manufacturer']) : 'Post Data seem to be empty!';
