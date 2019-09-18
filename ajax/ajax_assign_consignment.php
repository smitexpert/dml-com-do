<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();


if($_POST['trackid']){
    $trackid = $_POST['trackid'];
    $pid = $_POST['pid'];
    $tag = $_POST['tag'];
    
    $selctTrck = "SELECT g_weight, g_type, g_shipment_charge FROM consignment_booking WHERE tracking_id='$trackid'";
    $queryTrck = $db->link->query($selctTrck);
    $rowTrck = $queryTrck->fetch_assoc();
    
    $weight = $rowTrck['g_weight'];
    $type = $rowTrck['g_type'];
    $booking_price = $rowTrck['g_shipment_charge'];
    
    $selectZone = "SELECT zone FROM principal_zone WHERE principal_id = '$pid' AND country_tag = '$tag'";
    $queryZone = $db->link->query($selectZone);
    $rowZone = $queryZone->fetch_assoc();
    $zone = $rowZone['zone'];
    
    $selectPr = "SELECT price FROM principal_price WHERE weight='$weight' AND goods_type='$type' AND principal_id='$pid' AND zone='$zone'";
    $queryPr = $db->link->query($selectPr);
    
    $rowPr = $queryPr->fetch_assoc();
    
    $p_sql = "SELECT price FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$tag' AND weight='$weight' AND goods_type='$type' AND price > 0";
                
    $p_query = $db->link->query($p_sql);
    
    if($p_query->num_rows > 0){
        $p_row = $p_query->fetch_assoc();
        if($p_row['price'] < $rowPr['price']){
            $principal_rate = $p_row['price'];
        }else{
            $principal_rate = $rowPr['price'];
        }
    }else{
        $principal_rate = $rowPr['price'];
    }
    
    
    
    $principal_rate_usd = $db->converttousd($pid, $principal_rate);
    
    $costing = $db->getPrincipalCosting($pid, $principal_rate, $weight);
    
    $assignee = Session::get('adminId');
    
    $date = date('Y-m-d');
    
    $insert = "INSERT INTO consignment_booked (tracking_id, principal_id, principal_rate, principal_rate_usd, costing, booking_price, assigned_by, assigned_date) VALUES ('$trackid', '$pid', '$principal_rate', '$principal_rate_usd', '$costing', '$booking_price', '$assignee', '$date')";
    $query = $db->link->query($insert);
    
    if($query){
        
        $p_name = $db->getPrincipalName($pid);
        $p_cur = $db->getCurrencyName($pid);
        $cur_rate = $db->getCurrency($p_cur);
        
        $con_to_bdt = $costing*$db->getCurrency("USD");
        $con_to_base = $con_to_bdt/$cur_rate;
        
        $t=time();
        $transaction_id = 'DML'.$t;
        
        $sql_acc = "INSERT INTO accounts (reference_id, transaction_id, transaction_type, transaction_mode, payer_type, client_name, client_id, amount, based, base_rate, bdt_ammount, usd_ammount, prepared_by, description, transaction_date) VALUE ('$trackid', '$transaction_id', '1', 'booking', 'principal', '$p_name', '$pid', '$con_to_base', '$p_cur', '$cur_rate', '$con_to_bdt', '$costing', '$assignee', 'Consignment Booking', '$date')";
        
        $rsl_acc = $db->link->query($sql_acc);
        
        if($rsl_acc){
            $up = "UPDATE consignment_booking SET status = '2' WHERE tracking_id='$trackid'";
            $get = $db->link->query($up);
            if($get){
                echo '1';
            }else{
                echo 'STATUS NOT UPDATED!';
            }
        }else{
            echo 'Accounts Not Working!';
        }
        
        
    }else{
        echo 'CONSINGMENT ASSIGN ERROR!!!';
        echo $db->link->error;
    }
}




?>