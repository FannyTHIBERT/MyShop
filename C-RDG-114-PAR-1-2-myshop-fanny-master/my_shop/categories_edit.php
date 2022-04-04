<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');

require_once('inc/modify_category.php');

$cat=get_category() ;
?>

<?php
if(isset($_SESSION['error_admin_in_page_message'])): ?>
    <a class="alert alert-danger" role="alert"><?=htmlspecialchars($_SESSION['error_admin_in_page_message'])?></a>
    <?php unset($_SESSION['error_admin_in_page_message']);?>
    <?php endif; ?>



    <?php
verify_category();
include('inc/header_admin.php');



if (verify_category()){

    $db=connect_db();
     $id = strip_tags($_GET['id']);
     $bddCategories = "SELECT * FROM `categories` WHERE `id`=:id;";
     $query1 = $db->prepare($bddCategories);
     $query1->bindValue(':id', $id, PDO::PARAM_INT);
     $query1->execute();
     $result1 = $query1->fetch();
    
}

if (verify_category()){

    if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['parent_id']) && !empty($_POST['parent_id'])){
        $db=connect_db();
        $id = strip_tags($_POST['id']);
        $name = strip_tags($_POST['name']);
        $parent_id = strip_tags($_POST['parent_id']);        
        $bddCategories = "UPDATE `categories` SET `name`=:name, `parent_id`=:parent_id WHERE `id`=:id;";
        $query1 = $db->prepare($bddCategories);
        $query1->bindValue(':id', $id, PDO::PARAM_INT);
        $query1->bindValue(':name', $name, PDO::PARAM_STR);
        $query1->bindValue(':parent_id', $parent_id, PDO::PARAM_INT);
        $query1->execute();

        $_SESSION['success_admin_message'] = "Catégorie modifiée";
        header('Location: categories_admin.php');
    }else{
        $_SESSION['error_admin_in_page_message'] = "Le formulaire est incomplet";
        header("Location: categories_edit.php?id=$_POST[id]");
    }
}
}
?>







<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une catégorie</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<main class="container">
        <div class="row">
            <section class="col-12">
            
<div class="row">
            <section class="col-12">
                <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
                <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
                <a class="btn btn-secondary-menu" href="products_admin.php">Products</a>
            </section>
        </div>
                <h1>Modifier une catégorie</h1>
                <form method="post">
                <div class="form-group">
                      id n° <?= $result1['id'] ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Nom de la catégorie</label>
                        <input type="text" name="name" id="name" value="<?= $result1['name'] ?>" class="form-control">
                    </div>
                    </div>
                            <div class="form-group">
                                <label for="category_id">Catégorie parent</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                    <?php foreach($cat as $categ){ ?>
                        <option value="<?= $categ['id'] ?>"  <?php if($result1['parent_id'] == $categ['id']){ echo 'selected' ;} ?>> <?= $categ['name'] ?></option>
                        <?php } ?>
                    
                </select>
                            </div>
                    <button name="creatbtn" class="btn btn-secondary-menu">Enregistrer</button>
                    <input type="hidden" name="id" value="<?= $result1['id'] ?>" class="form-control">
                </form>
            </section>
        </div>    
    </main>
</body>
</html>
