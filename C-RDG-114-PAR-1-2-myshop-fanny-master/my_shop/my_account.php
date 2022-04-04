<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
require_once('inc/modify_user.php');
include('inc/header.php');

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $id=$_SESSION['user_id'];
    $db = connect_db();
    $bddCategories = 'SELECT * FROM users WHERE id=:id;';
    $query1 = $db->prepare($bddCategories);
    $query1->bindValue(':id', $id, PDO::PARAM_INT);
    $query1->execute();
    $result1 = $query1->fetch();
}

if (!is_null($_POST['enregistrer'])) {
    modify_account_validation_user($result1['id'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm'], $result1['admin']);
    }

if(isset($_GET["action"]) && !empty($_GET["action"]) && ($_GET["action"] == "logout"))
{
    logout();
    clean_php_session();
    header('Location: signin.php');
}


   

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un user</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

<main class="container">
<?php if(is_logged()): ?>
<a class="nav-link" ><center>Bienvenue <?=htmlspecialchars($_SESSION['username']) ?> !</center></a>

<?php endif; ?>   
<?php if(is_admin()==true): ?>
<a class="nav-item"><a class="nav-link" href="admin.php"> <center>Console d'administration</center></a> 
<?php endif; ?>   



        <div class="row">
            <section class="col-12">
            <?php
                    if(!empty($_SESSION['error_user_message'])){
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_user_message'].'
                        </div>';
                        $_SESSION['error_user_message']="";
                    }
                ?>

                <?php
                    if(!empty($_SESSION['success_user_message'])){
                        echo '<div class="alert alert-success" role="success">' . $_SESSION['success_user_message'].'
                        </div>';
                        $_SESSION['success_user_message']="";
                    }
                ?>              

                <h1><center>Mon compte</center></h1> 
                <!-- <a class="nav-link" href="signin.php?action=logout">Se déconnecter</a> -->


                <form method="post">
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?= $result1['username'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?= $result1['email'] ?>" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="password">Modifier mon Password</label>
                        <input type="text" name="password" id="password" value="" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="password_confirm">Confirmer mon Password</label>
                        <input type="text" name="password_confirm" id="password_confirm" value="" class="form-control">
                    </div>


                    <div class="form-group">
                    <input type="submit" name="enregistrer" id="enregistrer" class="btn btn-secondary-menu" placeholder="enregistrer">
                    </div>
                </form>
            </section>
        </div>    
    </main>
</body>
</html>
