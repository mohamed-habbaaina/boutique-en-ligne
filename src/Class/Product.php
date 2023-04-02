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
     * @return array fetch_assoc
     */
    public function getProduct(int $idProduct): array
    {
        $sqlIdProduct = 'SELECT * FROM `product` WHERE id_pro=:id LIMIT 1';
        $dataProcut = DbConnection::getDB()->prepare($sqlIdProduct);
        $dataProcut->bindParam(':id', $idProduct);
        $dataProcut->execute();
        return $dataProcut->fetch(\PDO::FETCH_ASSOC);

    }

    /**
     * method to get all products limit 6 offset 8/page
     */
    public function getAllProduct(int $offset): array
    {
        $sqlAllProduct = 'SELECT * FROM `product` LIMIT 8 OFFSET ' . $offset;
        $dataAllProduct = DbConnection::getDb()->prepare($sqlAllProduct);
        $dataAllProduct->execute();
        return $dataAllProduct->fetchAll(\PDO::FETCH_ASSOC);
    }
}
$produit = new Product();

var_dump($produit->getAllProduct(0));