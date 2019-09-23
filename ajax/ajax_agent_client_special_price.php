<?php

require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();

if(isset($_POST['get_agent_principals'])){
    $agent_mail = $_POST['get_agent_principals'];
    
    $sql = "SELECT principals_name.principal_name, principals_name.id FROM principals_name INNER JOIN agent_principal ON agent_principal.principal_id = principals_name.id WHERE agent_principal.agent_email = '$agent_mail' ORDER BY principals_name.id";
    
    $query = $db->link->query($sql);
    
    ?>
    <option value="">--</option>
    <?php
    
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['principal_name']; ?></option>
            <?php
        }
    }
}

?>