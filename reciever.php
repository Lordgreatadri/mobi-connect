<?php
header('Content-Type: application/json; charset=utf-8');
require_once("functions.php");
require_once("subscriber.php");
$mobiconnect = new MobiConnect;

$update = file_get_contents("php://input");
echo $type = $mobiconnect->processData($update);
file_put_contents("callback.txt", $update);
$update = json_decode($update, true);






if(!empty($update) || $update != ""){

	


	//check subscription type here
	if($type == "ACTIVATION"){

			try{

			$subscriber = new Subscriber;
			
			$subscriber->setExternalServiceId($update["externalServiceId"]);
			$subscriber->setRequestId($update["requestId"]);
			$subscriber->setRequestTimeStamp($update["requestTimeStamp"]);
			$subscriber->setChannel($update["channel"]);
			$subscriber->setMsisdn($update["requestParam"]["data"][0]["value"]);
			$subscriber->setOfferCode($update["requestParam"]["data"][1]["value"]);
			$subscriber->setTransactionId($update["requestParam"]["data"][2]["value"]);
			$subscriber->setClientTransactionId($update["requestParam"]["data"][3]["value"]);
			$subscriber->setSubscriberLifeCycle($update["requestParam"]["data"][4]["value"]);
			$subscriber->setSubscriptionStatus($update["requestParam"]["data"][5]["value"]);
			$subscriber->setNextBillingDate($update["requestParam"]["data"][7]["value"]);
			$subscriber->setType($update["requestParam"]["data"][8]["value"]);
			$subscriber->setShortCode($update["requestParam"]["data"][9]["value"]);
			$subscriber->setBillingId($update["requestParam"]["data"][10]["value"]);
			$subscriber->setChargeAmount($update["requestParam"]["data"][11]["value"]);
			$subscriber->setPlanId($update["requestParam"]["planId"]);
			$subscriber->setCommand($update["requestParam"]["command"]);

			//make a decision on update or insert
			$check = $subscriber->checkSubscriber();
			if(!is_array($check)){

				$subscriber->insertA();

			}else{
				//update subscriber data here
				$subscriber->updateSubscription();
			}
			
		}catch(Exception $e){

			echo "Error ".$e;
		}

	}elseif($type == "DEACTIVATION"){


			try{

			$subscriber = new Subscriber;
			
			$subscriber->setExternalServiceId($update["externalServiceId"]);
			$subscriber->setRequestId($update["requestId"]);
			$subscriber->setRequestTimeStamp($update["requestTimeStamp"]);
			$subscriber->setChannel($update["channel"]);
			$subscriber->setMsisdn($update["requestParam"]["data"][0]["value"]);
			$subscriber->setOfferCode($update["requestParam"]["data"][1]["value"]);
			$subscriber->setTransactionId($update["requestParam"]["data"][2]["value"]);
			$subscriber->setClientTransactionId($update["requestParam"]["data"][3]["value"]);
			$subscriber->setSubscriberLifeCycle($update["requestParam"]["data"][4]["value"]);
			$subscriber->setSubscriptionStatus($update["requestParam"]["data"][5]["value"]);
			$subscriber->setReason($update["requestParam"]["data"][7]["value"]);
			$subscriber->setType($update["requestParam"]["data"][8]["value"]);
			$subscriber->setPlanId($update["requestParam"]["planId"]);
			$subscriber->setCommand($update["requestParam"]["command"]);

			//make a decision on update or insert
			$check = $subscriber->checkSubscriber();

			if(!is_array($check)){
				$subscriber->insertD();
			}else{
				$subscriber->updateUnsubscription();
			}

		}catch(Exception $e){

			echo "Error ".$e;
		}

	}

	
}

?>