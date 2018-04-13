<?php

require_once dirname(dirname(__DIR__)) . '/templates/layouts/autoload.php';

use app\Classes\AutoModel;
use app\Common\CommonHelpers;

CommonHelpers::checkImage();

CommonHelpers::checkIfEmpty($_POST);

CommonHelpers::validateImage($_FILES);

(new AutoModel())->create($_POST, $_FILES);
