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
	private $tableName  = 'message_history';
	private $tableName2 = "delivery_reciept";
    private $db = '';
	private $dbConn = '';
	private $CorrelatorId;
	private $Status;
	private $LinkId;
	private $Refund;
	private $Type;
	private $Description;
	private $command;
	private $planId;


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

	
	// get CorrelatorId
	public function getCorrelatorId(){

		 return $this->CorrelatorId;
	}
	// set CorrelatorId
	public function setCorrelatorId($CorrelatorId){

		$this->CorrelatorId = $CorrelatorId;
	}

	public function getStatus(){

		 return $this->Status;
	}

	public function setStatus($Status){

		$this->Status = $Status;
	}
	// get LinkId
	public function getLinkId(){

		 return $this->LinkId;
	}
	// set LinkId
	public function setLinkId($LinkId){

		$this->LinkId = $LinkId;
	}
	// get Refund
	public function getRefund(){

		 return $this->Refund;
	}
	// set Refund
	public function setRefund($Refund){

		$this->Refund = $Refund;
	}
	// get Type
	public function getType(){

		 return $this->Type;
	}
	// set Type
	public function setType($Type){

		$this->Type = $Type;
	}
	// get Description
	public function getDescription(){

		 return $this->Description;
	}
	// set Description
	public function setDescription($Description){

		$this->Description = $Description;
	}
	// get command
	public function getCommand(){

		 return $this->command;
	}
	// set command
	public function setCommand($command){

		$this->command = $command;
	}
	// get planId
	public function getPlanId(){

		 return $this->planId;
	}
	// set planId
	public function setPlanId($planId){

		$this->planId = $planId;
	}


	public function logMessage(){


		$sql = 'INSERT INTO ' . $this->tableName. '(sms_log_id, statusCode, statusMessage, message, Msisdn, offerId, transactionId, sms_time) VALUES(null, :statusCode, :statusMessage, :message, :Msisdn, :offerId, :transactionId, :sms_time)';

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':statusCode', $this->statusCode);
		$stmt->bindParam(':statusMessage', $this->statusMessage);
		$stmt->bindParam(':message', $this->message);
		$stmt->bindParam(':Msisdn', $this->Msisdn);
		$stmt->bindParam(':offerId', $this->offerId);
		$stmt->bindParam(':transactionId', $this->transactionId);
		$stmt->bindParam(':sms_time', $this->sms_time);
		$stmt->execute();

		//close db connection
		$this->closeDB();

	}



	#update content push delivery response
	public function updateDeliveryResponse(){

		$sql = 'UPDATE '. $this->tableName.' SET statusMessage =:statusMessage  WHERE transactionId =:transactionId';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':statusMessage', $this->statusMessage);
		$stmt->bindParam(':transactionId', $this->transactionId);
		$stmt->execute();

		//close db connection
		$this->closeDB();

	}



	public function logDeliveryRespnse(){


		$sql = 'INSERT INTO ' . $this->tableName2 . '(delivery_reciept_id, Msisdn, CorrelatorId, Status, LinkId, Refund, Type, Description, command, transactionId, planId) VALUES(null, :Msisdn, :CorrelatorId, :Status, :LinkId, :Refund, :Type, :Description, :command, :transactionId, :planId)';

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':Msisdn', $this->Msisdn);
		$stmt->bindParam(':CorrelatorId', $this->CorrelatorId);
		$stmt->bindParam(':Status', $this->Status);
		$stmt->bindParam(':LinkId', $this->LinkId);
		$stmt->bindParam(':Refund', $this->Refund);
		$stmt->bindParam(':Type', $this->Type);
		$stmt->bindParam(':Description', $this->Description);
		$stmt->bindParam(':command', $this->command);
		$stmt->bindParam(':transactionId', $this->transactionId);
		$stmt->bindParam(':planId', $this->planId);
		$stmt->execute();


		//close db connection planId
		$this->closeDB();

	}


	public function closeDB(){
		$this->dbConn = $this->db->disconnect();
	}


}

?>