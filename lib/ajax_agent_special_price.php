<?php


require __DIR__.'/Session.php';
require __DIR__.'/Database.php';

Session::checkSession();

$db = new Database;




if(isset($_POST['principal_id'])){
    $principal_id = $_POST['principal_id'];
    $agent_client_email = $_POST['agent_email'];
    
    //select all country from agent price list 
    $zoneQuery = "SELECT DISTINCT principal_zone.country_tag, tbl_country.country_name FROM principal_zone INNER JOIN agent_client_price  ON principal_zone.principal_id = agent_client_price.principal_id AND principal_zone.zone = agent_client_price.zone INNER JOIN tbl_country ON principal_zone.country_tag = tbl_country.country_tag WHERE agent_client_price.principal_id = '$principal_id' AND agent_client_price.agent_client_email = '$agent_client_email'";
    
    $country_list = $db->link->query($zoneQuery);
    if($country_list->num_rows > 0){
        while($row = $country_list->fetch_assoc()){
            ?>
<option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
<?php
        }
    
    } 
        
}

if(isset($_POST['principal_id_new'])){
    $principal_id = $_POST['principal_id_new'];
    $agent_client_email = $_POST['agent_email_new'];
    
    //select all country from agent price list 
    $zoneQuery = "SELECT DISTINCT goods_type FROM agent_client_price WHERE agent_client_email = '$agent_client_email' AND principal_id = '$principal_id'";
    
    $country_list = $db->link->query($zoneQuery);
    if($country_list->num_rows > 0){
        while($row = $country_list->fetch_assoc()){
            ?>
<option value="<?php echo $row['goods_type']; ?>"><?php if($row['goods_type'] == "D"){
                echo "DOX";
            }else{
                echo "SPX";
            } ?></option>
<?php
        }
    
    } 
        
}

if(isset($_POST['agent_principal'])){
    $agent_principal_id = $_POST['agent_principal'];
    $agent_client_email = $_POST['agent_email'];
    $client_country = $_POST['client_country'];
    $agent_goods_type = $_POST['agent_goods_type'];
    $startdatepicker = $_POST['startdatepicker'];
    $enddatepicker = $_POST['enddatepicker'];
    
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    
    //insert into agent special price table
    for($i=0; $i<count($weight); $i++){
        
        $weight_i = $weight[$i];
        $price_i = $price[$i];
    if($i==0){
            $sql = "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, product_type, country_tag, weight, price, start_date, end_date, status) VALUES ('$agent_principal_id','$agent_client_email', '$agent_goods_type', '$client_country', '$weight_i', '$price_i', '$startdatepicker', '$enddatepicker', '1');";
        }else if($i == count($weight)-1){
            $sql .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, product_type, country_tag, weight, price, start_date, end_date, status) VALUES ('$agent_principal_id','$agent_client_email', '$agent_goods_type', '$client_country', '$weight_i', '$price_i', '$startdatepicker', '$enddatepicker', '1')";
        }else{
            $sql .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, product_type, country_tag, weight, price, start_date, end_date, status) VALUES ('$agent_principal_id','$agent_client_email', '$agent_goods_type', '$client_country', '$weight_i', '$price_i', '$startdatepicker', '$enddatepicker', '1');";
        }
    }
    
    $priceResult = $db->link->multi_query($sql);
    
    if($priceResult){
        print_r($priceResult);
    }else{
        echo $db->link->error;
    }
    
//    print_r($price);
    
}

if(isset($_POST['principal_id_update'])){
//    $principal_id_update = $_POST['principal_id_update'];
//    //select principal zone country from table
//    $principalZone = "SELECT DISTINCT agent_client_special_rate.country_tag FROM agent_client_special_rate WHERE principal_id = '$principal_id_update'";
//    $country_tag = $db->link->query($principalZone);
//    
//    
//    
//    echo $principal_id_update;
    
    
    $principal_id = $_POST['principal_id_update'];
    $agent_client_email = $_POST['agent_email_update'];
    
    //select all country from agent price list 
    $zoneQuery = "SELECT DISTINCT principal_zone.country_tag, tbl_country.country_name FROM principal_zone INNER JOIN agent_client_price  ON principal_zone.principal_id = agent_client_price.principal_id AND principal_zone.zone = agent_client_price.zone INNER JOIN tbl_country ON principal_zone.country_tag = tbl_country.country_tag WHERE agent_client_price.principal_id = '$principal_id' AND agent_client_price.agent_client_email = '$agent_client_email'";
    
    $country_list = $db->link->query($zoneQuery);
    if($country_list->num_rows > 0){
        while($row = $country_list->fetch_assoc()){
            ?>
<option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
<?php
        }
    
    } 
}

if(isset($_POST['client_country_update_1'])){
    $client_country_update = $_POST['client_country_update_1'];
    $principal_id_update = $_POST['principal_id_update_1'];
    $agent_email_update = $_POST['agent_email_update_1'];
    
    $product_type = "SELECT DISTINCT agent_client_price.goods_type FROM agent_client_price INNER JOIN principal_zone ON  agent_client_price.zone = principal_zone.zone WHERE agent_client_price.principal_id ='$principal_id_update' AND agent_client_price.agent_client_email = '$agent_email_update' AND principal_zone.country_tag = '$client_country_update' ";
    $product_type_new = $db->link->query($product_type);
    
     while($row = $product_type_new->fetch_assoc()){
            ?>
<option value="<?php echo $row['goods_type']; ?>"><?php echo $row['goods_type']; ?></option>
<?php
        }
    
//    echo $agent_email_update;
}

?>
