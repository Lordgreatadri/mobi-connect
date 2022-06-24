<?php
require_once('functions.php');
$sample_data = '{"externalServiceId":"233540106459","requestId":"a20588660301583576","requestTimeStamp":"20220403110735","channel":"2","requestParam":{"data":[{"name":"Msisdn","value":"540106459"},{"name":"OfferCode","value":"900001"},{"name":"TransactionId","value":"a20588660301583576"},{"name":"ClientTransactionId","value":"3e9158e5-c577-54d0-8397-b194dc9c1924"},{"name":"SubscriberLifeCycle","value":"SUB1"},{"name":"SubscriptionStatus","value":"A"},{"name":"Channel","value":"2"},{"name":"NextBillingDate","value":"2022-05-03 11:07:35"},{"name":"Type","value":"ACTIVATION"},{"name":"ShortCode","value":"5145"},{"name":"BillingId","value":"a158062854155645"},{"name":"ChargeAmount","value":"0"}],"planId":"900001","command":"NotifyActivation"},"featureId":"CallBack"}';

$mobiconnect = new MobiConnect;

$type = $mobiconnect->processData($sample_data);

if()

/*
Msisdn-540106459
OfferCode-900001
TransactionId-a20588660301583576
ClientTransactionId-3e9158e5-c577-54d0-8397-b194dc9c1924
SubscriberLifeCycle-SUB1
SubscriptionStatus-A
Channel-2
NextBillingDate-2022-05-03 11:07:35
Type-ACTIVATION
ShortCode-5145
BillingId-a158062854155645
ChargeAmount-0
*/
?>