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
        return $data['id_cart'] ?? false;
    }

    /**
     * Create i new cart "en cours".
     */
    public function insertCart(int $id_user): void
    {
        $reqInsertCart = "INSERT INTO `cart`(`id_user`, `state_car`) VALUES (:id_user,'en cours')";
        $insertNewCart = DbConnection::getDb()->prepare($reqInsertCart);
        $insertNewCart->bindParam(':id_user', $id_user);
        $insertNewCart->execute();

    }

    /**
     * check the database to see if the product has been ordered before by the user
     */
    public function selectProductCartQantity($id_cart, $id_product): array | bool
    {
        $reqSelecCart = 'SELECT quantity FROM `cart_product` WHERE id_cart = :id_cart AND id_pro = :id_product';
        $dataSelectCart = DbConnection::getDb()->prepare($reqSelecCart);
        $dataSelectCart->bindParam(':id_cart', $id_cart);
        $dataSelectCart->bindParam(':id_product', $id_product);
        $dataSelectCart->execute();

        $dataQantity = $dataSelectCart->fetch(\PDO::FETCH_ASSOC);
        return $dataQantity ?? false;

    }

    /**
     * Update "quantity" in cart_product
     */
    public function updatProductCart(int $quantity, int $id_cart, int $id_product): void
    {
        $reqUpdat = "UPDATE `cart_product` SET `quantity` = :quantity WHERE `cart_product`.`id_cart` = :id_cart AND `cart_product`.`id_pro` = :id_product";
        $reqUpdatCart = DbConnection::getDb()->prepare($reqUpdat);
        $reqUpdatCart->bindParam(':quantity', $quantity);
        $reqUpdatCart->bindParam(':id_cart', $id_cart);
        $reqUpdatCart->bindParam(':id_product', $id_product);
        $reqUpdatCart->execute();
    }

    /**
     * Create in cart_product "quantity" where id_caet && id_product.
     */
    public function insertProductCart($id_cart, $id_product, $quantity): void
    {
        $reqInsrt = "INSERT INTO `cart_product`(`id_cart`, `id_pro`, `quantity`) VALUES (:id_cart, :id_product, :quantity)";
        $reqInsertCart = DbConnection::getDb()->prepare($reqInsrt);
        $reqInsertCart->bindParam(':id_cart', $id_cart);
        $reqInsertCart->bindParam(':id_product', $id_product);
        $reqInsertCart->bindParam(':quantity', $quantity);
        $reqInsertCart->execute();

    }
}