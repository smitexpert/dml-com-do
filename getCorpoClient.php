<?php 
require __DIR__.'/lib/Session.php';
require __DIR__."/lib/Database.php";

$view = "";


$db = new Database();
$ndb = new Database();


include('lib/Traking.php');

if(isset($_POST['clientId'])){
    $clientId=$_POST['clientId'];

/*if ($_POST['action'] == 'getclientdata') {

 	if (!empty($clientId)) {

	//$query = "SELECT * FROM tbl_corporate_clients WHERE client_id=$clientId";
	$query = "SELECT cc . * , s .stuff_id,s.stuff_name 
	FROM tbl_corporate_clients AS cc, tbl_stuff AS s
	WHERE cc.client_assignee = s.stuff_id
	AND client_id =$clientId
	AND STATUS =1
	ORDER BY dated DESC";

    $selectCorpoClient = $Corpoclients->selectCorpoClient($query);
	if ($selectCorpoClient) {
		$findclientdata=$selectCorpoClient->fetch_assoc();
		if ($findclientdata) {
		//echo  $findclientdata['client_name'];
		echo json_encode($findclientdata);
		}else{
			echo "data not found";
		}
	}else{}

	}
}*/

$query = "SELECT * FROM corporate_clients WHERE id=$clientId";

$row = array();

$client_assignee = '';

$result = $db->link->query($query);

while($r = $result->fetch_assoc()){
    $row['client'] = $r;
    
    $client_assignee = $r['assign_to'];
    
}

print json_encode($row);
    
}

if(isset($_POST['countryTag'])){
    $countryTag = $_POST['countryTag'];
    $clientId = $_POST['client'];
    
    
    
    $sql = "SELECT zone FROM dml_zone WHERE country_tag='$countryTag'";
    $result = $db->link->query($sql);
    $row = $result->fetch_row();
    
    $routeId = $row[0];
    
    $clientEmail = $db->getClientEmail($clientId);
    
    $routeQuery = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$clientEmail' AND zone='$routeId'";
    $routeResult = $db->link->query($routeQuery);
    
    if($routeResult -> num_rows > 0){
        echo "1";
    }else{
        echo "0";
    }
    
}

if(isset($_POST['goods_weight_m'])){
    
    $countryTag = $_POST['ct'];
    $clientId = $_POST['client'];
    $goods_type = $_POST['goods_type_c'];
    $goods_weight = $_POST['goods_weight_m'];
    
    
    
    $sql = "SELECT zone FROM dml_zone WHERE country_tag='$countryTag'";
    $result = $db->link->query($sql);
    $row = $result->fetch_row();
    
    $routeId = $row[0];
    
    $clientEmail = $db->getClientEmail($clientId);
    
    $routeQuery = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$clientEmail' AND zone='$routeId' AND weight='$goods_weight' AND goods_type='$goods_type'";
    $routeResult = $db->link->query($routeQuery);
    
    if($routeResult -> num_rows > 0){
        $routeRows = $routeResult->fetch_row();
        echo "1";
    }else{
        echo "0";
    }
    
}

if(isset($_POST['goods_type_m'])){
    $countryTag = $_POST['ct'];
    $clientId = $_POST['client'];
    $goods_type = $_POST['goods_type_m'];
    
    
    $sql = "SELECT zone FROM dml_zone WHERE country_tag='$countryTag'";
    $result = $db->link->query($sql);
    $row = $result->fetch_row();
    
    $routeId = $row[0];
    
    $clientEmail = $db->getClientEmail($clientId);
    
    $routeQuery = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$clientEmail' AND zone='$routeId' AND goods_type='$goods_type'";
    $routeResult = $db->link->query($routeQuery);
    
    if($routeResult -> num_rows > 0){
        echo "1";
        /*print_r($routeRows);*/
    }else{
        echo "0";
    }
    
}


if(isset($_GET['view'])){
    $view = $_GET['view'];
}

