<?php

function logout(){

if(isset($_GET["action"]) && !empty($_GET["action"]) && ($_GET["action"] == "logout"))
{
    clean_php_session();
    
    $_SESSION['is_logged']==0;
    manage_php_session();
    header('Location: signin.php');


}

}

