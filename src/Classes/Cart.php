<?php
namespace src\Classes;

require_once('DbConnection.php');
require_once('Product.php');

class Cart extends Product {

    public function __construct(){

    }

    /**
     * check the database to see if the product has been ordered before by the user
     */
    public function checkProductCart($id_user, $id_product): ?array
    {
        $reqSelecCart = 'SELECT * FROM `cart_product` WHERE id_user = :id_user AND id_product = :id_product';
        $dataSelectCart = DbConnection::getDb()->prepare($reqSelecCart);
        $dataSelectCart->bindParam(':id_user', $id_user);
        $dataSelectCart->bindParam(':id_product', $id_product);
        $dataSelectCart->execute();

        return $dataSelectCart->fetch();

    }

    /**
     * Add product in cart table.
     */
    public function addCart($id_user, $id_product, $product_quantity): void
    {
        $reqInserCart = 'INSERT INTO `cart_product` (`id_user`, `id_pro`, `quantity`) VALUES (:id_user, :id_pro, :quantity)';
        $dataInserCart = DbConnection::getDb()->prepare($reqInserCart);
        $dataInserCart->bindParam(':id_user', $id_user);
        $dataInserCart->bindParam(':id_pro', $id_product);
        $dataInserCart->bindParam(':quantity', $product_quantity);
        $dataInserCart->execute();

    }
}
