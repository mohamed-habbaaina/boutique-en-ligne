<?php
require_once('./../Classes/Product.php');

$product = new \src\Classes\Product();

$req = $_GET['search'];
$data = $product->getSearchProduct($req);

echo json_encode($data);