<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();



if(isset($_POST['create_new_service'])){
    $new_service = $_POST['create_new_service'];
    $new_service = $db->link->real_escape_string($new_service);

    $sql = "INSERT INTO agent_services (service_name, status) VALUES ('$new_service', '1')";
    $query = $db->link->query($sql);
    if($query){
        echo "1";
    }else{
        echo "0";
    }
}

if(isset($_POST['agent_available_service'])){
    $agent_id = $_POST['agent_available_service'];
    $sql = "SELECT * FROM agent_services WHERE NOT EXISTS (SELECT null FROM agent_principal WHERE agent_email=(SELECT email FROM agent_clients WHERE id='$agent_id') AND agent_principal.principal_id=agent_services.id) AND status='1'";
    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        ?>
    <option value="">--</option>
        <?php
        while($rows = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['service_name']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['assign_new_service'])){
    $service_id = $_POST['assign_new_service'];
    $agent_id = $_POST['agent_id'];
    $sql = "INSERT INTO agent_principal(agent_email, principal_id, status) SELECT email, '$service_id', '1' FROM agent_clients WHERE id='$agent_id'";

    $query = $db->link->query($sql);

    if($query){
        echo "1";
    }else{
        echo "0";
    }
}

if(isset($_POST['agent_assigned_service'])){
    $agent_id = $_POST['agent_assigned_service'];

    $sql = "SELECT agent_principal.principal_id, agent_principal.status, agent_services.service_name FROM agent_principal INNER JOIN agent_services ON agent_principal.principal_id = agent_services.id WHERE agent_principal.agent_email=(SELECT email FROM agent_clients WHERE id='$agent_id') AND agent_services.status='1'";

    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <li class="list-group-item"><input onchange="update_service(<?php echo $row['principal_id'] ?>, <?php echo $agent_id; ?>)" type="checkbox" class="" id="<?php echo $row['principal_id'] ?>" <?php if($row['status'] == 1){ echo 'checked'; } ?>> <label for="<?php echo $row['principal_id'] ?>"><?php echo $row['service_name'] ?></label></li>
            <?php
        }
    }
}

if(isset($_POST['agent_update_service'])){
    $service_id = $_POST['agent_update_service'];
    $agent_id = $_POST['agent_id'];

    // $sql = "UPDATE agent_principal SET status=IF(status==1, 0)ELSE(1) WHERE principal_id='$service_id' AND agent_email=(SELECT email from agent_clients WHERE id='$agent_id')";

    
    $sql = "UPDATE agent_principal SET status=CASE
    WHEN status=1 THEN 0
    ELSE 1
    END WHERE principal_id='$service_id' AND agent_email=(SELECT email from agent_clients WHERE id='$agent_id')";

    $query = $db->link->query($sql);

    if($query){
        echo '1';
    }else{
        echo '0';
    }
}

?>