<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();



if(isset($_POST['agent_id'])){
    $agent_id = $_POST['agent_id'];
    $get_mail_query = "SELECT email FROM agent_company WHERE id='$agent_id'";
    $get_mail_result = $db->link->query($get_mail_query);
    $get_mail = $get_mail_result->fetch_row();
    $mail = $get_mail[0];
    
    $sql = "SELECT * FROM principals_name";
    $checked = "";
    
    $query = $db->link->query($sql);
    $i = 1;
    while($row = $query->fetch_assoc()){
        $pid = $row['id'];
        $sql_agent = "SELECT * FROM agent_principal WHERE principal_id='$pid' AND agent_email='$mail'";
        $query_agent = $db->link->query($sql_agent);
        if($query_agent->num_rows > 0){
            $checked = "checked";
        }else{
            $checked = "";
        }
        ?>
<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row['principal_name']; ?></td>
    <td class="text-center"><input type="checkbox" class="principal_id" id="pid_<?php echo $pid; ?>" onclick="update_status(event)" <?php echo $checked; ?> ></td>
</tr>
<?php
        $i++;
    }
}

if(isset($_POST['agent_up'])){
    $agent_id = $_POST['agent_up'];
    $get_mail_query = "SELECT email FROM agent_company WHERE id='$agent_id'";
    $get_mail_result = $db->link->query($get_mail_query);
    $get_mail = $get_mail_result->fetch_row();
    $mail = $get_mail[0];
    
    
    $principal_id = $_POST['principal_id'];
    $status = $_POST['status'];
    
    if($status == 'false'){
        $dlt_sql = "DELETE FROM agent_principal WHERE agent_email='$mail' AND principal_id='$principal_id'";
        $dlt_query = $db->link->query($dlt_sql);
        if($dlt_query){
            echo '1';
        }else{
            echo '0';
        }
    }else{
        $insert_sql = "INSERT INTO agent_principal (agent_email, principal_id, status) VALUES ('$mail', '$principal_id', '1')";
        $insert_query = $db->link->query($insert_sql);
        if($insert_query){
            echo '1';
        }else{
            echo '0';
        }
    }
    
    
    
}


if($_POST['agent_status_id']){
    $agent_id = $_POST['agent_status_id'];
    
    $get_sql = "SELECT status FROM agent_company WHERE id='$agent_id'";
    $get_query = $db->link->query($get_sql);
    $get_result = $get_query->fetch_row();
    $result = $get_result[0];
    
    if($result == 0){
        $up_sql = "UPDATE agent_company SET status = '1' WHERE id='$agent_id'";
    }else{
        $up_sql = "UPDATE agent_company SET status = '0' WHERE id='$agent_id'";
    }
    
    $up_query = $db->link->query($up_sql);
    if($up_query){
        echo '1';
    }else{
        echo '0';
    }
}




?>
