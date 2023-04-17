<?php

namespace src\controllers;

use src\Classes\Product;
use src\Classes\User;

require_once('../Classes/User.php');
require_once('../Classes/Product.php');

class AdminController
{

    public $user;
    public $product;

    public function __construct()
    {
        $this->user = new User();
        $this->product = new Product();
    }

    public function getInfo($id){
        return $this->user->getData($id);
    }

    public function getAllProduct(){
        $this->product->getAllProductData();
    }
}
