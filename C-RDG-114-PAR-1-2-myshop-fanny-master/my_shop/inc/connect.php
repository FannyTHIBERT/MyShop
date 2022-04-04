<?php
      
      require_once('env.php');
        
        
        //On établit la connexion
        function connect_db($host=DB_HOST,$username=DB_USERNAME,$passwd=DB_PASSWORD,$port=DB_PORT,$db=DB_NAME){
            try{
            
            $dsn="mysql:host=".$host.";port=".$port.";dbname=".$db;
                $db = new PDO($dsn, $username, $passwd);
        
        //On définit le mode d'erreur de PDO sur Exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (!empty($db)){
            $heurelog=date('Y-m-d H:i:s');    
            $message="connection succesfull";
            file_put_contents(JOURNAL_LOG_FILE, $message . " " . $heurelog  . PHP_EOL, FILE_APPEND | LOCK_EX);}
              }
        
        /*On capture les exceptions si une exception est lancée et on affiche
        *les informations relatives à celle-ci*/
        
        catch(PDOException $e){
      $errormessage=$e->getMessage();
        file_put_contents(ERROR_LOG_FILE, $errormessage. PHP_EOL, FILE_APPEND | LOCK_EX);
        return;
        
        }
        
        return $db;
        
        }
       
        ?>
