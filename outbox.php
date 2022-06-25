<?php
ini_set('max_execution_time', 10800); // 3 hours max execution time
include_once('dbconnect.php');
class Outbox{

	private $id;
	private $content;
	private $subscription_id;
	private $scheduled_date;
	private $status;
	private $priority;
	private $tableName = 'outbox';
	private $db = '';
	private $dbConn = '';


    
	public function __construct() {
		$this->db = new DbConnect();
		$this->dbConn = $this->db->connect();
	}
	

	

	public function getId(){

		return $this->id;
	}

	public function getContent(){

		 return $this->content;
	}

	public function setContent($content){

		$this->content = $content;
	}


	public function getScheduledDate(){

		 return $this->scheduled_date;
	}

	public function setScheduledDate($scheduled_date){

		$this->scheduled_date = $scheduled_date;
	}

	public function getSubscriptionId(){

		 return $this->subscription_id;
	}

	public function setSubscriptionId($subscription_id){

		$this->subscription_id = $subscription_id;
	}


	public function getStatus(){

		 return $this->status;
	}

	public function setStatus($status){

		$this->status = $status;
	}


	public function getMessage(){

		$sql = 'SELECT * from '. $this->tableName .' WHERE subscription_id = :subscription_id AND status = :status AND scheduled_date = :scheduled_date ORDER BY priority ASC LIMIT 1';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':subscription_id', $this->subscription_id);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':scheduled_date', $this->scheduled_date);
		$stmt->execute();
		$message = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->closeDB();
		return $message;
	}



	public function getRandMessage(){

		$sql = 'SELECT * from '. $this->tableName .' WHERE  status = :status AND id > 2 ORDER BY RAND() ASC LIMIT 1';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':status', $this->status);
		$stmt->execute();
		$message = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->closeDB();
		return $message;

	}

	public function updateOutBox(){

		$sql = 'UPDATE '. $this->tableName.' SET status = :status  WHERE subscription_id = :subscription_id';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':subscription_id', $this->subscription_id);
		$stmt->execute();

		//close db connection
		$this->closeDB();

	}



	public function closeDB(){
		$this->dbConn = $this->db->disconnect();
	}
}
?>