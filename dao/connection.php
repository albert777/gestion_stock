<?php
    class Connection
    {
    	private $connection;
		private $server;
		private $login;
		private $password;
		private $database;
		function __construct() {
			$this->server='localhost';
			$this->login='root';
			$this->password='';
			$this->database='gestionstock';
		}
		public function connectiondb(){
			$this->connection=new PDO("mysql:host=".$this->server.";dbname=".$this->database."",$this->login,$this->password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return $this->connection;
		}
		
    }
