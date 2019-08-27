<?php
require __DIR__.'/Session.php';
require __DIR__.'/Database.php';

Session::checkClientSession();

$db = new Database;

//start code for insertint principal price

if(isset($_POST['principal_price_id'])){
    $principal = $_POST['principal_price_id'];
    $zone_id = $_POST['zone_id'];
    $country = $_POST['country'];
    $good_type = $_POST['good_type'];
    
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    
    for($i=0; $i<count($weight); $i++){
        
        $weight_i = $weight[$i];
        $price_i = $price[$i];
        
        if($i==0){
            $sql = "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$principal', '$good_type', '$zone_id', '$country', '$weight_i', '$price_i', '1');";
        }else if($i == count($weight)-1){
            $sql .= "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$principal', '$good_type', '$zone_id', '$country', '$weight_i', '$price_i', '1')";
        }else{
            $sql .= "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$principal', '$good_type', '$zone_id', '$country', '$weight_i', '$price_i', '1');";
        }
    }
    
    $priceResult = $db->link->multi_query($sql);
    
    if($priceResult){
        print_r($priceResult);
    }else{
        echo $db->link->error;
    }
    
    
}

//End code for insertint principal price

//start code for viewing principal price


if(isset($_POST['principal_id_price'])){
    $principal_id = $_POST['principal_id_price'];
    $query = "SELECT DISTINCT zone FROM principal_price WHERE principal_id='$principal_id'";
    $result = $db->link->query($query);
    while($row = $result->fetch_assoc()){
        echo $row['zone'].' ';
    }
}





