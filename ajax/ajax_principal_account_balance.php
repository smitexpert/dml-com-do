<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();

if(isset($_POST['principal_id'])){
    $principal_id = $_POST['principal_id'];
    
    $sql = "SELECT amount, transaction_type, based FROM accounts WHERE payer_type='principal' AND client_id = '$principal_id'";
    
    $result = $db->link->query($sql);
    
    $debit = 0;
    $credit = 0;
    
    $based = "";
    
    while($row = $result->fetch_assoc()){
        if($row['transaction_type'] == 0){
            $credit += $row['amount'];
        }else if($row['transaction_type'] == 1){
            $debit += $row['amount'];
        }
        
        $based = $row['based'];
    }
    ?>
<tbody>
    <tr>
        <td style="text-align: left;">Total Credit</td>
        <td style="text-align: right;"><?php echo $based.' '.number_format($credit, 2); ?></td>
    </tr>
    <tr>
        <td style="text-align: left;">Total Debit</td>
        <td style="text-align: right;"><?php echo $based.' '.number_format($debit, 2); ?></td>
    </tr>
    <tr>
        <th style="text-align: right;">Balance</th>
        <th style="text-align: right;"><?php echo $based.' '.number_format($credit-$debit, 2); ?></th>
    </tr>
</tbody>
    <?php
}

?>



