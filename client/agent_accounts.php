<?php 
include('header.php'); 


?>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="nav_view">
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
            <BR>
            <input type="hidden" name="agent_email" id="agent_email" value="<?php echo $agent_email; ?>">
            <input type="hidden" name="agent_id" id="agent_id" value="<?php echo $agent_id; ?>">
            <input type="hidden" name="agent_id" id="client_table_id" value="<?php echo $id; ?>">
            <!-- end main tab bar code -->
            <div class="row">
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
                                    <div class="col-md-8">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning">Today</button>
                                            <button type="button" class="btn btn-warning">Yesterday</button>
                                            <button type="button" class="btn btn-warning">This Week</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="getdate" name="getdate">
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
                                                            <input id="formdate" name="formdate" onchange="dateField(event);" class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="todate">TO</label>
                                                            <!--<input type="text" class="form-control hasDatepicker" id="todate" name="todate" required>-->
                                                            <input onchange="dateField(event);" id="todate" name="todate" type="text" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <br>
                                                        <div class="gap" style="width: 100%; float: left; margin-top: 3px;margin-left:1px"></div>
                                                        <button class="btn btn-warning btn-sm btn-block" id="view_button" disabled>VIEW</button>
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
                                        <div class="loading-img" style="display: none;"><img style="margin-top: -30px" src="img/loading.gif" alt=""></div>
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
                                                            <input onchange="fromDatePay(event)" id="formdate_pay" name="formdate_pay" class="form-control" type="text" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="todate">TO</label>
                                                            <!--<input type="text" class="form-control hasDatepicker" id="todate" name="todate" required>-->
                                                            <input  onchange="fromDatePay(event)" id="todate_pay" name="todate_pay" type="text" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <br>
                                                        <div class="gap" style="width: 100%; float: left; margin-top: 3px;"></div>
                                                        <button class="btn btn-warning btn-sm btn-block" id="payment_view" disabled>VIEW</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="loading-img" style="display: none;"><img style="margin-top: -30px" src="img/loading.gif" alt=""></div>
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
                                        <table class="table table-bordered" id="agent_limit_table">
                                            
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
            </div>
            <!-- End View Consignment Area -->
        </div>
    </div>

<?php 
include('footer.php');
?>
