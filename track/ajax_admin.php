<?php

require_once 'Database.php';

$db = new Database;


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


if(isset($_POST['up_dml'])){
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
    
    $sql = "UPDATE test_track SET dml_awn='$dml', org_awn='$org', principal='$principal', shipper_name='$shipper_name', origin='$origin', destination='$destination', consignee_name='$consignee_name', pcs='$pcs', ship_content='$ship_content', booking_date='$booking_date' WHERE id='$id'";
    $query = $db->link->query($sql);
    if($query){
        echo 1;
    }else{
        echo 0;
//        echo $db->link->error;
    }
}

if(isset($_POST['dlt_id'])){
    $id = $_POST['dlt_id'];
    $sql = "DELETE FROM test_track WHERE dml_awn='$id'";
    $query = $db->link->query($sql);
    if($query){
        echo 1;
    }else{
        echo 0;
    }
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