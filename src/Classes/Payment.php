<?php
namespace src\Classes;

require_once('DbConnection.php');
require_once('Cart.php');

class Payment extends Cart {

    public function __construct(){

    }

    public function getAddressUser(int $id_user): array | bool
    {
        $reqAdress = 'SELECT * FROM `customer` WHERE id_user = :id_user LIMIT 1';
        $dataAdress = DbConnection::getDb()->prepare($reqAdress);
        $dataAdress->bindParam(':id_user', $id_user);
        $dataAdress->execute();
        return $dataAdress->fetch(\PDO::FETCH_ASSOC) ?? false;
    }

    /**
     * 
     */
    public function payment(int $id_user, int $id_cart, $total): void
    {
            $reqPayment = 'INSERT INTO `purshase`(`date_ord`, `id_cart`, `total`) VALUES (NOW(), :id_cart, :total)';
            $reqInsertPayment = DbConnection::getDb()->prepare($reqPayment);
            $reqInsertPayment->bindParam(':id_cart', $id_cart);
            $reqInsertPayment->bindParam(':total', $total);
            $reqInsertPayment->execute();
    }

    /**
     * 
     */
    public function setStateCart(int $id_cart): void
    {
        $reqState = "UPDATE `cart` SET `state_car`='closed' WHERE `id_cart`= :id_cart";
        $reqSetState = DbConnection::getDb()->prepare($reqState);
        $reqSetState->bindParam(':id_cart', $id_cart);
        $reqSetState->execute();
    }

    /**
     * stored user delivery data
     */
    public function insertAddress(int $id_user, string $address, string $zip, string $phone = null): void
    {
        $reqInsrtAds = 'INSERT INTO `customer`(`id_user`, `address_cus`, `phone_cus`, `zip_cus`) VALUES (:id_user, :address, :phone, :zip)';

        $reqInsertAddress = DbConnection::getDb()->prepare($reqInsrtAds);
        $reqInsertAddress->bindParam(':id_user', $id_user);
        $reqInsertAddress->bindParam(':address', $address);
        $reqInsertAddress->bindParam(':phone', $phone);
        $reqInsertAddress->bindParam(':zip', $zip);

        $reqInsertAddress->execute();

    }

}