<?php

require __DIR__.'/Session.php';
require __DIR__.'/Database.php';

Session::checkSession();

$db = new Database;
$ndb = new Database;

$userStatusId = Session::get('adminId');

$userStatusQuery = "SELECT status FROM user WHERE userId = '$userStatusId'";

$userStatusResult = $db->select($userStatusQuery);

while($userStatusRow = $userStatusResult->fetch_assoc()){
    $userStatus = $userStatusRow['status'];
}

if($userStatus == 0){
    header('location: logout.php');
}


if(isset($_POST['ruleId'])){
    $qId = $_POST['ruleId'];
    $query = "SELECT ruleName, status FROM user_rule WHERE ruleId='$qId'";
    $result = $db->select($query);
    $row =  $result->fetch_array();
    echo json_encode($row);
}


if(isset($_POST['designationTitleUp'])){
    $qId = $_POST['ruleIdUp'];
    $title = $_POST['designationTitleUp'];
    $status = $_POST['designationStausUp'];
    
    $title = mysqli_real_escape_string($db->link, $title);
    
    $query = "UPDATE user_rule SET ruleName='$title', status='$status' WHERE ruleId='$qId'";
    
    $result = $db->update($query);
    
    echo $result;
}


if(isset($_POST['userRegName'])){
    
    $userTblIndexMsg = "done";
    $checkUserTableMsg = "done";
    
    $query = "SELECT id FROM user ORDER BY id DESC LIMIT 1";

    $result = $db->select($query);

    while($row = $result->fetch_assoc()){
        $lastId = $row['id']+1;
    }
    
    $yearMonth = date('y').date('m');

    if($lastId < 10){
        $lastId = '0'.$lastId;
    }
    
    $userId = $yearMonth.$lastId;
    $name = mysqli_real_escape_string($db->link, $_POST['userRegName']);
    $email = mysqli_real_escape_string($db->link, $_POST['usermail']);
    $address = mysqli_real_escape_string($db->link, $_POST['address']);
    $contactOne = mysqli_real_escape_string($db->link, $_POST['contactOne']);
    $contactTwo = mysqli_real_escape_string($db->link, $_POST['contactTwo']);
    $password = md5($_POST['stuffPassword']);
    $rule = mysqli_real_escape_string($db->link, $_POST['stuffRole']);
    $status = mysqli_real_escape_string($db->link, $_POST['userStatus']);
    
    /*$creation_area = '';*/
    
    $in_user_data = "INSERT INTO user (id, userId, name, rule, email, password, contact1, contact2, address, status) VALUE ('$lastId', '$userId', '$name', '$rule', '$email', '$password', '$contactOne', '$contactTwo', '$address', '$status')";
    
    $in_user_result = $db->link->query($in_user_data);
    
    
    if($in_user_result === TRUE){
        
        
        $createUserMenu = "CREATE TABLE IF NOT EXISTS menu_$userId (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            menuName VARCHAR(100) NOT NULL,
            menuUrl VARCHAR(100) NOT NULL,
            menuIndex VARCHAR(100) NOT NULL
        )";

        if($db->link->query($createUserMenu) === TRUE){
            $checkUserTableMsg = 'done';
        }else{
            $checkUserTableMsg = 'error';
        }
        
        echo $userTblIndexMsg.$checkUserTableMsg;

        
    }else{
        echo 'Email Already Exist! '.$db->link->error;
    }
    
    /*echo $userId." ".$name." ".$email." ".$address." ".$contactOne." ".$contactTwo." ".$password." ".$rule." ".$status;*/
    
    /*print_r($creation_area);*/
    
}


