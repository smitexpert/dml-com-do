<?php include('includes/header.php'); 
error_reporting(E_ALL);
if (isset($_POST['submit'])) {
    $consignment_booked = $Consignment->bookConsignment($_POST);
}

?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="nav_view" style="display: block;">
                        <ul class="nav nav-pills">
                            <li class="active"><a id="personal" href="#">PERSONAL</a></li>
                            <li><a id="corporate" href="#">CORPORATE</a></li>
                            <li><a id="agent" href="#">AGENT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: PAGE CONTENT-->
            <br>
            <div class="row">
                <div id="personal_body">
                    <form action="" id="personal_consignment_form">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Consignment Booking Form
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Sender Information
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Name <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="sender_name" name="sender_name" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Company <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="sender_company" name="sender_company" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Email <span class="symbol required"></span>
                                                                </label>
                                                                <input type="email" class="form-control" id="sender_mail" name="sender_mail" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Contact <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="sender_contact" name="sender_contact" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Address <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="sender_addr" name="sender_addr" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Country <span class="symbol required"></span>
                                                                </label>
                                                                <!--                                                            <input type="text"  id="sender_country" name="sender_country" required="">-->
                                                                <select class="form-control" name="sender_country" id="sender_country" required>
                                                                    <option value="BD" selected>Bangladesh</option>
                                                                    <option value="IN">India</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Recipient Information
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Name <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_name" name="recipient_name" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Company <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_company" name="recipient_company" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Email <span class="symbol required"></span>
                                                                </label>
                                                                <input type="email" class="form-control" id="recipient_mail" name="recipient_mail" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 1 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr1" name="recipient_addr1" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 2 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr2" name="recipient_addr2" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 3 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr3" name="recipient_addr3" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Phone <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Mobile <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_mobile" name="recipient_mobile" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient City
                                                                </label>
                                                                <input type="textarea" class="form-control" id="recipient_addr" name="recipient_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group connected-group">
                                                                <label class="control-label">Destination Country<span class="symbol required"></span>
                                                                </label>
                                                                <select onchange="get_personal_price()" name="personal_dest_country" id="personal_dest_country" class="form-control selectpicker" data-show-subtext="true" data-validation="required" data-live-search="true">
                                                                    <option value="">--</option>
                                                                    <?php $query2 = "SELECT * FROM tbl_country WHERE status=1";
																	    $selectcnty = $Consignment->selectConsignment($query2);
																	    if ($selectcnty) { while ($getcntry=$selectcnty->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $getcntry['country_tag']; ?>"><?php echo $getcntry['country_name']; ?></option>

                                                                    <?php } }else{} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient ZIP/Postal Code
                                                                </label>
                                                                <input type="textarea" class="form-control" id="recipient_addr" name="recipient_zip">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Goods Informations
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="goods_title">Goods Title</label>
                                                                <input type="text" class="form-control" id="goods_title" name="goods_title" placeholder="Goods Title" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Local Product Code <span class="symbol required"></span>
                                                                </label>
                                                                <select onchange="get_personal_price()" name="personal_goods_type" id="personal_goods_type" class="form-control" required>
                                                                    <option value="">--</option>
                                                                    <option value="P">Parcel</option>
                                                                    <option value="D">Document</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Goods Weight <span class="symbol required"></span>
                                                                </label>
                                                                <select onchange="get_personal_price()" name="personal_goods_weight" id="personal_goods_weight" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" data-validation="required">
                                                                    <option value="">--</option>
                                                                    <?php 
																			$slectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
																				 $execweight =  $Corpoclients->selectCorpoClient($slectweight);
																		if ($execweight) { while ($findweight=$execweight->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $findweight['weight']; ?>"><?php echo $findweight['weight']; ?></option>
                                                                    <?php } }else{} ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Shipment Pieces<span class="symbol required"></span>
                                                                </label>
                                                                <input type="number" class="form-control" name="personal_shimpent_pieces" id="personal_shimpent_pieces" min='1' required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Declared Value/Custom's Value<span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="personal_shimpent_declared_value" id="personal_shimpent_declared_value" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    AWB NO
                                                                </label>
                                                                <input type="text" class="form-control" name="personal_custom_trackId" id="personal_custom_trackId" value="" placeholder="AWB NO">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Tracking ID <span class="symbol required"></span>
                                                                </label>
                                                                <input onclick="get_tracking_id(event)" style="cursor: pointer;" type="text" class="form-control personal_tracking_id" id="personal_tracking_id" name="personal_trackID" value="" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Shipping Charge in USD <span class="symbol required"></span>
                                                                </label>
                                                                <input onkeyup="personal_convert_to_bdt()" onchange="personal_convert_to_bdt()" style="text-align: right;" type="number" step="0.01" class="form-control" name="personal_shipping_charge" id="personal_shipping_charge" required readonly>
                                                                <span id="showgenprice"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                          <div class="form-group">
                                                               <label class="control-label">
                                                                    Assigned To
                                                                </label>
                                                                <select name="assigned_user" id="assigned_user" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                    <option value="">--</option>
                                                                    <?php
                                                                    
                                                                    $sql = "SELECT userId, name FROM user WHERE rule != 1";
                                                                    $query = $db->link->query($sql);
                                                                    
                                                                    if($query->num_rows > 0){
                                                                        while($rows = $query->fetch_assoc()){
                                                                            ?>
                                                                            <option value="<?php echo $rows['userId']; ?>"><?php echo $rows['name']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                    ?>
                                                                </select>
                                                          </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>IN BDT = <span id="personal_bdt"></span></p>
                                                        </div>
                                                        <div class="col-md-6"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-warning btn-block">SUBMIT</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="corporate_body" style="display: none">
                    <form id="corporate_booking_form" action="">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Consignment Booking Form
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Corporate Client Information
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Corporate Company <span class="symbol required"></span>
                                                                </label>
                                                                <select id="corporate_clients" name="corporate_clients" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" onchange="get_corporate_price()">

                                                                    <option value="">Select Corporate Client</option>
                                                                    <?php $query = "SELECT * FROM corporate_clients WHERE status=1 ORDER BY id DESC";
														    $selectCorpoClient = $Corpoclients->selectCorpoClient($query);
														    if ($selectCorpoClient) { while ($getcropoclnt=$selectCorpoClient->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $getcropoclnt['id'];?>"><?php echo $getcropoclnt['company_name'];?></option>
                                                                    <?php } }else{} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Name <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control corporate_sender_name" id="sender_name" name="sender_name" required="" readonly>
                                                                <input type="hidden" name="assign_to" class="corporate_assign_to">
                                                                <input type="hidden" name="sender_company" class="corporate_sender_company">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Email <span class="symbol required"></span>
                                                                </label>
                                                                <input type="email" class="form-control corporate_sender_mail" id="corporate_sender_mail" name="sender_mail" required="" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Contact <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control corporate_sender_contact" id="sender_contact" name="sender_contact" required="" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Address <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control corporate_sender_addr" id="sender_addr" name="sender_addr" required="" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Country <span class="symbol required"></span>
                                                                </label>
                                                                <!--                                                            <input type="text"  id="sender_country" name="sender_country" required="">-->
                                                                <select class="form-control" name="sender_country" id="sender_country" required>
                                                                    <option value="BD" selected>Bangladesh</option>
                                                                    <option value="IN">India</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Recipient Information
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Name <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Company <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_company" name="recipient_company" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Email <span class="symbol required"></span>
                                                                </label>
                                                                <input type="email" class="form-control" id="recipient_mail" name="recipient_mail" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 1 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr1" name="recipient_addr1" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 2 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr2" name="recipient_addr2" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 3 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr3" name="recipient_addr3" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Phone <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Mobile <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_mobile" name="recipient_mobile" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient City
                                                                </label>
                                                                <input type="textarea" class="form-control" id="recipient_addr" name="recipient_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group connected-group">
                                                                <label class="control-label">Destination Country<span class="symbol required"></span>
                                                                </label>
                                                                <select name="dest_country" id="corporate_dest_country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" onchange="get_corporate_price()">
                                                                    <option value="">--</option>
                                                                    <?php $query2 = "SELECT * FROM tbl_country WHERE status=1";
																	    $selectcnty = $Consignment->selectConsignment($query2);
																	    if ($selectcnty) { while ($getcntry=$selectcnty->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $getcntry['country_tag']; ?>"><?php echo $getcntry['country_name']; ?></option>

                                                                    <?php } }else{} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">ZIP/Postal Code <span class="symbol required"></span></label>
                                                                <input type="text" class="form-control" name="recipient_zip" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Goods Informations
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="goods_title">Goods Title</label>
                                                                <input type="text" class="form-control" name="goods_title" id="goods_title" placeholder="Goods Title" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Local Product Code <span class="symbol required"></span>
                                                                </label>
                                                                <select name="goods_type" id="corporate_goods_type" class="form-control" onchange="get_corporate_price()" required>
                                                                    <option value="">--</option>
                                                                    <option value="P">Parcel</option>
                                                                    <option value="D">Document</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Goods Weight <span class="symbol required"></span>
                                                                </label>
                                                                <select name="goods_weight" id="corporate_goods_weight" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" onchange="get_corporate_price()" required>
                                                                    <option value="">--</option>
                                                                    <?php 
																			$slectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
																				 $execweight =  $Corpoclients->selectCorpoClient($slectweight);
																		if ($execweight) { while ($findweight=$execweight->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $findweight['weight']; ?>"><?php echo $findweight['weight']; ?></option>
                                                                    <?php } }else{} ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Shipment Pieces<span class="symbol required"></span>
                                                                </label>
                                                                <input type="number" class="form-control" name="shimpent_pieces" id="shimpent_pieces" min='1' required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Declared Value/Custom's Value<span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="shimpent_declared_value" id="shimpent_declared_value" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    AWB NO <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="custom_trackId" id="custom_trackId" value="" placeholder="AWB NO">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Tracking ID <span class="symbol required"></span>
                                                                </label>
                                                                <input onclick="get_tracking_id(event)" style="cursor: pointer;" type="text" class="form-control corporate_tracking_id" name="trackID" value="" readonly required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Shipping Charge in USD <span class="symbol required"></span>
                                                                </label>
                                                                <input onkeyup="corporate_convert_to_usd()" onchange="corporate_convert_to_usd()" step="0.01" style="text-align: right;" type="number" class="form-control" name="shipping_charge" id="corporate_shipping_charge" readonly required>
                                                                <span id="showgenprice"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p>IN BDT = <span id="corporate_bdt"></span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-warning btn-block">SUBMIT</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="agent_body" style="display: none">
                    <form action="">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Consignment Booking Form
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Agent Information
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Agent Company <span class="symbol required"></span>
                                                                </label>
                                                                <select id="agent_company" name="agent_company" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">

                                                                    <option value="">Select Agent</option>
                                                                    <?php $query = "SELECT * FROM agent_company WHERE status=1 ORDER BY id DESC";
														    $selectCorpoClient = $Corpoclients->selectCorpoClient($query);
														    if ($selectCorpoClient) { while ($getcropoclnt=$selectCorpoClient->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $getcropoclnt['id'];?>"><?php echo $getcropoclnt['company_name'];?></option>
                                                                    <?php } }else{} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Name <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control agent_sender_name" id="sender_name" name="sender_name" required="" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Email <span class="symbol required"></span>
                                                                </label>
                                                                <input type="email" class="form-control agent_sender_mail" id="sender_mail" name="sender_mail" required="" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Contact <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control agent_sender_contact" id="sender_contact" name="sender_contact" required="" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Address <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control agent_sender_addr" id="sender_addr" name="sender_addr" required="" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Country <span class="symbol required"></span>
                                                                </label>
                                                                <!--                                                            <input type="text"  id="sender_country" name="sender_country" required="">-->
                                                                <select class="form-control" name="sender_country" id="sender_country" required>
                                                                    <option value="BD" selected>Bangladesh</option>
                                                                    <option value="IN">India</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Recipient Information
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Name <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_name" name="recipient_name" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Company <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_company" name="recipient_company" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Email <span class="symbol required"></span>
                                                                </label>
                                                                <input type="email" class="form-control" id="recipient_mail" name="recipient_mail" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 1 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr1" name="recipient_addr1" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 2 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr2" name="recipient_addr2" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 3 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr3" name="recipient_addr3" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Phone <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Mobile <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_mobile" name="recipient_mobile" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient City
                                                                </label>
                                                                <input type="textarea" class="form-control" id="recipient_addr" name="recipient_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group connected-group">
                                                                <label class="control-label">Destination Country<span class="symbol required"></span>
                                                                </label>
                                                                <select name="dest_country" id="dest_country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                    <option value="">--</option>
                                                                    <?php $query2 = "SELECT * FROM tbl_country WHERE status=1";
																	    $selectcnty = $Consignment->selectConsignment($query2);
																	    if ($selectcnty) { while ($getcntry=$selectcnty->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $getcntry['country_tag']; ?>"><?php echo $getcntry['country_name']; ?></option>

                                                                    <?php } }else{} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    Goods Informations
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="goods_title">Goods Title</label>
                                                                <input type="text" class="form-control" id="goods_title" placeholder="Goods Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Local Product Code <span class="symbol required"></span>
                                                                </label>
                                                                <select name="goods_type" id="goods_type" class="form-control">
                                                                    <option value="">--</option>
                                                                    <option value="P">Parcel</option>
                                                                    <option value="D">Document</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Goods Weight <span class="symbol required"></span>
                                                                </label>
                                                                <select name="goods_weight" id="goods_weight" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                    <option value="">--</option>
                                                                    <?php 
																			$slectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
																				 $execweight =  $Corpoclients->selectCorpoClient($slectweight);
																		if ($execweight) { while ($findweight=$execweight->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $findweight['weight']; ?>"><?php echo $findweight['weight']; ?></option>
                                                                    <?php } }else{} ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Shipment Pieces<span class="symbol required"></span>
                                                                </label>
                                                                <input type="number" class="form-control" name="shimpent_pieces" id="shimpent_pieces" min='1'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Declared Value/Custom's Value<span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="shimpent_declared_value" id="shimpent_declared_value">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    AWB NO <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="custom_trackId" id="custom_trackId" value="" placeholder="AWB NO">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Select Principal <span class="symbol required"></span>
                                                                </label>
                                                                <select name="agent_principal" id="agent_principal" class="form-control">
                                                                    <option value="">--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Tracking ID <span class="symbol required"></span>
                                                                </label>
                                                                <input onclick="get_tracking_id(event)" style="cursor: pointer;" type="text" class="form-control agent_tracking_id" name="trackID" value="" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Shipping Charge <span class="symbol required"></span>
                                                                </label>
                                                                <input style="text-align: right;" type="text" class="form-control" name="shipping_charge" id="shipping_charge" readonly>
                                                                <span id="showgenprice"></span>
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
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- end: PAGE -->


</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
