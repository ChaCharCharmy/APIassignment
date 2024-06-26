<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../core/initialize.php');

// Create instance of User
$user = new User($db);

// Call a function from User instance
$result = $user->read();
$num = $result->rowCount();

if($num > 0){
    $user_list = array();
    $user_list['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $user_item = array(
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        );
        // add current user into list
        array_push($user_list['data'], $user_item);
    }
    echo json_encode($user_list);
}
else{
    // json format always works in arrays
    echo json_encode(array('message'=>'Incorrect credentials.'));
}