<?php 
require __DIR__.'/lib/Session.php';
require __DIR__."/lib/Database.php";

Session::checkClientSession();

$db = new Database();


function getTrackingId(){
    
     $db = New Database();

    $date = date('y').date('m');

    $query = "SELECT tracking_id FROM tracking_id WHERE date='$date' ORDER BY id DESC LIMIT 1";

    $result = $db->link->query($query);

    $row = $result->fetch_row();

    if($result->num_rows == 0){
        $num = 1;
        $num_padded = sprintf("%06d", $num);
        $insert = "INSERT INTO tracking_id (date, tracking_id) VALUES ('$date', '$num_padded')";
        $insertQuery = $db->link->query($insert);

        if($insertQuery){
            echo $date.$num_padded;
        }else{
            echo $db->link->error;
        }
    }else{
        $num = $row[0]+1;

        $num_padded = sprintf("%06d", $num);
        $insert = "INSERT INTO tracking_id (date, tracking_id) VALUES ('$date', '$num_padded')";
        $insertQuery = $db->link->query($insert);

        if($insertQuery){
            echo $date.$num_padded;
        }else{
            echo $db->link->error;
        }
    }


}

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




if(isset($_POST['goods_weight_c'])){
    $countryTag = $_POST['ct'];
    $clientId = $_POST['client'];
    $goods_type = $_POST['goods_type_c'];
    $goods_weight = $_POST['goods_weight_c'];
    
    
    
    $sql = "SELECT zone FROM dml_zone WHERE country_tag='$countryTag'";
    $result = $db->link->query($sql);
    $row = $result->fetch_row();
    
    $routeId = $row[0];
    
    $clientEmail = $db->getClientEmail($clientId);
    
    $routeQuery = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$clientEmail' AND zone='$routeId' AND weight='$goods_weight' AND goods_type='$goods_type'";
    $routeResult = $db->link->query($routeQuery);
    
    if($routeResult -> num_rows > 0){
        $routeRows = $routeResult->fetch_row();
        echo $routeRows[5];
    }else{
        echo "0";
    }
    
}


if(isset($_POST['trackId_c'])){
    getTrackingId();
}



if(isset($_POST['trackID'])){
    
    $custom_trackId = $_POST['custom_trackId'];
    $trackID = $_POST['trackID'];
    $sender_type = 'corporate';
    
    $corpo_clients = $_POST['corpo_clients'];
    
    if($corpo_clients == ''){
        $corpo_clients = 0;
    }
    
    $sender_name = $_POST['sender_name'];
    $sender_company = $_POST['sender_company'];
    $sender_email = $_POST['sender_email'];
    $sender_contact = $_POST['sender_contact'];
    $sender_country = 'BD';
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
    
    $goods_title = $_POST['goods_title'];
    $recipient_city = $_POST['recipient_city'];
    $dest_country = $_POST['dest_country'];
    
    $goods_type = $_POST['goods_type'];
    $goods_weight = $_POST['goods_weight'];
    $shipping_charge = $_POST['shipping_charge'];
    $shimpent_pieces = $_POST['shimpent_pieces'];
    $shimpent_declared_value = $_POST['shimpent_declared_value'];
    
    
    $assigneQuery = "SELECT assign_to FROM corporate_clients WHERE email='$sender_email'";
    $assigneReslut = $db->link->query($assigneQuery);
    $assigneRow = $assigneReslut->fetch_row();
    
    $assigneUser = $assigneRow[0];
    
    $submiteduser = Session::get('ClientID');
    
   /* echo $custom_trackId.' '.$trackID.' '.$sender_type.' '.$corpo_clients.' '.$sender_name.' '.$sender_company.' 
    '.$sender_email.' '.$sender_contact.' '.$sender_email.' '.$sender_country.' '.$sender_addr.' '.$recipient_company.' '.$recipient_email.' 
    '.$recipient_addr1.' '.$recipient_addr2.' '.$recipient_addr3.' '.$recipient_zipcode.' '.$recipient_phone.' '.$recipient_mobile.' 
    '.$goods_title.' '.$goods_weight.' '.$shipping_charge.' '.$shimpent_pieces.' '.$shimpent_declared_value;*/
    
    $query = "INSERT INTO consignment_booking 
    (client_Id, tracking_id, awb_no, s_type, s_name, s_company, s_email, s_contact, s_country, s_address, r_name, r_company, r_email, r_address1, r_address2, r_address3, r_zip, r_phone, r_mobile, r_city, r_country, g_title, g_type, g_weight, g_pieces, g_customs_value, g_shipment_charge, assigned_user, submited_by) VALUES ('$corpo_clients', '$trackID', '$custom_trackId', '$sender_type', '$sender_name', '$sender_company', '$sender_email', '$sender_contact', '$sender_country', '$sender_addr', '$recipient_name', '$recipient_company',  '$recipient_email', '$recipient_addr1', '$recipient_addr2', '$recipient_addr3', '$recipient_zipcode', '$recipient_phone', '$recipient_mobile', '$recipient_city', '$dest_country', '$goods_title', '$goods_type', '$goods_weight', '$shimpent_pieces', '$shimpent_declared_value', '$shipping_charge', '$assigneUser', '$submiteduser')";
    
    
    
    $result = $db->link->query($query);
    
    if($result){
        echo '1';
    }else{
        echo $db->link->error;
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