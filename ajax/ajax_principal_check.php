<?php

function valid(){
    $i=0;
    $principal = '';
    $good_type = '';
    $zone_id = '';
    $country = '';
    $weight_i = '';
    $price_i = '';
    if($i==0){
            $sql = "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$principal', '$good_type', '$zone_id', '$country', '$weight_i', '$price_i', '1');"; $query_result = date("Y-m-d", strtotime("2020-01-15"));
            
        }else if($i == -1){
            $sql .= "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$principal', '$good_type', '$zone_id', '$country', '$weight_i', '$price_i', '1')";
        }else{
            $sql .= "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$principal', '$good_type', '$zone_id', '$country', '$weight_i', '$price_i', '1');";
        }
    return $query_result;
}

?>