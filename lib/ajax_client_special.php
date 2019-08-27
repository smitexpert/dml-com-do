<?php




require __DIR__.'/Session.php';
require __DIR__.'/Database.php';

Session::checkClientSession();

$db = new Database;



if(isset($_POST['client_email'])){
    $client_email = $_POST['client_email'];
    $client_zone = $_POST['client_zone_view'];
    
    $sql = "SELECT * FROM corporate_client_special_rate WHERE corporate_client_email='$client_email' AND country_tag='$client_zone'  AND status='1' AND price > 0";
    $result = $db->link->query($sql);
    
    $i=1;
    while($row = $result->fetch_assoc()){
        echo '<tr class="center">';
        echo '<td class="center">'.$i.'</td><td>'.$row['product_type'].'</td><td>'.$row['weight'].'</td><td>'.$row['price'].'</td>';
        echo '</tr>';
        $i=$i+1;
    }
    
}

if(isset($_POST['client_email_w'])){
    $client_email_w = $_POST['client_email_w'];
    $client_zone_w = $_POST['client_zone_w'];
    
    $sql = "SELECT DISTINCT weight FROM corporate_client_special_rate WHERE corporate_client_email='$client_email_w' AND country_tag='$client_zone_w' AND status='1'  AND status='1' AND price > 0";
    $result = $db->link->query($sql);
    
    while($row = $result->fetch_assoc()){
        ?>
        <option value="<?php echo $row['weight'] ?>"><?php echo $row['weight'] ?></option>
        <?php
    }
}

if(isset($_POST['client_email_t'])){
    $client_email_w = $_POST['client_email_t'];
    $client_zone_w = $_POST['client_zone_t'];
    
    $sqlP = "SELECT DISTINCT product_type FROM corporate_client_special_rate WHERE corporate_client_email='$client_email_w' AND country_tag='$client_zone_w' AND product_type='P'  AND status='1' AND price > 0";
    $resultP = $db->link->query($sqlP);
    
    while($rowP = $resultP->fetch_assoc()){
        ?>
        <option value="<?php echo $rowP['product_type'] ?>"><?php echo 'Parcel' ?></option>
        <?php
    }
    
    $sqlD = "SELECT DISTINCT product_type FROM corporate_client_special_rate WHERE corporate_client_email='$client_email_w' AND country_tag='$client_zone_w' AND product_type='D'  AND status='1' AND price > 0";
    $resultD = $db->link->query($sqlD);
    
    while($rowD = $resultD->fetch_assoc()){
        ?>
        <option value="<?php echo $rowD['product_type'] ?>"><?php echo 'Document' ?></option>
        <?php
    }
}



if(isset($_POST['client_zone_weight'])){
    
    
    $client_email_filter =  $_POST['client_email_filter'];
    $client_zone_filter = $_POST['client_zone_filter'];
    $client_zone_weight = $_POST['client_zone_weight'];
    $client_good_type = $_POST['client_good_type'];
    
    
    $where_c = "";
    
    if(($client_zone_weight == "") && ($client_good_type == "")){
        $where_c = "";
        
    }else if($client_zone_weight == ""){
        $where_c = "AND product_type='$client_good_type'";
        
    }else if($client_good_type == ""){
        $where_c = "AND weight='$client_zone_weight'";
        
    }else{
        $where_c = "AND weight='$client_zone_weight' AND product_type='$client_good_type'";
        
    }
    
    
    $sql = "SELECT * FROM corporate_client_special_rate WHERE corporate_client_email='$client_email_filter' AND country_tag='$client_zone_filter' $where_c  AND status='1' AND price > 0";
    $result = $db->link->query($sql);
    
    $i=1;
    while($row = $result->fetch_assoc()){
        echo '<tr class="center">';
        echo '<td class="center">'.$i.'</td><td>'.$row['product_type'].'</td><td>'.$row['weight'].'</td><td>'.$row['price'].'</td>';
        echo '</tr>';
        $i=$i+1;
    }
}


?>