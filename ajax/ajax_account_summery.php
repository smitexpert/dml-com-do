<?php
require '../lib/Session.php';
require "../lib/Database.php";
include('../classes/Accountsummery.php');


Session::checkSession();

$db = new Database();


$cal = new Accountsummery();

if(isset($_POST['accmaxdate'])){
    
    $accmindate = $_POST['accmindate'];
    $accmaxdate = $_POST['accmaxdate'];
    
    
    ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-sm-8">
        <div class="row space12">


            <ul class="mini-stats col-sm-12">
                <li class="col-sm-4">
                    <div class="sparkline_bar_good">
                        <!-- <span>3,5,9,8,13,11,14</span>+10% -->
                        <i class="clip-cube circle-icon circle-orange"></i>
                    </div>
                    <div class="values">
                        <strong><?php echo $cal->totalConsignment($accmindate, $accmaxdate);?></strong>
                        Total Consignment
                    </div>
                </li>
                <li class="col-sm-4">
                    <div class="sparkline_bar_neutral">
                        <i class="clip-home-2 circle-icon circle-orange"></i>
                    </div>
                    <div class="values">
                        <strong><?php echo $cal->totalDelivered($accmindate, $accmaxdate);  ?></strong>
                        Total Delivered
                    </div>
                </li>
                <li class="col-sm-4">
                    <div class="sparkline_bar_bad">
                        <i class="clip-banknote circle-icon circle-orange"></i>
                    </div>
                    <div class="values">
                        <strong><?php echo $cal->totalConsignmentsCharge($accmindate, $accmaxdate);?></strong>
                        Total Consignments Charge
                    </div>
                </li>
            </ul>




        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<hr>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-sm-8">
        <div class="row space12">


            <ul class="mini-stats col-sm-12">
                <li class="col-sm-4">
                    <div class="sparkline_bar_good">
                        <i class="clip-download-3 circle-icon circle-orange"></i>
                    </div>
                    <div class="values">
                        <strong><?php echo $cal->totalCredit($accmindate, $accmaxdate);?></strong>
                        Total Credit
                    </div>
                </li>
                <li class="col-sm-4">
                    <div class="sparkline_bar_neutral">
                        <i class="clip-upload-3 circle-icon circle-orange"></i>
                    </div>
                    <div class="values">
                        <strong><?php echo $cal->totalDebit($accmindate, $accmaxdate);?></strong>
                        Total Debit
                    </div>
                </li>
                <li class="col-sm-4">
                    <div class="sparkline_bar_bad">
                        <i class="clip-user-2 circle-icon circle-orange"></i>
                    </div>
                    <div class="values">
                        <strong><?php echo $cal->totalProfit($accmindate, $accmaxdate);  ?></strong>
                        Total Profit
                    </div>
                </li>
            </ul>




        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<?php
}

?>
