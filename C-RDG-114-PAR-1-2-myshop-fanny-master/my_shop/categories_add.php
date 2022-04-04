<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
require_once('inc/modify_category.php');
include('inc/header_admin.php');

$cat=get_category();

if($_POST){
    if(isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['parent_id']) && !empty($_POST['parent_id'])){ 
            $db=connect_db();
            $name = strip_tags($_POST['name']);
            $parent_id = strip_tags($_POST['parent_id']);
            $bddCategories = "INSERT INTO `categories` (`name`, `parent_id`) VALUES (:name, :parent_id);";
            $query1 = $db->prepare($bddCategories);
            $query1->bindValue(':name', $name, PDO::PARAM_STR);
            $query1->bindValue(':parent_id', $parent_id, PDO::PARAM_INT);
            $query1->execute();
            $_SESSION['success_admin_message'] = "Catégorie ajouté avec succès !";
            header('Location: categories_admin.php');
        }else{
            $_SESSION['error_admin_message'] = "Le formulaire n'est pas complet";
            header('Location: categories_admin.php');
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
    <title>Ajouter une catégorie</title>
</head>
<body> 
    <main class="container ">
        <div class="row">
            <section class="col-12">
               
<div class="row ">
            <section class="col-12 ">
                <a id = "retourbtn"class="btn btn-secondary-menu " href="categories_admin.php">Retour</a>
                </section>
        </div>



                <h1>Ajouter une catégorie</h1>
                    <form method="POST">
                            <div class="form-group">
                                <label for="name">Nom de la catégorie</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Catégorie parent</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                    <?php foreach($cat as $categ){ ?>
                        <option value="<?= $categ['id'] ?>"  <?php if($result1['parent_id'] == $categ['id']){ echo 'selected' ;} ?>> <?= $categ['name'] ?></option>
                        <?php } ?>
                    
                </select>
                            </div>
                            <div>
                            <button name="creatbtn" class="btn btn-secondary-menu">Créer</button>
                            </div>
                        </form>
            </section>
        </div>    
    </main>
</body>
</html>
