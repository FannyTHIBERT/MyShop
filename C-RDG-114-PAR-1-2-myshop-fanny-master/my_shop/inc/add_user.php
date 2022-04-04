<?php
require_once('inc/connect.php');
require_once('inc/password.php');

function already_user($email)
    {
    $bdd=connect_db();     
    $sql = "SELECT email FROM `users` WHERE `email`=:emailparam;";
    $marequete=$bdd->prepare($sql);
    $marequete->bindParam(':emailparam',$email,PDO::PARAM_STR);
    $marequete->execute();
    $res1 = $marequete->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($res1)){


    $_SESSION['error_user_message']="email déjà utilisé, merci de vous connecter";
    $message2="email déjà utilisé";
    $heurelog=date('Y-m-d H:i:s');
    file_put_contents(JOURNAL_LOG_FILE,"my_password_verify " .  $message2. " " .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
    header('Location: signup.php');
    return true;
    }
    }

    function already_user_admin($email)
    {
    $bdd=connect_db();     
    $sql = "SELECT email FROM users WHERE email=:emailparam;";
    $marequete=$bdd->prepare($sql);
    $marequete->bindParam(':emailparam',$email,PDO::PARAM_STR);
    $marequete->execute();
    $res1 = $marequete->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($res1)){
    return true;
    }
    return false;
    }



function create_account_validation($name,$email,$password,$password_confirmation,$is_admin=null){
try {   
if ($name=="" || $email=="" || $password=="" || $password_confirmation=="")
{
    throw new Exception('Merci de remplir tous les champs');
    
}
   else
    {
   
    if (already_user_admin($email) == true) {throw new Exception("email déjà connu, impossible de créer un compte");
                                       }

   else{

   if(is_string($name) && strlen($name)>2 && strlen($name)<11) {
      
       if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
           if ( strlen($password)>2 && strlen($password)<11 && $password==$password_confirmation)
                       
                       {
                        $bdd=connect_db();     
                        $hash = my_password_hash($password);
                        $created_at=date('Y-m-d');
                        if(is_null($_POST['is_admin'])){$is_admin =false;} else{$is_admin = $_POST['is_admin'];}
                        $marequete=$bdd->prepare('INSERT INTO users (username, password, email, admin, created_at) VALUES (:nameparam,:passwordparam, :emailparam, :adminparam, :dateparam)');
                        $marequete->bindParam(':adminparam', $is_admin, PDO::PARAM_BOOL);
                        $marequete->bindParam(':nameparam',$name,PDO::PARAM_STR);
                        $marequete->bindParam(':passwordparam',$hash,PDO::PARAM_STR);
                        $marequete->bindParam(':emailparam',$email,PDO::PARAM_STR);
                        $marequete->bindParam(':dateparam',$created_at,PDO::PARAM_STR);
                        $marequete->execute();
                        $bdd->lastInsertId()    ;
                        
                        // si il s'agit d'un client qui créee son compte, on set ses donénes de sessions et on le renvoie vers la Home
                        $url = $_SERVER['SCRIPT_NAME'] ;
                        if(strpos($url,"signup.php")){
                        $_SESSION['user_id']=$bdd->lastInsertId() ;      
                        $_SESSION['username']=$name;
                        $_SESSION['is_logged']=1;
                        $_SESSION['success_user_message']="Votre compte a bien été crée";
                        file_put_contents(JOURNAL_LOG_FILE, "verif user_id " . $_SESSION['user_id']. " is_logged " . $_SESSION['is_logged'] .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
                        header('Location: signup.php');
                        return true;
                    
                    }
// sinon on gere le message de succés de création de compte et on renvoie vers la page gestion des utilisateurs

                        else {
                        $_SESSION['success_admin_message'] = "User ajouté avec succès !!";
                        header('Location: users_admin.php');

                        }


                        }
      
           else {
            $heurelog=date('Y-m-d H:i:s');    
            $message="invalid password or password confirmation";
            file_put_contents(JOURNAL_LOG_FILE, "create_account_validation " . $message. " " .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);   
            $_SESSION['error_user_message']="invalid password or password confirmation";
            $_SESSION['error_admin_message']="invalid password or password confirmation";
                }
    
            }
       else {
            $heurelog=date('Y-m-d H:i:s');    
            $message="Invalid email";
            file_put_contents(JOURNAL_LOG_FILE, "create_account_validation " . $message. " " .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);    
            $_SESSION['error_user_message']="Invalid email";
            $_SESSION['error_admin_message']="Invalid email";
            }

   }else {
        $heurelog=date('Y-m-d H:i:s');    
        $message="Invalid name";
        file_put_contents(JOURNAL_LOG_FILE, "create_account_validation " . $message. " " .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
        $_SESSION['error_user_message']="Invalid name";
        $_SESSION['error_admin_message']="Invalid name";
         }
}  
}
//
}//fin du try

catch (Exception $e) {
    $_SESSION['error_admin_message'] = $e->getMessage();
}


}// f

?>