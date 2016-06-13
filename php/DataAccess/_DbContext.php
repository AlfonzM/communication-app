<?php
require 'vendor/autoload.php';
class DbContext{
	public $account_db;
	public $communication_db;

	public function Connect(){
		try{
			$host = 'localhost';
			$username = 'root';
			$password = 'root';

			$this->account_db = new PDO("mysql:host=$host;dbname=analysis_db", 
				$username, $password, 
				array(PDO::ATTR_PERSISTENT => true));

			$this->communication_db = new PDO("mysql:host=$host;dbname=communication_db", 
				$username, $password, 
				array(PDO::ATTR_PERSISTENT => true));

			if ($this->account_db && $this->communication_db){  
				date_default_timezone_set('Asia/Tokyo');
			}
			else{
				throw new Exception('Unable to connect to server.');
			}
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function Disconnect(){
		$this->account_db = null;
		$this->communication_db = null;
	}
}
?>