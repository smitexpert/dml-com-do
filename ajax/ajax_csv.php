<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();





if(isset($_POST['minformdate'])){
    $minformdate = $_POST['minformdate'];
    $mintodate = $_POST['mintodate'];
    $principal_id = $_POST['principal_id'];
    
    $minformdate = date('Y-m-d', strtotime($minformdate));
    $mintodate = date('Y-m-d', strtotime($mintodate));
    
    /*$sql = "SELECT * FROM consignment_booked WHERE principal_id='$principal_id' AND date >= '$minformdate' AND date <= '$mintodate'";*/
    $sql = "SELECT * FROM consignment_booked WHERE principal_id='$principal_id' AND assigned_date BETWEEN '$minformdate' AND '$mintodate' AND status='0'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        ?>
<style>
    .total {
        width: 100%;
        text-align: center;
        padding: 8px 0;
        display: block;
        background-color: #f0ad4e;
        color: #fff;
        font-weight: bold;
        border-radius: 3px;
    }
    
    th, td {
        text-align: center;
    }

</style>
<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-2">
        <p class="total">Total: <?php echo $query->num_rows; ?></p>
    </div>
    <div class="col-md-2">
        <form action="print_csv.php" target="_blank" method="POST">
           <input type="hidden" name="principal_id" value="<?php echo $principal_id; ?>">
           <input type="hidden" name="fromdate" value="<?php echo $minformdate; ?>">
           <input type="hidden" name="todate" value="<?php echo $mintodate; ?>">
            <button type="submit" class="btn btn-warning btn-md btn-block">CREATE CSV</button>
        </form>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tracking ID</th>
            <th>Costing</th>
            <th>Booking Price</th>
            <th>Assigned Date</th>
        </tr>
    </thead>
    <tbody>

        <?php
        while($row = $query->fetch_assoc()){
            ?>

        <tr>
            <td><?php echo $row['tracking_id']; ?></td>
            <td><?php echo $row['costing']; ?></td>
            <td><?php echo $row['booking_price']; ?></td>
            <td><?php echo $row['assigned_date']; ?></td>
        </tr>

        <?php
        }
        ?>

    </tbody>
</table>
<?php
    }else{
        echo "0";
    }
}




?>
