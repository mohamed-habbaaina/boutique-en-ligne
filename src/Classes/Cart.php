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
     * Create new cart "en cours".
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
        $reqSelecCart = 'SELECT * FROM `cart_product` WHERE id_cart = :id_cart AND id_pro = :id_product';
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

    /**
     * ?Secure cart:
     * check if id_user corresponding to id_cart of $_session['id_user'].
     */
    public function checkSecureCart(int $id_cart, int $id_user): bool
    {
        $reqCartUser = 'SELECT `cart_product`.`id_cart`, `cart`.`id_user` AS user FROM `cart_product` INNER JOIN `cart` ON `cart_product`.`id_cart` = `cart`.`id_cart` WHERE `cart_product`.`id_cart` = :id_cart LIMIT 1';
        $dataCartUser = DbConnection::getDb()->prepare($reqCartUser);
        $dataCartUser->bindParam(':id_cart', $id_cart);
        if($dataCartUser->execute())
        {
            $dataSelectCartUser = $dataCartUser->fetch(\PDO::FETCH_ASSOC);
            if($dataSelectCartUser['user'] == $id_user)
            {
                return true;
            } else
            {
                return false;
            }
        }
        return false;
    }

    /**
     * Check if connected
     */
    public function isConnected(): bool
    {
        if(isset($_SESSION['user']))
        {
            return true;
        } else
        {
            return false;
        }
    }

    // check if id_cart exists in the database and store it in a  $_SESSION.
    public function getAllCart($id_cart): array | bool
    {
        $requAllCart = 'SELECT `cart_product`.*, `cart`.`id_user`, `product`.`name_pro`, `product`.`image_pro`, `product`.`price_pro` 
        FROM `cart_product` INNER JOIN `cart` 
        ON `cart_product`.`id_cart` = `cart`.`id_cart` 
        INNER JOIN `product` 
        ON `cart_product`.`id_pro` = `product`.`id_pro` 
        WHERE `cart`.`id_cart` = :id_cart';
        $dataAllCart = DbConnection::getDb()->prepare($requAllCart);
        $dataAllCart->bindParam(':id_cart', $id_cart);
        $dataAllCart->execute();
        return $dataAllCart->fetchAll(\PDO::FETCH_ASSOC) ?? false;
    }

    /**
     * SELECT id_cart WHERE email
     */
    public function checkIdCart($email): array | bool
    {
        $reqIdCart = "SELECT `id_cart` FROM `cart` INNER JOIN `user` 
        ON `cart`.`id_user` = `user`.`id_user` 
        WHERE `cart`.`state_car` = 'en cours' 
        AND `user`.`email` = :email";
        $idCart = DbConnection::getDb()->prepare($reqIdCart);
        $idCart->bindParam(':email', $email);
        $idCart->execute();

        return $idCart->fetch(\PDO::FETCH_ASSOC) ?? false;
    }

    /** 
     * Delete Product FROM cart_product tabel.
    */
    public function deletCartProduct($id_cart, $id_product): void
    {
        $reqDelet = 'DELETE FROM `cart_product` WHERE `id_cart`=:id_cart AND `id_pro`=:id_product';
        $deletProduct = DbConnection::getDb()->prepare($reqDelet);
        $deletProduct->bindParam(':id_cart', $id_cart);
        $deletProduct->bindParam(':id_product', $id_product);
        $deletProduct->execute();
    }

    /**
     * Get total cart 'en cours'.
     */
    public function getTotalCart(int $id_cart): array | bool
    {
        $reqTotal = "SELECT `cart_product`.`id_pro`, `cart_product`.`quantity`, `product`.`price_pro` 
        FROM `cart_product` INNER JOIN `cart` 
        ON `cart_product`.`id_cart` = `cart`.`id_cart` 
        INNER JOIN `product` 
        ON `cart_product`.`id_pro` = `product`.`id_pro` 
        WHERE `cart`.`state_car` = 'en cours' 
        AND `cart`.`id_cart` = :id_cart";

        $datatotalCart = DbConnection::getDb()->prepare($reqTotal);
        $datatotalCart->bindParam(':id_cart', $id_cart);
        $datatotalCart->execute();
        return $datatotalCart->fetchAll(\PDO::FETCH_ASSOC) ?? false;
    }
}
