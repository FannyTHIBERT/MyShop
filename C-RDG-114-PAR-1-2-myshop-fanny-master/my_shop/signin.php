
<?php
$pagetitle = 'Login';
$currentPage ='Login';

require_once('inc/add_user.php');
include_once('inc/search.php');
include_once('inc/logout.php');
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
logout();
session_start();

if(!is_null($_POST["valid_connection"])) {my_password_verify($_POST["form_username"],$password=$_POST["form_password"]);}
if (is_logged() && !is_admin()){header('Location: my_account.php');}
if (is_logged() && is_admin()){header('Location: admin.php');}

include('inc/header.php');
// Facebook
// facebook
if(!is_null($_POST["valid_connection"])) {my_password_verify($_POST["form_username"],$password=$_POST["form_password"]);}

if (!is_null($_SESSION['error_user_message'])) : ?>
            <div class="row">
                <section class="col-12">
                    <a class="alert alert-danger"><?= htmlspecialchars($_SESSION['error_user_message']) ?></a>
            </div>
<?php unset($_SESSION['error_user_message']); ?>
      <?php endif; ?>

      
<div class="" id="login-form-wrap">

    <h2>LOGIN</h2>
 
    <form id="login-form" action ="signin.php" method="POST">
        <p>
            <input type="email" id="username" name="form_username" placeholder="email" required><i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="password" id="email" name="form_password" placeholder="Mot de passe" required><i class="validation"><span></span><span></span></i>
        </p>
        <p>
            <input type="submit" id="login" name="valid_connection"  placeholder="Connexion">
        </p>
    </form>
   
    <div id="create-account-wrap">
        <p>Or <a href="signup.php">Create Account</a> <p>
    </div>
    <!--create-account-wrap-->
</div>

<div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>

<!-- facebook -->




<?php
include('inc/footer.php');
?>

</body>

</html>