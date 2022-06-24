<?php
header('Content-Type: application/json; charset=utf-8');
require_once("functions.php");
//require_once("subscriber.php");

$update = file_get_contents("php://input");

if(empty($update)){
	echo "Access denied";
	exit;
}

$update = json_decode($update, true);
file_put_contents("request.txt", $update["service"]);

$mobiconnect = new MobiConnect;
//$subscriber = new Subscriber;

//echo $result = $mobiconnect->getAccessTokenNew("0PQdFoGXRsh7ZrHU56tNIfTWWRWFaRoc", "rgRB1LbpkObaATAS");

//echo $result = $mobiconnect->getOAuthAccessToken("0PQdFoGXRsh7ZrHU56tNIfTWWRWFaRoc", "rgRB1LbpkObaATAS");

//echo $result = $mobiconnect->subscribe("233540781969", "33", "900001", "USSD");

//echo $result = $mobiconnect->unsubscribe("233540106459", "33", "900001", "USSD");

//echo $result = $mobiconnect->chargeAmount("233543645688", "33", "900007", "USSD", 0.6);

//echo $result = $mobiconnect->sendNotification("Sample content test", "33", "900001", "233540106459", "2");

//echo $result = $mobiconnect->contentPush("Content push test", "33", "900001", "233540106459", "2");

//echo $mobiconnect->sendSMS("")

//make a decision on what service to execute

switch ($update["service"]) {
  case "subscribe":
    $mobiconnect->subscribe($update["msisdn"], "161", $update["code"], $update["channel"]);
    break;
  case "unsubscribe":
    $mobiconnect->unsubscribe($update["msisdn"], "161", $update["code"], $update["channel"]);
    break;
  case "push":
    $mobiconnect->contentPush($update["content"], "161", $update["code"], $update["msisdn"], $update["channel"]);
     //$mobiconnect->contentPush("Content push test", "33", "900001", "233540106459", "2");
    break;
  default:
    $message = "please provide valid credentials";

    echo $message;
}




/*
for($i = 0; $i<$count; $i++){
	echo $update["requestParam"]["data"][$i]["value"].'<br/>';
}
*/

/*
$subscriber ->setMsisdn("540106459");
$suv = $subscriber->checkSubscriber();
echo is_array($suv);
*/

//echo $update["externalServiceId"];

//echo "hey";
?>