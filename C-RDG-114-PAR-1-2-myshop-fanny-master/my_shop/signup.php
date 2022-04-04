<?php

require_once('inc/add_user.php');
include_once('inc/search.php');
include_once('inc/logout.php');
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
logout();
session_start();

if(!is_null($_POST["valid_connection"]))
{create_account_validation($name=$_POST["name"],$email=$_POST["email"],$password=$_POST["password"],$password=$_POST["password_confirmation"]);}

if (is_logged() && !is_admin()){header('Location: my_account.php');}


include('inc/header.php');


manage_php_session();

//fonction "logout" A compléter avec le lien de déconnexion / Renvoie vers la page de login
if(isset($_GET["action"]) && !empty($_GET["action"]) && ($_GET["action"] == "logout"))
{
    clean_php_session();
    header('Location: signin.php');
}
 
// On ne lance la verification qu'au clic sur Valider


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account_creation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    
</head>
<body>   


<!-- <h1>Mon compte </h1> -->



    <?php 
// gestion des messages d'erreur
if(!is_null($_SESSION['error_user_message'])): ?>
<div class="row"><section class="col-12">
<a class="alert alert-danger"><?=htmlspecialchars($_SESSION['error_user_message']) ?></a>
</div>
<?php unset($_SESSION['error_user_message']);?>
<?php endif; ?>





    <div class="" id="login-form-wrap">
    <!-- <h1>Mon compte </h1> -->
    <h2>SIGNUP</h2>

    <form id="login-form" action="signup.php" method="POST">
        <p>
            <input type="text" id="name" name="name" placeholder="Nom" required><i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="text" id="email" name="email" placeholder="email" required><i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="password" id="password" name="password" placeholder="password" required><i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="password confirmation" required><i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="submit" id="valid_connection" name="valid_connection"  placeholder="Valider">
        </p>
    </form>
    <div id="create-account-wrap">
        <p> <a href="signin.php">J'ai déjà un compte</a> <p>
    </div>
    </div>


    </body>
</html>