if(isset($_POST['menu-area'])){
    
    $userId = $_POST['userId'];
    
    $sql = "TRUNCATE TABLE menu_$userId";
    
    $result = $db->link->query($sql);
    
    if($result === TRUE){
        $menu_area = $_POST['menu-area'];

        for($i=0; $i<count($menu_area); $i++){
            $j = $menu_area;

            $sql_ma = "SELECT * FROM menu_sidebar WHERE id=$j[$i]";
            $result_ma = $db->select($sql_ma);
            $row_ma = $result_ma->fetch_assoc();

            $ma_menu_name = mysqli_real_escape_string($db->link, $row_ma['menuName']);
            $ma_menu_url = mysqli_real_escape_string($db->link, $row_ma['menuUrl']);
            $ma_menu_index = mysqli_real_escape_string($db->link, $row_ma['menuIndex']);

            if($i==0){
                $ma_sql = "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index');";
            }else if($i == count($menu_area)-1){
                $ma_sql .= "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index')";
            }else{
                $ma_sql .= "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index');";
            }


        }

        if($db->link->multi_query($ma_sql) === TRUE) {
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo $db->link->error();
    }

    
    /*$ma_sql = "";
    $userTblIndexMsg = "done";


    if(isset($_POST['menu-area'])){

        $menu_area = $_POST['menu-area'];

        for($i=0; $i<count($menu_area); $i++){
            $j = $menu_area;

            $sql_ma = "SELECT * FROM menu_sidebar WHERE id=$j[$i]";
            $result_ma = $db->select($sql_ma);
            $row_ma = $result_ma->fetch_assoc();

            $ma_menu_name = mysqli_real_escape_string($db->link, $row_ma['menuName']);
            $ma_menu_url = mysqli_real_escape_string($db->link, $row_ma['menuUrl']);
            $ma_menu_index = mysqli_real_escape_string($db->link, $row_ma['menuIndex']);

            if($i==0){
                $ma_sql = "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index');";
            }else if($i == count($menu_area)-1){
                $ma_sql .= "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index')";
            }else{
                $ma_sql .= "INSERT INTO menu_$userId (menuName, menuUrl, menuIndex) VALUES ('$ma_menu_name', '$ma_menu_url', '$ma_menu_index');";
            }


        }

        if($db->link->multi_query($ma_sql) === TRUE) {
            $userTblIndexMsg = "done";
        }else{
            $userTblIndexMsg = "error";
        }

    }*/
    
    
}


if(isset($_POST['userStatusChange'])){
    
    $userId = $_POST['userStatusChange'];
    
    $statusQuery = "SELECT status FROM user WHERE userId='$userId'";
    
    $statusResult = $db->select($statusQuery);
    
    while($statusRow = $statusResult->fetch_assoc()){
        
        if($statusRow['status'] == 1){
            
            $updateUserStatusQuery = "UPDATE user SET status='0' WHERE userId='$userId'";
            
            $updateUserStatusResult = $db->update($updateUserStatusQuery);
            
            if($updateUserStatusResult === TRUE){
                echo '0';
            }else{
                echo 'Not Working!';
            }
            
            
        }else{
            
            $updateUserStatusQuery = "UPDATE user SET status='1' WHERE userId='$userId'";
            
            $updateUserStatusResult = $db->update($updateUserStatusQuery);
            
            if($updateUserStatusResult === TRUE){
                echo '1';
            }else{
                echo 'Not Working!';
            }
        }
        
        
        
    }
    
    
}


if(isset($_POST['p_z_c_tag'])){
    
    $userId = mysqli_real_escape_string($db->link, $_POST['userId']);
    $zone_id = mysqli_real_escape_string($db->link, $_POST['zone_id']);
//    $country = mysqli_real_escape_string($db->link, $_POST['country']);
    $country = $_POST['country'];
    
    for($i=0; $i<count($country); $i++){
        
        $tags = $country[$i];
        
        if($i==0){
            $zoneSql = "INSERT INTO principal_zone (principal_id, zone, country_tag) VALUES ('$userId', '$zone_id', '$tags');";
        }else if($i == count($country)-1){
            $zoneSql .= "INSERT INTO principal_zone (principal_id, zone, country_tag) VALUES ('$userId', '$zone_id', '$tags')";
        }else{
            $zoneSql .= "INSERT INTO principal_zone (principal_id, zone, country_tag) VALUES ('$userId', '$zone_id', '$tags');";
        }
    }
    
    $zoneResult = $db->link->multi_query($zoneSql);
    
    if($zoneResult){
        print_r($zoneResult);
    }else{
        echo $db->link->error;
    }
    
    
}


if(isset($_POST['dml_country'])){
    
    $zone_id = mysqli_real_escape_string($db->link, $_POST['dml_zone_id']);
//    $country = mysqli_real_escape_string($db->link, $_POST['country']);
    $country = $_POST['dml_country'];
    
    for($i=0; $i<count($country); $i++){
        
        $tags = $country[$i];
        
        if($i==0){
            $zoneSql = "INSERT INTO dml_zone (zone, country_tag, uapdate_date) VALUES ('$zone_id', '$tags', NOW());";
        }else if($i == count($country)-1){
            $zoneSql .= "INSERT INTO dml_zone (zone, country_tag, uapdate_date) VALUES ('$zone_id', '$tags', NOW())";
        }else{
            $zoneSql .= "INSERT INTO dml_zone (zone, country_tag, uapdate_date) VALUES ('$zone_id', '$tags', NOW());";
        }
    }
    
    $zoneResult = $db->link->multi_query($zoneSql);
    
    if($zoneResult){
        print_r($zoneResult);
    }else{
        echo $db->link->error;
    }
    
    
}

if(isset($_POST['principalId'])){
    $principalId = $_POST['principalId'];
    $zone_code = $_POST['zone_code'];
    
//    $sql = "SELECT * FROM principal_zone WHERE principal_id='$principalId' AND zone='$zone_code' ORDER BY country_tag ASC";
    $sql = "SELECT principal_zone.*, tbl_country.country_name FROM principal_zone INNER JOIN tbl_country ON principal_zone.country_tag = tbl_country.country_tag WHERE principal_zone.principal_id = '$principalId' AND principal_zone.zone = '$zone_code' ORDER BY tbl_country.country_name ASC";
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
        
            $conutry_name = $db->getCountryName($row['country_tag']);

            echo "<tr>";
                echo "<td class='center'>".$i."</td>";
                echo "<td>".$conutry_name."</td>";
                echo "<td class='center'>".$row['country_tag']."</td>";
                echo "<td class='center'><button id='".$row['id']."' class='btn btn-sm btn-warning' onClick='removeCountry(event);'>REMOVE</button></td>";
            echo "</tr>";
            $i++;
        }
    }else{
            echo '0';
    }
}


