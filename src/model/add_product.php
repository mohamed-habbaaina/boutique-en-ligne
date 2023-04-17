<?php
use src\Classes\Product;
require_once('./../Classes/Product.php');

$product = new src\Classes\Product();

if(isset($_POST['name']))
{
    // display message JS
    $message = [];

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $origin = $_POST['origin'];
    $origin_descript = $_POST["origin_descript"];
    $category = $_POST['category'];
    $category_descript = $_POST["category_descript"];
    
    
    $imageName = $_FILES['image']['name'];
    $imageType = $_FILES['image']['type'];
    $imageSize = $_FILES['image']['size'];
    $imageError = $_FILES['image']['error'];
    $image_tmp_name = $_FILES['image']['tmp_name'];

    if($name && $description && $price && $origin && $category)
    {

        $extensions = explode('.', $imageName);
        $typeImagePermit = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/jpg'];
    
        // check that the picture is uploaded.
        if($imageError === 0)
        {
            // Velidate photo size
            if($imageSize < 2000000)
            {
                // Validate double extensions.
                if(count($extensions) === 2)
                {
                    // validate type.
                    if(in_array($imageType, $typeImagePermit))
                    {
                        // upload image
                        // create image name (last id in DB), eg: last id === 15 => imageName === 16.
                        // image extension
                        $extension = strtolower($extensions[1]);
                        $imageNameDB = 'image' . $product->creatImageNewName() . '.' . $extension;
                        $path = './../../uploads/';
                        // send image to uploads folder.
                        move_uploaded_file($image_tmp_name, $path . $imageNameDB);
    
                        // insert into DB.
                        $product->insertProduct($name, $description, $price,$imageNameDB, $origin, $origin_descript, $category, $category_descript);

                        header("HTTP/1.1 201 create product");
    
                        $message[] = 'Votre Produit est bien enregistré !';
                        
                    }
                } else{
                    $message[] = 'Veuillez télécharger une image !';
                }
            } else
            {
                $message[] = 'Taille maximum autorisée 2 M !';
            }
        }
    } else{
        $message[] = 'Veuillez remplir tous les champs !';
    }

    if(!empty($message))
    {
        echo json_encode($message);
    } 
}

