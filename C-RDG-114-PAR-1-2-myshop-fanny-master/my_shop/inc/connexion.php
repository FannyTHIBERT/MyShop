<?php

require_once('inc/env.php');


class DBController 
{
	protected $host = DB_HOST;
	protected $user = DB_USERNAME;
	protected $password = DB_PASSWORD;
	protected $database = DB_NAME;
	protected $port = DB_PORT;

	public $connexion;

	public function __construct()
	{
		// $this->con = new PDO($this->host,$this->user,$this->password,$this->database);
		$dsn ='mysql:host=' . $this->host . ';dbname=' . $this->database . ';port=' . $this->port;
		// $con = new PDO ($dsn, $this->user, $this->password);

		try {
            $this->connexion = new PDO($dsn, $this->user, $this->password);
			
			$this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  			// echo "Connected successfully";
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "";
            die();
        }
        return $this->connexion;
    }
		
	// protected function closeConnexion(){
    
	// 	if ($this->connexion != null){
	// 		$this->connexion = null;
	// 	}
			
	// }	
}

// $db=new DBController();