if(isset($_POST['removeCountry'])){
    $removeCountry = $_POST['removeCountry'];
    
    $sql = "DELETE FROM principal_zone WHERE id='$removeCountry'";
    $result = $db->link->query($sql);
    
    if($result){
        echo '1';
    }else{
        echo '0';
    }
}


if(isset($_POST['getCountryInfo'])){
    $id = $_POST['getCountryInfo'];
    
    $sql = "SELECT * FROM tbl_country WHERE country_id='$id'";
    $rlt = $db->link->query($sql);
    $row = $rlt->fetch_array();
    echo json_encode($row);
}


if(isset($_POST['countryId'])){
    $countryId = $_POST['countryId'];
    $countryName = $_POST['countryName'];
    $countryTag = $_POST['countryTag'];
    
    $sql = "UPDATE tbl_country SET country_name='$countryName', country_tag='$countryTag' WHERE country_id='$countryId'";
    $rlt = $db->link->query($sql);
    if($rlt){
        echo '1';
    }else{
        echo '0';
    }
}


if(isset($_POST['currencyName'])){
    $currencyName = strtoupper($_POST['currencyName']);
    $currencyRate = $_POST['currencyRate'];
    $user = Session::get('adminId');
    
    $sql = "INSERT INTO currency (currency_name, currency_rate, user) VALUES ('$currencyName', '$currencyRate', '$user')";
    $result = $db->link->query($sql);
    if($result){
        echo '1';
    }else{
        echo '0';
    }
}


if(isset($_POST['currencyId'])){
    $currencyId = $_POST['currencyId'];
    $sql = "SELECT * FROM currency WHERE id='$currencyId'";
    $result = $db->link->query($sql);
    
    if($result->num_rows > 0){
        $row = $result->fetch_array();
        echo json_encode($row);
    }else{
        echo 0;
    }
}

if(isset($_POST['upCurrencyId'])){
    $upCurrencyId = $_POST['upCurrencyId'];
    $upCurrencyRate = $_POST['upCurrencyRate'];
    $user = Session::get('adminId');
    
    $sql = "UPDATE currency SET currency_rate='$upCurrencyRate', user='$user' WHERE id='$upCurrencyId'";
    $result = $db->link->query($sql);
    if($result){
        echo '1';
    }else{
        echo '0';
    }
    
}

if(isset($_POST['getPrincipalId'])){
    $getPrincipalId = $_POST['getPrincipalId'];
    $sql = "SELECT * FROM principals_name WHERE id='$getPrincipalId'";
    $result = $db->link->query($sql);
    $row = $result->fetch_array();
    
    echo json_encode($row);
}

if(isset($_POST['upPrincipalId'])){
    $upPrincipalId = $_POST['upPrincipalId'];
    $upPrincipalName = $_POST['upPrincipalName'];
    $upPrincipalBased = $_POST['upPrincipalBased'];
    $upCurrency = $_POST['upCurrency'];
    $upFuelCost = $_POST['upFuelCost'];
    $upAirlinesCost = $_POST['upAirlinesCost'];
    $user = Session::get('adminId');
    
    $sql = "UPDATE principals_name SET based='$upPrincipalBased', currency='$upCurrency', fuel_cost='$upFuelCost', airlines_cost='$upAirlinesCost', user='$user' WHERE id='$upPrincipalId'";
    $result = $db->link->query($sql);
    if($result){
        echo '1';
    }else{
        echo '0';
    }
}


