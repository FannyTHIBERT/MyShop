<?php
require_once('inc/add_user.php');
require_once('inc/connect.php');
require_once('inc/modify_category.php');

function modify_product_complete($id,$name,$price,$category_id,$description,$littleimg,$bigimg){
if(empty($id) || empty($name) || empty($price) || empty($category_id) || empty($description)
|| empty($littleimg) || empty($bigimg))
       {
$_SESSION['error_admin_in_page_message'] = "Le formulaire n'est pas complet";            
header("Location: products_edit.php?id=$_GET[id]");
return false;
       }
else {
    
    return true; 
}
}

function modify_product_validation(
    $name = null,
    $price = null,
    $description = null,
    $littleimg= null,
    $bigimg=null
) {

if (!is_string($name) || $name=="" ){$_SESSION['error_admin_in_page_message'] = "Le nom n'est pas valide";
    header("Location:   products_edit.php?id=$_GET[id]");
    return false; }
if ( !is_numeric($price)){$_SESSION['error_admin_in_page_message'] = "Attention, le prix n'est pas correct";
    header("Location:   products_edit.php?id=$_GET[id]"); 
    return false; }
if (!is_string($description)){$_SESSION['error_admin_in_page_message'] = "La description n'est pas valide";
    header("Location:   products_edit.php?id=$_GET[id]");
    return false; }
if (!is_string($littleimg)){$_SESSION['error_admin_in_page_message'] = "L'image n'est pas valide";
    header("Location:   products_edit.php?id=$_GET[id]");
    return false; }
if (!is_string($bigimg)){$_SESSION['error_admin_in_page_message'] = "L'image n'est pas valide";
    header("Location:   products_edit.php?id=$_GET[id]");
    return false; }
return true;
}


function modify_product(
    $id,
    $name = null,
    $price = null,
    $category_id = null,
    $description = null,
    $littleimg= null,
    $bigimg=null
) {
    try{
$db=connect_db();
$id=strip_tags($_GET['id']);
$name = strip_tags($_POST['name']);
$price= strip_tags($_POST['price']);
$category_id= strip_tags($_POST['category_id']);
$description= strip_tags($_POST['description']);
$littleimg= strip_tags($_POST['littleimg']);
$bigimg= strip_tags($_POST['bigimg']);
$bddProducts = "UPDATE products SET name=:name, price=:price, category_id=:category_id, description=:description, littleimg=:littleimg, bigimg=:bigimg WHERE id=:id;";
$query1 = $db->prepare( $bddProducts);
$query1->bindValue(':id', $id, PDO::PARAM_INT);
$query1->bindValue(':name', $name, PDO::PARAM_STR);
$query1->bindValue(':price', $price, PDO::PARAM_INT);
$query1->bindValue(':category_id', $category_id, PDO::PARAM_INT);
$query1->bindValue(':description', $description, PDO::PARAM_STR);
$query1->bindValue(':littleimg', $littleimg, PDO::PARAM_STR);
$query1->bindValue(':bigimg', $bigimg, PDO::PARAM_STR);
$query1->execute();
$_SESSION['success_admin_message'] ="Produit modifié !";
header('Location: products_admin.php');


//fin try
    }


catch (Exception $e) {
    $_SESSION['error_admin_message'] = $e->getMessage();
}
}


?>