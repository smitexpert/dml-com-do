<?php
include("../../lib/Session.php");
include("../../lib/Database.php");



Session::checkAgentSession();
$t = time();
$transaction_id = 'DML'.$t;

$agent_email = Session::get('agent_email');
$agent_id = Session::get('agent_id');
$db = new Database();

if(isset($_POST['consignment_id'])){

    $cons_id = $_POST['consignment_id'];

    //get consignment information from consignment_booking table
    $getConsignmentInformation = "SELECT consignment_booking.*, agent_consignment.service_id, custom_tracking_no.custom_id FROM consignment_booking INNER JOIN agent_consignment ON consignment_booking.tracking_id = agent_consignment.tracking_id INNER JOIN custom_tracking_no ON custom_tracking_no.tracking_id =  consignment_booking.tracking_id WHERE consignment_booking.id='$cons_id'";

    $getInfo = $db->link->query($getConsignmentInformation);

    echo json_encode($getInfo->fetch_assoc());

}

if(isset($_POST['shiping_charge_bdt'])){
    $shiping_charge_bdt = $_POST['shiping_charge_bdt'];
    
    $sql = "SELECT currency_rate FROM currency WHERE currency_name='USD'";
    $query = $db->link->query($sql);
    $row = $query->fetch_row();
    echo $row[0]*$shiping_charge_bdt;
}

if(isset($_POST['shipping_charge'])){

    //sender information 
     $client_id = $_POST['client_id'];
     $agent_name = $_POST['sender_name'];
     $agent_company_name = $_POST['sender_company'];
     $s_email = $_POST['sender_mail'];
     $s_contact = $_POST['sender_contact'];
     $s_address = $_POST['sender_addr'];
     $s_country = $_POST['sender_country'];
 
     //recipient information
     $recipient_name = $_POST['recipient_name'];
     $recipient_company = $_POST['recipient_company'];
     $recipient_mail = $_POST['recipient_mail'];
     $recipient_addr1 = $_POST['recipient_addr1'];
     $recipient_addr2 = $_POST['recipient_addr2'];
     $recipient_addr3 = $_POST['recipient_addr3'];
     $recipient_phone = $_POST['recipient_phone'];
     $recipient_mobile = $_POST['recipient_mobile'];
     $recipient_city = $_POST['recipient_city'];
     $dest_country = $_POST['dest_country'];
     $recipient_zip = $_POST['recipient_zip'];
 
     //goods information
     $goods_title = $_POST['goods_title'];
     $goods_type = $_POST['goods_type'];
     $goods_weight = $_POST['goods_weight'];
     $shimpent_pieces = $_POST['shimpent_pieces'];
     $shimpent_declared_value = $_POST['shimpent_declared_value'];
     $custom_trackId = $_POST['custom_trackId'];
     $trackID = $_POST['trackID'];
     $refference_no = $_POST['refference_no'];
     $shipping_charge = $_POST['shipping_charge'];    
     $shipping_charge_old = $_POST['shipping_charge_old'];  

     $changed_amount = $shipping_charge - $shipping_charge_old;
     
     
     $agent_principal = $_POST['agent_principal'];
 
     //get principal information
     $selectZone = "SELECT zone FROM principal_zone WHERE principal_id = '$agent_principal' AND country_tag = '$dest_country'";
     $queryZone = $db->link->query($selectZone);
     $rowZone = $queryZone->fetch_assoc();
     $zone = $rowZone['zone'];
 
     //get principal price
     $selectPr = "SELECT price FROM principal_price WHERE weight='$goods_weight' AND goods_type='$goods_type' AND principal_id='$agent_principal' AND zone='$zone'";
     $queryPr = $db->link->query($selectPr);
 
     $rowPr = $queryPr->fetch_assoc();
     $principal_rate = $rowPr['price'];
 
     $principal_rate_usd = $db->converttousd($agent_principal, $rowPr['price']);
 
     //get principal currency name
     $principal_currency_name =  $db->getCurrencyName($agent_principal);
     $base_rate = $db->getCurrency($principal_currency_name);
     
     
 
     //get principal name and currency rate
     $usd_sql = "SELECT currency_rate FROM currency WHERE currency_name='USD'";
     $usd_query = $db->link->query($usd_sql);
     $usd_row = $usd_query->fetch_row();
     $bdt_rate = $usd_row[0]*$shipping_charge;
     $usd_rate = $usd_row[0];
     $p_bdt_rate = $principal_rate*$base_rate;
     $costing = $db->getPrincipalCosting($agent_principal, $rowPr['price'], $goods_weight);
     
     $usd_costing_rate = $usd_row[0]*$costing;
     $dml_costing_usd = $costing - $principal_rate_usd;
     $dml_costing_bdt = $dml_costing_usd*$usd_rate;
     $t2 = $t+1;
     $t3 = $t2+1;
 
     $p_sql = "SELECT principal_name FROM principals_name WHERE id='$agent_principal'";
     $p_query = $db->link->query($p_sql);
     $p_row = $p_query->fetch_row();
     $p_name = $p_row[0];
 
     //update consignment information here
     $updateConsignment = "UPDATE consignment_booking SET awb_no = '$custom_trackId', s_name = '$agent_name', s_company = '$agent_company_name', s_email = '$s_email', s_contact = '$s_contact', s_country = '$s_country', s_address = '$s_address', r_name = '$recipient_name', r_company = '$recipient_company', r_email = '$recipient_mail', r_address1 = '$recipient_addr1', r_address2 = '$recipient_addr2', r_address3 = '$recipient_addr3', r_zip = '$recipient_zip', r_phone = '$recipient_phone', r_mobile = '$recipient_mobile', r_city = '$recipient_city', r_country = '$dest_country', g_title = '$goods_title', g_type = '$goods_type', g_weight = '$goods_weight', g_pieces = '$shimpent_pieces', g_customs_value = '$shimpent_declared_value', g_shipment_charge = '$shipping_charge', submited_by = '$agent_id' WHERE tracking_id = '$trackID'; UPDATE custom_tracking_no SET custom_id = '$refference_no' WHERE tracking_id = '$trackID'; UPDATE agent_accounts SET debit_amount = debit_amount + $changed_amount WHERE agent_email = '$agent_email'";
     
    //  echo $sql;
     
     $query = $db->link->multi_query($updateConsignment);
     if($query){
         echo 1;
     }else{
         echo $db->link->error;
     }
 
 }
?>