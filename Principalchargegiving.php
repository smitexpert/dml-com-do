<?php
// require __DIR__."/classes/Accounts.php";
// $Corpoclients = new Corporateclients();
require_once __DIR__."/lib/Database.php";
$database = new Database();
if ($_POST['action'] == 'Principalchargegiving') {
if(isset($_POST['corp_clientid'])){ $corp_clientid = $_POST['corp_clientid'];}
if(isset($_POST['nameofclient'])){ $nameofclient = $_POST['nameofclient'];}
if(isset($_POST['collection_type'])){ $collection_type = $_POST['collection_type'];}
if(isset($_POST['bank_name'])){ $bank_name = $_POST['bank_name'];}
if(isset($_POST['account_number'])){$account_number=$_POST['account_number'];}
if(isset($_POST['check_number'])){$check_number=$_POST['check_number'];}
if(isset($_POST['collection_date'])){$collection_date=$_POST['collection_date'];}
if(isset($_POST['cash_giver'])){$cash_giver=$_POST['cash_giver'];}
if(isset($_POST['cash_reciever'])){$cash_reciever=$_POST['cash_reciever'];}
if(isset($_POST['collected_amount'])){$collected_amount=$_POST['collected_amount'];}
if(isset($_POST['money_rec_no'])){$money_rec_no=$_POST['money_rec_no'];}
			$query="INSERT INTO tbl_account_principal (client_id,cour_comp_name,amount_collected_by,bank_name,amount_collection,account_number,check_number,cash_given_date,cash_giver,cash_reciever,money_rec_no,entry_date) VALUES ('$corp_clientid','$nameofclient','$collection_type','$bank_name','$collected_amount','$account_number','$check_number','$collection_date','$cash_giver','$cash_reciever','$money_rec_no',NOW())";
				$insres=$database->insert($query);
			if ($insres) {
				$msg="Charge submition successfull";
				echo $msg;
			}else{
				$msg = "Charge submition failed";
				echo $msg;
			}
}
?>