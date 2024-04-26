<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../../core/initialize.php');

$ingredients = new Ingredients($db);
$ingredients->id = isset($_GET['id'])? $_GET['id'] : die();

if($ingredients->delete()){
    echo json_encode(array('message'=>'ingredient deleted.'));
}
else{
    echo json_encode(array('message'=>'ingredient NOT deleted.'));
}