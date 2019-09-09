<?php

require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');


if(isset($_POST['check_country'])){
    $tag = $_POST['check_country'];
    $principal_id = $_POST['check_principal_id'];
    
    $sql = "SELECT * FROM principal_special_rate WHERE principal_id='$principal_id' AND country_tag='$tag'";
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        echo '1';
    }else{
        echo '0';
    }
}

if(isset($_POST['add_principal_id'])){
    $principal_id = $_POST['add_principal_id'];
    $tag = $_POST['country'];
    
    $d_price = $_POST['d_price'];
    $d_weight = $_POST['d_weight'];
    
    $p_price = $_POST['p_price'];
    $p_weight = $_POST['p_weight'];
    
    $res = 0;

    for($i=0; $i<count($d_price); $i++){
        $weight_d = $d_weight[$i];
        $price_d = $d_price[$i];
        if($i == 0){
            $sql_d = "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'D', '$weight_d', '$price_d', '$logged_user', '1');";
        }else if($i == count($d_price)-1){
            $sql_d .= "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'D', '$weight_d', '$price_d', '$logged_user', '1')";
        }else{
            $sql_d .= "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'D', '$weight_d', '$price_d', '$logged_user', '1');";
        }
    }
    
    $query_d = $db->link->multi_query($sql_d);
    
    for($i=0; $i<count($p_price); $i++){
        $weight_p = $p_weight[$i];
        $price_p = $p_price[$i];
        if($i == 0){
            $sql_p = "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'P', '$weight_p', '$price_p', '$logged_user', '1');";
        }else if($i == count($p_price)-1){
            $sql_p .= "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'P', '$weight_p', '$price_p', '$logged_user', '1')";
        }else{
            $sql_p .= "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'P', '$weight_p', '$price_p', '$logged_user', '1');";
        }
    }
    
    $query_p = $dbn->link->multi_query($sql_p);
    
    if($query_d){
        $res++;
    }else{
        echo $db->link->error;
    }
    
    if($query_p){
        $res++;
    }else{
        echo $dbn->link->error;
    }
    
    echo $res;
}

?>