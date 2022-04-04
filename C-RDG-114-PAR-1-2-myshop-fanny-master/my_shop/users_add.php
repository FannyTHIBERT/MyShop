<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
require_once('inc/close.php');
require_once('inc/add_user.php');
include('inc/header_admin.php');

if(!is_null($_POST["enregistrer"]))
{create_account_validation($name=$_POST["username"],$email=$_POST["email"],$password=$_POST["password"],$password=$_POST["password_conf"],$created_at=null, $is_admin=$_POST["is_admin"]);}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta username="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Ajouter un user</title>
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['error_admin_message'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_admin_message'] . '
                        </div>';
                    $_SESSION['error_admin_message'] = "";
                }
                ?>


<div class="row">
            <section class="col-12">
                <a class="btn btn-secondary-menu" style="color:white;" href="users_admin.php">Retour</a>
                </section>
        </div>
                <h1>Ajouter un user</h1>
                
                <hr>
         
                
                <form method="POST">
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                                  
                    
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="text" name="password" id="password" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="password_conf">password confirmation</label>
                        <input type="text" name="password_conf" id="password_conf" class="form-control">
                    </div>
                    
                    <div class="form-group">
                                <label for="admin">Type de compte </label>
                                <select name="admin" id="admin" class="form-control">
                                <option value=0>-- Votre choix --  </option>   
                                <option value=1>Administrateur </option>
                                <option value=0>Classique</option>
                               

                                </select>
                            </div>
                    <input type="submit" name="enregistrer"  placeholder="enregistrer">
                    </div>

                   


                </form>
            </section>
        </div>
    </main>
</body>

</html>