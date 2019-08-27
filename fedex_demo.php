<?php

if(isset($_GET['awn'])){

$awn = $_GET['awn'];

$url = "https://gatewaybeta.fedex.com:443/xml";
$xml = "<TrackRequest xmlns='http://fedex.com/ws/track/v3'>
    <WebAuthenticationDetail>
        <UserCredential>
            <Key>KEk7IRIZgkeWLNbt</Key>
            <Password>7osKRFYhFt1RataGgArHmotvk</Password>
        </UserCredential>
    </WebAuthenticationDetail>
    <ClientDetail>
        <AccountNumber>510087860</AccountNumber>
        <MeterNumber>113990600</MeterNumber>
    </ClientDetail>
    <TransactionDetail>
        <CustomerTransactionId>ActiveShipping</CustomerTransactionId>
    </TransactionDetail>
    <Version>
        <ServiceId>trck</ServiceId>
        <Major>3</Major>
        <Intermediate>0</Intermediate>
        <Minor>0</Minor>
    </Version>
    <PackageIdentifier>
        <Value>".$awn."</Value>
        <Type>TRACKING_NUMBER_OR_DOORTAG</Type>
    </PackageIdentifier>
    <IncludeDetailedScans>1</IncludeDetailedScans>
</TrackRequest>";

$headers = array(
"Content-type: text/xml",
"Content-length: " . strlen($xml),
"Connection: close",
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$data = curl_exec($ch);
//echo $data;
/*if(curl_errno($ch))
print curl_error($ch);
else
curl_close($ch);*/

//$xml = json_encode($xml);



$ob= simplexml_load_string($data);
$json = json_encode($ob);
$configData = json_decode($json, true);
//var_dump($configData);

//if(isset($configData['TrackDetails']['Events'])){
//    echo 'Events Available'; 
//}else{
//    echo 'Nothing is found';
//}

if(isset($configData['TrackDetails']['Events'])){
//    print_r($configData['AWBInfo']['ShipmentInfo']['ShipmentEvent']);
    $ships = $configData['TrackDetails']['Events'];
    
//    echo count($ships);
    
//foreach($ships as $ship){
//        if(isset($ship['EventType'])){
//            echo $ship['EventType'].' ';
//            echo $ship['EventDescription'].' <br>';
//        }
//
//    }
//}
    
    for($i=count($ships)-1; $i>=0; $i--){
        if(isset($ships[$i]['EventType'])){
            echo $ships[$i]['EventType'].' ';
            echo $ships[$i]['EventDescription'].' <br>';
        }
    }

//WC [Description] => With delivery courier
//OK [Description] => Delivered - Signed for by

/*foreach($configData as $child) {
 echo '<pre>';  print_r($child);
}*/
    
    }
}


?>
