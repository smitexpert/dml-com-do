<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$userId = Session::get('adminId');


$t=time();
$transaction_id = 'DML'.$t;

if(isset($_POST['corporate_selection'])){
    
    $id = $_POST['corporate_selection'];
    $sql = "SELECT * FROM corporate_clients WHERE id='$id'";
    $result = $db->link->query($sql);
    
    $row = $result->fetch_array();
    
    echo json_encode($row);
}
if(isset($_POST['agent_selection_view'])){
    
    $id = $_POST['agent_selection_view'];
    $sql = "SELECT * FROM agent_clients WHERE id='$id'";
    $result = $db->link->query($sql);
    
    $row = $result->fetch_array();
    
    echo json_encode($row);
}



//agent data submission
if(isset($_POST['pay_mode_agent'])){
    print_r($_REQUEST);

    $pay_mode_agent = $_POST['pay_mode_agent'];
    $refferenceno = $_POST['refferenceno'];
    $agent_credit_date = $_POST['agent_credit_date'];
    $agent_name = $_POST['agent_name'];
    $bank_account_no_agent = $_POST['bank_account_no_agent'];
    $bank_name_agent = $_POST['bank_name_agent'];
    $description_agent = $_POST['description_agent'];
    $ammount_agent = $_POST['ammount_agent'];
    $agent_id = $_POST['agent_id'];
    $usd_rate = $_POST['usd_rate'];
    $ammount_agent_usd = $_POST['ammount_agent_usd'];

    //insert into accounts
    $insert_accounts = "INSERT INTO accounts (reference_id, transaction_id,transaction_type,transaction_mode,payer_type,client_name,client_id,amount,based,base_rate,bdt_ammount,bank_aacount_no,bank_name,prepared_by,description, transaction_date,usd_ammount) VALUES('$refferenceno','$transaction_id','1','$pay_mode_agent','agent','$agent_name','$agent_id','$ammount_agent','BDT','1','$ammount_agent','$bank_account_no_agent','$bank_name_agent','$userId','$description_agent','$agent_credit_date','$ammount_agent_usd');UPDATE agent_accounts SET cash_amount = cash_amount + $ammount_agent WHERE agent_email = (SELECT agent_clients.email FROM agent_clients WHERE agent_clients.id = '$agent_id')";

    $result = $db->link->multi_query($insert_accounts);

    echo $result;
    //update agent accounts


    
}

if(isset($_POST['corporate_credit_date'])){
    
    $cd = $_POST['corporate_credit_date'];
    $corporate_credit_date = date("Y-m-d", strtotime($cd));
    $pay_mode_corporate = $_POST['pay_mode_corporate'];
    $refferenceno = $_POST['refferenceno'];
    $client_name = $_POST['client_name'];
    $bank_account_no = $_POST['bank_account_no'];
    $bank_name = $_POST['bank_name'];
    $description = $_POST['description'];
    $ammount = $_POST['ammount'];
    $payer_type = $_POST['payer_type'];
    $client_id = $_POST['client_id'];
    
    $user = Session::get("adminId");
    
    $usd = $db->getCurrency("USD");
    
    $usd_ammount = $ammount/$usd;
    
    $sql = "INSERT INTO accounts (reference_id, transaction_id, transaction_type, transaction_mode, payer_type, client_name, client_id, amount, based, base_rate, bdt_ammount, usd_ammount, bank_aacount_no, bank_name, prepared_by, description, transaction_date) VALUES ('$refferenceno', '$transaction_id', '1', '$pay_mode_corporate', '$payer_type', '$client_name', '$client_id', '$ammount', 'BDT', '1', '$ammount', '$usd_ammount', '$bank_account_no', '$bank_name', '$user', '$description', '$corporate_credit_date')";
    
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
    
    $sql = "INSERT INTO accounts (reference_id, transaction_id, transaction_type, transaction_mode, payer_type, client_name, amount, based, base_rate, bdt_ammount, bank_aacount_no, bank_name, prepared_by, description, transaction_date) VALUES ('$refferenceno', '$transaction_id', '1', '$pay_mode', '$payer_type', '$client_name', '$ammount', 'BDT', '1', '$ammount', '$bank_account_no', '$bank_name', '$user', '$description', '$corporate_credit_date')";
    
    $result = $db->link->query($sql);
    
    if($result){
        echo '1';
    }else{
        echo $db->link->error;
    }
}


?>