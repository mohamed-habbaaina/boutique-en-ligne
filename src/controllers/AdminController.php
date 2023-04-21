<?php

namespace src\controllers;

use src\Classes\Product;
use src\Classes\User;
use src\model\ContactModel;

require_once($_SERVER['DOCUMENT_ROOT'] . '/boutique-en-ligne/src/Classes/Product.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/boutique-en-ligne/src/Classes/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/boutique-en-ligne/src/model/ContactModel.php');

class AdminController
{

    public $user;
    public $product;
    public $contact;

    public function __construct()
    {
        if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin') {
            return "Access denied, you have to be admin";
        } else {
            $this->user = new User();
            $this->product = new Product();
            $this->contact = new ContactModel();
        }
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

    public function getMessagesList()
    {
        return $this->contact->getAllMessages();
    }

    public function getMessage($id)
    {
        return $this->contact->getMessage($id);
    }

    public function delMessage($id)
    {
        $this->contact->delMessage($id);
    }

    public function delUser($id)
    {
        $this->user->delUser($id);
    }

    public function delProduct($id)
    {
        $this->product->delProduct($id);
    }

    public function changeName($id, $newName)
    {
        $this->product->updateName($id, $newName);
    }

    public function changeCategory($id, $newCategory)
    {
        $this->product->updateCategory($id, $newCategory);
    }

    public function changeCategoryDescription($id, $newCategoryDescription)
    {
        $this->product->updateCategoryDescription($id, $newCategoryDescription);
    }

    public function changeDescription($id, $newDescription)
    {
        $this->product->updateDescription($id, $newDescription);
    }

    public function changeOrigin($id, $newOrigin)
    {
        $this->product->updateOrigin($id, $newOrigin);
    }

    public function changeOriginDescription($id, $newOriginDescription)
    {
        $this->product->updateOriginDescription($id, $newOriginDescription);
    }

    public function changePrice($id, $newPrice)
    {
        $this->product->updatePrice($id, $newPrice);
    }

    public function changeProductImage($id, $imageData)
    {
        // vérifier si il n'y a pas d'erreur
        if ($imageData['error'] == 0) {
            // vérifier la taille du fichier
            if ($imageData['size'] <= 2000000) {
                // Autoriser seulement certaines extensions
                $fileInfo = pathinfo($imageData['name']);
                $extension = $fileInfo['extension'];
                $allowedExtentions = ['jpg', 'jpeg', 'gif', 'png', 'bnp'];
                if (in_array($extension, $allowedExtentions)) {
                    // Stocker l'image
                    $imageName = basename($imageData['name']);
                    move_uploaded_file($imageData['tmp_name'], '../../uploads/' . $imageName);
                    $this->product->updateImage($id, $imageName);
                }
            }
        }
    }

    public function delComment($id)
    {
        if (isset($_SESSION) && $_SESSION['user']['role'] === 'admin') {
            echo "ok";
            $this->product->delComment($id);
        }
    }
}
