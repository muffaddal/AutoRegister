<?php

require_once dirname(dirname(__DIR__)) . '/templates/layouts/autoload.php';

use app\Classes\AutoModel;


print_r($_POST);die;
/**
 * Update Sold status of the car
 */
if (!empty($_POST['sold_status'])) {

    $modelId        = $_POST['sold_status'];
    $soldStatus = (new AutoModel())->updateSoldStatus($modelId);
    echo json_encode($soldStatus);
    die;
}

/**
 * Get Data for Modal Pop up.
 */
if (!empty($_POST['model_id'])) {

    $modelId     = $_POST['model_id'];
    $listings = (new AutoModel())->get($modelId);
    echo json_encode($listings);
    die;
}
