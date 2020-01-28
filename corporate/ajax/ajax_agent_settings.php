<?php
include("../../lib/Session.php");
include("../../lib/Database.php");



Session::checkAgentSession();
$t = time();
$transaction_id = 'DML'.$t;

$agent_email = Session::get('agent_email');
$agent_id = Session::get('agent_id');
$db = new Database();

if(isset($_POST['agent_old_pass_check'])){

    $agent_old_pass_check = md5($_POST['agent_old_pass_check']);
    $agent_email = $_POST['agent_email'];
    $new_pass = md5($_POST['new_pass']);
    $confirm_pass = $_POST['confirm_pass'];
    $agent_id = $_POST['agent_id'];

    //get old pass 
    $old_pass = "SELECT password FROM agent_clients WHERE email = '$agent_email' AND id = '$agent_id'";
    $old_pass = $db->link->query($old_pass);

    if($old_pass ->num_rows > 0){
        while($row = $old_pass->fetch_assoc()){
            $old_db_pass = $row['password'];
        }
    }

    if($agent_old_pass_check != $old_db_pass){
        echo 0;
    }else{
        //update password
        $updatePass = "UPDATE agent_clients SET password = '$new_pass' WHERE email = '$agent_email' AND id = '$agent_id'";
        $update = $db->link->query($updatePass);
        
        if($update){
            echo 1;
        }

    }
    // echo $old_db_pass."\n";
    // echo $agent_old_pass_check;

}
?>