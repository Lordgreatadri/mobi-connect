<?php
require_once('constants.php');
class MobiConnect{


    public function getAccessTokenNew($client_id, $client_secret){
        $data_to_post = array(
            'grant_type' => 'client_credentials'
        );

        //basic auth key generation
        $basic_auth_key = 'Basic '.base64_encode($client_id . ':' . $client_secret);
        $request_url = ACCESS_TOKEN_URL;
        $data_to_post = json_encode($data_to_post);

        $ch =  curl_init($request_url);  
				curl_setopt( $ch, CURLOPT_POST, true );  
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_to_post);  
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
				    'Authorization: '.$basic_auth_key,
				    'Cache-Control: no-cache',
				    'Content-Type: application/json',
				  ));

		$result = curl_exec($ch); 
		$err = curl_error($ch);
		curl_close($ch);


        if($err){
			return $err;
		}else{
			
			$json = json_decode($result, true);
			
			return $json["access_token"];
		}
    }


    public function processData($data){

        $type = "none";

        $json_output = json_decode($data, true);
        $count = count($json_output["requestParam"]["data"]);

        for($i = 0; $i<$count; $i++){
            //echo $json_output["requestParam"]["data"][$i]["name"].'-'.$json_output["requestParam"]["data"][$i]["value"].'<br/>';

            
            if($json_output["requestParam"]["data"][$i]["name"] == "Type"){

                $type = $json_output["requestParam"]["data"][$i]["value"];
            }
        
        }

        return $type;

    }


    


    public function subscribe($customer_id, $node_id, $subscription_id, $registeration_channel){

        $access_token = $this->getAccessTokenNew("hGDR6B0dlEgCvMJpz1fubSUcDv8lG0Lj", "qnY7S4TTYrr9Tvtl");


        $curl = curl_init();
        //$url = 'https://staging-ghana.api.mtn.com/v2/customers/'.$customer_id.'/subscriptions';
        
        $data_to_post = array(
            'nodeId' => $node_id,
            'subscriptionId' => $subscription_id, 
            'registrationChannel' => $registeration_channel,
            'subscriptionProviderId' => "SM6D"
        );

        $data_to_post = json_encode($data_to_post);

        curl_setopt_array($curl, array(
        
        //test bed url
        //CURLOPT_URL => 'https://staging-ghana.api.mtn.com/v2/customers/'.$customer_id.'/subscriptions',
        //live environment url
        CURLOPT_URL => 'https://ghana.api.mtn.com/v2/customers/'.$customer_id.'/subscriptions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data_to_post,
        CURLOPT_HTTPHEADER => array(
            'x-country-code: GHA',
            'Authorization: Bearer '.$access_token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }


    
    public function unsubscribe($customer_id, $node_id, $subscription_id, $registeration_channel){

        $access_token = $this->getAccessTokenNew("hGDR6B0dlEgCvMJpz1fubSUcDv8lG0Lj", "qnY7S4TTYrr9Tvtl");

        $curl = curl_init();

        $data_to_post = array(
            'callbackUrl' => 'http://mobi-connect/callback/',
            'description' => 'Unsubscription for '.$subscription_id.' for'.$customer_id
        );

        $data_to_post = json_encode($data_to_post);

        curl_setopt_array($curl, array(

        //test url for unsubscription    
        //CURLOPT_URL => 'https://staging-ghana.api.mtn.com/v2/customers/'.$customer_id.'/subscriptions/'.$subscription_id.'?subscriptionProviderId=SM6D&nodeId='.$node_id.'&registrationChannel='.$registeration_channel.'',

        //live environment url for unsubscription
        CURLOPT_URL => 'https://ghana.api.mtn.com/v2/customers/'.$customer_id.'/subscriptions/'.$subscription_id.'?subscriptionProviderId=SM6D&nodeId='.$node_id.'&registrationChannel='.$registeration_channel.'',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_POSTFIELDS => $data_to_post,
        CURLOPT_HTTPHEADER => array(
        
            'x-country-code: GHA',
            'Authorization: Bearer '.$access_token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }




    public function chargeAmount($customer_id, $node_id, $subscription_id, $registeration_channel, $amount_charged){

        //$access_token = $this->getAccessTokenNew("0PQdFoGXRsh7ZrHU56tNIfTWWRWFaRoc", "rgRB1LbpkObaATAS");
        $access_token = $this->getAccessTokenNew("hGDR6B0dlEgCvMJpz1fubSUcDv8lG0Lj", "qnY7S4TTYrr9Tvtl");


        $curl = curl_init();

        $data_to_post = array(
            "nodeId" => $node_id,
            "subscriptionId" => $subscription_id, 
            "registrationChannel" => $registeration_channel,
            "subscriptionProviderId" => "SM6D",
            'amountCharged'=> $amount_charged
        );

        $data_to_post = json_encode($data_to_post);

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://staging-ghana.api.mtn.com/v2/customers/'.$customer_id.'/subscriptions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data_to_post,
        CURLOPT_HTTPHEADER => array(
            'x-country-code: GHA',
            'Authorization: Bearer '.$access_token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;


    }


    public function sendSMS($recieverAddr, $message, $clientCorrelator){

        //$access_token = $this->getAccessTokenNew("0PQdFoGXRsh7ZrHU56tNIfTWWRWFaRoc", "rgRB1LbpkObaATAS");
        $access_token = $this->getAccessTokenNew("hGDR6B0dlEgCvMJpz1fubSUcDv8lG0Lj", "qnY7S4TTYrr9Tvtl");


        $curl = curl_init();

        $data_to_post = array(
            "senderAddress" => '5128',
            "receiverAddress" => $recieverAddr, 
            "message" => $message,
            "clientCorrelator" => ""
        );

        $data_to_post = json_encode($data_to_post);

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://staging-ghana.api.mtn.com/v2/customers/'.$customer_id.'/subscriptions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data_to_post,
        CURLOPT_HTTPHEADER => array(
            'x-country-code: GHA',
            'Authorization: Bearer '.$access_token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        
    }



    //get Oauth access token
    public function getOAuthAccessToken($client_id, $client_secret){
        $data_to_post = array(
            'grant_type' => 'client_credentials'
        );

        //basic auth key generation
        $basic_auth_key = 'Basic '.base64_encode($client_id . ':' . $client_secret);
        $request_url = OAUTH_URL;
        $data_to_post = json_encode($data_to_post);

        $ch =  curl_init($request_url);  
                curl_setopt( $ch, CURLOPT_POST, true );  
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_to_post);  
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt($ch, CURLOPT_VERBOSE, true); 
                curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: '.$basic_auth_key,
                    'Cache-Control: no-cache',
                    'Content-Type: application/json',
                  ));

        $result = curl_exec($ch); 
        $err = curl_error($ch);
        curl_close($ch);


        if($err){
            return $err;
        }else{
            
            $json = json_decode($result, true);
            
            return $json["access_token"];
        }
    }



    public function sendNotification($messageContent, $contentProviderId, $subscriptionId, $customerId, $channel){

        $access_token = $this->getOAuthAccessToken("hGDR6B0dlEgCvMJpz1fubSUcDv8lG0Lj", "qnY7S4TTYrr9Tvtl");


        $curl = curl_init();

        $data_to_post = array(
            "messageContent" => $messageContent,
            "contentProviderId" => $contentProviderId, 
            "subscriptionId" => $subscriptionId,
            "customerId" => $customerId,
            "channel"    => $channel
        );

        $data_to_post = json_encode($data_to_post);

        curl_setopt_array($curl, array(

        //test content push url    
        //CURLOPT_URL => 'https://preprod.api.mtn.com/v1/notification/3PP/61e00ed06d94a52f98e0bcf1',

        //live environment content push url    
        CURLOPT_URL => 'https://api.mtn.com/v1/notification/3PP/61e00ed06d94a52f98e0bcf1',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data_to_post,
        CURLOPT_HTTPHEADER => array(
            'x-country-code: GHA',
            'Authorization: Bearer '.$access_token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        
    }



    public function contentPush($messageContent, $contentProviderId, $subscriptionId, $customerId, $channel){

        $access_token = $this->getOAuthAccessToken("hGDR6B0dlEgCvMJpz1fubSUcDv8lG0Lj", "qnY7S4TTYrr9Tvtl");


        $curl = curl_init();

        $data_to_post = array(
            "messageContent" => $messageContent,
            "contentProviderId" => $contentProviderId, 
            "subscriptionId" => $subscriptionId,
            "customerId" => $customerId,
            "channel"    => $channel
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

        curl_close($curl);
        return $response;
        
    }


    public function sayHello(){
        echo  $access_token = $this->getOAuthAccessToken("hGDR6B0dlEgCvMJpz1fubSUcDv8lG0Lj", "qnY7S4TTYrr9Tvtl");
    }
}
?>