if(isset($_POST['check_tag_in_zone'])){
    $tag = $_POST['check_tag_in_zone'];
    $principalId = $_POST['tag_principalid_zone'];
    $zone_id = $_POST['tag_zone_id'];
    
    
    $sql = "SELECT IF( EXISTS (SELECT id FROM principal_zone WHERE principal_id='$principalId' AND country_tag='$tag'), 1, 0)";
    $rlt = $db->link->query($sql);
    
    $row = $rlt->fetch_row();
    
    echo $row[0];
}


if(isset($_POST['check_zone_for_price'])){
    $check_zone_for_price = $_POST['check_zone_for_price'];
    $principalId = $_POST['tag_principalid_zone'];
    
    $sql_zone = "SELECT IF( EXISTS (SELECT id FROM principal_zone WHERE principal_id='$principalId' AND zone='$check_zone_for_price'), 1, 0)";
    $rlt_zone = $db->link->query($sql_zone);
    
    $row_zone = $rlt_zone->fetch_row();
    
    
    
    $sql_price = "SELECT IF( EXISTS (SELECT id FROM principal_price WHERE principal_id='$principalId' AND zone='$check_zone_for_price'), 1, 0)";
    $rlt_price = $db->link->query($sql_price);
    
    $row_price = $rlt_price->fetch_row();
    
    if($row_zone[0] == 0){
        echo "PLEASE ADD ZONE FIRST";
    }else if($row_price[0] > 0){
        echo "SELECTED ZONE ALREADY EXIST";
    }else{
        echo '0';
    }
}


if(isset($_POST['setzoneprincipalid'])){
    $setzoneprincipalid = $_POST['setzoneprincipalid'];
    $zone_code_price = $_POST['zone_code_price'];
    
    $d_weight = $_POST['d_weight'];
    $d_price = $_POST['d_price'];
    
    $p_weight = $_POST['p_weight'];
    $p_price = $_POST['p_price'];
    
    $rl = 0;
    
    
    
    $sql_price = "SELECT IF( EXISTS (SELECT id FROM principal_price WHERE principal_id='$setzoneprincipalid' AND zone='$zone_code_price'), 1, 0)";
    $rlt_price = $db->link->query($sql_price);
    
    $row_price = $rlt_price->fetch_row();
    
    if($row_price[0] > 0){
        echo "SELECTED ZONE ALREADY EXIST";
    }else{
        
    
        for($i=0; $i<count($d_weight); $i++){

            $d_w = $d_weight[$i];
            $d_p = $d_price[$i];

            if($i==0){
                $d_sql = "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$setzoneprincipalid', 'D', '$zone_code_price', '0', '$d_w', '$d_p', '1');";
            }else if($i == count($d_weight)-1){
                $d_sql .= "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$setzoneprincipalid', 'D', '$zone_code_price', '0', '$d_w', '$d_p', '1')";
            }else{
                $d_sql .= "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$setzoneprincipalid', 'D', '$zone_code_price', '0', '$d_w', '$d_p', '1');";
            }
        }

        $d_rlt = $db->link->multi_query($d_sql);
        
        $db->link->close();
        
       

        if($d_rlt){
            $rl++;
        }
        
        
        for($j=0; $j<count($p_weight); $j++){

            $p_w = $p_weight[$j];
            $p_p = $p_price[$j];

            if($j==0){
                $p_sql = "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$setzoneprincipalid', 'P', '$zone_code_price', '0', '$p_w', '$p_p', '1');";
            }else if($j == count($p_weight)-1){
                $p_sql .= "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$setzoneprincipalid', 'P', '$zone_code_price', '0', '$p_w', '$p_p', '1')";
            }else{
                $p_sql .= "INSERT INTO principal_price (principal_id, goods_type, zone, country, weight, price, status) VALUES ('$setzoneprincipalid', 'P', '$zone_code_price', '0', '$p_w', '$p_p', '1');";
            }
        }
            
        $p_rlt = $ndb->link->multi_query($p_sql);

        if($p_rlt){
            $rl++;
        }else{
            echo $db->link->error;
        }


        echo $rl;
    }
    
    
}




/*echo 'Working';*/


?>