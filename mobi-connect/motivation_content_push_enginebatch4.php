<?php
ini_set('max_execution_time', 10800); // 3 hours max execution time
require_once('outbox.php');
require_once('outbox_tracker.php');
require_once('subscriber.php');
require_once("functions.php");
require_once("messagehistory.php");
//SELECT * FROM mobi_connect.subscribers LIMIT 0, 1000


//get content to send.
$scheduled_date = date("Y-m-d H:i");
$outBoxModel = new OutBox;
$outBoxModel->setSubscriptionId('9916110010');
$outBoxModel->setStatus('uncompleted');

//check and get only scheduled contents when the set time is due........
$outBoxModel->setScheduledDate($scheduled_date);
$contentToSend = $outBoxModel->getMessage();




if(!empty($contentToSend ['content'])){
  //content available 
	$outBoxTracker = new OutBoxTracker;
	//$outBoxTracker->connect();

	

	$outBoxTracker->setSubscriptionId('9916110010');
	//also set a batch number
  $outBoxTracker->setBatchNo('MT-4');
  
	//get the id of the last person content was sent to.
	$lastId = $outBoxTracker->getId();
	

	//get subscribers who are active on this subscription_id
	$subscriber = new Subscriber;
	$subscriber->setLastId($lastId['last_id']);
	$subscriber->setOfferCode('9916110010');
	$result = $subscriber->getChunkedSubscribersMT4();
   

	//check if there are available subscribers
	if(!empty($result)){

    //instantiate the MobiConnect Class
    $mobiconnect = new MobiConnect;

		foreach($result as $sub){

			//call function to push content here
			//echo $sub['Msisdn'].'<br/>';
			$smsResponse = $mobiconnect->contentPush($contentToSend ['content'], "161", "9916110010", $sub['Msisdn'], "2");
			$output = json_decode($smsResponse, true);

			//log message here
			
			$messageHistoryModel = new MessageHistory;
			$messageHistoryModel->setStatusCode($output["statusCode"]);
			$messageHistoryModel->setStatusMessage($output["statusMessage"]);
			$messageHistoryModel->setTransactionId($output["transactionId"]);
			$messageHistoryModel->setSmsTime(date("y-m-d H:i:s"));
			$messageHistoryModel->setMessage($contentToSend ['content']);
			$messageHistoryModel->setMsisdn($sub['Msisdn']);
			$messageHistoryModel->setOfferId("9916110010");
			$messageHistoryModel->logMessage();
			
      
			//keep track of the id of the last subscriber to be processed.
			$last_subscriber_id = $sub['subscriber_id'];
		}

		echo $last_subscriber_id;

	   //update the last id and the subscription id in outbox tracker.
		 $outBoxTracker = new OutBoxTracker;
	   $outBoxTracker->setLastId($last_subscriber_id);
	   $outBoxTracker->setSubscriptionId('9916110010');
	   //also set a batch number
     $outBoxTracker->setBatchNo('MT-4');
	   $outBoxTracker->updateOutBox();
	}else{

		

		//update this particular row in outbox tracker
    $outBoxTracker = new OutBoxTracker;
		$outBoxTracker->setSubscriptionId('9916110010');
		$outBoxTracker->setLastId('0');
		//also set a batch number
    $outBoxTracker->setBatchNo('MT-4');
		$outBoxTracker->updateOutBox();


		//update this particular row in outbox
		$outBoxModel = new OutBox;
		$outBoxModel->setSubscriptionId('9916110010');
		$outBoxModel->setStatus('completed');
		$contentToSend = $outBoxModel->updateOutBox();

		//close connection
		//$outBoxTracker->closeDB();

		//update related row in outbox

		echo "No more subscribers available, So updated outbox tracker";
	}
	
	
}else{
	echo "No content";
}



?>