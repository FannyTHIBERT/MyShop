<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');


//est-ce que l'id existe et n'est pas vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){
    $db=connect_db();
    $id = strip_tags($_GET['id']);
    $bddCategories = 'SELECT * FROM users WHERE id=:id;';
    $query1 = $db->prepare($bddCategories);
    $query1->bindValue(':id', $id, PDO::PARAM_INT);
    $query1->execute();
    $result1 = $query1->fetch();
    $is_admin=$result1['admin'] ;
    
       if(!$result1){
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('Location: users_admin.php');
        }
    }else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: users_admin.php');
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
    <title>Détails du compte</title>


</head>
<body>
    <main class="container">
    <div class="row adminbtn">
                <h1></hi></br>
                <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
                <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
                <a class="btn btn-secondary-menu" href="products_admin.php">Products</a>
                    <hr>
                <h1>Détails du compte <?= $result1['name'] ?></h1>
                <p>ID : <?= $result1['id'] ?></p>
                <p>Username : <?= $result1['username'] ?></p>
                <p>Email : <?= $result1['email'] ?></p>
                <p>Type de compte : <?= $result1['admin'] ?></p>
                <p>Crée le : <?= $result1['created_at'] ?></p>
                <p><a class="btn btn-dark" href="users_admin.php">Retour</a> <a class="btn btn-warning" href="users_edit.php?id=<?= $result1['id'] ?>">Modifier</a> <a class="btn btn-danger" href="users_delete.php?id=<?= $result1['id'] ?>">Supprimer</a></p>
        </div>

                
        </div>
    </main>
</body>
</html>