if(isset($_POST['goods_weight_c'])){
    $countryTag = $_POST['ct'];
    $clientId = $_POST['client'];
    $goods_type = $_POST['goods_type_c'];
    $goods_weight = $_POST['goods_weight_c'];
    
    
    
    $sql = "SELECT zone FROM dml_zone WHERE country_tag='$countryTag'";
    $result = $db->link->query($sql);
    
    $account_sql = "SELECT amount, transaction_type FROM accounts WHERE payer_type='corporate' AND client_id='$clientId'";
    
    if($result->num_rows > 0){
        $row = $result->fetch_row();
        $routeId = $row[0];

        $clientEmail = $db->getClientEmail($clientId);

        $routeQuery = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$clientEmail' AND zone='$routeId' AND weight='$goods_weight' AND goods_type='$goods_type'";
        $routeResult = $db->link->query($routeQuery);

        if($routeResult -> num_rows > 0){
            $routeRows = $routeResult->fetch_row();
            echo $routeRows[5];
        }else{
            echo "PNF";
        }
    }else{
        echo "CNF";
    }
    
    
    
}


if(isset($_POST['trackId_c'])){
    getTrackingId();
}



if(isset($_POST['trackID'])){
    
    
    if($_POST['custom_trackId'] == ""){
        $custom_trackId = $_POST['custom_trackId_p'];
    }else{
        $custom_trackId = $_POST['custom_trackId'];
    }
    
    if($_POST['trackID'] == ""){
        $trackID = $_POST['trackID_p'];
    }else{
        $trackID = $_POST['trackID'];
    }
    
    
    $sender_type = $_POST['sender_type'];
    
    $corpo_clients = $_POST['corpo_clients'];
    
    if($corpo_clients == ''){
        $corpo_clients = 0;
    }
    
    $sender_name = $_POST['sender_name'];
    $sender_company = $_POST['sender_company'];
    $sender_email = $_POST['sender_email'];
    $sender_contact = $_POST['sender_contact'];
    $sender_country = strtoupper($_POST['sender_country']);
    $sender_addr = $_POST['sender_addr'];
    
    $recipient_name = $_POST['recipient_name'];
    $recipient_company = $_POST['recipient_company'];
    $recipient_email = $_POST['recipient_email'];
    $recipient_addr1 = $_POST['recipient_addr1'];
    $recipient_addr2 = $_POST['recipient_addr2'];
    $recipient_addr3 = $_POST['recipient_addr3'];
    $recipient_zipcode = $_POST['recipient_zipcode'];
    $recipient_phone = $_POST['recipient_phone'];
    $recipient_mobile = $_POST['recipient_mobile'];
    
    /*$goods_title = $_POST['goods_title'];
    $recipient_city = $_POST['recipient_city'];
    $dest_country = $_POST['dest_country'];*/
    
    /*$goods_type = $_POST['goods_type'];
    $goods_weight = $_POST['goods_weight'];
    $shipping_charge = $_POST['shipping_charge'];
    $shimpent_pieces = $_POST['shimpent_pieces'];
    $shimpent_declared_value = $_POST['shimpent_declared_value'];*/
    
    if($_POST['goods_title'] == ""){
        $goods_title = $_POST['goods_title'];
    }else{
        $goods_title = $_POST['goods_title'];
    }
    
    if($_POST['recipient_city'] == ""){
        $recipient_city = $_POST['recipient_city_p'];
    }else{
        $recipient_city = $_POST['recipient_city'];
    }
    
    if($_POST['dest_country'] == ""){
        $dest_country = $_POST['dest_country_p'];
    }else{
        $dest_country = $_POST['dest_country'];
    }
    
    if($_POST['shimpent_declared_value'] == ""){
        $shimpent_declared_value = $_POST['shimpent_declared_value_p'];
    }else{
        $shimpent_declared_value = $_POST['shimpent_declared_value'];
    }
    
    if($_POST['shimpent_pieces'] == ""){
        $shimpent_pieces = $_POST['shimpent_pieces_p'];
    }else{
        $shimpent_pieces = $_POST['shimpent_pieces'];
    }
    
    if($_POST['shipping_charge'] == ""){
        $shipping_charge = $_POST['shipping_charge_p'];
    }else{
        $shipping_charge = $_POST['shipping_charge'];
    }
    
    if($_POST['goods_type'] == ""){
        $goods_type = $_POST['goods_type_p'];
    }else{
        $goods_type = $_POST['goods_type'];
    }
    
    if($_POST['goods_weight'] == ""){
        $goods_weight = $_POST['goods_weight_p'];
    }else{
        $goods_weight = $_POST['goods_weight'];
    }
    
    
    $assigneQuery = "SELECT assign_to FROM corporate_clients WHERE email='$sender_email'";
    $assigneReslut = $db->link->query($assigneQuery);
    $assigneRow = $assigneReslut->fetch_row();
    
    $assigneUser = $assigneRow[0];
    
    $submiteduser = Session::get('adminId');
    
   /* echo $custom_trackId.' '.$trackID.' '.$sender_type.' '.$corpo_clients.' '.$sender_name.' '.$sender_company.' 
    '.$sender_email.' '.$sender_contact.' '.$sender_email.' '.$sender_country.' '.$sender_addr.' '.$recipient_company.' '.$recipient_email.' 
    '.$recipient_addr1.' '.$recipient_addr2.' '.$recipient_addr3.' '.$recipient_zipcode.' '.$recipient_phone.' '.$recipient_mobile.' 
    '.$goods_title.' '.$goods_weight.' '.$shipping_charge.' '.$shimpent_pieces.' '.$shimpent_declared_value;*/
    
    $query = "INSERT INTO consignment_booking 
    (client_Id, tracking_id, awb_no, s_type, s_name, s_company, s_email, s_contact, s_country, s_address, r_name, r_company, r_email, r_address1, r_address2, r_address3, r_zip, r_phone, r_mobile, r_city, r_country, g_title, g_type, g_weight, g_pieces, g_customs_value, g_shipment_charge, assigned_user, submited_by, status) VALUES ('$corpo_clients', '$trackID', '$custom_trackId', '$sender_type', '$sender_name', '$sender_company', '$sender_email', '$sender_contact', '$sender_country', '$sender_addr', '$recipient_name', '$recipient_company',  '$recipient_email', '$recipient_addr1', '$recipient_addr2', '$recipient_addr3', '$recipient_zipcode', '$recipient_phone', '$recipient_mobile', '$recipient_city', '$dest_country', '$goods_title', '$goods_type', '$goods_weight', '$shimpent_pieces', '$shimpent_declared_value', '$shipping_charge', '$assigneUser', '$submiteduser', '1')";
    
    
    
    $result = $db->link->query($query);
    
    $t=time();
    $transaction_id = 'DML'.$t;
    
    $getRate = $db->getCurrency('USD');
    
    $bdt = $shipping_charge*$getRate;
    
    $date = date("Y-m-d");
    
    if($result){
        
        if($sender_type == 'corporate'){
            $in_account = "INSERT INTO accounts (reference_id, transaction_id, transaction_type, transaction_mode, payer_type, client_name, client_id, amount, based, base_rate, bdt_ammount, usd_ammount, prepared_by, description, transaction_date) VALUES ('$trackID', '$transaction_id', '0', 'booking', 'corporate', '$sender_company', '$corpo_clients', '$bdt', 'BDT', '$getRate', '$bdt', '$shipping_charge', '$submiteduser', 'Consignment Booking', '$date')";
            
            $in_result = $db->link->query($in_account);
            
            if($in_result){
                echo '1';
            }else{
                echo $db->link->error;
            }
        }
    }else{
        echo $db->link->error;
    }
    
    
    
    
    
}

