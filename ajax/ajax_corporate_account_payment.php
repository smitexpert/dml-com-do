<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();

if(isset($_POST['principal_id'])){
    $principal_id = $_POST['principal_id'];
    
   /* $sqli = "SELECT * FROM `accounts` WHERE payer_type='corporate' AND client_id='3' AND transaction_type='1' ORDER BY id DESC LIMIT 10";*/
    
    $sql = "SELECT * FROM ( SELECT * FROM accounts WHERE payer_type='corporate' AND client_id='$principal_id' AND transaction_type='1' ORDER BY id DESC LIMIT 10 ) sub ORDER BY id ASC";
    
    
    $result = $db->link->query($sql);
    ?>
<thead>
    <tr>
        <th style="text-align: center">#</th>
        <th style="text-align: center">Date</th>
        <th style="text-align: center">Transaction ID</th>
        <th style="text-align: center">Reference No.</th>
        <th style="text-align: center">Description</th>
        <th style="text-align: center">Amount</th>
        <th style="text-align: center">Balance</th>
    </tr>

</thead>
<?php
    $i=1;
    $balance = 0;
    while($row = $result->fetch_assoc()){
        $balance+=$row['amount'];
        ?>
        
<tbody>
    <tr>
        <th><?php echo $i; ?></th>
        <td><?php echo $row['transaction_date']; ?></td>
        <td><?php echo $row['transaction_id']; ?></td>
        <td><?php echo $row['reference_id']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td style="text-align: right"><?php echo $row['based'].' '.number_format($row['amount'], 2); ?></td>
        <td style="text-align: right"><?php echo $row['based'].' '.number_format($balance, 2); ?></td>
    </tr>
</tbody>

<?php
        $i++;
    }
}

?>





