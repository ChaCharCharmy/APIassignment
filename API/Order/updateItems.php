<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

$orders = new Orders($db);

$data = json_decode(file_get_contents('php://input'));

$orders->id = $data->id;
$orders->items = $data->items;

if($orders->updateCategory()){
    echo json_encode(array('message'=>'order updated.'));
}
else{
    echo json_encode(array('message'=>'order NOT updated.'));
}