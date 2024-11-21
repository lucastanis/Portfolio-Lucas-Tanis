<?php
// auteur: Lucas Tanis
// functie: definitie class Database
namespace Bas\classes;

use PDO;
use PDOException;


require_once "config.php";

class Database{
	protected static $conn = NULL;
	
	private $servername = SERVERNAME;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $dbname = DATABASE;
	
	public function __construct(){
		if (!self::$conn) {
			try{
				 self::$conn = new PDO ("mysql:host=$this->servername;
						dbname=$this->dbname",
						$this->username,
						$this->password) ;

				 self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
				 self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			}

			catch(PDOException $e){
				 echo "Connectie mislukt: " . $e->getMessage() ;
			}
		} else {
		}
	}
	
	public function getConnection(){
		return self::$conn;
	}
	
}
?>