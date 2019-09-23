<?php

require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['get_agent_info'])){
    $get_agent_info = $_POST['get_agent_info'];
    $sql = "SELECT * FROM agent_clients WHERE id='$get_agent_info'";
    $query = $db->link->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if(isset($_POST['get_agent_principals'])){
    $id = $_POST['get_agent_principals'];
    
    $sql = "SELECT agent_principal.principal_id, principals_name.principal_name FROM agent_principal INNER JOIN agent_clients ON agent_clients.email = agent_principal.agent_email INNER JOIN principals_name ON agent_principal.principal_id = principals_name.id WHERE agent_clients.id = '$id' AND agent_principal.status='1'";
    
    $query = $db->link->query($sql);
    ?>
    <option value="">--</option>
    <?php
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['principal_id']; ?>"><?php echo $row['principal_name']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['agent_dest_country'])){
    $agent_dest_country = $_POST['agent_dest_country'];
    $agent_goods_type = $_POST['agent_goods_type'];
    $agent_goods_weight = $_POST['agent_goods_weight'];
    $agent_principal = $_POST['agent_principal'];
    $agent_sender_mail = $_POST['agent_sender_mail'];
    
    $sql = "SELECT price, principal_id FROM agent_client_price WHERE weight = '2' AND agent_client_email = 'sujon@gmail.com' AND principal_id = '2' AND goods_type = ''";
    
    $sql = "SELECT agent_client_price.price, agent_client_price.principal_id, dml_zone.country_tag FROM agent_client_price INNER JOIN dml_zone ON dml_zone.zone = agent_client_price.zone WHERE dml_zone.country_tag = '$agent_dest_country' AND  agent_client_price.weight = '$agent_goods_weight' AND agent_client_price.agent_client_email = '$agent_sender_mail' AND agent_client_price.principal_id = '$agent_principal' AND agent_client_price.goods_type = '$agent_goods_type'";
    
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        $row = $query->fetch_array();
        echo $row['price'];
    }else{
        echo "NOTHING";
    }
}

if(isset($_POST['usd'])){
    $usd = $_POST['usd'];
    
    $sql = "SELECT currency_rate FROM currency WHERE currency_name='USD'";
    $query = $db->link->query($sql);
    $row = $query->fetch_row();
    echo $row[0]*$usd;
}


if(isset($_POST['agent_company_name'])){
    $agent_company_name = $_POST['agent_company_name'];
    $agent_company_id = $_POST['agent_company'];
    $sender_name = $_POST['sender_name'];
    $sender_mail = $_POST['sender_mail'];
    $sender_contact = $_POST['sender_contact'];
    $sender_addr = $_POST['sender_addr'];
    $sender_country = $_POST['sender_country'];
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
    $goods_title = $_POST['goods_title'];
    $goods_type = $_POST['goods_type'];
    $goods_weight = $_POST['goods_weight'];
    $shimpent_pieces = $_POST['shimpent_pieces'];
    $shimpent_declared_value = $_POST['shimpent_declared_value'];
    $custom_trackId = $_POST['custom_trackId'];
    $trackID = $_POST['trackID'];
    $shipping_charge = $_POST['shipping_charge'];
    
    $agent_principal = $_POST['agent_principal'];
    
    $assign_to = $_POST['assign_to'];
    
    $sql = "INSERT INTO consignment_booking(client_Id, tracking_id, awb_no, s_type, s_name, s_company, s_email, s_contact, s_country, s_address, r_name, r_company, r_email, r_address1, r_address2, r_address3, r_zip, r_phone, r_mobile, r_city, r_country, g_title, g_type, g_weight, g_pieces, g_customs_value, g_shipment_charge, status, assigned_user, submited_by) VALUES ('$agent_company_id', '$trackID', '$custom_trackId', 'agent', '$sender_name', '$agent_company_name', '$sender_mail', '$sender_contact', '$sender_country', '$sender_addr', '$recipient_name', '$recipient_company', '$recipient_mail', '$recipient_addr1', '$recipient_addr2', '$recipient_addr3', '$recipient_zip', '$recipient_phone', '$recipient_mobile', '$recipient_city', '$dest_country', '$goods_title', '$goods_type', '$goods_weight', '$shimpent_pieces', '$shimpent_declared_value', '$shipping_charge', '2', '$assign_to', '$logged_user')";
    
    $query = $db->link->query($sql);
//    $query = true;
    
    if($query){
        
        $selectZone = "SELECT zone FROM principal_zone WHERE principal_id = '$agent_principal' AND country_tag = '$dest_country'";
        $queryZone = $db->link->query($selectZone);
        $rowZone = $queryZone->fetch_assoc();
        $zone = $rowZone['zone'];

        $selectPr = "SELECT price FROM principal_price WHERE weight='$goods_weight' AND goods_type='$goods_type' AND principal_id='$agent_principal' AND zone='$zone'";
        $queryPr = $db->link->query($selectPr);

        $rowPr = $queryPr->fetch_assoc();

        $principal_rate = $rowPr['price'];

        $principal_rate_usd = $db->converttousd($agent_principal, $rowPr['price']);

        $costing = $db->getPrincipalCosting($agent_principal, $rowPr['price'], $goods_weight);
        
        $sql2 = "INSERT INTO consignment_booked (tracking_id, principal_id, principal_rate, principal_rate_usd, costing, booking_price, assigned_by, status, assigned_date) VALUES ('$trackID', '$agent_principal', '$principal_rate', '$principal_rate_usd', '$costing', '$shipping_charge', '$logged_user', '0', NOW())";
        
//        echo $sql2;
        
        $query2 = $db->link->query($sql2);
        if($query2){
            echo "1";
        }else{
            echo $db->link->error;
        }
        
    }else{
        echo $db->link->error;
    }
}

?>