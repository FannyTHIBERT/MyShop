<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');
require_once('inc/close.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    
</head>
<body>   


<?php

      

        // Afficher tous les éléments "categories" de la bdd
        $db=connect_db();
        $var="categories";
        $bddCategories = "SELECT * FROM ".$var;
        $query1=$db->prepare($bddCategories);
        $query1->execute();
        $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        
?>    


    
    <main class="container">
        <div class="col adminbtn">
            
            
                <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
                <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
                <a class="btn btn-secondary-menu" href="products_admin.php">Products</a>
                <h1>Categories</h1>
                <a  a href="categories_add.php" id="add" alt="add" class="btn btn-secondary-menu">Ajouter une catégorie</a>
        </div>
        <div class="row">
            <section class="col">
                
                <?php
                    if(!empty($_SESSION['success_admin_message'])){
                        echo '<div class="alert alert-success" role="success">' . $_SESSION['success_admin_message'].'
                        </div>';
                        $_SESSION['success_admin_message']='';
                    }
                                    ?>

                <div class=>
                
                </div>

                <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent_id</th>
                </thead>
                <tbody>
                    <?php
                    //boucle sur la variable result1
                    foreach($result1 as $categories){
                        ?>
                        <tr>
                            <td><?= $categories['id'] ?></td>
                            <td><?= $categories['name'] ?></td>
                            <td><?= $categories['parent_id'] ?></td>
                            <td id ="catadmbtn" class="adminbtn ">
                                <a class="btn btn-info" id="read" alt="read" href="categories_details.php?id=<?= $categories['id'] ?>">Détails</a>  
                                <a class="btn btn-warning" id="edit" alt="edit" href="categories_edit.php?id=<?= $categories['id'] ?>">Modifier</a>  
                                <a class="btn btn-danger" id="delete" alt="delete" href="categories_delete.php?id=<?= $categories['id'] ?>">Supprimer</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                        </tbody>
                    </table> 
            
            </section>
        </div>
    </main>      
</body>
</html>
