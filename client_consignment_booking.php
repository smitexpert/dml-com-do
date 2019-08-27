<?php include('includes/clientheader.php'); 

$client_mail = Session::get('ClientEmail');

$clientQuery = "SELECT * FROM corporate_clients WHERE email='$client_mail'";
$clientResult = $db->link->query($clientQuery);

$clientInfo = $clientResult->fetch_assoc();


?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/client-sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            Consignment Booking Form
                        </div>
                        <div class="panel-body">
                            <form action="" role="form" id="form_cons_booking">
                               <div class="row">
                                   <div class="col-md-12">
                                       <input type="hidden" value="<?php echo $clientInfo['id']; ?>" class="form-control" id="corpo_clients" name="corpo_clients" required>
                                       <input type="hidden" value="<?php echo $clientInfo['name']; ?>" class="form-control" id="sender_name" name="sender_name" required>
                                       <input type="hidden" value="<?php echo $clientInfo['company_name']; ?>" class="form-control" id="sender_company" name="sender_company" required>
                                       <input type="hidden" value="<?php echo $clientInfo['email']; ?>" class="form-control" required id="client_mail" name="sender_email" required>
                                       <input type="hidden" value="<?php echo $clientInfo['contact']; ?>" required class="form-control" name="sender_contact" id="sender_contact">
                                       <input type="hidden" value="<?php echo $clientInfo['address']; ?>" required class="form-control" id="sender_addr" name="sender_addr">
                                   </div>
                               </div>
                                <div class="row">
                                    
                                    <!-- RECIPIEND START -->
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading warning" style="margin-bottom: 12px;">
                                                <i class="fa fa-external-link-square"></i>Recipient Information
                                                <div class="panel-tools"><butotn class="btn btn-xs btn-link"><i class="fa fa-refresh"></i></butotn></div>
                                            </div>
                                            <div class="panel-body borderOrange">

                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Name<span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient_name" name="recipient_name" placeholder="name of the receiver" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Company<span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient_company" name="recipient_company" placeholder="name of the company" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Email <span class="symbol required"></span>
                                                    </label>
                                                    <input class="form-control" type="email" required id="recipient_mail" name="recipient_email" placeholder="example@gmail.com">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Address 1<span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" required class="form-control" id="recipient_addr" name="recipient_addr1">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Address 2
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient_addr" name="recipient_addr2">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Address 3
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient_addr" name="recipient_addr3">
                                                </div>



                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Rec Country Zip Code <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" required class="form-control" id="recipient_zipcode" name="recipient_zipcode">
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Recipient Phone <span class="symbol required"></span>
                                                        </label>
                                                        <input type="text"  class="form-control" name="recipient_phone" id="recipient_phone">
                                                    </div>



                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Recipient Mobile <span class="symbol required"></span>
                                                        </label>
                                                        <input type="text" required class="form-control" id="recipient_mobile" name="recipient_mobile">
                                                    </div>
                                                </div>



                                                <!--
													<div class="form-group">
														<label class="control-label">
															Additional Comments <span class="symbol required"></span>
														</label>
														<input type="textarea" class="form-control" id="addi_comment" name="addi_comment">
													</div>
-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 center-block">
                                        <div class="panel panel-default">
                                            <div class="panel-heading bdOrange">
                                                <i class="fa fa-external-link-square"></i>Goods Information
                                                <div class="panel-tools"><butotn class="btn btn-xs btn-link"><i class="fa fa-refresh"></i></butotn></div>
                                            </div>
                                            <div class="panel-body borderOrange">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Goods Title <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" class="form-control" name="goods_title" id="goods_title" placeholder="Description of Goods" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Recipient City
                                                            </label>
                                                            <input type="textarea" class="form-control" id="recipient_addr" name="recipient_city" placeholder="Destination City" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group connected-group">
                                                            <label class="control-label">Destination Country<span class="symbol required"></span>
                                                            </label>
                                                            <select name="dest_country" id="dest_country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
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
                                                <!-- GENERATE RANDOM UNIQUE TRACK ID -->
                                                <?php
	// $query = "SELECT id FROM tbl_consignment ORDER BY id DESC LIMIT 1";
 	//  $selectCons = $Consignment->selectConsignment($query);
	// $lastId=mysqli_fetch_array($selectCons);
	// $trackid = $randnum=rand().$idlast=$lastId['id'];
	/*include('lib/Traking.php');*/
	//$num =9;
	//$trackid=$num . rand(100000000,888999999);
