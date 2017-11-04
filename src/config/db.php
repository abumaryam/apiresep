<?php 

/**
* 
*/
class db {
	
	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = 'yourpassword';
	private $dbname = 'api';

	public function connect()
	{
		$mysql_connect_string = "mysql:host=".$this->dbhost.";dbname=".$this->dbname;
		$database_connection = new PDO($mysql_connect_string, $this->dbuser, $this->dbpass);
		$database_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $database_connection;
	}



}