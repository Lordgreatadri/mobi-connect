<?php
ini_set('max_execution_time', 10800); // 3 hours max execution time
include_once('dbconnect.php');
class Subscriber{

	private $subscriber_id;
	private $externalServiceId;
	private $requestId;
	private $requestTimeStamp;
	private $channel;
	private $Msisdn;
	private $keyword;
	private $OfferCode;
	private $TransactionId;
	private $ClientTransactionId;
	private $SubscriberLifeCycle;
	private $SubscriptionStatus;
	private $Reason;
	private $NextBillingDate;
	private $Type;
	private $ShortCode;
	private $BillingId;
	private $ChargeAmount;
	private $planId;
	private $command;
	private $inserted_at;
	private $updated_at;
	private $tableName = 'subscribers';
    private $last_id;
    private $db = '';
	private $dbConn = '';


	public function __construct() {
		$this->db = new DbConnect();
		$this->dbConn = $this->db->connect();
	}

	public function getSubscriberId(){

		return $this->subscriber_id;
	}

	public function getExternalServiceId(){

		 return $this->externalServiceId;
	}

	public function setExternalServiceId($externalServiceId){

		$this->externalServiceId = $externalServiceId;
	}

	public function getRequestId(){

		 return $this->requestId;
	}

	public function setRequestId($requestId){

		$this->requestId = $requestId;
	}


	public function getRequestTimeStamp(){

		 return $this->requestTimeStamp;
	}

	public function setRequestTimeStamp($requestTimeStamp){

		$this->requestTimeStamp = $requestTimeStamp;
	}


	public function getChannel(){

		 return $this->channel;
	}

	public function setChannel($channel){

		$this->channel = $channel;
	}


	public function getMsisdn(){

		 return $this->Msisdn;
	}

	public function setMsisdn($Msisdn){

		$this->Msisdn = $Msisdn;
	}


	public function getKeyword(){

		 return $this->keyword;
	}

	public function setKeyword($keyword){

		$this->keyword = $keyword;
	}


	public function getOfferCode(){

		 return $this->OfferCode;
	}

	public function setOfferCode($OfferCode){

		$this->OfferCode = $OfferCode;
	}

	public function getTransactionId(){

		 return $this->TransactionId;
	}

	public function setTransactionId($TransactionId){

		$this->TransactionId = $TransactionId;
	}


	public function getClientTransactionId(){

		 return $this->ClientTransactionId;
	}

	public function setClientTransactionId($ClientTransactionId){

		$this->ClientTransactionId = $ClientTransactionId;
	}


	public function getSubscriberLifeCycle(){

		 return $this->SubscriberLifeCycle;
	}

	public function setSubscriberLifeCycle($SubscriberLifeCycle){

		$this->SubscriberLifeCycle = $SubscriberLifeCycle;
	}


	public function getSubscriptionStatus(){

		 return $this->SubscriptionStatus;
	}

	public function setSubscriptionStatus($SubscriptionStatus){

		$this->SubscriptionStatus = $SubscriptionStatus;
	}


	public function getReason(){

		 return $this->Reason;
	}

	public function setReason($Reason){

		$this->Reason = $Reason;
	}


	public function getNextBillingDate(){

		 return $this->NextBillingDate;
	}

	public function setNextBillingDate($NextBillingDate){

		$this->NextBillingDate = $NextBillingDate;
	}


	public function getType(){

		 return $this->Type;
	}

	public function setType($Type){

		$this->Type = $Type;
	}

	public function getShortCode(){

		 return $this->ShortCode;
	}

	public function setShortCode($ShortCode){

		$this->ShortCode = $ShortCode;
	}


	public function getBillingId(){

		 return $this->BillingId;
	}

	public function setBillingId($BillingId){

		$this->BillingId = $BillingId;
	}


	public function getChargeAmount(){

		 return $this->ChargeAmount;
	}

	public function setChargeAmount($ChargeAmount){

		$this->ChargeAmount = $ChargeAmount;
	}


	public function getPlanId(){

		 return $this->planId;
	}

	public function setPlanId($planId){

		$this->planId = $planId;
	}


	public function getCommand(){

		 return $this->command;
	}

	public function setCommand($command){

		$this->command = $command;
	}



	public function getInsertedAt(){

		 return $this->inserted_at;
	}

	public function setInsertedAt($inserted_at){

		$this->inserted_at = $inserted_at;
	}


