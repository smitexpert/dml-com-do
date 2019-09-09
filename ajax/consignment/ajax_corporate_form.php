<?php
require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$t = time();

$usd = $db->getCurrency('USD');

$transaction_id = 'DML'.$t;

$logged_user = Session::get('adminId');

if(isset($_POST['corporate_id'])){
    $corporate_id = $_POST['corporate_id'];
    
    $sql = "SELECT * FROM corporate_clients WHERE id='$corporate_id'";
    $query = $db->link->query($sql);
    $data = json_encode($query->fetch_array());
    echo $data;
}

if(isset($_POST['usd'])){
    $usd = $_POST['usd'];
    
    $sql = "SELECT currency_rate FROM currency WHERE currency_name='USD'";
    $query = $db->link->query($sql);
    if($query->num_rows  > 0){
        $res = $query->fetch_array();
    }
    
    echo $res['currency_rate']*$usd;
}


if(isset($_POST['get_sender_mail'])){
    $get_sender_mail = $_POST['get_sender_mail'];
    $get_dest_country = $_POST['get_dest_country'];
    $get_goods_type = $_POST['get_goods_type'];
    $get_goods_weight = $_POST['get_goods_weight'];
    
    $sql = "SELECT corporate_client_price.price FROM corporate_client_price INNER JOIN dml_zone ON  corporate_client_price.zone = dml_zone.zone WHERE dml_zone.country_tag='$get_dest_country' AND corporate_client_price.corporate_client_email='$get_sender_mail' AND corporate_client_price.goods_type='$get_goods_type' AND corporate_client_price.weight='$get_goods_weight'";
    
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        $res = $query->fetch_array();
        echo $res['price'];
    }else{
        echo "NOTHING";
    }
}

if(isset($_POST['sender_name'])){
    $corporate_clients = $_POST['corporate_clients'];
    $sender_name = $_POST['sender_name'];
    $sender_company = $_POST['sender_company'];
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
    $assign_to = $_POST['assign_to'];
    
    $sql = "INSERT INTO consignment_booking(client_Id, tracking_id, awb_no, s_type, s_name, s_company, s_email, s_contact, s_country, s_address, r_name, r_company, r_email, r_address1, r_address2, r_address3, r_zip, r_phone, r_mobile, r_city, r_country, g_title, g_type, g_weight, g_pieces, g_customs_value, g_shipment_charge, status, assigned_user, submited_by) VALUES ('$corporate_clients', '$trackID', '$custom_trackId', 'corporate', '$sender_name', '$sender_company', '$sender_mail', '$sender_contact', '$sender_country', '$sender_addr', '$recipient_name', '$recipient_company', '$recipient_mail', '$recipient_addr1', '$recipient_addr2', '$recipient_addr3', '$recipient_zip', '$recipient_phone', '$recipient_mobile', '$recipient_city', '$dest_country', '$goods_title', '$goods_type', '$goods_weight', '$shimpent_pieces', '$shimpent_declared_value', '$shipping_charge', '1', '$assign_to', '$logged_user')";
    
    $query = $db->link->query($sql);
    
    if($query){
        $bdt = $shipping_charge*$usd;
        $sql2 = "UPDATE corporate_accounts SET debit_amount=debit_amount+$shipping_charge WHERE corporate_client_email='$sender_mail'";
        $query2 = $db->link->query($sql2);
        $sql3 = "INSERT INTO accounts (reference_id, transaction_id, transaction_type, transaction_mode, payer_type, client_name, client_id, amount, based, base_rate, bdt_ammount, usd_ammount, prepared_by, description, transaction_date, entry_date) VALUES ('$trackID', '$transaction_id', '0', 'booking', 'corporate', '$sender_company', '$corporate_clients', '$shipping_charge', 'USD', '$usd', '$bdt', '$shipping_charge', '$logged_user', 'CORPORATE CONSIGNMENT BOOKING', NOW(), NOW())";
        
        $query3 = $db->link->query($sql3);
        if($query2 && $query3){
            echo '1';
        }else{
            echo $db->link->error;
        }
    }else{
        echo $db->link->error;
    }
}

?>