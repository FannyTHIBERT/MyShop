<?php
require_once('connect.php');
require_once('env.php');
require_once('session.php');


function my_password_hash(string $password){
    $hash=password_hash($password, PASSWORD_BCRYPT);
    return $hash;
    }

    function name_verify($name)
    {
        return is_string($name) && strlen($name) > 2 && strlen($name) < 11;
    }


function my_password_verify($email,$password){

if($email=="" || $password=="" ) // si parametre absent la requete n'est pas envoyée 
{
    $heurelog=date('Y-m-d H:i:s');    
    $message="parmeters missing";
    file_put_contents(JOURNAL_LOG_FILE, "my_password_verify " . $message. " " .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
    $_SESSION['error_message']="merci de remplir tous les champs";
}  
else
{
      
    // construction d'un tableau qui va chercher en base le password pour le user passé 
        $db=connect_db();
        $query1=$db->prepare('SELECT id, password, email, username, admin FROM users WHERE email= :emailparam');
        $query1->bindParam('emailparam',$email,PDO::PARAM_STR);
        $query1->execute();
        $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        
        if(empty($res1)){
        $_SESSION['error_user_message']="mot de passe ou email invalide";    
        $message="No results matching your search";
        $heurelog=date('Y-m-d H:i:s');
        file_put_contents(JOURNAL_LOG_FILE,"my_password_verify " .  $message. " " .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
        return false;
        }

else {
        $passwordbdd=$res1[0]["password"];
        $logged=password_verify($password,$passwordbdd);
        if($logged==true)
        {
            $_SESSION['email']=$res1[0]["email"];
            $_SESSION['username']=$res1[0]["username"];
            $_SESSION['is_admin']=$res1[0]["admin"];
            $_SESSION['user_id']=$res1[0]["id"];
            $_SESSION['id']=session_id();
            $_SESSION['is_logged']=1;
            $heurelog=date('Y-m-d H:i:s');
            file_put_contents(JOURNAL_LOG_FILE, "my_password_verify, logué : " .  $_SESSION['is_logged']. " " . "user_id : ". $_SESSION['user_id']. " " . $_SESSION['username'] ." " . $_SESSION['email'] ." session id :" . $_SESSION['id']." admin : ". $_SESSION['is_admin']." ". $heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
            return true;
  
  
        }

        else 
        {
        $heurelog=date('Y-m-d H:i:s');    
        $message="incorrect password";
        $_SESSION['error_user_message']="mot de passe ou email invalide";
        file_put_contents(JOURNAL_LOG_FILE, "my_password_verify " . $message. " " .$heurelog . PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        
    }

    } 
    return false;

}
    // reste à verifier que les infos passées dans my_passord_verify correspondent aux infos contenuesdans my_array_verify
   
  
       function validate($name,$email,$password,$password_confirmation=null) {
   
        if(is_string($name) && strlen($name)>2 && strlen($name)<11) {
           
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
           
                if ( strlen($password)>2 && strlen($password)<11 )
                            
                            { 
                                
                                return true;
                            }
           
                else {echo "invalid password or password confirmation";}
                
            }
            else {echo "Invalid email <br>";}
    
        }else {echo "Invalid name <br>";}
        
    }// fin de fonction validate
    


//$exemple1=my_password_hash("mot2passe");
//$res=var_dump($exemple1);
//echo $res;
//$verif1=my_password_verify("jeremie.carlier@gmail.com","mot2passe");
//$res2=var_dump($verif1);
//echo $res2;





?>