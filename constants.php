<?php
/* end points */

//test access token url
//define('ACCESS_TOKEN_URL', 'https://staging.api.mtn.com/edgemicro-custom-auth/token');

//live environment access token url
define('ACCESS_TOKEN_URL', 'https://api.mtn.com/edgemicro-custom-auth/token');


//test O auth url
//define('OAUTH_URL', 'https://preprod.api.mtn.com/v1/oauth/access_token/accesstoken?grant_type=client_credentials');

//live environment O auth url
define('OAUTH_URL', 'https://api.mtn.com/v1/oauth/access_token/accesstoken?grant_type=client_credentials');


//live environment for content push
define('CONTENT_PUSH_URL', 'https://api.mtn.com/v1/contents/pushes');

//define('SUBSCRIPTION_URL', 'https://api.mtn.com/v2/customers/'.$customer_id.'/subscriptions');
?>