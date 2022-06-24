<?php
ini_set('max_execution_time', 10800); // 3 hours max execution time
include_once('dbconnect.php');

class OutBoxTracker{

	private $last_id;
	private $subscription_id;
	private $tableName = 'out_box_tracker';
	private $dbConn = '';
	private $db = '';
	private $batch_no = '';

	public function __construct() {
		$this->db = new DbConnect();
		$this->dbConn = $this->db->connect();
	}

	public function getLastId(){

		return $this->last_id;
	}

	public function setLastId($last_id){

		$this->last_id = $last_id;
	}

	public function getSubscriptionId(){

		 return $this->subscription_id;
	}

	public function setSubscriptionId($subscription_id){

		$this->subscription_id = $subscription_id;
	}



	public function getBatchNo(){

		 return $this->batch_no;
	}

	public function setBatchNo($batch_no){

		$this->batch_no = $batch_no;
	}


	public function getId(){

		$sql = 'SELECT last_id from '. $this->tableName .' WHERE subscription_id = :subscription_id AND batch_no = :batch_no LIMIT 1';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':subscription_id', $this->subscription_id);
		$stmt->bindParam(':batch_no', $this->batch_no);
		$stmt->execute();
		$last_id = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->closeDB();
		return $last_id;
	}

	public function updateOutBox(){

		$sql = 'UPDATE '. $this->tableName.' SET last_id = :last_id  WHERE subscription_id = :subscription_id AND batch_no = :batch_no';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':last_id', $this->last_id);
		$stmt->bindParam(':subscription_id', $this->subscription_id);
		$stmt->bindParam(':batch_no', $this->batch_no);
		$stmt->execute();

		//close db connection
		$this->closeDB();

	}


	public function closeDB(){

		try{
           $this->dbConn = $this->db->disconnect();
		}catch(Exception $e){
           echo $e->getMessage();
		}
		

		//echo "Disconne!!!!!";
	}


}
?>