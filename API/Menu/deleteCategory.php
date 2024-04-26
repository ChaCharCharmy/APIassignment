<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

$category = new Menu($db);
$category->id = isset($_GET['id'])? $_GET['id'] : die();

if($category->delete()){
    echo json_encode(array('message'=>'category deleted.'));
}
else{
    echo json_encode(array('message'=>'category NOT deleted.'));
}