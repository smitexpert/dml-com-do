<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();

if(isset($_POST['principals'])){
    $principals = $_POST['principals'];
    $minformdate = $_POST['minformdate'];
    $mintodate = $_POST['mintodate'];
    
    $minformdate = date('Y-m-d', strtotime($minformdate));
    $mintodate = date('Y-m-d', strtotime($mintodate . "+1 day"));
    
    
    for($i=0; $i<count($principals); $i++){
        $query = "SELECT * FROM consignment_booked WHERE principal_id = '$principals[$i]' AND date BETWEEN '$minformdate' AND '$mintodate' AND status = '1'";
        $result = $db->link->query($query);
        
        
    
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['tracking_id']; ?></td>
                    <td><?php echo $db->getConsignmentWeight($row['tracking_id']); ?></td>
                    <td><?php echo $row['costing']; ?></td>
                    <td><?php echo $row['booking_price']; ?></td>
                    <td><?php echo $db->getPrincipalName($row['principal_id']); ?></td>
                </tr>
                <?php
            }
        }
    }
    
}

?>
