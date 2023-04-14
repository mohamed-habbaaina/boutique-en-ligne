<?php
namespace src\Classes;

require_once('DbConnection.php');
require_once('Product.php');

class Cart extends Product {

    public function __construct(){

    }

    public function selectIdCart( int $id_user): ?int
    {
        $reqIdCart = "SELECT id_cart FROM `cart` WHERE id_user=:id_user AND state_car = 'en cours'";
        $dataIdCart = DbConnection::getDb()->prepare($reqIdCart);
        $dataIdCart->bindParam(':id_user', $id_user);
        $dataIdCart->execute();
        $data = $dataIdCart->fetch(\PDO::FETCH_ASSOC);
        return $data['id_cart'];
    }

    public function insertCart(int $id_user): void
    {
        $reqInsertCart = "INSERT INTO `cart`(`id_user`, `state_car`) VALUES (:id_user,'en cours')";
        $insertNewCart = DbConnection::getDb()->prepare($reqInsertCart);
        $insertNewCart->bindParam(':id_user', $id_user);
        $insertNewCart->execute();

    }

    // INSERT INTO `cart`(`id_user`, `state_car`) VALUES ('1','termine');

    /**
     * check the database to see if the product has been ordered before by the user
     */


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
