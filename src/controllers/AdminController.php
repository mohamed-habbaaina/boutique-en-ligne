<?php

namespace src\controllers;

use src\Classes\Product;
use src\Classes\User;

require_once($_SERVER['DOCUMENT_ROOT'] . '/boutique-en-ligne/src/Classes/Product.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/boutique-en-ligne/src/Classes/User.php');

class AdminController
{

    public $user;
    public $product;

    public function __construct()
    {
        $this->user = new User();
        $this->product = new Product();
    }

    public function getInfo($id)
    {
        return $this->user->getData($id);
    }

    public function getUserOrders($id)
    {
        return $this->user->getUserOrders($id);
    }

    public function getProductData()
    {
        $products = [];
        $i = 0;
        do {
            $tmpProducts = $this->product->getAllProduct($i);
            $products = array_merge($products, $tmpProducts);
            $i += 8;
        } while (!empty($tmpProducts));
        echo json_encode($products);
    }
}
