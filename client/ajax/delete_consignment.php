<?php
include("../../lib/Session.php");
include("../../lib/Database.php");



Session::checkAgentSession();
$t = time();
$transaction_id = 'DML'.$t;

$agent_email = Session::get('agent_email');
$agent_id = Session::get('agent_id');
$db = new Database();

if(isset($_POST['tracking_number'])){

    $tracking_number = $_POST['tracking_number'];

    //get shiping price
    $getShipingPrice = "SELECT g_shipment_charge FROM  consignment_booking WHERE tracking_id = '$tracking_number' AND status = '1'";
    $getPrice = $db->link->query($getShipingPrice);

    if($getPrice->num_rows > 0){
        while($row = $getPrice->fetch_assoc()){
            $shipingPrice = $row['g_shipment_charge'];
        }
    }
    //update agent_account
    $updateAgentAccount = "UPDATE agent_accounts SET debit_amount = debit_amount - $shipingPrice WHERE agent_email = '$agent_email'; UPDATE consignment_booking  SET status = '0' WHERE tracking_id = '$tracking_number' AND status = '1'";

    $getInfo = $db->link->multi_query($updateAgentAccount);

    
    if($getInfo){
        echo 1;
    }else{
        echo $db->link->error;
    }

}

if(isset($_POST['undo_tracking_number'])){

    $tracking_number = $_POST['undo_tracking_number'];

    //get shiping price
    $getShipingPrice = "SELECT g_shipment_charge FROM  consignment_booking WHERE tracking_id = '$tracking_number' AND status = '0'";
    $getPrice = $db->link->query($getShipingPrice);

    if($getPrice->num_rows > 0){
        while($row = $getPrice->fetch_assoc()){
            $shipingPrice = $row['g_shipment_charge'];
        }
    }
    //update agent_account
    $updateAgentAccount = "UPDATE agent_accounts SET debit_amount = debit_amount + $shipingPrice WHERE agent_email = '$agent_email'; UPDATE consignment_booking  SET status = '1' WHERE tracking_id = '$tracking_number' AND status = '0'";

    $getInfo = $db->link->multi_query($updateAgentAccount);

    
    if($getInfo){
        echo 1;
    }else{
        echo $db->link->error;
    }

}
if(isset($_POST['undo_tracking_number_fetch'])){

    $tracking_number = $_POST['undo_tracking_number_fetch'];

    //get shiping price
    $getShipingPrice = "SELECT consignment_booking.*, custom_tracking_no.custom_id, tbl_country.country_name FROM consignment_booking INNER JOIN custom_tracking_no ON consignment_booking.tracking_id = custom_tracking_no.tracking_id INNER JOIN tbl_country ON consignment_booking.r_country = tbl_country.country_tag WHERE consignment_booking.tracking_id = '$tracking_number' AND consignment_booking.s_type = 'agent' AND consignment_booking.status = '1'";
    $getPrice = $db->link->query($getShipingPrice);

    echo json_encode($getPrice->fetch_assoc());
   
    

}
?>