<?php
require_once("functions.php");
require_once("messagehistory.php");
$mobiconnect = new MobiConnect;
/*
$smsResponse = $mobiconnect->contentPush("Hello swizi bansi", "161", "9916110010", '540106459', "2");


$output = json_decode($smsResponse, true);

var_dump($output);
*/


//log message here
/*
$messageHistoryModel = new MessageHistory;
$messageHistoryModel->setStatusCode($output["statusCode"]);
$messageHistoryModel->setStatusMessage($output["statusMessage"]);
$messageHistoryModel->setTransactionId($output["transactionId"]);
$messageHistoryModel->setSmsTime(date("y-m-d H:i:s"));
$messageHistoryModel->setMessage("Proverbs is serious");
$messageHistoryModel->setMsisdn("540106459");
$messageHistoryModel->setOfferId("9916110010");
$messageHistoryModel->logMessage();

echo $output["transactionId"];
*/


        


        $access_token = $mobiconnect->getOAuthAccessToken("hGDR6B0dlEgCvMJpz1fubSUcDv8lG0Lj", "qnY7S4TTYrr9Tvtl");


        $curl = curl_init();

        $data_to_post = array(
            "messageContent" => "$messageContent content",
            "contentProviderId" => "161", 
            "subscriptionId" => "9916110010",
            "customerId" => '244454889',
            "channel"    => '2'
        );

        $data_to_post = json_encode($data_to_post);

        curl_setopt_array($curl, array(
        //CURLOPT_URL => 'https://preprod.api.mtn.com/v1/notification/3PP/61e00ed06d94a52f98e0bcf1',
        CURLOPT_URL => CONTENT_PUSH_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_VERBOSE => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data_to_post,
        CURLOPT_HTTPHEADER => array(
            'targetSystem: SM6D',
            'x-country-code: GHA',
            'Authorization: Bearer '.$access_token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        print_r(curl_getinfo($curl));

        curl_close($curl);

        var_dump($response);
?>