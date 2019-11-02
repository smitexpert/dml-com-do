<?php

require_once 'Database.php';

$db = new Database;
$dbn = new Database;


if(isset($_POST['dml'])){
    $dml = mysqli_real_escape_string($db->link, $_POST['dml']);
    $org = mysqli_real_escape_string($db->link, $_POST['org']);
    $principal = mysqli_real_escape_string($db->link, $_POST['principal']);
    $shipper_name = mysqli_real_escape_string($db->link, $_POST['shipper_name']);
    $origin = mysqli_real_escape_string($db->link, $_POST['origin']);
    $destination = mysqli_real_escape_string($db->link, $_POST['destination']);
    $consignee_name = mysqli_real_escape_string($db->link, $_POST['consignee_name']);
    $pcs = mysqli_real_escape_string($db->link, $_POST['pcs']);
    $ship_content = mysqli_real_escape_string($db->link, $_POST['ship_content']);
    $booking_date = mysqli_real_escape_string($db->link, $_POST['booking_date']);
    
    $sql = "INSERT INTO test_track (dml_awn, org_awn, principal, shipper_name, origin, destination, consignee_name, pcs, ship_content, booking_date, status) VALUES ('$dml', '$org', '$principal', '$shipper_name', '$origin', '$destination', '$consignee_name', '$pcs', '$ship_content', '$booking_date', '1')";
    $query = $db->link->query($sql);
    if($query){
        echo 1;
    }else{
        echo 0;
//        echo $db->link->error;
    }
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if(isset($_POST['up_dml'])){
    $local_ip = $_POST['local_ip'];
    $id = mysqli_real_escape_string($db->link, $_POST['up_id']);
    $dml = mysqli_real_escape_string($db->link, $_POST['up_dml']);
    $org = mysqli_real_escape_string($db->link, $_POST['up_org']);
    $principal = mysqli_real_escape_string($db->link, $_POST['up_principal']);
    $shipper_name = mysqli_real_escape_string($db->link, $_POST['up_shipper_name']);
    $origin = mysqli_real_escape_string($db->link, $_POST['up_origin']);
    $destination = mysqli_real_escape_string($db->link, $_POST['up_destination']);
    $consignee_name = mysqli_real_escape_string($db->link, $_POST['up_consignee_name']);
    $pcs = mysqli_real_escape_string($db->link, $_POST['up_pcs']);
    $ship_content = mysqli_real_escape_string($db->link, $_POST['up_ship_content']);
    $booking_date = mysqli_real_escape_string($db->link, $_POST['up_booking_date']);


    $ip_address = get_client_ip();
    $local_ip = $_POST['local_ip'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $geo_location = "lat:  - long: ";

    $getSql = "SELECT test_track.id, test_track.dml_awn, test_track.org_awn, test_track.principal, test_track.shipper_name, test_track.origin, test_track.destination, test_track.consignee_name, test_track.pcs, test_track.ship_content, test_track.booking_date, test_track.status FROM test_track WHERE test_track.id='$id'";

    $getQuery = $db->link->query($getSql);

    $getRow = $getQuery->fetch_assoc();

    // var_dump($getRow);

    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $now_date = $dt->format('F j, Y, g:i a');

    $old_id = mysqli_real_escape_string($db->link, $getRow['id']);
    $old_dml_awn = mysqli_real_escape_string($db->link, $getRow['dml_awn']);
    $old_org_awn = mysqli_real_escape_string($db->link, $getRow['org_awn']);
    $old_principal = mysqli_real_escape_string($db->link, $getRow['principal']);
    $old_shipper_name = mysqli_real_escape_string($db->link, $getRow['shipper_name']);
    $old_origin = mysqli_real_escape_string($db->link, $getRow['origin']);
    $old_destination = mysqli_real_escape_string($db->link, $getRow['destination']);
    $old_consignee_name = mysqli_real_escape_string($db->link, $getRow['consignee_name']);
    $old_pcs = mysqli_real_escape_string($db->link, $getRow['pcs']);
    $old_ship_content = mysqli_real_escape_string($db->link, $getRow['ship_content']);
    $old_booking_date = mysqli_real_escape_string($db->link, $getRow['booking_date']);

    $inSql = "INSERT INTO test_track_update_history (table_id, dml_awn, org_awn, principal, shipper_name, origin, destination, consignee_name, pcs, ship_content, booking_date, ip_address, local_ip, user_agent, geo_location, status, update_date) VALUES ('$old_id', '$old_dml_awn', '$old_org_awn', '$old_principal', '$old_shipper_name', '$old_origin', '$old_destination', '$old_consignee_name', '$old_pcs', '$old_ship_content', '$old_booking_date', '$ip_address', '$local_ip', '$user_agent', '$geo_location', '".$getRow['status']."', '$now_date');UPDATE test_track SET dml_awn='$dml', org_awn='$org', principal='$principal', shipper_name='$shipper_name', origin='$origin', destination='$destination', consignee_name='$consignee_name', pcs='$pcs', ship_content='$ship_content', booking_date='$booking_date' WHERE id='$id'";
    $query = $dbn->link->multi_query($inSql);
    if($query){
        echo 1;
    }else{
        // echo 0;
       echo $db->link->error;
    }
}



if(isset($_POST['dlt_id'])){
    $id = $_POST['dlt_id'];
    $ip_address = get_client_ip();
    $local_ip = $_POST['local_ip'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $geo_location = "";
    // $geo_location_array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip_address));

    $geo_location_array = "";

    if(empty($geo_location_array)){
        $geo_location_array['geoplugin_latitude'] = "";
        $geo_location_array['geoplugin_longitude'] = "";
    }


    $geo_location_lat = $geo_location_array['geoplugin_latitude'];
    $geo_location_long = $geo_location_array['geoplugin_longitude'];

    $geo_location = "lat: ".$geo_location_lat." - long: ".$geo_location_long;

    $getSql = "SELECT test_track.id, test_track.dml_awn, test_track.org_awn, test_track.principal, test_track.shipper_name, test_track.origin, test_track.destination, test_track.consignee_name, test_track.pcs, test_track.ship_content, test_track.booking_date, test_track.status FROM test_track WHERE test_track.dml_awn='$id'";

    $getQuery = $db->link->query($getSql);

    $getRow = $getQuery->fetch_assoc();

    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $now_date = $dt->format('F j, Y, g:i a');

    $inSql = "INSERT INTO test_track_delete_history (table_id, dml_awn, org_awn, principal, shipper_name, origin, destination, consignee_name, pcs, ship_content, booking_date, ip_address, local_ip, user_agent, geo_location, status, del_date) VALUES ('".$getRow['id']."', '".$getRow['dml_awn']."', '".$getRow['org_awn']."', '".$getRow['principal']."', '".$getRow['shipper_name']."', '".$getRow['origin']."', '".$getRow['destination']."', '".$getRow['consignee_name']."', '".$getRow['pcs']."', '".$getRow['ship_content']."', '".$getRow['booking_date']."', '$ip_address', '$local_ip', '$user_agent', '$geo_location', '".$getRow['status']."', '$now_date'); DELETE FROM test_track WHERE dml_awn='$id'";

    // $sql = "DELETE FROM test_track WHERE dml_awn='$id'";

    $query = $db->link->multi_query($inSql);
    if($query){
        echo 1;
    }else{
        echo $db->link->error;
    }

    // echo $now_date; 
}

if(isset($_POST['org_up_id'])){
    $id = $_POST['org_up_id'];
    $org = $_POST['org_up'];
    
    $sql = "UPDATE test_track SET org_awn='$org' WHERE dml_awn='$id'";
    $query = $db->link->query($sql);
    if($query){
        echo '1';
    }else{
        echo '0';
    }
}

if(isset($_POST['update_id'])){
    $update_id = $_POST['update_id'];
    
    $sql = "SELECT * FROM test_track WHERE dml_awn='$update_id'";
    $query = $db->link->query($sql);
    $data = $query->fetch_array();
    
    echo json_encode($data);
}


?>