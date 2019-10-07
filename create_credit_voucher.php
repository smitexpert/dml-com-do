<?php 
include('includes/header.php'); 

//select rate from rate table
$get_rate = "SELECT *FROM currency WHERE currency_name = 'USD'";
$get = $db->link->query($get_rate);

$rate = $get->fetch_row();

$rate_usd = $rate[2];

?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- end: PAGE HEADER -->
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <br>
                                <div class="nav_view" style="display: block;">
                                    <ul class="nav nav-pills">
                                        <li><a id="AGENT" href="#">AGENT</a></li>
                                        <li><a id="CORPORATE" href="#">CORPORATE CLIENT</a></li>
                                        <li><a id="PERSONAL" href="#">PERSONAL</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="viewarea">
                                <div class="viewsec" id="AGENTVIEW" style="display: none;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-external-link-square"></i>
                                            Agent Payment Window
                                        </div>
                                        <div class="panel-body">

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="agent_selection" id="agent_selection" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                        <option value="">--</option>
                                                        <?php
                                                        
                                                        $sql = "SELECT * FROM agent_clients WHERE status = '1'";
                                                        $result = $db->link->query($sql);
                                                        
                                                        if($result->num_rows > 0){
                                                            while($row = $result->fetch_assoc()){
                                                                ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="agent_form_view" style="display: none;">
                                                        <br>
                                                        <br>
                                                            <form action="" id="agent_form">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group" id="pay_mode_agent">
                                                                       <label for="">Payment Mode:</label><br>
                                                                        <label class="radio-inline"><input class="radio_agent" type="radio" name="pay_mode_agent" value="cash" checked>Cash</label>
                                                                        <label class="radio-inline"><input class="radio_agent" type="radio" name="pay_mode_agent" value="cheque">Cheque</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Refference No:</label>
                                                                        <input type="text" class="form-control" name="refferenceno" id="refferenceno" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Date:</label>
                                                                        <input type="text" class="form-control" name="agent_credit_date" id="agent_credit_date" value="<?php echo date("Y-m-d"); ?>"  required>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Agent Name:</label>
                                                                        <input type="text" class="form-control" name="agent_name" id="agent_name" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Bank Account No:</label>
                                                                        <input type="text" class="form-control" name="bank_account_no_agent" id="bank_account_no_agent" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Bank Name:</label>
                                                                        <input type="text" class="form-control" name="bank_name_agent" id="bank_name_agent" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Descirption:</label>
                                                                        <input type="text" class="form-control" name="description_agent" id="description_agent">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Amount(BDT):</label>
                                                                        <input onkeyup="bdtToUsd(event)" type="number" step="any" class="form-control" name="ammount_agent" id="ammount_agent" min="0"  required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Amount(USD):</label>
                                                                        <input onkeyup="usdToBdt(event)" type="number" step="any" class="form-control" name="ammount_agent_usd" id="ammount_agent_usd" min="0"  required>
                                                                    </div>
                                                                </div>
                                                                    
                                                                        <input type="hidden" class="form-control" name="based" id="based" min="0" value="BDT">
                                                                        <input type="hidden" class="form-control" name="usd_rate" id="usd_rate" value="<?php echo  $rate_usd; ?>">
                                                                <div class="col-md-4">
                                                                    <br>
                                                                    <input type="hidden" name="payer_type" value="agent">
                                                                    <input type="hidden" name="agent_id" id="agent_id">
                                                                    <button class="btn btn-warning btn-block">SUBMIT</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="viewsec" id="CORPORATEVIEW" style="display: none;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-external-link-square"></i>
                                            Corporate Payment Window
                                        </div>
                                        <div class="panel-body">

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="corporate_selection" id="corporate_selection" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                        <option value="">--</option>
                                                        <?php
                                                        
                                                        $sql = "SELECT * FROM corporate_clients WHERE status = '1'";
                                                        $result = $db->link->query($sql);
                                                        
                                                        if($result->num_rows > 0){
                                                            while($row = $result->fetch_assoc()){
                                                                ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="corporate_form_view" style="display: none;">
                                                        <br>
                                                        <br>
                                                            <form action="" id="corporate_form">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group" id="pay_mode">
                                                                       <label for="">Payment Mode:</label><br>
                                                                        <label class="radio-inline"><input id="radio_cash" type="radio" name="pay_mode_corporate" value="cash" checked>Cash</label>
                                                                        <label class="radio-inline"><input id="radio_check" type="radio" name="pay_mode_corporate" value="check">Cheque</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Refference No:</label>
                                                                        <input type="text" class="form-control" name="refferenceno" id="refferenceno" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Date:</label>
                                                                        <input type="text" class="form-control" name="corporate_credit_date" id="corporate_credit_date" value="<?php echo date("Y-m-d"); ?>"  required>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Corporate Client Name:</label>
                                                                        <input type="text" class="form-control" name="client_name" id="client_name" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Bank Account No:</label>
                                                                        <input type="text" class="form-control" name="bank_account_no" id="bank_account_no" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Bank Name:</label>
                                                                        <input type="text" class="form-control" name="bank_name" id="bank_name" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Descirption:</label>
                                                                        <input type="text" class="form-control" name="description" id="description"  required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Ammount:</label>
                                                                        <input type="number" step="any" class="form-control" name="ammount" id="ammount" min="0"  required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="">Based:</label>
                                                                        <input type="text" class="form-control" name="based" id="based" min="0" value="BDT"  readonly>
                                                                    </div>
                                                                <div class="col-md-4">
                                                                    <br>
                                                                    <input type="hidden" name="payer_type" value="corporate">
                                                                    <input type="hidden" name="client_id" id="client_id">
                                                                    <button class="btn btn-warning btn-block">SUBMIT</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="viewsec" id="PERSONALVIEW" style="display: none;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-external-link-square"></i>
                                            Personal Payment Window
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="personal_form_view">
                                                        <form action="" id="porsonal_form">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group" id="pay_mode_p">
                                                                       <label for="">Payment Mode:</label><br>
                                                                        <label class="radio-inline"><input id="radio_cash" type="radio" name="pay_mode" value="cash" checked>Cash</label>
                                                                        <label class="radio-inline"><input id="radio_check" type="radio" name="pay_mode" value="check">Cheque</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Refference No:</label>
                                                                        <input type="text" class="form-control" name="refferenceno" id="refferenceno_p" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Date:</label>
                                                                        <input type="text" class="form-control" name="personal_credit_date" id="personal_credit_date" value="<?php echo date("m-d-Y"); ?>" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Client Name:</label>
                                                                        <input type="text" class="form-control" name="client_name" id="client_name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Bank Account No:</label>
                                                                        <input type="text" class="form-control" name="bank_account_no_p" id="bank_account_no_p" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Bank Name:</label>
                                                                        <input type="text" class="form-control" name="bank_name_p" id="bank_name_p" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Descirption:</label>
                                                                        <input type="text" class="form-control" name="description" id="description" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Ammount:</label>
                                                                        <input type="number" step="any" class="form-control" name="ammount" id="ammount" min="0" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="">Based:</label>
                                                                        <input type="text" class="form-control" name="based" id="based" min="0" value="BDT"  readonly>
                                                                    </div>
                                                                <div class="col-md-4">
                                                                    
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <br>
                                                                    <input type="hidden" name="payer_type" value="personal">
                                                                    <button class="btn btn-warning btn-block">SUBMIT</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-1"></div>
            </div>

            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->


</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