if(isset($_POST['country_check'])){
    $country_check = $_POST['country_check'];
    $principal_price_id_check = $_POST['principal_price_id_check'];
    
    $i=1;
    $j=1;
    
    $query_p = "SELECT * FROM principal_price WHERE principal_id='$principal_price_id_check' AND country='$country_check' AND goods_type='P'";
    $result_p = $db->link->query($query_p);
    if($result_p->num_rows > 0){
        $i=0;
    }
    
    $query_d = "SELECT * FROM principal_price WHERE principal_id='$principal_price_id_check' AND country='$country_check' AND goods_type='D'";
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


if(isset($_POST['view_principal_price_id'])){
    $view_principal_price_id = $_POST['view_principal_price_id'];
    $sql = "SELECT based FROM principals_name WHERE id='$view_principal_price_id'";
    
    $result = $db->link->query($sql);
    
    $row = $result->fetch_row();
    
    $based = $row[0];
    
    if($based == 1){
        $slZone = "SELECT DISTINCT zone FROM principal_price WHERE principal_id='$view_principal_price_id'";
        $zoneResult = $db->link->query($slZone);
        while($zoneRow = $zoneResult->fetch_assoc()){
            ?>
            <option value="<?php echo $zoneRow['zone']; ?>"><?php echo $zoneRow['zone']; ?></option>
            <?php
        }
    }else{
        $slCountry = "SELECT DISTINCT country FROM principal_price WHERE principal_id='$view_principal_price_id'";
        $countryResult = $db->link->query($slCountry);
        while($countryRow = $countryResult->fetch_assoc()){
            ?>
            <option value="<?php echo $countryRow['country']; ?>"><?php echo $db->getCountryName($countryRow['country']); ?></option>
            <?php
        }
    }
}


if(isset($_POST['zone_country'])){
    $zone_country = $_POST['zone_country'];
    
    $view_principal_price_id = $_POST['zone_principal_price_id'];
    $sql = "SELECT based FROM principals_name WHERE id='$view_principal_price_id'";
    
    $result = $db->link->query($sql);
    
    $row = $result->fetch_row();
    
    $based = $row[0];
    
    if($based == 1){
        $query = "SELECT * FROM principal_price WHERE principal_id='$view_principal_price_id' AND zone='$zone_country' AND price > 0";
        $znResult = $db->link->query($query);
        $i=1;
        while($znRow = $znResult->fetch_assoc()){
            echo '<tr class="center">';
            echo '<td class="center">'.$i.'</td><td>'.$znRow['goods_type'].'</td><td>'.$znRow['weight'].'</td><td>'.$znRow['price'].'</td><td></td>';
            echo '</tr>';
            $i=$i+1;
        }
    }else{
        $query = "SELECT * FROM principal_price WHERE principal_id='$view_principal_price_id' AND country='$zone_country' AND price > 0";
        $znResult = $db->link->query($query);
        $i=1;
        while($znRow = $znResult->fetch_assoc()){
            echo '<tr class="center">';
            echo '<td class="center">'.$i.'</td><td>'.$znRow['goods_type'].'</td><td>'.$znRow['weight'].'</td><td>'.$znRow['price'].'</td><td></td>';
            echo '</tr>';
            $i=$i+1;
        }
    }
    
}

if(isset($_POST['check_principal_price_id'])){
    $check_principal_price_id = $_POST['check_principal_price_id'];
    $check_zone_country = $_POST['check_zone_country'];
    
    
    $sql = "SELECT based FROM principals_name WHERE id='$check_principal_price_id'";
    
    $result = $db->link->query($sql);
    
    $row = $result->fetch_row();
    
    $based = $row[0];
    
    if($based == 1){
        $query = "SELECT * FROM principal_price WHERE principal_id='$check_principal_price_id' AND zone='$check_zone_country' AND price > 0";
        $znResult = $db->link->query($query);
        while($znRow = $znResult->fetch_assoc()){
            ?>
            <option value="<?php echo $znRow['weight']; ?>"><?php echo $znRow['weight']; ?></option>
            <?php
        }
    }else{
        $query = "SELECT * FROM principal_price WHERE principal_id='$check_principal_price_id' AND country='$check_zone_country' AND price > 0";
        $znResult = $db->link->query($query);
        while($znRow = $znResult->fetch_assoc()){
            ?>
            <option value="<?php echo $znRow['weight']; ?>"><?php echo $znRow['weight']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['principal_price_id_type'])){
    $check_principal_price_id = $_POST['principal_price_id_type'];
    $check_zone_country = $_POST['zone_country_type'];
    $check_good_type = $_POST['check_good_type'];
    
    
    $sql = "SELECT based FROM principals_name WHERE id='$check_principal_price_id'";
    
    $result = $db->link->query($sql);
    
    $row = $result->fetch_row();
    
    $based = $row[0];
    
    if($based == 1){
        $p_query = "SELECT DISTINCT goods_type FROM principal_price WHERE principal_id='$check_principal_price_id' AND zone='$check_zone_country' AND goods_type='P' AND price > 0";
        $p_Result = $db->link->query($p_query);
        while($p_Row = $p_Result->fetch_assoc()){
            ?>
            <option value="<?php echo $p_Row['goods_type']; ?>"><?php echo "Parcel"; ?></option>
            <?php
        }
        $d_query = "SELECT DISTINCT goods_type FROM principal_price WHERE principal_id='$check_principal_price_id' AND zone='$check_zone_country' AND goods_type='D' AND price > 0";
        $d_Result = $db->link->query($d_query);
        while($d_Row = $d_Result->fetch_assoc()){
            ?>
            <option value="<?php echo $d_Row['goods_type']; ?>"><?php echo "Document"; ?></option>
            <?php
        }
    }else{
        $p_query = "SELECT DISTINCT goods_type FROM principal_price WHERE principal_id='$check_principal_price_id' AND country='$check_zone_country' AND goods_type='P' AND price > 0";
        $p_Result = $db->link->query($p_query);
        while($p_Row = $p_Result->fetch_assoc()){
            ?>
            <option value="<?php echo $p_Row['goods_type']; ?>"><?php echo "Parcel"; ?></option>
            <?php
        }
        $d_query = "SELECT DISTINCT goods_type FROM principal_price WHERE principal_id='$check_principal_price_id' AND country='$check_zone_country' AND goods_type='D' AND price > 0";
        $d_Result = $db->link->query($d_query);
        while($d_Row = $d_Result->fetch_assoc()){
            ?>
            <option value="<?php echo $d_Row['goods_type']; ?>"><?php echo "Document"; ?></option>
            <?php
        }
    }
    
    
}


if(isset($_POST['filter_zone_code'])){
    $filter_zone_code = $_POST['filter_zone_code'];
    $filter_good_type = $_POST['filter_good_type'];
    $filter_principal_id = $_POST['filter_principal_id'];
    $filter_zone_country = $_POST['filter_zone_country'];
    
    $sql = "SELECT based FROM principals_name WHERE id='$filter_principal_id'";
    $result = $db->link->query($sql);
    $row = $result->fetch_row();
    $based = $row[0];
    
    $where_p = "";
    
    if(($filter_zone_code == "") && ($filter_good_type == "")){
        $where_p = "";
    }else if($filter_zone_code == ""){
        $where_p = "AND goods_type='$filter_good_type'";
    }else if($filter_good_type == ""){
        $where_p = "AND cast(weight as decimal(5,1)) ='$filter_zone_code'";
    }else{
        $where_p = "AND  cast(weight as decimal(5,1)) ='$filter_zone_code' AND goods_type='$filter_good_type'";
    }
    
    /*echo $filter_zone_code;*/
    
    if($based == 1){
        $query = "SELECT * FROM principal_price WHERE principal_id='$filter_principal_id' AND zone='$filter_zone_country' $where_p AND price > 0";
        $getResult = $db->link->query($query);
        $i=1;
        while($getRow = $getResult->fetch_assoc()){
            echo '<tr class="center">';
            echo '<td class="center">'.$i.'</td><td>'.$getRow['goods_type'].'</td><td>'.$getRow['weight'].'</td><td>'.$getRow['price'].'</td><td></td>';
            echo '</tr>';
            $i=$i+1;
        }
    }else{
        $query = "SELECT * FROM principal_price WHERE principal_id='$filter_principal_id' AND country='$filter_zone_country' $where_p AND price > 0";
        $getResult = $db->link->query($query);
        $i=1;
        while($getRow = $getResult->fetch_assoc()){
            echo '<tr class="center">';
            echo '<td class="center">'.$i.'</td><td>'.$getRow['goods_type'].'</td><td>'.$getRow['weight'].'</td><td>'.$getRow['price'].'</td><td></td>';
            echo '</tr>';
            $i=$i+1;
        }
    }
}


if(isset($_POST['client_cash_deposit_id'])){
    $client_cash_deposit_id = $_POST['client_cash_deposit_id'];
    $cashamount = $_POST['cashamount'];
    $moneyreceiptno = $_POST['moneyreceiptno'];
    
    if($client_cash_deposit_id != 0){
        $client_mail = $db->getClientEmail($client_cash_deposit_id);
    
        $received_by = Session::get('adminId');

        

        $insert = "INSERT INTO corporate_client_cash_history (corporate_client_email, reference_no, cash_amount, payment_date, received_by) VALUES ('$client_mail', '$moneyreceiptno', '$cashamount', NOW(), '$received_by')";

        $result = $db->link->query($insert);
        
        

        if($result){
            
            $new_cash = (float) $cashamount;
            
            $getSQL = "SELECT cash_amount, balance FROM corporate_accounts WHERE corporate_client_email='$client_mail'";
            $getReslut = $db->link->query($getSQL);
            while($getRow = $getReslut->fetch_assoc()){
                $cash_amount = (float) $getRow['cash_amount'];
                $balance = (float) $getRow['balance'];
            }
            
            $up_cash_amount = $cash_amount+$new_cash;
            $up_balance = $balance+$new_cash;
            
            $upSQL = "UPDATE corporate_accounts SET cash_amount='$up_cash_amount', balance='$up_balance' WHERE corporate_client_email='$client_mail'";
            $upResult = $db->link->query($upSQL);
            
            if($upResult){
                echo '<div class="alert alert-success"><strong>Success!</strong><br> Client Cash Deposit Success!!!</div>';
            }
            
            
            
            
        }else{
            echo '<div class="alert alert-danger"><strong>Warning!</strong><br> Money Receipt No: '.$moneyreceiptno.' Already Exists!</div>';
            
        }
    }else{
        echo '<div class="alert alert-danger"><strong>Warning!</strong><br> Client Company Not Found!</div>';
    }
    
    
    
}


if(isset($_POST['client_limit_update_id_check'])){
    $client_limit_update_id = $_POST['client_limit_update_id_check'];
    $client_mail = $db->getClientEmail($client_limit_update_id);
    
    if($client_limit_update_id != 0){
        
        $checkSQL = "SELECT credit_limit FROM corporate_accounts WHERE corporate_client_email='$client_mail'";
        $checkResult = $db->link->query($checkSQL);
        $checkROW = $checkResult->fetch_row();
        echo $checkROW[0];
    }else{
        echo 'NOT';
    }
}


if(isset($_POST['client_limit_update_id'])){
    $client_limit_update_id = $_POST['client_limit_update_id'];
    $updatelimitamount = (float) $_POST['updatelimitamount'];
    
    $client_mail = $db->getClientEmail($client_limit_update_id);
    
    $received_by = Session::get('adminId');
    
    if($client_limit_update_id != 0){
        if($updatelimitamount <= 0){
            echo '<div class="alert alert-danger"><strong>Warning!</strong><br> Negetive Value Not Accept!</div>';
        }else{
            $insertLimit = "INSERT INTO corporate_client_limit_history (corporate_client_email, limit_amount, update_date, update_by) VALUE 
            ('$client_mail', '$updatelimitamount', NOW(), '$received_by')";
            $resultLimit = $db->link->query($insertLimit);
            if($resultLimit){
                $upLimit = "UPDATE corporate_accounts SET credit_limit='$updatelimitamount' WHERE corporate_client_email='$client_mail'";
                $upLimitResult = $db->link->query($upLimit);

                if($upLimitResult){
                    echo '1';
                }
            }else{
                echo '<div class="alert alert-danger"><strong>Warning!</strong><br> Unknown Error!!!</div>';
            }
        }
        
    }else{
        echo '<div class="alert alert-danger"><strong>Warning!</strong><br> Client Company Not Found!</div>';
    }
}


if(isset($_POST['client_price_id'])){
    $client_price_id = $_POST['client_price_id'];
    $zone_id = $_POST['client_zone_id'];
    $good_type = $_POST['client_good_type'];
    
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    
    for($i=0; $i<count($weight); $i++){
        
        $weight_i = $weight[$i];
        $price_i = $price[$i];
        
        if($i==0){
            $sql = "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$client_price_id', '$good_type', '$zone_id', '$weight_i', '$price_i');";
        }else if($i == count($weight)-1){
            $sql .= "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$client_price_id', '$good_type', '$zone_id', '$weight_i', '$price_i')";
        }else{
            $sql .= "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$client_price_id', '$good_type', '$zone_id', '$weight_i', '$price_i');";
        }
    }
    
    $priceResult = $db->link->multi_query($sql);
    
    if($priceResult){
        print_r($priceResult);
    }else{
        echo $db->link->error;
    }
    
    
}

//start code for view client price

if(isset($_POST['client_zone_id_check'])){
    $zone_id_check = $_POST['client_zone_id_check'];
    $client_price_id_check = $_POST['client_price_id_check'];
    
    $i=1;
    $j=1;
    
    $query_p = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$client_price_id_check' AND zone='$zone_id_check' AND goods_type='P'";
    $result_p = $db->link->query($query_p);
    if($result_p->num_rows > 0){
        $i=0;
    }
    
    $query_d = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$client_price_id_check' AND zone='$zone_id_check' AND goods_type='D'";
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

if(isset($_POST['client_email'])){
    $client_email = $_POST['client_email'];
    $client_zone = $_POST['client_zone_view'];
    
    $sql = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$client_email' AND zone='$client_zone' AND price > 0";
    $result = $db->link->query($sql);
    
    $i=1;
    while($row = $result->fetch_assoc()){
        echo '<tr class="center">';
        echo '<td class="center">'.$i.'</td><td>'.$row['goods_type'].'</td><td>'.$row['weight'].'</td><td>'.$row['price'].'</td>';
        echo '</tr>';
        $i=$i+1;
    }
    
}


if(isset($_POST['client_email_w'])){
    $client_email_w = $_POST['client_email_w'];
    $client_zone_w = $_POST['client_zone_w'];
    
    $sql = "SELECT DISTINCT weight FROM corporate_client_price WHERE corporate_client_email='$client_email_w' AND zone='$client_zone_w' AND price > 0";
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
    
    $sqlP = "SELECT DISTINCT goods_type FROM corporate_client_price WHERE corporate_client_email='$client_email_w' AND zone='$client_zone_w' AND goods_type='P' AND price > 0";
    $resultP = $db->link->query($sqlP);
    
    while($rowP = $resultP->fetch_assoc()){
        ?>
        <option value="<?php echo $rowP['goods_type'] ?>"><?php echo 'Parcel' ?></option>
        <?php
    }
    
    $sqlD = "SELECT DISTINCT goods_type FROM corporate_client_price WHERE corporate_client_email='$client_email_w' AND zone='$client_zone_w' AND goods_type='D' AND price > 0";
    $resultD = $db->link->query($sqlD);
    
    while($rowD = $resultD->fetch_assoc()){
        ?>
        <option value="<?php echo $rowD['goods_type'] ?>"><?php echo 'Document' ?></option>
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
        $where_c = "AND goods_type='$client_good_type'";
        
    }else if($client_good_type == ""){
        $where_c = "AND weight='$client_zone_weight'";
        
    }else{
        $where_c = "AND weight='$client_zone_weight' AND goods_type='$client_good_type'";
        
    }
    
    
    $sql = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$client_email_filter' AND zone='$client_zone_filter' $where_c";
    $result = $db->link->query($sql);
    
    $i=1;
    while($row = $result->fetch_assoc()){
        echo '<tr class="center">';
        echo '<td class="center">'.$i.'</td><td>'.$row['goods_type'].'</td><td>'.$row['weight'].'</td><td>'.$row['price'].'</td>';
        echo '</tr>';
        $i=$i+1;
    }
}
//End code for view client price
?>