<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../core/initialize.php');

// Create instance of Table
$table = new Table($db);

$data = json_decode(file_get_contents('php://input'));

$table->tableId = $data->tableId;
$table->isOccupied = $data->isOccupied;

if($table->updateIsOccupied()){
    echo json_encode(array('message'=>'Table availability updated.'));
}
else{
    echo json_encode(array('message'=>'Table availability NOT updated.'));
}