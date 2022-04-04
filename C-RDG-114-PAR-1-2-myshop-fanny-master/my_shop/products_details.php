<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');

//est-ce que l'id existe et n'est pas vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $db=connect_db();
    $bddCategories = 'SELECT * FROM products WHERE id=:id;';
    $query1 = $db->prepare($bddCategories);
    $query1->bindValue(':id', $id, PDO::PARAM_INT);
    $query1->execute();
    $result1 = $query1->fetch();
        if(!$result1){
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('Location: products_admin.php');
        }
    }else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: products_admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Détails des produits</title>
</head>
<body>
    <main class="container">
    <div class="col adminbtn">
            
            
            <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
            <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
            <a class="btn btn-secondary-menu" href="products_admin.php">Products</a>
            <h1>Détails du produit <?= $result1['name'] ?></h1>
       
            <hr> 
            <p>ID : <?= $result1['id'] ?></p>
                <p>Name : <?= $result1['name'] ?></p>
                <p>Category_id : <?= $result1['category_id'] ?></p>
                <p>description : <?= $result1['description'] ?></p>
                <p>littleimg : <?= $result1['littleimg'] ?></p>
                <p>bigimg : <?= $result1['bigimg'] ?></p>
                
                <p><a class="btn btn-dark" href="products_admin.php">Retour</a> <a class="btn btn-warning" href="products_edit.php?id=<?= $result1['id'] ?>">Modifier</a> <a class="btn btn-danger" href="products_delete.php?id=<?= $result1['id'] ?>">Supprimer</a></p>
       </div>



                
               
            <
    </main>
</body>
</html>