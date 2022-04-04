<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');
require_once('inc/modify_category.php');


$cat=get_category();

if($_POST){
    if(isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['price']) && !empty($_POST['price'])
        && isset($_POST['category_id']) && !empty($_POST['category_id'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['littleimg']) && !empty($_POST['littleimg'])
        && isset($_POST['bigimg']) && !empty($_POST['bigimg']))
        
        {            
            $db=connect_db();
            $name = strip_tags($_POST['name']);
            $price= strip_tags($_POST['price']);
            $category_id= strip_tags($_POST['category_id']);
            $description= strip_tags($_POST['description']);
            $littleimg= strip_tags($_POST['littleimg']);
            $bigimg= strip_tags($_POST['bigimg']);
            $bddProducts = "INSERT INTO products (name, price, category_id, description, littleimg, bigimg) VALUES (:name, :price, :category_id, :description, :littleimg, :bigimg) ;";
            $query1 = $db->prepare($bddProducts);
            $query1->bindValue(':name', $name, PDO::PARAM_STR);
            $query1->bindValue(':price', $price, PDO::PARAM_INT);
            $query1->bindValue(':category_id', $category_id, PDO::PARAM_INT);
            $query1->bindValue(':description', $description, PDO::PARAM_STR);
            $query1->bindValue(':littleimg', $littleimg, PDO::PARAM_STR);
            $query1->bindValue(':bigimg', $bigimg, PDO::PARAM_STR);
            $query1->execute();
            $_SESSION['success_admin_message'] = "Produit ajouté avec succès !";
            header('Location: products_admin.php');
        }else{
            $_SESSION['error_admin_message'] = "Le formulaire n'est pas complet";
            header('Location: products_add.php');
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Ajouter un produit</title>
</head>
<body> 
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                   
                ?>

<main class="container">
    <div class="col adminbtn">
            
            
            <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
            <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
            <a class="btn btn-secondary-menu" href="products_admin.php">Products</a>
            <h1>Ajouter un produit</h1>
       
            <hr>    
            <form class="formedit" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Categorie </label>
                                <select name="category_id" id="category_id" class="form-control">
                                <?php foreach($cat as $categ){ ?>
                                    <option value="<?= $categ['id'] ?>"  <?php if($result1['category_id'] == $categ['id']){ echo 'selected' ;} ?>> <?= $categ['name'] ?></option>
                                <?php } ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="littleimg">Littleimg</label>
                                <input type="text" name="littleimg" id="littleimg" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="bigimg">Bigimg</label>
                                <input type="text" name="bigimg" id="bigimg" class="form-control">
                            </div>
                            <button name="creatbtn" class="btn btn-secondary-menu">Enregistrer</button>
                        </form>      
                    </div>



                
                    
            </section>
        </div>    
    </main>
</body>
</html>