	public function getUpdatedAt(){

		 return $this->updated_at;
	}

	public function setUpdatedAt($updated_at){

		$this->updated_at = $updated_at;
	}


	public function getLastId(){

		 return $this->last_id;
	}

	public function setLastId($last_id){

		$this->last_id = $last_id;
	}



	public function insertA() {

		$sql = 'INSERT INTO ' . $this->tableName . '(subscriber_id, externalServiceId, requestId, requestTimeStamp, channel, Msisdn, OfferCode, TransactionId, ClientTransactionId, SubscriberLifeCycle, SubscriptionStatus, NextBillingDate, Type, ShortCode, BillingId, ChargeAmount, planId, command, inserted_at, updated_at) VALUES(null, :externalServiceId, :requestId, :requestTimeStamp, :channel, :Msisdn, :OfferCode, :TransactionId, :ClientTransactionId, :SubscriberLifeCycle, :SubscriptionStatus, :NextBillingDate, :Type, :ShortCode, :BillingId, :ChargeAmount, :planId, :command, :inserted_at, :updated_at)';

        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':externalServiceId', $this->externalServiceId);
        $stmt->bindParam(':requestId', $this->requestId);
        $stmt->bindParam(':requestTimeStamp', $this->requestTimeStamp);
        $stmt->bindParam(':channel', $this->channel);
        $stmt->bindParam(':Msisdn', $this->Msisdn);
        $stmt->bindParam(':OfferCode', $this->OfferCode);
        $stmt->bindParam(':TransactionId', $this->TransactionId);
        $stmt->bindParam(':ClientTransactionId', $this->ClientTransactionId);
        $stmt->bindParam(':SubscriberLifeCycle', $this->SubscriberLifeCycle);
        $stmt->bindParam(':SubscriptionStatus', $this->SubscriptionStatus);
        $stmt->bindParam(':NextBillingDate', $this->NextBillingDate);
        $stmt->bindParam(':Type', $this->Type);
        $stmt->bindParam(':ShortCode', $this->ShortCode);
        $stmt->bindParam(':BillingId', $this->BillingId);
        $stmt->bindParam(':ChargeAmount', $this->ChargeAmount);
        $stmt->bindParam(':command', $this->command);
        $stmt->bindParam(':planId', $this->planId);
        $stmt->bindParam(':inserted_at', $this->inserted_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
       

        if($stmt->execute()) {
			return true;
		} else {
			return false;
		}

	}



	public function insertD() {

		$sql = 'INSERT INTO ' . $this->tableName . '(subscriber_id, externalServiceId, requestId, requestTimeStamp, channel, Msisdn, OfferCode, TransactionId, ClientTransactionId, SubscriberLifeCycle, SubscriptionStatus, Reason, Type, planId, command, inserted_at, updated_at) VALUES(null, :externalServiceId, :requestId, :requestTimeStamp, :channel, :Msisdn, :OfferCode, :TransactionId, :ClientTransactionId, :SubscriberLifeCycle, :SubscriptionStatus, :Reason, :Type, :planId, :command, :inserted_at, :updated_at)';

        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':externalServiceId', $this->externalServiceId);
        $stmt->bindParam(':requestId', $this->requestId);
        $stmt->bindParam(':requestTimeStamp', $this->requestTimeStamp);
        $stmt->bindParam(':channel', $this->channel);
        $stmt->bindParam(':Msisdn', $this->Msisdn);
        $stmt->bindParam(':OfferCode', $this->OfferCode);
        $stmt->bindParam(':TransactionId', $this->TransactionId);
        $stmt->bindParam(':ClientTransactionId', $this->ClientTransactionId);
        $stmt->bindParam(':SubscriberLifeCycle', $this->SubscriberLifeCycle);
        $stmt->bindParam(':SubscriptionStatus', $this->SubscriptionStatus);
        $stmt->bindParam(':Reason', $this->Reason);
        $stmt->bindParam(':Type', $this->Type);
        $stmt->bindParam(':planId', $this->planId);
        $stmt->bindParam(':command', $this->command);
        $stmt->bindParam(':inserted_at', $this->inserted_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
       

        if($stmt->execute()) {
			return true;
		} else {
			return false;
		}

	}


