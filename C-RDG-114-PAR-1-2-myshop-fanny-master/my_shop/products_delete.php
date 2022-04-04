
<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');



    if(isset($_GET['id']) && !empty($_GET['id'])){

        $id = strip_tags($_GET['id']);
        $bddCategories = "SELECT * FROM `products` WHERE `id`=:id;";
        $db=connect_db();
        $query = $db->prepare($bddCategories);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
            if(!$result){
                $_SESSION['erreur'] = "Cet id n'existe pas";
                header('Location: products_admin.php');
                die();
            }
        $bddCategories = "DELETE FROM `products` WHERE `id`=:id;";
        $db=connect_db();
        $query = $db->prepare($bddCategories);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $_SESSION['success_admin_message'] = "Produit supprimé";
        header('Location: products_admin.php');
        }else{
        $_SESSION['error_admin_message'] = "URL invalide";
        header('Location: products_admin.php');
        }       
