<?php
include("../../lib/Session.php");
include("../../lib/Database.php");



Session::checkAgentSession();
$t = time();
$transaction_id = 'DML'.$t;

$agent_email = Session::get('agent_email');
$agent_id = Session::get('agent_id');
$db = new Database();

if(isset($_POST['agent_email'])){

    $agent_email = $_POST['agent_email'];

    $sql = "SELECT *FROM agent_accounts WHERE agent_email = '$agent_email'";
    
    $result = $db->link->query($sql);
    
    $credit_limit = 0;
    $cash_amount = 0;
    $debit_amount = 0;

    while($row = $result->fetch_assoc()){
        $credit_limit = $row['credit_limit'];
        $cash_amount = $row['cash_amount'];
        $debit_amount = $row['debit_amount'];
    }

    $total = $credit_limit + $cash_amount - $debit_amount; 
    
    
    ?>
<tbody>
    <tr>
        <td style="text-align: left;">Total Credit</td>
        <td style="text-align: right;"><?php echo number_format($cash_amount, 2); ?></td>
    </tr>
    <tr>
        <td style="text-align: left;">Limit</td>
        <td style="text-align: right;"><?php echo number_format($credit_limit, 2); ?></td>
    </tr>
    <tr>
        <td style="text-align: left;">Total Debit</td>
        <td style="text-align: right;"><?php echo number_format($debit_amount, 2); ?></td>
    </tr>
    <tr>
        <th style="text-align: right;">Due Limit</th>
        <th style="text-align: right;"><?php echo number_format($total, 2); ?></th>
    </tr>
</tbody>

<?php
}

if(isset($_POST['agent_email_balance'])){

    $agent_email = $_POST['agent_email_balance'];

    $sql = "SELECT *FROM agent_accounts WHERE agent_email = '$agent_email'";
    
    $result = $db->link->query($sql);
    $cash_amount = 0;
    $debit_amount = 0;

    while($row = $result->fetch_assoc()){
        $cash_amount = $row['cash_amount'];
        $debit_amount = $row['debit_amount'];
    }

    $total = $cash_amount - $debit_amount; 
    
    
    ?>
<tbody>
    <tr>
        <td style="text-align: left;">Total Credit</td>
        <td style="text-align: right;"><?php echo number_format($cash_amount, 2); ?></td>
    </tr>
    
    <tr>
        <td style="text-align: left;">Total Debit</td>
        <td style="text-align: right;"><?php echo number_format($debit_amount, 2); ?></td>
    </tr>
    <tr>
        <th style="text-align: right;">Balance</th>
        <th style="text-align: right;"><?php echo number_format($total, 2); ?></th>
    </tr>
</tbody>

<?php
}
if(isset($_POST['agent_email_transaction'])){

    $agent_email = $_POST['agent_email_transaction'];
    $client_table_id = $_POST['client_table_id'];

    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];

    $sql = "SELECT *FROM accounts WHERE client_id = '$client_table_id' AND payer_type = 'agent'  AND transaction_date BETWEEN '$fromdate' AND '$todate' ORDER BY transaction_date DESC";
    
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
    $i=1;
    $balance = 0;
    while($row = $result->fetch_assoc()){
        ?>
        <tr>
        <td style="text-align: center"><?php echo $i; ?></td>
        <td style="text-align: center"><?php echo $row['transaction_date']; ?></td>
        <td style="text-align: center"><?php echo $row['reference_id']; ?></td>
        <td style="text-align: center"><?php echo $row['transaction_id']; ?></td>
        <td style="text-align: center"><?php echo $row['description']; ?></td>
        <?php 
        if($row['transaction_type'] == '1'){
            $balance = $balance - $row['amount'];
            ?>
            <td style="text-align: right"><?php echo $row['amount']; ?></td>
            <td style="text-align: right"><?php echo "--"; ?></td>
            <?php
        }else{
            $balance = $balance + $row['amount'];
            ?>
            <td style="text-align: right"><?php echo "--"; ?></td>
            <td style="text-align: right"><?php echo $row['amount']; ?></td>
            <?php
            }
            if($balance < 0){
                ?>
                <td style="text-align: right; font-weight:bold; color:red "><?php echo number_format($balance,2); ?></td>
                <?php
            }else{
                ?>
                <td style="text-align: right; font-weight:bold "><?php echo number_format($balance,2); ?></td>
                <?php
            }
        ?>
        
    </tr>
        <?php
        $i++;
    }
    ?>
</tbody>

<?php
}

if(isset($_POST['agent_email_payment'])){

    $agent_email = $_POST['agent_email_payment'];
    $client_table_id = $_POST['client_table_id'];

    $formdate_pay = $_POST['formdate_pay'];
    $todate_pay = $_POST['todate_pay'];

    $sql = "SELECT *FROM accounts WHERE client_id = '$client_table_id' AND payer_type = 'agent' AND transaction_type = '0'  AND transaction_date BETWEEN '$formdate_pay' AND '$todate_pay' ORDER BY transaction_date DESC";
    
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
    $i=1;
    $balance = 0;
    while($row = $result->fetch_assoc()){
        ?>
        <tr>
        <td style="text-align: center"><?php echo $i; ?></td>
        <td style="text-align: center"><?php echo $row['transaction_date']; ?></td>
        <td style="text-align: center"><?php echo $row['reference_id']; ?></td>
        <td style="text-align: center"><?php echo $row['transaction_id']; ?></td>
        <td style="text-align: center"><?php echo $row['description']; ?></td>
        <?php 
        if($row['transaction_type'] == '1'){
            $balance = $balance - $row['amount'];
            ?>
            <td style="text-align: right"><?php echo $row['amount']; ?></td>
            <td style="text-align: right"><?php echo "--"; ?></td>
            <?php
        }else{
            $balance = $balance + $row['amount'];
            ?>
            <td style="text-align: right"><?php echo "--"; ?></td>
            <td style="text-align: right"><?php echo $row['amount']; ?></td>
            <?php
            }
            if($balance < 0){
                ?>
                <td style="text-align: right; font-weight:bold; color:red "><?php echo number_format($balance,2); ?></td>
                <?php
            }else{
                ?>
                <td style="text-align: right; font-weight:bold "><?php echo number_format($balance,2); ?></td>
                <?php
            }
        ?>
        
    </tr>
        <?php
        $i++;
    }
    ?>
</tbody>

<?php
}
?>