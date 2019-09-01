<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database;



if(isset($_POST['agent_limit_update_id_check'])){
    $agent_limit_update_id = $_POST['agent_limit_update_id_check'];
    $agent_mail = $db->getAgentEmail($agent_limit_update_id);
    
    if($agent_limit_update_id != 0){
        
        $checkSQL = "SELECT credit_limit FROM agent_accounts WHERE agent_email='$agent_mail'";
        $checkResult = $db->link->query($checkSQL);
        $checkROW = $checkResult->fetch_row();
        echo $checkROW[0];
    }else{
        echo 'NOT';
    }
}

if(isset($_POST['agent_limit_update_id'])){
    $agent_limit_update_id = $_POST['agent_limit_update_id'];
    $updatelimitamount = (float) $_POST['updatelimitamount'];
    
    $agent_mail = $db->getAgentEmail($agent_limit_update_id);
    
    $received_by = Session::get('adminId');
    
    if($agent_limit_update_id != 0){
        if($updatelimitamount <= 0){
            echo '<div class="alert alert-danger"><strong>Warning!</strong><br> Negetive Value Not Accept!</div>';
        }else{
            $insertLimit = "INSERT INTO agent_client_limit_history (agent_client_email, limit_amount, update_date, update_by) VALUE 
            ('$agent_mail', '$updatelimitamount', NOW(), '$received_by')";
            $resultLimit = $db->link->query($insertLimit);
            if($resultLimit){
                $upLimit = "UPDATE agent_accounts SET credit_limit='$updatelimitamount' WHERE agent_email='$agent_mail'";
                $upLimitResult = $db->link->query($upLimit);

                if($upLimitResult){
                    echo '1';
                }
            }else{
                echo '<div class="alert alert-danger"><strong>Warning!</strong><br> Unknown Error!!!</div>';
            }
        }
        
    }else{
        echo '<div class="alert alert-danger"><strong>Warning!</strong><br> Client Company Not Found!</div>';
    }
}

?>
