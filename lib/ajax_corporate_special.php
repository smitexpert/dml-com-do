<?php


require __DIR__.'/Session.php';
require __DIR__.'/Database.php';

Session::checkSession();

$db = new Database;




if(isset($_POST['client_zone_id_check'])){
    $zone_id_check = $_POST['client_zone_id_check'];
    $client_price_id_check = $_POST['client_price_id_check'];
    
    $i=1;
    $j=1;
    
    $query_p = "SELECT * FROM corporate_client_special_rate WHERE corporate_client_email='$client_price_id_check' AND country_tag='$zone_id_check' AND product_type='P'";
    $result_p = $db->link->query($query_p);
    if($result_p->num_rows > 0){
        $i=0;
    }
    
    $query_d = "SELECT * FROM corporate_client_special_rate WHERE corporate_client_email='$client_price_id_check' AND country_tag='$zone_id_check' AND product_type='D'";
    $result_d = $db->link->query($query_d);
    if($result_d->num_rows > 0){
        $j=0;
    }
    
    if(($i==0) AND ($j==0)){
        echo 0;
    }else if(($i==1) AND ($j==0)){
        echo 1;
    }else if(($i==0) AND ($j==1)){
        echo 2;
    }else{
        echo 3;
    }
}


if(isset($_POST['client_price_id'])){
    $client_price_id = $_POST['client_price_id'];
    $zone_id = $_POST['client_zone_id'];
    $good_type = $_POST['client_good_type'];
    
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    
    $startdatepicker = $_POST['startdatepicker'];
    $startdatepicker = date('Y-m-d', strtotime($startdatepicker));
    
    $enddatepicker = $_POST['enddatepicker'];
    $enddatepicker = date('Y-m-d', strtotime($enddatepicker));
    
    for($i=0; $i<count($weight); $i++){
        
        $weight_i = $weight[$i];
        $price_i = $price[$i];
        
        if($i==0){
            $sql = "INSERT INTO corporate_client_special_rate (corporate_client_email, product_type, country_tag, weight, price, start_date, end_date, status) VALUES ('$client_price_id', '$good_type', '$zone_id', '$weight_i', '$price_i', '$startdatepicker', '$enddatepicker', '1');";
        }else if($i == count($weight)-1){
            $sql .= "INSERT INTO corporate_client_special_rate (corporate_client_email, product_type, country_tag, weight, price, start_date, end_date, status) VALUES ('$client_price_id', '$good_type', '$zone_id', '$weight_i', '$price_i', '$startdatepicker', '$enddatepicker', '1')";
        }else{
            $sql .= "INSERT INTO corporate_client_special_rate (corporate_client_email, product_type, country_tag, weight, price, start_date, end_date, status) VALUES ('$client_price_id', '$good_type', '$zone_id', '$weight_i', '$price_i', '$startdatepicker', '$enddatepicker', '1');";
        }
    }
    
    $priceResult = $db->link->multi_query($sql);
    
    if($priceResult){
        print_r($priceResult);
    }else{
        echo $db->link->error;
    }
    
    
}

/*-----------------------------------------------------------*/




?>