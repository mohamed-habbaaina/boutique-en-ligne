<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/includes.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
    <?php require_once "./includes/header.php" ?>
    <button id="productDisplayBtn">Products</button>
    <button id="userDisplayBtn">Users</button>
    <button id="commentDisplayBtn">Comments</button>

    <div id="userDisplay">
        <p>USERS</p>
        <button id="userUpdateBtn">Update</button>
    </div>
    <div id="productDisplay">
        <p>PRODUCTS</p>
        <button id="productUpdateBtn">Update</button>
    </div>
    <div id="commentDisplay">
        <p>COMMENTS</p>
        <button id="commentUpdateBtn">Update</button>
    </div>
    
    <script src="./js/admin.js"></script>
</body>
</html>