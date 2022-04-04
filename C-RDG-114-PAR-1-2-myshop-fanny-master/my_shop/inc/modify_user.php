<?php
include_once('add_user.php');


function modify_account_validation(
    $id,
    $name = null,
    $email = null,
    $password = null,
    $password_confirmation = null,
    $is_admin = null
) {
    try {
        $updatedPassword = false;
        $db = connect_db();
        $bddCategories = "SELECT id, username, email, password, admin FROM users WHERE id=:id";
        $marequete = $db->prepare($bddCategories);
        $marequete->bindParam(':id', $id, PDO::PARAM_INT);
        $marequete->execute();
        $result1 = $marequete->fetch();
        // if 1
        if (!$result1) {
            $_SESSION['error_admin_in_page_message'] = "Cet id n'existe pas";
        } else { //else 1 verification  des parametres à passer dans modify

            //verif nom
            if ($name != $result1['username']) {
                if (name_verify($name)) {
                    $name = $_POST['username'];
                } else {
                    header('users_edit.php?id=$_GET[id]');
                    throw new Exception('nom invalide');
                }
            }
            // double verif email
            if ($email != $result1['email']) {
                if (already_user_admin($email)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $email = $_POST['email'];
                    } else {
                        header('users_edit.php?id=$_GET[id]');
                        throw new Exception('email invalide');
                        return false;
                    }
                    header('users_edit.php?id=$_GET[id]');
                    throw new Exception('email déjà utilisé');
                    return false;
                } // verif si email n'existe pas ET si email est valide
            }
            //verif password
            if ($password != '' && $password_confirmation != "") {
                if ($password == $password_confirmation && strlen($password) > 2 && strlen($password) < 11) {
                    $password = my_password_hash($password);
                    $updatedPassword = true;
                } else {
                    header('users_edit.php?id=$_GET[id]');
                    throw new Exception("mot de passe ou confirmation de mot de passe invalide");
                    return false;
                };
            }
            $bdd2 = connect_db();
            $marequete2 = $bdd2->prepare('UPDATE users SET username=:nameparam, email=:emailparam, admin=:adminparam WHERE id=:id');
            $marequete2->bindParam(':adminparam', $is_admin, PDO::PARAM_BOOL);
            $marequete2->bindParam(':nameparam', $name, PDO::PARAM_STR);
            $marequete2->bindParam(':emailparam', $email, PDO::PARAM_STR);
            $marequete2->bindParam(':id', $id, PDO::PARAM_INT);
            $marequete2->execute();
            header('Location: users_admin.php');
            $_SESSION['success_admin_message'] ="Vos modifications ont été enregistrées";

         if ($updatedPassword) {
                $marequete2 = $bdd2->prepare('UPDATE users SET password=:passwordparam WHERE id=:id');
                $marequete2->bindParam(':passwordparam', $password, PDO::PARAM_STR);
                $marequete2->bindParam(':id', $id, PDO::PARAM_INT);
                $marequete2->execute();
                header('Location: users_admin.php');
                
            }
           
            
             header('Location: users_admin.php');


        } // fin else1
    }
    //fin try
    catch (Exception $e) {
        $_SESSION['error_admin_in_page_message'] = $e->getMessage();
    }
}

function modify_account_validation_user(
    $id,
    $name = null,
    $email = null,
    $password = null,
    $password_confirmation = null,
    $is_admin = null
) {
    try {
        $updatedPassword = false;
        $db = connect_db();
        $bddCategories = "SELECT id, username, email, password, admin FROM users WHERE id=:id";
        $marequete = $db->prepare($bddCategories);
        $marequete->bindParam(':id', $id, PDO::PARAM_INT);
        $marequete->execute();
        $result1 = $marequete->fetch();
        // if 1
        if (!$result1) {
            $_SESSION['error_user_message'] = "Cet id n'existe pas";
        } else { //else 1 verification  des parametres à passer dans modify

            //verif nom
            if ($name != $result1['username']) {
                if (name_verify($name)) {
                    $name = $_POST['username'];
                } else {
                    throw new Exception('nom invalide');
                }
            }
            // double verif email
            if ($email != $result1['email']) {
                if (already_user_admin($email)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $email = $_POST['email'];
                    } else {
                        throw new Exception('email invalide');
                    }
                    throw new Exception('email déjà utilisé');
                } // verif si email n'existe pas ET si email est valide
            }
            //verif password
            if ($password != '' && $password_confirmation != "") {
                if ($password == $password_confirmation && strlen($password) > 2 && strlen($password) < 11) {
                    $password = my_password_hash($password);
                    $updatedPassword = true;
                } else {
                    throw new Exception("mot de passe ou confirmation de mot de passe invalide");
                };
            }
            $bdd2 = connect_db();
            $marequete2 = $bdd2->prepare('UPDATE users SET username=:nameparam, email=:emailparam, admin=:adminparam WHERE id=:id');
            $marequete2->bindParam(':adminparam', $is_admin, PDO::PARAM_BOOL);
            $marequete2->bindParam(':nameparam', $name, PDO::PARAM_STR);
            $marequete2->bindParam(':emailparam', $email, PDO::PARAM_STR);
            $marequete2->bindParam(':id', $id, PDO::PARAM_INT);
            $marequete2->execute();
            $_SESSION['success_user_message'] ="Vos modifications ont été enregistrées";

         if ($updatedPassword) {
                $marequete2 = $bdd2->prepare('UPDATE users SET password=:passwordparam WHERE id=:id');
                $marequete2->bindParam(':passwordparam', $password, PDO::PARAM_STR);
                $marequete2->bindParam(':id', $id, PDO::PARAM_INT);
                $marequete2->execute();
                
            }

            
             header('Location: my_account.php');


        } // fin else1
    }
    //fin try
    catch (Exception $e) {
        $_SESSION['error_admin_message'] = $e->getMessage();
    }
}