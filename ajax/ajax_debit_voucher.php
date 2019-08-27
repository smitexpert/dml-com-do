<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();

$t=time();
$transaction_id = 'DML'.$t;

if(isset($_POST['corporate_selection'])){
    
    $id = $_POST['corporate_selection'];
    $sql = "SELECT principals_name.id, principals_name.principal_name, principals_name.currency, currency.currency_rate FROM principals_name INNER JOIN currency ON principals_name.currency = currency.currency_name WHERE principals_name.id='$id'";
    $result = $db->link->query($sql);
    
    $row = $result->fetch_array();
    
    echo json_encode($row);
}

if(isset($_POST['corporate_credit_date'])){
    
    $cd = $_POST['corporate_credit_date'];
    $corporate_credit_date = date("Y-m-d", strtotime($cd));
    $pay_mode = $_POST['pay_mode'];
    $refferenceno = $_POST['refferenceno'];
    $client_name = $_POST['client_name'];
    $bank_account_no = $_POST['bank_account_no'];
    $bank_name = $_POST['bank_name'];
    $description = $_POST['description'];
    $ammount = $_POST['ammount'];
    $based = $_POST['based'];
    $rate = $_POST['rate'];
    $bdt = $ammount*$rate;
    $payer_type = $_POST['payer_type'];
    $client_id = $_POST['client_id'];
    
    $user = Session::get("adminId");
    
    $sql = "INSERT INTO accounts (reference_id, transaction_id, transaction_type, transaction_mode, payer_type, client_name, client_id, amount, based, base_rate, bdt_ammount, bank_aacount_no, bank_name, prepared_by, description, transaction_date) VALUES ('$refferenceno', '$transaction_id', '0', '$pay_mode', '$payer_type', '$client_name', '$client_id', '$ammount', '$based', '$rate', '$bdt', '$bank_account_no', '$bank_name', '$user', '$description', '$corporate_credit_date')";
    
    $result = $db->link->query($sql);
    
    if($result){
        echo '1';
    }else{
        echo $db->link->error;
    }
}

if(isset($_POST['personal_credit_date'])){
    
    $corporate_credit_date = $_POST['personal_credit_date'];
    $pay_mode = $_POST['pay_mode'];
    $refferenceno = $_POST['refferenceno'];
    $client_name = $_POST['client_name'];
    $bank_account_no = $_POST['bank_account_no_p'];
    $bank_name = $_POST['bank_name_p'];
    $description = $_POST['description'];
    $ammount = $_POST['ammount'];
    $payer_type = $_POST['payer_type'];
    
    $user = Session::get("adminId");
    
    $sql = "INSERT INTO accounts (reference_id, transaction_id, transaction_type, transaction_mode, payer_type, client_name, amount, based, base_rate, bdt_ammount, bank_aacount_no, bank_name, prepared_by, description, transaction_date) VALUES ('$refferenceno', '$transaction_id', '0', '$pay_mode', '$payer_type', '$client_name', '$ammount', 'BDT', '1', '$ammount', '$bank_account_no', '$bank_name', '$user', '$description', '$corporate_credit_date')";
    
    $result = $db->link->query($sql);
    
    if($result){
        echo '1';
    }else{
        echo $db->link->error;
    }
}


?>