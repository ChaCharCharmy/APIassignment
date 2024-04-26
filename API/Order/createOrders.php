<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

$orders = new Orders($db);

$data = json_decode(file_get_contents('php://input'));

$orders->items = $data->items;
$orders->status = $data->status;
$orders->datetime = $data->datetime;
$orders->price = $data->price;

if($orders->create()){
    echo json_encode(array('message' => 'order created.'));
}
else{
    echo json_encode(array('message' => 'order not created.'));
}