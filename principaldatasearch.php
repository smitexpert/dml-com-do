<?php 
require __DIR__."/classes/Courcompanyset.php";
$Courcompanyset = new Courcompanyset();

//GEET ALL COMPANY PRICES,THIS DATA WILL SHOW BY DEFAULT WHEN SEACH PRICE OPTIONS NOT SELECTED

if ($_POST['action'] == 'getallcompprice') {

	$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id order by p.unit ASC";

	if (isset($query)) {
		$selectcourcomp = $Courcompanyset->selectcourComp($query);
		if (count($selectcourcomp)>0) {
			$i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; 

				$data['cour_comp_name']=$getcourcomp['cour_comp_name'];
				$data['route_code']=$getcourcomp['route_code'];
				$data['country_name']=$getcourcomp['country_name'];
				$data['income_or_outgo']=$getcourcomp['income_or_outgo'];
				$data['goods_type']=$getcourcomp['goods_type'];
				$data['unit']=$getcourcomp['unit'];
				$data['price']=$getcourcomp['price'];
		}
		echo json_encode($getcourcomp);

	}}}
		?>