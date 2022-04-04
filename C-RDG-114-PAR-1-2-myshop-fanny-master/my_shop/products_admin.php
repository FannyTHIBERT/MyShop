<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">



</head>
<body>   
<?php
     
      
        // Afficher tous les éléments "categories" de la bdd
        $db=connect_db();
        $var="products";
        $bddProducts = "SELECT * FROM ".$var;
        $query=$db->prepare($bddProducts);
        $query->execute();
        $result1 = $query->fetchAll(PDO::FETCH_ASSOC);  
?>    
    <main class="container">
        <div class="row">
            <section class="col-12">
              
                
                    <?php if(!is_null($_SESSION['success_admin_message'])): ?>
                        <p> <a class="alert alert-success" role="success">'<?=htmlspecialchars($_SESSION['success_admin_message']) ?></a> </p>
                        <?php unset($_SESSION['success_admin_message']);?>
                        <?php endif; ?>
                        <div class="row">
           
                        <section class="col-12">
                <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
                <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
                <a class="btn btn-secondary-menu" href="products_admin.php"> Products </a>
            </section>
            </div>



                <h1>Products</h1>
                
                <div>
                <a href="products_add.php" class="btn btn-secondary-menu">Ajouter un produit</a>
                </div>
                
                <table class="table">
                <thead>
          
                    <th>ID</th>
                    <th>name</th>
                    <th>price</th>
                    <th>category_id</th>
                    <th>description</th>
                    <th>littleimg</th>
                    <th>bigimg</th>
                    </thead>
                <tbody>
                    <?php
                    //boucle sur la variable result1
                    foreach($result1 as $products){
                        ?>
                        <tr>
                            <td><?= $products['id'] ?></td>
                            <td><?= substr($products['name'],0, 20)?></td>
                            <td><?= $products['price'] ?></td>
                            <td><?= $products['category_id'] ?></td>
                            <td><?= substr($products['description'],0,20) ?></td>
                            <td><?= substr($products['littleimg'],0, 20) ?></td>
                            <td><?= substr($products['bigimg'],0,20) ?></td>
                            <td><a class="btn btn-info" href="products_details.php?id=<?= $products['id'] ?>">Détails</a>  <a class="btn btn-warning" href="products_edit.php?id=<?= $products['id'] ?>">Modifier</a>  <a class="btn btn-danger" href="products_delete.php?id=<?= $products['id'] ?>">Supprimer</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                        </tbody>
                    </table> 
            <a href="products_add.php" class="btn btn-secondary-menu">Ajouter un produit</a>
            </section>
        </div>
    </main>      
</body>
</html>
