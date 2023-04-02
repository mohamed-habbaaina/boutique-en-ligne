<?php
namespace src\Class;

require_once('./ConnectDb.php');

class Product
{
    public function __construct()
    {

    }

    /**
     * method to get product by id
     */
    public function getProduct(int $idProduct): null|array
    {
        $sqlIdProduct = 'SELECT * FROM `product` WHERE id_pro=:id LIMIT 1';
        $dataProcut = \DbConnection::getDB()->prepare($sqlIdProduct);
        $dataProcut->bindParam(':id', $idProduct);
        $dataProcut->execute();
        return $dataProcut->fetch();

    }

    // public function getAllProduct(): ?array
    // {
// 
    // }
}
$produit = new Product();

var_dump($produit->getProduct(3));