<?php
/**
* Database Connection
**/

    class DbConnect{

        
    	private $server = '192.168.193.254';  //'localhost';
        private $dbname = 'mobi_connect';
        private $user = 'mefor';
        private $pass = 'meF0r@1234&5$HaW9(1&McC';
        



        /*
        private $server = 'localhost';
        private $dbname = 'mobi_connect';
        private $user = 'root';
        private $pass = '';
        */

    	public function connect(){

    	   try {
    	   	
    	   	  $conn = new PDO('mysql:host='.$this->server. ';dbname=' .$this->dbname, $this->user, $this->pass);  
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              return $conn;
    	   } catch (Exception $e) {
    	   	   
    	   	   echo "Database Error: ".$e->getMessage();
    	   }
           
           
    	}

        public function disconnect(){
          
          $this->conn = '';
          echo "Disconnected";
        }
    }

    $db = new DbConnect;
    $db->connect();
?>