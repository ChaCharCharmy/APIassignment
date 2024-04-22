<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../core/initialize.php');

// Create instance of table
$table = new Table($db);

$data = json_decode(file_get_contents('php://input'));

$table->capacity = $data->capacity;
$table->isOccupied = $data->isOccupied;

if($table->create()){
    echo json_encode(array('message' => 'Table created.'));
}
else{
    echo json_encode(array('message' => 'Table not created.'));
}
