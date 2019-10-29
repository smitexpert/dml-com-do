<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();


if(isset($_POST['returnToShiper'])){
    
    $id  = $_POST['returnToShiper'];
    
    $sql = "UPDATE consignment_booking SET status='0' WHERE id='$id'";
    $query = $db->link->query($sql);
    if($query){
        echo "1";
    }else{
        echo $db->link->error;
    }
    
}


if(isset($_POST['get_con_details'])){
    
    $id = $_POST['get_con_details'];
    
    $sql = "SELECT * FROM consignment_booking WHERE id='$id'";
    $query = $db->link->query($sql);
    $row = $query->fetch_array();
    
    echo json_encode($row);
}

if(isset($_POST['get_country_name'])){
    $tag = $_POST['get_country_name'];
    echo $db->getCountryName($tag);
}






if(isset($_POST['get_principal_list'])){
    
    $id = $_POST['get_principal_list'];
    $track_id = $_POST['track_id'];

    $agent_id_sql = "SELECT client_id FROM accounts WHERE payer_type='agent' AND reference_id='$track_id'";
    $agent_id_query = $db->link->query($agent_id_sql);
    $agent_id_row = $agent_id_query->fetch_assoc();
    $agent_id = $agent_id_row['client_id'];
    
    $sql = "SELECT * FROM consignment_booking WHERE id='$id'";
    $query = $db->link->query($sql);
    $row = $query->fetch_assoc();
    
    $r_zip = $row['r_zip'];
    $r_city = $row['r_city'];
    $country = $row['r_country'];
    
    $g_type = $row['g_type'];
    $weight = $row['g_weight'];
    $trackingId = $row['tracking_id'];

    $principal_sql = "SELECT principal_id FROM consignment_booked WHERE tracking_id='$trackingId'";
    $principal_query = $db->link->query($principal_sql);
    $principal_row = $principal_query->fetch_assoc();
    $principal_selected = $principal_row['principal_id'];
    
    $dt = 0;
    
    
    $slPrincipal = "SELECT * FROM principals_name";
    $qrPrincipal = $db->link->query($slPrincipal);
    
    $lowest_price = array();
    $lowest_costing = array();
    $lowest_p_id = array();
    $price_type = array();
    $i=0;
    
    while($rowPrincipla = $qrPrincipal->fetch_assoc()){
        $principal_id = $rowPrincipla['id'];
        $principal_name = $rowPrincipla['principal_name'];
        $slZone = "SELECT zone FROM principal_zone WHERE country_tag='$country' AND principal_id='$principal_id'";
        $qrZone = $db->link->query($slZone);
        $rowZone = $qrZone->fetch_row();
        
        $zone = $rowZone[0];
        
        
        $slPrice = "SELECT price FROM principal_price WHERE principal_id='$principal_id' AND zone='$zone' AND weight='$weight' AND goods_type='$g_type' AND price > 0";
        $qrPrice = $db->link->query($slPrice);
        
        if($qrPrice->num_rows > 0){
            
            $dt = 1;
            $min_row_price = 0;
            
            while($rowPrice = $qrPrice->fetch_assoc()){
                $p_sql = "SELECT price FROM principal_special_rate WHERE principal_id='$principal_id' AND country_tag='$country' AND weight='$weight' AND goods_type='$g_type' AND price > 0";
                
                $p_query = $db->link->query($p_sql);
                
                if($p_query->num_rows > 0){
                    $p_row = $p_query->fetch_assoc();
                    
                    if($p_row['price'] < $rowPrice['price']){
                        $lowest_price[$i] = $p_row['price'];
                        $min_row_price = $p_row['price'];
                        $price_type[$i] = 1;
                    }else{
                        $lowest_price[$i] = $rowPrice['price'];
                        $min_row_price = $rowPrice['price'];
                        $price_type[$i] = 0;
                    }
                    
                }else{
                    $lowest_price[$i] = $rowPrice['price'];
                    $min_row_price = $rowPrice['price'];
                    $price_type[$i] = 0;
                }
                
                
                $lowest_costing[$i] = $db->getPrincipalCosting($principal_id, $min_row_price, $weight);
                $lowest_p_id[$i] = $principal_id;
                $i++;
            }
     
            
        }
    }
    
    
    
    
    if($dt == 1){
        array_multisort($lowest_costing, $lowest_p_id, $price_type);
    }
    
    $j=0;
    while($j < count($lowest_price)){
        
            ?>

            
<tr>
    <td><?php echo $db->getPrincipalName($lowest_p_id[$j]); ?></td>
    <td><?php echo $lowest_costing[$j]; ?></td>
    <td><?php echo $db->checkRemoteArea($country, $r_zip, $r_city, $lowest_p_id[$j]); ?></td>
    <td><?php if($price_type[$j] == 1){ echo "Sepecial"; } else { echo "General"; } ?></td>
    <td>
        <input onclick="getRemotePossAgent(<?php echo $id.', '.$lowest_p_id[$j]; ?>)" type="radio" name="radio" >
        
    </td>
</tr>
           
           <?php
        
        
        $j++;
    }
    
    
    
}


?>