?>

                                                <div id="findprice">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <!--<div class="col-md-4">
														        <label class="control-label">
                                                                    Where<span class="symbol required"></span>
                                                                </label>
                                                                <select name="income_or_outgo" id="income_or_outgo" class="form-control" required>
                                                                    <option value="outgoing">outgoing</option>
                                                                    <option value="incoming">incoming</option>

                                                                </select>
														    </div>-->
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">
                                                                        Parcel/Document <span class="symbol required"></span>
                                                                    </label>
                                                                    <select name="goods_type" id="goods_type" class="form-control" required>
                                                                        <option value="">--</option>
                                                                        <option value="P">Parcel</option>
                                                                        <option value="D">Document</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">
                                                                        Goods Weight <span class="symbol required"></span>
                                                                    </label>
                                                                    <select name="goods_weight" required id="goods_weight" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
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
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">
                                                                        Shipping Charge <span class="symbol required"></span>
                                                                    </label>
                                                                    <input style="text-align: right;" type="text" class="form-control" name="shipping_charge" id="shipping_charge" required readonly>
                                                                    <span id="showgenprice"></span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <label class="control-label">
                                                                    Shipment Pieces<span class="symbol required"></span>
                                                                </label>
                                                                <input type="number" class="form-control" name="shimpent_pieces" id="shimpent_pieces" min='1' required>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">
                                                                        Value/Custom's Value<span class="symbol required"></span>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="shimpent_declared_value" id="shimpent_declared_value" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">
                                                                        Tracking ID <span class="symbol required"></span>
                                                                    </label>
                                                                    <input style="cursor: pointer;" type="text" required class="form-control" name="trackID" id="trackID" value="" readonly>
                                                                </div>

                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="center-block text-center" id="loader" style="display: none;">
                                                    <span>Data is loading.. please wait for while</span><br>
                                                    <img src="assets/images/dataloader.gif" alt="ddd" width="25">
                                                </div>

                                                <!-- 												<div class="form-group">
														<label class="control-label">
															Goods Quantity
														</label>
														<input type="text" class="form-control" name="goods_quantity" id="goods_quantity">
													</div>
 -->
                                                <div class="form-group">
                                                    <div class="row">

                                                        <div class="col-md-4">
                                                            <!--<div class="form-group">
                                                                <label class="control-label">
                                                                    Shipping Charge <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" required class="form-control" name="consignment_charge" id="consignment_charge">
                                                                <span id="showgenprice"></span>
                                                            </div>-->
                                                        </div>

                                                        <div class="col-md-4">
                                                            <!--<div class="form-group">
                                                                <label class="control-label">
                                                                    Custom's Value <span></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="clientPrice" id="clientPrice" placeholder="">
                                                                <span id="showclientprice"></span>
                                                            </div>-->
                                                        </div>

                                                        <div class="col-md-4">
                                                            <!--<div class="form-group">
                                                                <label class="control-label">
                                                                    Total Charge Amount <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" required class="form-control" name="total_charge" id="total_charge">
                                                            </div>-->
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    AWB NO <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="custom_trackId" id="custom_trackId" value="" placeholder="AWB NO" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <!--<div class="form-group">
                                                    <div class="row">




                                                    </div>
                                                </div>-->


                                                <!--<div class="form-group">
														<label class="control-label">
															Booking Expire date <span class="symbol required"></span>
														</label>
														<input type="text" required class="form-control" name="booking_date_exp" id="booking_date_exp">
													</div>-->



                                                <!--<div class="form-group">
														<label class="control-label">
															Assign to Stuff <span class="symbol required"></span>
														</label>
															<input type="text" class="form-control" id="assign_to_stuff" readonly>														
													</div>-->




                                                <!--<div class="form-group">
														<label class="control-label">
															Booked By <span class="symbol required"></span>
														</label>
															<select name="booked_by" required id="booked_by" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
															<option value="">--</option>
														<?php 
															$selectstuff = "SELECT stuff_id,stuff_name,stuff_role FROM tbl_stuff WHERE stuff_role=2 AND  stuff_status=1";
															//$selectstuff = "SELECT ad.id,userName,role FROM tbl_stuff WHERE stuff_role=4 AND  stuff_status=1";
																 $execstuff =  $Corpoclients->selectCorpoClient($selectstuff);
														if ($execstuff) { while ($findstuff=$execstuff->fetch_assoc()) { ?>
															<option value="<?php echo $findstuff['stuff_id']; ?>"><?php echo $findstuff['stuff_name']; ?></option>
														<?php } }else{ }?>
															</select>														
													</div>	-->




                                                <!--<div class="form-group connected-group">
														<label class="control-label">Consignment Status<span class="symbol required"></span>
														</label>
														<select name="cons_status" id="cons_status" class="form-control" required>
															<option value="">--</option>
															<option value="1">Publish</option>
															<option value="2">Pending</option>
														</select>
													</div>-->



                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- RECIPIENT ENDS -->





                                <!-- Goods part starts -->
                                <div class="row">
                                    <div class="col-md-2"></div>

                                    
                                    <div class="col-md-2"></div>
                                </div>
                                <!-- goods part ends -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group connected-group">
                                            <input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="SUBMIT">
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
            </div>

            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->


</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/clientfooter.php');
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {


        // var corpo_clients = $("#corpo_clients").val();
        // var income_or_outgo = $("#income_or_outgo").val();
        // var sender_name = $("#sender_name").val();
        // var dest_country = $("#dest_country").val();
        // var goods_type = $("#goods_type").val();
        // var goods_weight = $("#goods_weight").val();


        //ACTIVING THE CLIENT DROPDOWN WHEN CORPORATE SELECTED
        $("#sender_type").change(function() {
            event.preventDefault();
            var sender = $("#sender_type").find(":selected").val();
            var element = document.getElementById('cclientara');
            if (sender == 2) {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        });

        $("#sender_corporate").click(function() {
            var element = document.getElementById('cclientara');
            element.style.display = 'block';

            $('#form_cons_booking')[0].reset();
            $("#sender_corporate").prop("checked", true);
        });

        $("#sender_personal").click(function() {
            var element = document.getElementById('cclientara');
            element.style.display = 'none';
            $('#form_cons_booking')[0].reset();
            $("#sender_personal").prop("checked", true);
        });

       





    })

</script>
