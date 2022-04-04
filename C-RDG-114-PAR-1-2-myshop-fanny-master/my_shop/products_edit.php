<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');
require_once('inc/add_user.php');
require_once('inc/add_user.php');
include('inc/modify_product.php');
require_once('inc/modify_category.php');

if(isset($_SESSION['error_admin_in_page_message'])): ?>
    <a class="alert alert-danger" role="alert"><?=htmlspecialchars($_SESSION['error_admin_in_page_message'])?></a>
    <?php unset($_SESSION['error_admin_in_page_message']);?>
    <?php endif; 


$cat=get_category();


if(!is_null($_POST["enregistrer"])) 
{ // début de la fonction 1er if
     if (modify_product_complete($id=$_GET['id'],$name=$_POST['name'],$price=$_POST['price'],$category_id=$_POST['category_id'],$description=$_POST['description'],$littleimg=$_POST['littleimg'],
    $bigimg=$_POST['bigimg'])) // si formulaire complet, on regarde la validité    
    { // début du 2eme if
    if ( modify_product_validation($name=$_POST['name'],$price=$_POST['price'],$description=$_POST['description'],$littleimg=$_POST['littleimg'],
        $bigimg=$_POST['bigimg']) ) 
        // debut du 3eme if
        { modify_product($id=$_GET['id'],$name=$_POST['name'],$price=$_POST['price'],$category_id=$_POST['category_id'],$description=$_POST['description'],$littleimg=$_POST['littleimg'],
        $bigimg=$_POST['bigimg']);   } else {header("Location:   products_edit.php?id=$_GET[id]");}
        }  else {header("Location:   products_edit.php?id=$_GET[id]");} 
}//fin de la fonction 1er id


if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
     $bddProducts = "SELECT * FROM `products` WHERE `id`=:id;";
    $db=connect_db();
     $query1 = $db->prepare( $bddProducts);
    $query1->bindValue(':id', $id, PDO::PARAM_INT);
    $query1->execute();
    $result1 = $query1->fetch();
    if(!$result1){
    $_SESSION['error_admin_message'] = "Cet id n'existe pas";
    header('Location: products_admin.php');
    }
    }else{
    $_SESSION['error_admin_message'] = "URL invalide";
    header('Location: products_admin.php');
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
    <title>Modifier un produit</title>
</head>
<body> 
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                                      
                    if(!empty($_SESSION['success_error_message'])){
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['success_admin_message'].'
                        </div>';
                        $_SESSION['success_admin_message']="";
                  }


                ?>




<main class="container">
    <div class="col adminbtn">
            
            
            <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
            <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
            <a class="btn btn-secondary-menu" href="products_admin.php">Products</a>
            <h1>Modifier un produit</h1>
       
            <hr>    
            <form method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="<?= $result1['name'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" value="<?= $result1['price'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category_id</label>
                                <select name="category_id" id="category_id" class="form-control">
                                <?php foreach($cat as $categ){ ?>
                                    <option value="<?= $categ['id'] ?>"  <?php if($result1['category_id'] == $categ['id']){ echo 'selected' ;} ?>> <?= $categ['name'] ?></option>
                                <?php } ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" value="<?= $result1['description'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="littleimg">Littleimg</label>
                                <input type="text" name="littleimg" id="littleimg" value="<?= $result1['littleimg'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="bigimg">Bigimg</label>
                                <input type="text" name="bigimg" id="bigimg" value="<?= $result1['bigimg'] ?>" class="form-control">
                            </div>
                            
                            </div>
        <input type="submit" name="enregistrer" id="enregistrer" class="btn btn-primary" placeholder="enregistrer">
        </div>       </div>



                
                    
                        </form>
                              </section>

                              
     


        </div>    
    </main>
</body>
</html>