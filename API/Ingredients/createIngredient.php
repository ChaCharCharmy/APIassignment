<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

$ingredients = new Ingredients($db);

$data = json_decode(file_get_contents('php://input'));

$ingredients->ingredients = $data->ingredients;
$ingredients->price = $data->price;

if($ingredients->create()){
    echo json_encode(array('message' => 'ingredient created.'));
}
else{
    echo json_encode(array('message' => 'ingredients not created.'));
}