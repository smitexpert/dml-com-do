<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();

if(isset($_POST['principal_id'])){
    $principal_id = $_POST['principal_id'];
    
    $sql = "SELECT * FROM accounts WHERE payer_type='principal' AND client_id='$principal_id'";
    
    
    $result = $db->link->query($sql);
    
    ?>
<thead>
    <tr>
        <th style="text-align: center">#</th>
        <th style="text-align: center">Date</th>
        <th style="text-align: center">Reference No.</th>
        <th style="text-align: center">Transaction ID</th>
        <th style="text-align: center">Description</th>
        <th style="text-align: center">Debit</th>
        <th style="text-align: center">Credit</th>
        <th style="text-align: center">Balance</th>
    </tr>

</thead>
<tbody>
<?php
    $balance = 0;
    $i=1;
    while($row = $result->fetch_assoc()){
        
        if($row['transaction_type'] == 0){
            $balance += $row['amount'];
        }else{
            $balance -= $row['amount'];
        }
        
        
        ?>
        

    <tr>
       <th><?php echo $i; ?></th>
        <td><?php echo $row['transaction_date']; ?></td>
        <td><?php echo $row['reference_id']; ?></td>
        <td><?php echo $row['transaction_id']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <?php
        if($row['transaction_type'] == 0){
            ?>
            <td style="text-align: right">00.00</td>
            <td style="text-align: right"><?php echo $row['based'].' '.number_format($row['amount'], 2); ?></td>
            <?php
        }else{
            ?>
            <td style="text-align: right"><?php echo $row['based'].' '.number_format($row['amount'], 2); ?></td>
            <td style="text-align: right">00.00</td>
            <?php
        }
        ?>
        <td style="text-align: right"><?php echo $row['based'].' '.number_format($balance, 2); ?></td>
    </tr>

<?php
        $i++;
    }
    ?>
    
</tbody>
    <?php
}

?>