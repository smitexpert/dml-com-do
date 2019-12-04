<?php



function dhl_tracking($dml_awn, $org_awn, $date_time=null){

if(null === $date_time){
    $date_time = [
        'DATE' => date('d M Y'),
        'TIME' => date('H:i A'),
    ];
}
    
include('php_get_urls.php');

$awn = $org_awn;

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


if(isset($configData['AWBInfo']['ShipmentInfo']['ShipperName'])){
?>
<table class="table">
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Location</th>
        <th>Activities</th>
    </tr>
    <tr>
        <td><?php echo date('d M Y', strtotime($date_time['DATE'])) ?></td>
        <td><?php echo date('H:i: A', strtotime($date_time['TIME'])) ?></td>
        <td>DHAKA-BGD</td>
        <td>Shipment picked up</td>
    </tr>
    <?php
        if(isset($configData['AWBInfo']['ShipmentInfo']['ShipmentEvent']))                                                {
            $ships = $configData['AWBInfo']['ShipmentInfo']['ShipmentEvent'];
            
//            var_dump($ships[0]['ServiceEvent']['EventCode']);
            
            for($i=0; $i<count($ships); $i++){
                if(isset($ships[$i]['ServiceEvent']['EventCode'])){
                    ?>
    <tr>
        <td><?php echo date("d M Y", strtotime($ships[$i]['Date'])); ?></td>
        <td><?php echo date("h:i: A", strtotime($ships[$i]['Time'])); ?></td>
        <td><?php echo $ships[$i]['ServiceArea']['Description']; ?></td>
        <td><?php echo $ships[$i]['ServiceEvent']['Description']; ?></td>
    </tr>
    <?php
                }
            }
        }
    ?>
</table>
<?php
}else{
    ?>
<table class="table tbl_five">
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Location</th>
        <th>Activities</th>
    </tr>
    <tr>
        <td><?php echo date('d M Y', strtotime($date_time['DATE'])) ?></td>
        <td><?php echo date('H:i: A', strtotime($date_time['TIME'])) ?></td>
        <td>DHAKA-BGD</td>
        <td>Shipment picked up</td>
    </tr>
</table>
<?php
    }

    
    }


?>
