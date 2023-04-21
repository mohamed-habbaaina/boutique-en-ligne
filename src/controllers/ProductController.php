<?php
namespace src\controllers;
use src\Classes\Product;

require_once($_SERVER['DOCUMENT_ROOT'] . '/boutique-en-ligne/src/Classes/Product.php');

Class ProductController{

    public $product;

    public function __construct()
    {
        $this->product = new Product();

    }

    public function addRate($value_rat, $id_user, $id_pro)
    {
        
        if($id_rate=$this->product->isRated($id_user, $id_pro)){

            $this->product->updateRate($id_rate, $value_rat, $id_user, $id_pro);

        }else{
            if($value_rat >= 1 && $value_rat <= 5){
            $this->product->insertRate($value_rat, $id_user, $id_pro);
            }
        }

    }

    public function fetchRate($id_pro){
        $this->product->selectRate($id_pro);
    }

    public function getMostLiked(){
      return $this->product->selectMostLiked();
    }

    public function getCategory(){
        return $this->product->selectAllCategory();
    }

    public function getOrigin(){
        return $this->product->selectAllOrigin();

    }

    public function displayCategory($category){
        return $this->product->selectOneCategory($category);
    }
    
    public function displayOrigin($origin){
        return $this->product->selectOneOrigin($origin);
    }

    

}
?>