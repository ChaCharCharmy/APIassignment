<?php

// Set endpoints headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

// initialize API
include_once('../../core/initialize.php');

$category = new Menu($db);

$category->id = isset($_GET['id'])? $_GET['id'] : die();
$category->read_single();

$category_info = array(
    'id'        => $category->id,
    'categorys'  => $category->category
);

print_r(json_encode($category_info));