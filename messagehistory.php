<?php
include_once('dbconnect.php');

class MessageHistory{

	private $sms_log_id;
	private $statusCode;
	private $statusMessage;
	private $transactionId;
	private $deliveryResponse;
	private $sms_time;
	private $message;
	private $Msisdn;
	private $offerId;
	private $tableName = 'message_history';
    private $db = '';
	private $dbConn = '';

	public function __construct() {
		$this->db = new DbConnect();
		$this->dbConn = $this->db->connect();
	}


	public function getSmsLogId(){

		 return $this->sms_log_id;
	}


    /*
	public function setSmsLogId($sms_log_id){

		$this->sms_log_id = $sms_log_id;
	}
	*/


	public function getStatusCode(){

		 return $this->statusCode;
	}

	public function setStatusCode($statusCode){

		$this->statusCode = $statusCode;
	}


	public function getStatusMessage(){

		 return $this->statusMessage;
	}

	public function setStatusMessage($statusMessage){

		$this->statusMessage = $statusMessage;
	}



	public function getTransactionId(){

		 return $this->transactionId;
	}

	public function setTransactionId($transactionId){

		$this->transactionId = $transactionId;
	}


	public function getSmsTime(){

		 return $this->sms_time;
	}

	public function setSmsTime($sms_time){

		$this->sms_time = $sms_time;
	}


	public function getMessage(){

		 return $this->message;
	}

	public function setMessage($message){

		$this->message = $message;
	}


	public function getMsisdn(){

		 return $this->Msisdn;
	}

	public function setMsisdn($Msisdn){

		$this->Msisdn = $Msisdn;
	}


	public function getOfferId(){

		 return $this->offerId;
	}

	public function setOfferId($offerId){

		$this->offerId = $offerId;
	}

	#get delivery response
	public function getDeliveryResponse(){

		 return $this->deliveryResponse;
	}
	#set delivery response
	public function setDeliveryResponse($deliveryResponse){

		$this->deliveryResponse = $deliveryResponse;
	}

	public function logMessage(){


		$sql = 'INSERT INTO ' . $this->tableName . '(sms_log_id, statusCode, statusMessage, message, Msisdn, offerId, transactionId, sms_time) VALUES(null, :statusCode, :statusMessage, :message, :Msisdn, :offerId, :transactionId, :sms_time)';

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':statusCode', $this->statusCode);
		$stmt->bindParam(':statusMessage', $this->statusMessage);
		$stmt->bindParam(':message', $this->message);
		$stmt->bindParam(':Msisdn', $this->Msisdn);
		$stmt->bindParam(':offerId', $this->offerId);
		$stmt->bindParam(':transactionId', $this->transactionId);
		$stmt->bindParam(':sms_time', $this->sms_time);
		$stmt->execute();

	}


	#update content push delivery response
	public function updateDeliveryResponse(){

		$sql = 'UPDATE '. $this->tableName.' SET deliveryResponse =:deliveryResponse  WHERE transactionId = :transactionId';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':deliveryResponse', $this->deliveryResponse);
		$stmt->bindParam(':transactionId', $this->transactionId);
		$stmt->execute();

		//close db connection
		$this->closeDB();

	}
}

?>