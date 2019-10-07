<?php
include('includes/header.php');
	// if (isset($_POST['submit'])) {
	//    $insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);
	// }
?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <!-- CLIENT PRICE SEARCH PORTION STARTS -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group connected-group" style="margin-left: -20px;">
                                    <label class="control-label" style="font-size: 16px">Select Agent<span class="symbol required"></span>
                                    </label>
                                    <select name="cour_company" required id="cour_company" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                        <option value="">--</option>
                                        <?php
			$selectclientname = "SELECT * FROM agent_clients WHERE status='1'";
				$findclientname =  $db->link->query($selectclientname);
		if ($findclientname->num_rows > 0) { while ($getclientname=$findclientname->fetch_assoc()) { ?>
                                        <option id="cour_comp_name" class="" value="<?php echo $getclientname['email']; ?>"><?php echo $getclientname['company_name']; ?></option>
                                        <!-- <option data-subtext="<?php //echo $getclientname['cour_comp_name']; ?>" class="cl" value="<?php //echo $getclientname['client_id']; ?>"><?php //echo $getclientname['cour_comp_name']; ?></option> -->
                                        <?php } }else{} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br>
                                <div class="nav_view" style="display: none;">
                                    <ul class="nav nav-pills">
                                        <li><a id="overview" href="#">OVERVIEW</a></li>
                                        <li><a id="limit" href="#">LIMIT</a></li>
                                        <li><a id="transection" href="#">TRANSECTION</a></li>
                                        <li><a id="payment" href="#">PAYMENT</a></li>
                                        <li><a id="balance" href="#">BALANCE</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>


            <div id="overviewbody" style="display: none;">
                <div class="row">

                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                Agent's Account
                            </div>
                            <div class="panel-body">

                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning">Today</button>
                                            <button type="button" class="btn btn-warning">Yesterday</button>
                                            <button type="button" class="btn btn-warning">This Week</button>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="box box-red">
                                                    <div class="box-content">
                                                        <h1>0</h1>
                                                    </div>

                                                    <div class="box-footer">
                                                        text text
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box box-purple">
                                                    <div class="box-content">
                                                        <h1>0</h1>
                                                    </div>

                                                    <div class="box-footer">
                                                        text text
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box box-green">
                                                    <div class="box-content">
                                                        <h1>0</h1>
                                                    </div>

                                                    <div class="box-footer">
                                                        text text
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="box box-blue">
                                                    <div class="box-content">
                                                        <h1>0</h1>
                                                    </div>

                                                    <div class="box-footer">
                                                        text text
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box box-orange">
                                                    <div class="box-content">
                                                        <h1>0</h1>
                                                    </div>

                                                    <div class="box-footer">
                                                        text text
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box box-orange">
                                                    <div class="box-content">
                                                        <h1>0</h1>
                                                    </div>

                                                    <div class="box-footer">
                                                        text text
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

            <div id="transectionbody" style="display: none;">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                Agent's Transection
                            </div>
                            <div class="panel-body">

                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="formdate">FROM</label>
                                                            <!--<input type="text" class="form-control hasDatepicker" id="formdate" name="formdate" required>-->
                                                            <input id="formdate" name="formdate" type="text" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="todate">TO</label>
                                                            <!--<input type="text" class="form-control hasDatepicker" id="todate" name="todate" required>-->
                                                            <input id="todate" name="todate" type="text" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <br>
                                                        <div class="gap" style="width: 100%; float: left; margin-top: 5px;"></div>
                                                        <button class="btn btn-warning btn-sm btn-block" disabled>VIEW</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <br>

                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="loading-img" style="display: block;"><img style="margin-top: -30px" src="img/loading.gif" alt=""></div>
                                        <table class="table table-bordered" id="agent_transection_table">
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
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <br>

                                <br>


                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

            <div id="paymentbody" style="display: none;">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                Agent Payments
                            </div>
                            <div class="panel-body">

                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="formdate">FROM</label>
                                                            <!--<input type="text" class="form-control hasDatepicker" id="formdate" name="formdate" required>-->
                                                            <input id="formdate" name="formdate" type="text" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="todate">TO</label>
                                                            <!--<input type="text" class="form-control hasDatepicker" id="todate" name="todate" required>-->
                                                            <input id="todate" name="todate" type="text" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <br>
                                                        <div class="gap" style="width: 100%; float: left; margin-top: 5px;"></div>
                                                        <button class="btn btn-warning btn-sm btn-block" disabled>VIEW</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="loading-img" style="display: block;"><img style="margin-top: -30px" src="img/loading.gif" alt=""></div>
                                        <table class="table table-bordered" id="agent_payment_table">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center">#</th>
                                                    <th style="text-align: center">Date</th>
                                                    <th style="text-align: center">Reference No.</th>
                                                    <th style="text-align: center">Transaction ID</th>
                                                    <th style="text-align: center">Description</th>
                                                    <th style="text-align: center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <br>

                                <br>


                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

            <div id="balancebody" style="display: none;">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                Agent's Balance
                            </div>
                            <div class="panel-body">

                                <br>

                                <div class="row">
                                   <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="loading-img" style="display: block;"><img style="margin-top: -30px" src="img/loading.gif" alt=""></div>
                                        <table class="table table-bordered" id="agent_balance_table">
                                            
                                        </table>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>

                                <br>

                                <br>


                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

            <div id="limitbody" style="display: none;">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                Agent's Limit
                            </div>
                            <div class="panel-body">

                                <br>

                                <div class="row">
                                   <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="loading-img" style="display: block;"><img style="margin-top: -30px" src="img/loading.gif" alt=""></div>
                                        <table class="table table-bordered" id="principal_limit_table">
                                            
                                        </table>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>

                                <br>

                                <br>


                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

            <br><br>

        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
