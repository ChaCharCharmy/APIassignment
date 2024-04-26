<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

$category = new Menu($db);

$data = json_decode(file_get_contents('php://input'));

$category->category = $data->category;

if($category->create()){
    echo json_encode(array('message' => 'category created.'));
}
else{
    echo json_encode(array('message' => 'category not created.'));
}