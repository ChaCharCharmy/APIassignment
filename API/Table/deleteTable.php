<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../core/initialize.php');

// Create instance of Table
$table = new Table($db);
$table->tableId = isset($_GET['id'])? $_GET['id'] : die();

if($table->delete()){
    echo json_encode(array('message'=>'Table deleted.'));
}
else{
    echo json_encode(array('message'=>'Table NOT deleted.'));
}