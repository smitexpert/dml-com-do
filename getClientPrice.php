<?php 
require __DIR__."/classes/Corporateclients.php";
$Corpoclients = new Corporateclients();



//FIND THE CUSTOM price OF THIS CLIENT
if ($_POST['action'] == 'getClientPrice') {


$clientId = $_REQUEST['clientId'];
$income_or_outgo = $_REQUEST['income_or_outgo'];
$goods_type = $_REQUEST['goods_type'];
$unit = $_REQUEST['unit'];
$dest_country = $_REQUEST['dest_country'];

		if (isset($dest_country)) {
			$selectcntryroute = "SELECT country_route FROM tbl_country WHERE country_id=$dest_country";

			if ($selectcntryroute !=false) {
			$exectcntryroute=$Corpoclients->selectCorpoClient($selectcntryroute);
			$findcntryroute=$exectcntryroute->fetch_assoc();
			$country_route = $findcntryroute['country_route'];
			}else{ die(); }

		}else{ echo "country not found"; die(); }



if (!empty($clientId) && !empty($country_route) && !empty($income_or_outgo) && !empty($goods_type) && !empty($unit)) {
	$selectclientprice = "SELECT price FROM tbl_corpo_client_price WHERE corpo_client_id=$clientId AND route_code=$country_route AND income_or_outgo='$income_or_outgo' AND goods_type='$goods_type' AND unit=$unit";


	 if ($selectclientprice !=false) {

	 		$execclientprice=$Corpoclients->selectCorpoClient($selectclientprice);
			if (isset($execclientprice)) {
				$findcorpoprice=$execclientprice->fetch_assoc();
				if (count($findcorpoprice)>0) {
				 echo $clientPrice = $findcorpoprice['price'];
				}else {
					

//IF CLIENT PRICE NOT SETTED THAN IT WILL SEARCH TO THE GENERAL PRICE : STARTS
					// echo $slectgenprice = "SELECT * FROM tbl_route_price WHERE route_code=$country_route AND income_or_outgo='$income_or_outgo' AND goods_type='$goods_type' AND unit=$unit";
					// $execgenprice=$Corpoclients->selectCorpoClient($slectgenprice);
					// if ($execgenprice) {
					// $findgenprice=$execgenprice->fetch_assoc();
					// 	if ($findgenprice) {
					// 	echo  $findgenprice['price'];
					// 	}else{
					// 		echo "NOT FOUND";
					// 	}

					// }else{}
//IF CLIENT PRICE NOT SETTED THAN IT WILL SEARCH TO THE GENERAL PRICE : STARTS






				}

			}else{ }

	 }


}else{ }



}else{}

//FIND THE CUSTOM price OF THIS CLIENT ENDS


if ($_POST['action'] == 'getgenprice') {

$clientId = $_REQUEST['clientId'];
$income_or_outgo = $_REQUEST['income_or_outgo'];
$goods_type = $_REQUEST['goods_type'];
$unit = $_REQUEST['unit'];
$dest_country = $_REQUEST['dest_country'];

		if (isset($dest_country)) {
			$selectcntryroute = "SELECT country_route FROM tbl_country WHERE country_id=$dest_country";

			if ($selectcntryroute !=false) {
			$exectcntryroute=$Corpoclients->selectCorpoClient($selectcntryroute);
			$findcntryroute=$exectcntryroute->fetch_assoc();
			$country_route = $findcntryroute['country_route'];
			}else{ die(); }

		}else{ echo "country not found"; die(); }


					$slectgenprice = "SELECT * FROM tbl_route_price WHERE route_code=$country_route AND income_or_outgo='$income_or_outgo' AND goods_type='$goods_type' AND unit=$unit";
					if ($slectgenprice !=false) {
					$execgenprice=$Corpoclients->selectCorpoClient($slectgenprice);
					if ($execgenprice) {
					$findgenprice=$execgenprice->fetch_assoc();
						if ($findgenprice) {
						echo $findgenprice['price'];
						}else{
							echo "NOT FOUND";
						}

					}else{}
			}


}