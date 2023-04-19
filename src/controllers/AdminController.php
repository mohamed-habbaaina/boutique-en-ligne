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

    public function getUserInfo($id)
    {
        return $this->user->getData($id);
    }

    public function getProductInfo($id)
    {
        return $this->product->getProduct($id);
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

    public function delUser($id) {
        $this->user->delUser($id);
    }

    public function delProduct($id) {
        $this->product->delProduct($id);
    }

    public function changeName($id, $newName) {
        $this->product->updateName($id, $newName);
    }

    public function changeCategory($id, $newCategory) {
        $this->product->updateCategory($id, $newCategory);
    }
    
    public function changeCategoryDescription($id, $newCategoryDescription) {
        $this->product->updateCategoryDescription($id, $newCategoryDescription);
    }

    public function changeDescription($id, $newDescription) {
        $this->product->updateDescription($id, $newDescription);
    }

    public function changeOrigin($id, $newOrigin) {
        $this->product->updateOrigin($id, $newOrigin);
    }

    public function changeOriginDescription($id, $newOriginDescription) {
        $this->product->updateOriginDescription($id, $newOriginDescription);
    }

    public function changePrice($id, $newPrice) {
        $this->product->updatePrice($id, $newPrice);
    }
}
