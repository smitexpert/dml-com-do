<?php 
include('includes/header.php'); 
include('classes/Calculation.php'); 
include('classes/Accountsummery.php'); 

$cal = new Calculation();
$accsum = new Accountsummery();

?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <br>
    <!-- start: PAGE -->
    <div class="main-content">
        <div class="container">
            <!-- start: PAGE HEADER -->
            <div class="row">
                <div class="col-sm-12">

                    <!-- start: PAGE TITLE & BREADCRUMB -->

                    <div class="page-header" style="text-align: center;">
                        <h1 style="font-weight: bold">Accounts At Glance</h1>
                    </div>
                    <!-- end: PAGE TITLE & BREADCRUMB -->
                </div>
            </div>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-sm-8">
                    <form action="" id="accform">
                        <div class="row space12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formdate">FROM</label>
                                    <input id="accmindate" name="accmindate" class="form-control" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="todate">TO</label>
                                    <input id="accmaxdate" name="accmaxdate" class="form-control" type="text" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <br>
                                <div class="gap" style="width: 100%; float: left; margin-top: 5px;"></div>
                                <button class="btn btn-warning btn-sm btn-block">VIEW</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>

            <br>

            <div id="content">
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
                                        <!-- <strong><?php //echo $res['total_consignment'];?></strong> -->

                                        <strong><?php echo $cal->totalConsignment();?></strong>
                                Total Consignment
                                    </div>
                                </li>
                                <li class="col-sm-4">
                                    <div class="sparkline_bar_neutral">
                                        <!-- <span>20,15,18,14,10,12,15,20</span>0% -->
                                        <i class="clip-home-2 circle-icon circle-orange"></i>
                                    </div>
                                    <div class="values">
                                        <strong><?php echo $cal->totalDelivered();  ?></strong>
                                Total Delivered
                                    </div>
                                </li>
                                <li class="col-sm-4">
                                    <div class="sparkline_bar_bad">
                                        <!-- <span>4,6,10,8,12,21,11</span>+50% -->
                                        <i class="clip-banknote circle-icon circle-orange"></i>
                                    </div>
                                    <div class="values">
                                        <strong><?php echo $cal->totalConsignmentsCharge();?></strong>
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
                                        <!-- <span>3,5,9,8,13,11,14</span>+10% -->
                                        <i class="clip-download-3 circle-icon circle-orange"></i>
                                    </div>
                                    <div class="values">
                                        <!-- <strong><?php //echo $res['total_consignment'];?></strong> -->

                                        <strong><?php echo number_format($cal->totalCredit(), 2);?></strong>
                                        Total Credit
                                    </div>
                                </li>
                                <li class="col-sm-4">
                                    <div class="sparkline_bar_neutral">
                                        <!-- <span>20,15,18,14,10,12,15,20</span>0% -->
                                        <i class="clip-upload-3 circle-icon circle-orange"></i>
                                    </div>
                                    <div class="values">
                                        <strong><?php echo number_format($cal->totalDebit(), 2);?></strong>
                                        Total Debit
                                    </div>
                                </li>
                                <li class="col-sm-4">
                                    <div class="sparkline_bar_bad">
                                        <!-- <span>4,6,10,8,12,21,11</span>+50% -->
                                        <i class="clip-user-2 circle-icon circle-orange"></i>
                                    </div>
                                    <div class="values">
                                        <strong><?php echo number_format($cal->totalProfit(), 2);  ?></strong>
                                        Total Profit
                                    </div>
                                </li>
                            </ul>




                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <hr>


            <!-- SUMMERY PORTION END -->




            <br><br><br>




            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
