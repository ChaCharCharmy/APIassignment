<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

$item = new MenuItems($db);

$data = json_decode(file_get_contents('php://input'));

$item->category = $data->category;
$item->items = $data->items;
$item->ingredient = $data->ingredient;
$item->price = $data->price;

if($item->create()){
    echo json_encode(array('message' => 'item created.'));
}
else{
    echo json_encode(array('message' => 'item not created.'));
}