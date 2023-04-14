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
        $sqlIdProduct = 'SELECT product.id_pro, name_pro, description_pro, price_pro, image_pro, origin_pro, category_pro, AVG(value_rat) as avg_rating 
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


    /******************* Image name ********************/
    /***************************************************/

    // Get the last id in database
    public function getLastId()
    {
        $sqlLastId = 'SELECT `id_pro` FROM `product` ORDER BY id_pro DESC LIMIT 1';
        $lastId = DbConnection::getDb()->prepare($sqlLastId);
        $lastId->execute();
        return $lastId->fetch();

    }

    /* Creation of the image name that match the insert image id
    * eg: if last id = 20 => image name === 21 , image name === next id.
    */
    public function creatImageNewName(): string
    {
        $lastId = $this->getLastId();
        return (string)($lastId[0] + 1);
    }

    /**
     * add products to database
     */
    public function insertProduct(string $name, string $description, int $price, string $image, string $origin, string $category): void
    {
        $sqlInsert = 'INSERT INTO `product`(`name_pro`, `description_pro`, `price_pro`, `image_pro`, `origin_pro`, `category_pro`) VALUES (:name_pro, :description_pro, :price_pro, :image_pro, :origin_pro, :category_pro)';
        $reqInsertProduct = DbConnection::getDb()->prepare($sqlInsert);
        $reqInsertProduct->bindParam(':name_pro', $name);
        $reqInsertProduct->bindParam(':description_pro', $description);
        $reqInsertProduct->bindParam(':price_pro', $price);
        $reqInsertProduct->bindParam(':image_pro', $image);
        $reqInsertProduct->bindParam(':origin_pro', $origin);
        $reqInsertProduct->bindParam(':category_pro', $category);
        $reqInsertProduct->execute();

    }

    /* Get Product like $request.
    */
   public function getSearchProduct($request): ?array
   {
       $req = "SELECT * FROM `product` WHERE name_pro LIKE '%{$request}%' LIMIT 10";
       $reqSearch = DbConnection::getDb()->prepare($req);
       $reqSearch->execute();
       return $reqSearch->fetchAll(\PDO::FETCH_ASSOC);
   }
}
// $produit = new Product();

// $data = $produit->getImageNewName();
// var_dump($data);

// $produit->insertProduct('nameName', 'descriptiontest', 10, '1000', 'origin', 'categorie');