if(isset($_POST["generalZoneCheck"])){
    $generalZoneCheck = $_POST['generalZoneCheck'];
    
    $sql = "SELECT zone FROM general_price WHERE zone = '$generalZoneCheck'";
    $rlt = $db->link->query($sql);
    if($rlt->num_rows > 0){
        echo '1';
    }else{
        echo '0';
    }
}

if($view != ""){
    $viewTblSql = "SHOW COLUMNS FROM $view";
    $viewTblRsl = $db->link->query($viewTblSql);
    
    while($viewTblRow = $viewTblRsl->fetch_assoc()){
        $viewTblCols[] = $viewTblRow;
    }
    
    foreach($viewTblCols as $viewTblCol){
        $viewTblSl[] = $viewTblCol['Field'];
    }
    
    
    
    $totalTblCol = count($viewTblSl);
    
    $viewSql = "SELECT * FROM $view";
    $viewRsl = $db->link->query($viewSql);
    
    if($viewRsl->num_rows > 0){
        ?>
        <table>
            <tr>
                <?php
            for($i=0; $i<$totalTblCol; $i++){
                ?>
                <td><?php echo $viewTblSl[$i]; ?></td>
                <?php
                }
            ?>
            </tr>
        <?php
        while($viewRow = $viewRsl->fetch_row()){
            ?>
            <tr>
                <?php
            for($i=0; $i<$totalTblCol; $i++){
                ?>
                <td><?php echo $viewRow[$i]; ?></td>
                <?php
                }
            ?>
            </tr>
            <?php
        }
        
        ?>
        </table>
        <?php
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*if($viewRsl->num_rows > 0){
        while($viewRow = $viewRsl->fetch_assoc()){
            
        }
    }*/
}


if(isset($_POST['general_zone'])){
    
    $general_zone = $_POST['general_zone'];
    $user = Session::get("adminId");
    
    $d_weight = $_POST['d_weight'];
    $d_price = $_POST['d_price'];
    
    $p_weight = $_POST['p_weight'];
    $p_price = $_POST['p_price'];
    
    $rl = 0;
    
    $sql = "SELECT zone FROM general_price WHERE zone = '$general_zone'";
    $rlt = $db->link->query($sql);
    if($rlt->num_rows > 0){
        echo 'Zone Alread Exist!';
    }else{
    
        for($i=0; $i<count($d_weight); $i++){

                $d_w = $d_weight[$i];
                $d_p = $d_price[$i];

                if($i==0){
                    $d_sql = "INSERT INTO general_price (goods_type, zone, weight, price, user) VALUES ('D', '$general_zone', '$d_w', '$d_p', '$user');";
                }else if($i == count($d_weight)-1){
                    $d_sql .= "INSERT INTO general_price (goods_type, zone, weight, price, user) VALUES ('D', '$general_zone', '$d_w', '$d_p', '$user')";
                }else{
                    $d_sql .= "INSERT INTO general_price (goods_type, zone, weight, price, user) VALUES ('D', '$general_zone', '$d_w', '$d_p', '$user');";
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
                    $p_sql = "INSERT INTO general_price (goods_type, zone, weight, price, user) VALUES ('P', '$general_zone', '$p_w', '$p_p', '$user');";
                }else if($j == count($p_weight)-1){
                    $p_sql .= "INSERT INTO general_price (goods_type, zone, weight, price, user) VALUES ('P', '$general_zone', '$p_w', '$p_p', '$user')";
                }else{
                    $p_sql .= "INSERT INTO general_price (goods_type, zone, weight, price, user) VALUES ('P', '$general_zone', '$p_w', '$p_p', '$user');";
                }
            }

            $p_rlt = $ndb->link->multi_query($p_sql);

            if($p_rlt){
                $rl++;
            }else{
                echo $ndb->link->error;
            }


            echo $rl;
        
        
    }
}

if(isset($_POST['ct_p'])){
    $ct_p = $_POST['ct_p'];
    $goods_weight_p = $_POST['goods_weight_p'];
    $goods_type_p = $_POST['goods_type_p'];
    
    $slZone = "SELECT zone FROM dml_zone WHERE country_tag='$ct_p'";
    $slRlt = $db->link->query($slZone);
    
    if($slRlt->num_rows > 0){
        $zoneRow = $slRlt->fetch_row();
        $zone = $zoneRow[0];
        
        $slPrice = "SELECT price FROM general_price WHERE zone='$zone' AND goods_type='$goods_type_p' AND weight='$goods_weight_p'";
        $priceRlt = $db->link->query($slPrice);
        
        
        
        if($priceRlt->num_rows > 0){
            $priceRow = $priceRlt->fetch_row();
            echo $priceRow[0];
        }else{
            echo "PNF";
        }
        
    }else{
        echo "CNF";
    }
    
}



//echo $clientId;







//FIND THE CUSTOM price OF THIS CLIENT
// if ($_POST['action'] == 'getClientPrice') {

//  $route = $_REQUEST['route'];
//  $income_or_outgo = $_REQUEST['income_or_outgo'];
//  $goods_type = $_REQUEST['goods_type'];
//  $unit = $_REQUEST['unit'];


// 	  if (!empty($route) && !empty($income_or_outgo) && !empty($goods_type) && !empty($unit)) {
// 			$slectgenprice = "SELECT * FROM tbl_corpo_client_price WHERE corpo_client_id=$clientId AND route_code=$route AND income_or_outgo='$income_or_outgo' AND goods_type='$goods_type' AND unit=$unit";
// 			$execgenprice=$Corpoclients->selectCorpoClient($slectgenprice);
// 			if ($execgenprice) {
// 				$findgenprice=$execgenprice->fetch_assoc();
// 				if ($findgenprice) {
// 				//echo  $findgenprice['price'];
// 				echo json_encode($findgenprice);
// 				}else{
// 					echo "CLIENT PRICE NOT SET";
// 				}
// 			}else{}

// 		}
// 	}

//FIND THE CUSTOM price OF THIS CLIENT ENDS







?>
