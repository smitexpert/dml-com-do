<?php 
require __DIR__."/classes/Courcompanyset.php";
$Courcompanyset = new Courcompanyset();



if (isset($_POST['exportCsv'])) {

		$selectprinciprice = $_POST['csvdata'];

		if ($selectprinciprice !=false) {
		 		$exectprinciprice=$Courcompanyset->selectcourComp($selectprinciprice);
				if (isset($exectprinciprice)) {


			      header('Content-Type: text/csv; charset=utf-8');  
			      header('Content-Disposition: attachment; filename=menifestedConsignments.csv');  
			      $output = fopen("php://output", "w");  
			      fputcsv($output, array('sender_name', 'recipient_name', 'dest_country', 'income_or_outgo', 'goods_quantity', 'goods_weight', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id', 'track_id'));


					while ($findprinciprice=$exectprinciprice->fetch_assoc()) {
					fputcsv($output, $findprinciprice);
					 // $sender_name = $findprinciprice['sender_name'];
					 // $recipient_name = $findprinciprice['recipient_name'];
					 // $dest_country = $findprinciprice['dest_country'];
					 // $income_or_outgo = $findprinciprice['income_or_outgo'];
					 // $goods_quantity = $findprinciprice['goods_quantity'];
					 // $goods_weight = $findprinciprice['goods_weight'];
					 // $track_id = $findprinciprice['track_id'];

					}
					fclose($output);  

				}else{ 
					header('Location:menifest_cons_srch.php');}
		}else{

		}

}

