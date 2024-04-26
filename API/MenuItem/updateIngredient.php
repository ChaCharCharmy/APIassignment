<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

$item = new MenuItems($db);

$data = json_decode(file_get_contents('php://input'));

$item->id = $data->id;
$item->ingredient = $data->ingredient;

if($item->update()){
    echo json_encode(array('message'=>'item updated.'));
}
else{
    echo json_encode(array('message'=>'item NOT updated.'));
}