	public function updateSubscription(){

		$sql = 'UPDATE ' . $this->tableName . ' SET externalServiceId = :externalServiceId, requestId = :requestId, requestTimeStamp = :requestTimeStamp, channel = :channel,  Msisdn = :Msisdn, OfferCode = :OfferCode, TransactionId = :TransactionId,
		ClientTransactionId = :ClientTransactionId, SubscriberLifeCycle = :SubscriberLifeCycle, SubscriptionStatus = :SubscriptionStatus, Reason = :Reason, channel = :channel,
		NextBillingDate = :NextBillingDate, Type = :Type, ShortCode = :ShortCode, BillingId = :BillingId, ChargeAmount = :ChargeAmount, planId = :planId, command = :command, updated_at = :updated_at WHERE 
		Msisdn = :Msisdn AND OfferCode = :OfferCode ';

		$stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':externalServiceId', $this->externalServiceId);
        $stmt->bindParam(':requestId', $this->requestId);
        $stmt->bindParam(':requestTimeStamp', $this->requestTimeStamp);
        $stmt->bindParam(':channel', $this->channel);
        $stmt->bindParam(':Msisdn', $this->Msisdn);
        $stmt->bindParam(':OfferCode', $this->OfferCode);
        $stmt->bindParam(':TransactionId', $this->TransactionId);
        $stmt->bindParam(':ClientTransactionId', $this->ClientTransactionId);
        $stmt->bindParam(':SubscriberLifeCycle', $this->SubscriberLifeCycle);
        $stmt->bindParam(':SubscriptionStatus', $this->SubscriptionStatus);
        $stmt->bindParam(':Reason', $this->Reason);
        $stmt->bindParam(':channel', $this->channel);
        $stmt->bindParam(':NextBillingDate', $this->NextBillingDate);
        $stmt->bindParam(':Type', $this->Type);
        $stmt->bindParam(':ShortCode', $this->ShortCode);
        $stmt->bindParam(':BillingId', $this->BillingId);
        $stmt->bindParam(':ChargeAmount', $this->ChargeAmount);
        $stmt->bindParam(':planId', $this->planId);
        $stmt->bindParam(':command', $this->command);
        $stmt->bindParam(':updated_at', $this->updated_at);

        if($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function updateUnsubscription(){

		$sql = 'UPDATE ' . $this->tableName . ' SET externalServiceId = :externalServiceId, requestId = :requestId, requestTimeStamp = :requestTimeStamp, channel = :channel, Msisdn = :Msisdn, OfferCode = :OfferCode, TransactionId = :TransactionId, ClientTransactionId = :ClientTransactionId, SubscriberLifeCycle = :SubscriberLifeCycle, SubscriptionStatus = :SubscriptionStatus, Reason = :Reason, Type = :Type, planId = :planId, command = :command, updated_at = :updated_at WHERE Msisdn = :Msisdn AND OfferCode = :OfferCode ';

		$stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':externalServiceId', $this->externalServiceId);
        $stmt->bindParam(':requestId', $this->requestId);
        $stmt->bindParam(':requestTimeStamp', $this->requestTimeStamp);
        $stmt->bindParam(':channel', $this->channel);
        $stmt->bindParam(':Msisdn', $this->Msisdn);
        $stmt->bindParam(':OfferCode', $this->OfferCode);
        $stmt->bindParam(':TransactionId', $this->TransactionId);
        $stmt->bindParam(':ClientTransactionId', $this->ClientTransactionId);
        $stmt->bindParam(':SubscriberLifeCycle', $this->SubscriberLifeCycle);
        $stmt->bindParam(':SubscriptionStatus', $this->SubscriptionStatus);
        $stmt->bindParam(':Reason', $this->Reason);
        $stmt->bindParam(':Type', $this->Type);
        $stmt->bindParam(':planId', $this->planId);
        $stmt->bindParam(':command', $this->command);
        $stmt->bindParam(':updated_at', $this->updated_at);

        if($stmt->execute()) {
			return true;
		} else {
			return false;
		}


	}


