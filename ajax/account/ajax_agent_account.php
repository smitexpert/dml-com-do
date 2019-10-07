<?php

require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$t = time();

$transaction_id = 'DML'.$t;

$logged_user = Session::get('adminId');

if(isset($_POST['agent_credit_limit'])){
    $agent_email = $_POST['agent_credit_limit'];
    $sql = "SELECT * FROM agent_accounts WHERE agent_email='$agent_email'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <tbody>
                <tr>
                    <th>Total Credit</th>
                    <td style="text-align: right"><?php echo number_format($row['cash_amount'], 2); ?> BDT</td>
                </tr>
                <tr>
                    <th>Limit</th>
                    <td style="text-align: right"><?php echo number_format($row['credit_limit'], 2); ?> BDT</td>
                </tr>
                <tr>
                    <th>Total Debit</th>
                    <td style="text-align: right"><?php echo number_format($row['debit_amount'], 2); ?> BDT</td>
                </tr>
                <tr>
                    <th style="text-align: right">Due Limit</th>
                    <td style="text-align: right"><?php echo number_format(($row['cash_amount']+$row['credit_limit'])-$row['debit_amount'], 2); ?> BDT</td>
                </tr>
            </tbody>
            <?php
        }
    }
}

if(isset($_POST['agent_transection'])){
    $agent_email = $_POST['agent_transection'];
    $sql = "SELECT * FROM `accounts` WHERE payer_type='agent' AND client_id = (SELECT agent_clients.id FROM agent_clients WHERE agent_clients.email='$agent_email') ORDER BY id ASC";

    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        $i=0;
        $balance = 0;
        while($row = $query->fetch_assoc()){
            $i++;
            
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['transaction_date']; ?></td>
                <td><?php echo $row['reference_id']; ?></td>
                <td><?php echo $row['transaction_id']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <?php
                    if($row['transaction_type'] == 1){
                        $balance += $row['bdt_ammount'];
                        ?>
                <td><?php echo "0.00 BDT"; ?></td>
                <td><?php echo number_format($row['bdt_ammount'])." BDT"; ?></td>
                        <?php
                    }else{
                        $balance -= $row['bdt_ammount'];
                        ?>
                        <td><?php echo number_format($row['bdt_ammount'])." BDT"; ?></td>
                        <td><?php echo "0.00 BDT"; ?></td>
                        <?php
                    }
                ?>
                <td><?php echo $balance; ?> BDT</td>
            </tr>
            <?php
        }
    }
}

if(isset($_POST['agent_payment'])){
    $agent_email = $_POST['agent_payment'];
    
    $sql = "SELECT * FROM `accounts` WHERE (transaction_mode='cash' OR transaction_mode='cheque') AND payer_type='agent' AND client_id = (SELECT agent_clients.id FROM agent_clients WHERE agent_clients.email='$agent_email') ORDER BY id ASC";

    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        $i=0;
        $balance = 0;
        while($row = $query->fetch_assoc()){
            $i++;
            
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['transaction_date']; ?></td>
                <td><?php echo $row['reference_id']; ?></td>
                <td><?php echo $row['transaction_id']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo number_format($row['amount'], 2); ?> BDT</td>
            </tr>
            <?php
        }
    }

}

if(isset($_POST['agent_balance'])){
    $agent_email = $_POST['agent_balance'];
    
    $sql = "SELECT * FROM agent_accounts WHERE agent_email='$agent_email'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        $row = $query->fetch_assoc();
        ?>
        <tbody>
                <tr>
                    <th>Total Credit</th>
                    <td style="text-align: right"><?php echo number_format($row['cash_amount'], 2); ?> BDT</td>
                </tr>
                <tr>
                    <th>Total Debit</th>
                    <td style="text-align: right"><?php echo number_format($row['debit_amount'], 2); ?> BDT</td>
                </tr>
                <tr>
                    <th style="text-align: right">Due Limit</th>
                    <td style="text-align: right"><?php echo number_format($row['cash_amount'] - $row['debit_amount'], 2); ?> BDT</td>
                </tr>
            </tbody>
        <?php
    }
}

?>