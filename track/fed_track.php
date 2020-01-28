<?php



function fedex_tracking($dml_awn, $org_awn, $date_time=null){

if(null === $date_time){
    $date_time = [
        'DATE' => date('d M Y'),
        'TIME' => date('H:i A'),
    ];
}
    
include('php_get_urls.php');

$awn = $org_awn;

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
    ?>
<table class="table tbl_five">


    <?php
    
    for($i=count($ships)-1; $i>=0; $i--){
        if(isset($ships[$i]['EventType'])){
            ?>
    <tr>
        <td><?php echo date('d M Y', strtotime($ships[$i]['Timestamp'])); ?></td>
        <td><?php echo date('h:i:A', strtotime($ships[$i]['Timestamp'])); ?></td>
        <?php
                if(isset($ships[$i]['Address']['City'])){
                    ?>
        <td><?php echo $ships[$i]['Address']['City'].', '.$ships[$i]['Address']['CountryCode'];?></td>

        <?php
                }else{
                    ?>
        <td></td>
        <?php
                }
                ?>

        <td><?php echo $ships[$i]['EventDescription'];?></td>

    </tr>
    <?php
            /*echo $ships[$i]['Timestamp'].' ';
            if(isset($ships[$i]['Address']['City'])){
                echo $ships[$i]['Address']['City'].', ';
                echo $ships[$i]['Address']['CountryCode'].' ';
            }
            echo $ships[$i]['EventType'].' ';
            echo $ships[$i]['EventDescription'].' <br>';*/
        }
    }
    
    ?>

</table>

<?php
    
    }
}


?>
