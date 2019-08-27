<?php
require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['get_personal_dest_country'])){
    
    $get_personal_dest_country = $_POST['get_personal_dest_country'];
    $get_personal_goods_type = $_POST['get_personal_goods_type'];
    $get_personal_goods_weight = $_POST['get_personal_goods_weight'];
    
    $sql = "SELECT general_price.price FROM general_price INNER JOIN dml_zone ON general_price.zone=dml_zone.zone WHERE dml_zone.country_tag='$get_personal_dest_country' AND general_price.weight='$get_personal_goods_weight' AND general_price.goods_type='$get_personal_goods_type'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        $row = $query->fetch_assoc();
        echo $row['price'];
    }else{
        echo "NOTHING";
    }
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

if(isset($_POST['sender_name'])){
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
    $recipient_zip = $_POST['recipient_zip'];
    $recipient_phone = $_POST['recipient_phone'];
    $recipient_mobile = $_POST['recipient_mobile'];
    $recipient_city = $_POST['recipient_city'];
    $dest_country = $_POST['personal_dest_country'];
    $goods_title = $_POST['goods_title'];
    $goods_type = $_POST['personal_goods_type'];
    $goods_weight = $_POST['personal_goods_weight'];
    $shimpent_pieces = $_POST['personal_shimpent_pieces'];
    $shimpent_declared_value = $_POST['personal_shimpent_declared_value'];
    $custom_trackId = $_POST['personal_custom_trackId'];
    $trackID = $_POST['personal_trackID'];
    $shipping_charge = $_POST['personal_shipping_charge'];
    $assigned_user = $_POST['assigned_user'];
    
    $sql = "INSERT INTO consignment_booking(tracking_id, awb_no, s_type, s_name, s_company, s_email, s_contact, s_country, s_address, r_name, r_company, r_email, r_address1, r_address2, r_address3, r_zip, r_phone, r_mobile, r_city, r_country, g_title, g_type, g_weight, g_pieces, g_customs_value, g_shipment_charge, status, assigned_user, submited_by) VALUES ('$trackID', '$custom_trackId', 'personal', '$sender_name', '$sender_company', '$sender_mail', '$sender_contact', '$sender_country', '$sender_addr', '$recipient_name', '$recipient_company', '$recipient_mail', '$recipient_addr1', '$recipient_addr2', '$recipient_addr3', '$recipient_zip', '$recipient_phone', '$recipient_mobile', '$recipient_city', '$dest_country', '$goods_title', '$goods_type', '$goods_weight', '$shimpent_pieces', '$shimpent_declared_value', '$shipping_charge', '1', '$assigned_user', '$logged_user')";
    
    $query = $db->link->query($sql);
    
    if($query){
        echo '1';
    }else{
        echo $db->link->error;
    }
}

?>