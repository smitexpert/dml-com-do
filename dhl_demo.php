<?php

if(isset($_GET['awn'])){

$awn = $_GET['awn'];

$url = "http://xmlpitest-ea.dhl.com/XMLShippingServlet";
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<req:KnownTrackingRequest xmlns:req="http://www.dhl.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com
						TrackingRequestKnown.xsd">
    <Request>
        <ServiceHeader>
            <MessageTime>2002-06-25T11:28:56-08:00</MessageTime>
            <MessageReference>1234567890123456789012345678</MessageReference>
            <SiteID>DServiceVal</SiteID>
            <Password>testServVal</Password>
        </ServiceHeader>
    </Request>
    <LanguageCode>en</LanguageCode>
    <AWBNumber>'.$awn.'</AWBNumber>
    <LevelOfDetails>ALL_CHECK_POINTS</LevelOfDetails>
    <PiecesEnabled>S</PiecesEnabled>
</req:KnownTrackingRequest>';

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



if(isset($configData['AWBInfo']['ShipmentInfo']['ShipmentEvent'])){
//    print_r($configData['AWBInfo']['ShipmentInfo']['ShipmentEvent']);
    $ships = $configData['AWBInfo']['ShipmentInfo']['ShipmentEvent'];
    
    for($i=0; $i<count($ships); $i++){
//        print_r($ships[$i]);
        foreach($ships[$i] as $ship){
//            echo '<pre>'; print_r($ship);
//            echo $ship['EventCode'];
            if(isset($ship['EventCode'])){
                echo $ship['EventCode'].' ';
                echo $ship['Description'].' <br>';
            }
                
        }
    }
}

//WC [Description] => With delivery courier
//OK [Description] => Delivered - Signed for by

//foreach($configData as $child) {
// echo '<pre>';  print_r($child);
//}
//    
    }


?>
