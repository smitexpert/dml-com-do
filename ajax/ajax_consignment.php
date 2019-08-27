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
    
    $sql = "SELECT * FROM consignment_booking WHERE id='$id'";
    $query = $db->link->query($sql);
    $row = $query->fetch_assoc();
    
    $r_zip = $row['r_zip'];
    $r_city = $row['r_city'];
    $country = $row['r_country'];
    
    $g_type = $row['g_type'];
    $weight = $row['g_weight'];
    
    $dt = 0;
    
    
    $slPrincipal = "SELECT * FROM principals_name";
    $qrPrincipal = $db->link->query($slPrincipal);
    
    $lowest_price = array();
    $lowest_costing = array();
    $lowest_p_id = array();
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
            
            while($rowPrice = $qrPrice->fetch_assoc()){
                $lowest_price[$i] = $rowPrice['price'];
                $lowest_costing[$i] = $db->getPrincipalCosting($principal_id, $rowPrice['price'], $weight);
                $lowest_p_id[$i] = $principal_id;
                $i++;
            }
     
            
        }
    }
    
    
    
    
    if($dt == 1){
        array_multisort($lowest_costing, $lowest_p_id);
    }
    
    $j=0;
    while($j < count($lowest_price)){
        
            ?>

            
<tr>
    <td><?php echo $db->getPrincipalName($lowest_p_id[$j]); ?></td>
    <td><?php echo $lowest_costing[$j]; ?></td>
    <td><?php echo $db->checkRemoteArea($country, $r_zip, $r_city, $lowest_p_id[$j]); ?></td>
    <td>
        <input onclick="getRemotePoss(<?php echo $id.', '.$lowest_p_id[$j]; ?>)" type="radio" name="radio">
    </td>
</tr>
           
           <?php
        
        
        $j++;
    }
    
    
    
}


?>
