<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
require_once('inc/modify_user.php');
include('inc/header_admin.php');

if (!is_null($_POST['enregistrer'])) {
    modify_account_validation($_GET['id'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm'], $_POST['admin']);
    }

if(isset($_SESSION['error_admin_in_page_message'])): ?>
    <a class="alert alert-danger" role="alert"><?=htmlspecialchars($_SESSION['error_admin_in_page_message'])?></a>
    <?php unset($_SESSION['error_admin_in_page_message']);?>
    <?php endif; 

if (!empty($_SESSION['success_admin2_message'])) {
     echo '<div class="alert alert-success" role="success">' . $_SESSION['success_admin2_message'] . '
     </div>';
     $_SESSION['success_admin2_message'] = "";
                }


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $db = connect_db();
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = $_POST['id'];
    }
    $bddCategories = 'SELECT * FROM users WHERE id=:id;';
    $query1 = $db->prepare($bddCategories);
    $query1->bindValue(':id', $id, PDO::PARAM_INT);
    $query1->execute();
    $result1 = $query1->fetch();

   if (!$result1) {
        $_SESSION['error_admin_message'] = "Cet id n'existe pas";
        header('Location: users_admin.php');
    }
} else {
    $_SESSION['error_admin_message'] = "URL invalide";
    header('Location: users_admin.php');
}

//est-ce que l'id existe et n'est pas vide dans l'url





?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un user</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>

<body>

    <main class="container">
        <div class="container adminbtnUser"
            <div class="row adminbtnUser ">
                

                <a class="btn btn-secondary-menu" href="users_admin.php">Users</a>
                <a class="btn btn-secondary-menu" href="categories_admin.php">Catégories</a>
                <a class="btn btn-secondary-menu" href="products_admin.php">Products</a>
                    <hr>
                <h1>Edit User<?= $result1['name'] ?></h1> 
            </div> 
        </div>
    
        <div class="row">
            <section class="col-12">
                
                            


                
                <form class="formedit" method="post">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?= $result1['username'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?= $result1['email'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Modifier le mot de passe</label>
                        <input type="text" name="password" id="password" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Confirmer le mot de passe</label>
                        <input type="text" name="password_confirm" id="password_confirm" value="" class="form-control">
                    </div>

                    <div class="form-group">
                                <label for="admin">Type de compte </label>
                                <select name="admin" id="admin" class="form-control">
                                <option value=0>-- Votre choix --  </option>   
                                <option <?php if($result1['admin'] ==1){ echo 'selected' ;} ?> value=1>Administrateur </option>
                                <option <?php if($result1['admin'] ==0){ echo 'selected' ;} ?> value=0>Classique</option>
                               

                                </select>
                            </div>
                </div>
        <input type="submit" name="enregistrer" id="enregistrer" class="btn btn-secondary-menu" placeholder="enregistrer">
        </div>
        </form>
        </section>
        </div>
    </main>
</body>


</html>