	public function checkSubscriber(){

		$sql = 'SELECT Msisdn from '. $this->tableName .' WHERE Msisdn = :Msisdn AND OfferCode = :OfferCode';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':Msisdn', $this->Msisdn);
		$stmt->bindParam(':OfferCode', $this->OfferCode);
		$stmt->execute();
		$subscriber = $stmt->fetch(PDO::FETCH_ASSOC);
		return $subscriber;
	}


	public function getChunkedSubscribersMT1(){

        //SELECT * FROM mobi_connect.subscribers LIMIT 0, 1000
		$sql = 'SELECT Msisdn, subscriber_id, SubscriptionStatus from '. $this->tableName .' WHERE subscriber_id > :last_id AND OfferCode = :OfferCode AND SubscriptionStatus = "A" ORDER BY subscriber_id ASC LIMIT 0, 30000';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':last_id', $this->last_id);
		$stmt->bindParam(':OfferCode', $this->OfferCode);
		$stmt->execute();
        
        $count = $stmt->rowCount();

        if($count > 0){
	        while($subscriber = $stmt->fetch(PDO::FETCH_ASSOC)){

				$arr[] = $subscriber;
			}
			return $arr;
	    }

        $this->dbConn = $this->db->disconnect();
	}



	#uploading the next checked sub base 
	public function getChunkedSubscribersMT2(){

        //SELECT * FROM mobi_connect.subscribers LIMIT 0, 1000
		$sql = 'SELECT Msisdn, subscriber_id, SubscriptionStatus from '. $this->tableName .' WHERE subscriber_id > :last_id AND OfferCode = :OfferCode AND SubscriptionStatus = "A" ORDER BY subscriber_id ASC LIMIT 30000, 30000';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':last_id', $this->last_id);
		$stmt->bindParam(':OfferCode', $this->OfferCode);
		$stmt->execute();
        
        $count = $stmt->rowCount();

        if($count > 0){
	        while($subscriber = $stmt->fetch(PDO::FETCH_ASSOC)){

				$arr[] = $subscriber;
			}
			return $arr;
	    }

        $this->dbConn = $this->db->disconnect();
	}


	#uploading the next  30000 checked sub base 
	public function getChunkedSubscribersMT3(){

        //SELECT * FROM mobi_connect.subscribers LIMIT 0, 1000
		$sql = 'SELECT Msisdn, subscriber_id, SubscriptionStatus from '. $this->tableName .' WHERE subscriber_id > :last_id AND OfferCode = :OfferCode AND SubscriptionStatus = "A" ORDER BY subscriber_id ASC LIMIT 60000, 30000';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':last_id', $this->last_id);
		$stmt->bindParam(':OfferCode', $this->OfferCode);
		$stmt->execute();
        
        $count = $stmt->rowCount();

        if($count > 0){
	        while($subscriber = $stmt->fetch(PDO::FETCH_ASSOC)){

				$arr[] = $subscriber;
			}
			return $arr;
	    }

        $this->dbConn = $this->db->disconnect();
	}

	#uploading the next 30000 checked sub base 
	public function getChunkedSubscribersMT4(){

        //SELECT * FROM mobi_connect.subscribers LIMIT 0, 1000
		$sql = 'SELECT Msisdn, subscriber_id, SubscriptionStatus from '. $this->tableName .' WHERE subscriber_id > :last_id AND OfferCode = :OfferCode AND SubscriptionStatus = "A" ORDER BY subscriber_id ASC LIMIT 90000, 30000';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':last_id', $this->last_id);
		$stmt->bindParam(':OfferCode', $this->OfferCode);
		$stmt->execute();
        
        $count = $stmt->rowCount();

        if($count > 0){
	        while($subscriber = $stmt->fetch(PDO::FETCH_ASSOC)){

				$arr[] = $subscriber;
			}
			return $arr;
	    }

        $this->dbConn = $this->db->disconnect();
	}


	#uploading the next 30000 checked sub base 
	public function getChunkedSubscribersMT5(){

        //SELECT * FROM mobi_connect.subscribers LIMIT 0, 1000
		$sql = 'SELECT Msisdn, subscriber_id, SubscriptionStatus from '. $this->tableName .' WHERE subscriber_id > :last_id AND OfferCode = :OfferCode AND SubscriptionStatus = "A" ORDER BY subscriber_id ASC LIMIT 120000, 30000';
		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':last_id', $this->last_id);
		$stmt->bindParam(':OfferCode', $this->OfferCode);
		$stmt->execute();
        
        $count = $stmt->rowCount();

        if($count > 0){
	        while($subscriber = $stmt->fetch(PDO::FETCH_ASSOC)){

				$arr[] = $subscriber;
			}
			return $arr;
	    }

        $this->dbConn = $this->db->disconnect();
	}


	public function closeDB(){
		$this->dbConn = $this->db->disconnect();
	}

}

?>