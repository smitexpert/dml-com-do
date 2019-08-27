<?php 
//error_reporting(E_ALL);
require __DIR__."/classes/Priceset.php";
$Priceset = new Priceset();
if ($_POST['action'] == 'getgenpr') {


 $route = $_REQUEST['route'];
 $income_or_outgo = $_REQUEST['income_or_outgo'];
 $goods_type = $_REQUEST['goods_type'];
 $unit = $_REQUEST['unit'];


 if (!empty($route) && !empty($income_or_outgo) && !empty($goods_type) && !empty($unit)) {

	$slectgenprice = "SELECT * FROM tbl_route_price WHERE route_code=$route AND income_or_outgo='$income_or_outgo' AND goods_type='$goods_type' AND unit=$unit";

	$execgenprice=$Priceset->selectRoute($slectgenprice);
	if ($execgenprice) {

		$findgenprice=$execgenprice->fetch_assoc();

		if ($findgenprice) {
		echo  $findgenprice['price'];
		}else{
			echo "error";
		}

	}else{}


}





 }
