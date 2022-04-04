
<?php
require_once('inc/session.php');
require_once('inc/connect.php');
require_once('inc/password.php');
require_once('inc/close.php');
include('inc/header_admin.php');


    if(isset($_GET['id']) && !empty($_GET['id'])){
        $db=connect_db();
        $id = strip_tags($_GET['id']);
        $bddCategories = "SELECT * FROM `categories` WHERE `id`=:id;";
        $query = $db->prepare($bddCategories);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
            if(!$result){
                $_SESSION['erreur'] = "Cet id n'existe pas";
                header('Location: categories_admin.php');
                die();
            }
        $bddCategories = "DELETE FROM `categories` WHERE `id`=:id;";
        $query = $db->prepare($bddCategories);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $_SESSION['success_admin_message'] = "Catégorie supprimée";
        header('Location: categories_admin.php');
        }else{
        $_SESSION['error_admin_message'] = "URL invalide";
        header('Location: categories_admin.php');
        }       

