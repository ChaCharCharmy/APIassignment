<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

// multiple access methods (i.e. PUT and PATCH )can be done but need to be connected to seperate functions
header('Access-Control-Allow-Methodss: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize API
include_once('../core/initialize.php');

// Create instance of User
$user = new User($db);

$data = json_decode(file_get_contents('php://input'));

$user->id = $data->id;
$user->username = $data->username;
$user->email = $data->email;
$user->password = $data->password;

if($user->update()){
    echo json_encode(array('message'=>'User updated.'));
}
else{
    echo json_encode(array('message'=>'User NOT updated.'));
}