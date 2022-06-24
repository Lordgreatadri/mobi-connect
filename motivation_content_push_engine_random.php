<?php
require_once('outbox.php');
require_once('outbox_tracker.php');
require_once('subscriber.php');
require_once("functions.php");
//SELECT * FROM mobi_connect.subscribers LIMIT 0, 1000




//get content to send.
$outBoxModel = new OutBox;
//$outBoxModel->setSubscriptionId('9916110009');
$outBoxModel->setStatus('uncompleted');
$contentToSend = $outBoxModel->getRandMessage();



//echo $contentToSend['subscription_id'];

if(!empty($contentToSend ['content'])){
  //content available 
	$outBoxTracker = new OutBoxTracker;
	$outBoxTracker->setSubscriptionId($contentToSend['subscription_id']);

  
	//get the id of the last person content was sent to.
	$lastId = $outBoxTracker->getId();
	

	//get subscribers who are active on this subscription_id
	 $subscriber = new Subscriber;
	 $subscriber->setLastId($lastId['last_id']);
	 $subscriber->setOfferCode($contentToSend['subscription_id']);
	 $result = $subscriber->getChunkedSubscribers();


	//check if there are available subscribers
	if(!empty($result)){

    //instantiate the MobiConnect Class
    $mobiconnect = new MobiConnect;

		foreach($result as $sub){

			//call function to push content here
			//echo $sub['Msisdn'].'<br/>';
			$mobiconnect->contentPush($contentToSend ['content'], "161", $contentToSend['subscription_id'], $sub['Msisdn'], "2");

			//keep track of the id of the last subscriber to be processed.
			$last_subscriber_id = $sub['subscriber_id'];
		}

		echo $last_subscriber_id;

	   //update the last id and the subscription id in outbox tracker.
	   $outBoxTracker->setLastId($last_subscriber_id);
	   $outBoxTracker->setSubscriptionId($contentToSend['subscription_id']);
	   $outBoxTracker->updateOutBox();
	}else{

		

		//update this particular row in outbox tracker
		$outBoxTracker->setSubscriptionId($contentToSend['subscription_id']);
		$outBoxTracker->setLastId('0');
		$outBoxTracker->updateOutBox();

		//update related row in outbox

		echo "No more subscribers available, So updated outbox tracker";
	}
	
	
}else{
	echo "No content";
}



?>