<?php
session_start();

require_once('./../Classes/Product.php');

// use src\Class;

$shop = new src\Classes\Product();

// Get the page number stored in the global session variable, and use it for paging 'OFFSET'.

$page = isset($_SESSION['page']) ? (int)$_SESSION['page'] : 1;

// get 8 items per page.
$numberArticl = 8;
$offset = ($page - 1) * $numberArticl;

$data = $shop->getAllProduct($offset);

echo json_encode($data);