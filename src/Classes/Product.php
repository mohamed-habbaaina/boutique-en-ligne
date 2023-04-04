<?php
namespace src\Classes;

require_once('DbConnection.php');

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
        $sqlIdProduct = 'SELECT name_pro, description_pro, price_pro, image_pro, origin_pro, category_pro, AVG(value_rat) as avg_rating 
        FROM `product` LEFT JOIN `rate` 
        ON product.id_pro = rate.id_pro 
        WHERE product.id_pro=:id 
        GROUP BY product.id_pro LIMIT 1';
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
        $sqlAllProduct = 'SELECT product.id_pro, name_pro, price_pro, image_pro, category_pro, AVG(value_rat) as avg_rating 
        FROM `product` 
        LEFT JOIN `rate` 
        ON product.id_pro = rate.id_pro 
        GROUP BY product.id_pro 
        LIMIT 8 OFFSET ' . $offset;

        $dataAllProduct = DbConnection::getDb()->prepare($sqlAllProduct);
        $dataAllProduct->execute();
        return $dataAllProduct->fetchAll(\PDO::FETCH_ASSOC);
    }
}
// $produit = new Product();

// var_dump($produit->getAllProduct(0));