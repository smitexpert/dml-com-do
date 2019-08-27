<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();

if(isset($_POST['principal_id'])){
    $principal_id = $_POST['principal_id'];
    
    $sql = "SELECT amount, transaction_type, based FROM accounts WHERE payer_type='corporate' AND client_id = '$principal_id'";
    
    $result = $db->link->query($sql);
    
    $mail = $db->getClientEmail($principal_id);
    
    $sql_limit = "SELECT credit_limit FROM corporate_accounts WHERE corporate_client_email='$mail'";
    $res_limit = $db->link->query($sql_limit);
    $row_limit = $res_limit->fetch_row();
    $limit = $row_limit[0];
    
    $debit = 0;
    $credit = 0;
    
    $based = "";
    $style = "";
    $total = 0;
    
    while($row = $result->fetch_assoc()){
        if($row['transaction_type'] == 1){
            $credit += $row['amount'];
        }else if($row['transaction_type'] == 0){
            $debit += $row['amount'];
        }
        
        $based = $row['based'];
        
        $total = $credit-$debit;
        $total += $limit;
        
        if($total < 0){
            $style = "color: #f00;";
        }
    }
    ?>
<tbody>
    <tr>
        <td style="text-align: left;">Total Credit</td>
        <td style="text-align: right;"><?php echo $based.' '.number_format($credit, 2); ?></td>
    </tr>
    <tr>
        <td style="text-align: left;">Limit</td>
        <td style="text-align: right;"><?php echo $based.' '.number_format($limit, 2); ?></td>
    </tr>
    <tr>
        <td style="text-align: left;">Total Debit</td>
        <td style="text-align: right;"><?php echo $based.' '.number_format($debit, 2); ?></td>
    </tr>
    <tr>
        <th style="text-align: right;">Due Limit</th>
        <th style="text-align: right; <?php echo $style; ?>"><?php echo $based.' '.number_format($total, 2); ?></th>
    </tr>
</tbody>
    <?php
}

?>



