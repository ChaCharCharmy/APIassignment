<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methodss: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../core/initialize.php');

// Create instance of User
$user = new User($db);

$data = json_decode(file_get_contents('php://input'));

$user->id = $data->id;
$user->username = $data->username;

if($user->updateUsername()){
    echo json_encode(array('message'=>'Username updated.'));
}
else{
    echo json_encode(array('message'=>'Username NOT updated.'));
}