<?php
function redirection(){
if (is_logged() && !is_admin()){header('Location: my_account.php');}
if (is_logged() &&  is_admin()){header('Location: my_account.php');}
}

?>