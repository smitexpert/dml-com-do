<?php include('includes/extra-page-header.php');


if(Session::get('role') != 1){
    
    $getUrl = '/consignment_list.php';

    $usrMenuId = Session::get('adminId');

    $countMenu = "SELECT COUNT(id) FROM menu_$usrMenuId";

    $tmr = $db->link->query($countMenu);

    $row_menu = $tmr->fetch_row();

    $menuSession = Session::get('menus');

    $isUrlActive = false;

    for($i=0; $i<$row_menu[0]; $i++){
        $menuUrl = '/'.$menuSession[$i];
        if( $menuUrl == $getUrl ){
            $isUrlActive = true;
        }
    }

    if($getUrl != '/dashboard.php'){
        if($isUrlActive != true){
            header("location: dashboard.php");
        }
    }
}




if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM consignment_booking WHERE id='$id'";
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        $row = $query->fetch_assoc();
    }else{
        header("location: consignment_list.php");
    }
    
}else{
    header("location: consignment_list.php");
}


if(isset($_POST['trackID'])){
    
    $trackID = $_POST['trackID'];
    
    $recipient_name = $_POST['recipient_name'];
    $recipient_company = $_POST['recipient_company'];
    $recipient_mail = $_POST['recipient_email'];
    $recipient_addr1 = $_POST['recipient_addr1'];
    $recipient_addr2 = $_POST['recipient_addr2'];
    $recipient_addr3 = $_POST['recipient_addr3'];
    $recipient_zipcode = $_POST['recipient_zipcode'];
    $recipient_phone = $_POST['recipient_phone'];
    $recipient_mobile = $_POST['recipient_mobile'];
    
    $goods_title = $_POST['goods_title'];
    $recipient_city = $_POST['recipient_city'];
    $dest_country = $_POST['dest_country'];
    $goods_type = $_POST['goods_type'];
    $goods_weight = $_POST['goods_weight'];
    $shipping_charge = $_POST['shipping_charge'];
    $shimpent_pieces = $_POST['shimpent_pieces'];
    $shimpent_declared_value = $_POST['shimpent_declared_value'];
    $custom_trackId = $_POST['custom_trackId'];
    
    $upBy = Session::get("adminId");
    
    
    
    $upSql = "UPDATE consignment_booking SET awb_no='$custom_trackId', r_name='$recipient_name', r_company='$recipient_company', r_email='$recipient_mail', r_address1='$recipient_addr1', r_address2='$recipient_addr2', r_address3='$recipient_addr3', r_zip='$recipient_zipcode', r_phone='$recipient_phone', r_mobile='$recipient_mobile', r_city='$recipient_city', r_country='$dest_country', g_title='$goods_title', g_type='$goods_type', g_weight='$goods_weight', g_pieces='$shimpent_pieces', g_customs_value='$shimpent_declared_value', g_shipment_charge='$shipping_charge', submited_by='$upBy' WHERE tracking_id='$trackID'";
    $update = $db->link->query($upSql);
    
    if($update){
        header("location: consignment_list.php");
    }
    
    
    
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
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            Consignment Booking Update
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']."?id=".$row['id']; ?>" role="form" id="update_cons_booking" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="errorHandler alert alert-danger no-display">
                                            <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                        </div>
                                        <div class="successHandler alert alert-success no-display">
                                            <i class="fa fa-ok"></i> Your form validation is successful!
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading bdOrange">
                                                <i class="fa fa-external-link-square"></i>Sender Information
                                                <div class="panel-tools">
                                                    <butotn class="btn btn-xs btn-link"><i class="fa fa-refresh"></i></butotn>
                                                </div>
                                            </div>
                                            <div class="panel-body borderOrange">


                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Sender Name<span class="symbol required"></span>
                                                    </label>
                                                    <input type="hidden" value="<?php echo $row['s_type']; ?>" name="s_type" id="s_type">
                                                    <input type="hidden" value="<?php echo $row['client_Id']; ?>" name="client_Id" id="client_Id">
                                                    <input type="text" class="form-control" id="sender_name" name="sender_name" value="<?php echo $row['s_name']; ?>" readonly>
                                                    <!--<input type="hidden" class="form-control" id="sender_id" name="sender_id">-->

                                                </div>




                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Sender Company
                                                    </label>
                                                    <input type="text" class="form-control" id="sender_company" name="sender_company" value="<?php echo $row['s_company']; ?>" readonly>
                                                </div>



                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Sender Email <span class="symbol required"></span>
                                                    </label>
                                                    <input class="form-control" type="email" required id="client_mail" name="sender_email" value="<?php echo $row['s_email']; ?>" readonly>
                                                </div>



                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Sender Contact <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" name="sender_contact" id="sender_contact" value="<?php echo $row['s_contact']; ?>" readonly>
                                                </div>


                                                <div class="form-group connected-group">
                                                    <label class="control-label">Sender Country<span class="symbol required"></span>
                                                    </label>
                                                    <select name="sender_country" id="sender_country" class="form-control" disabled>
                                                        <option value="">--</option>
                                                        <option value="bd" selected>Bangladesh</option>
                                                        <option value="india">India</option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Sender Address <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" id="sender_addr" name="sender_addr" value="<?php echo $row['s_address']; ?>" readonly>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                    <!-- SENDER INFO END -->


                                    <!-- RECIPIEND START -->
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading warning" style="margin-bottom: 12px;">
                                                <i class="fa fa-external-link-square"></i>Recipient Information
                                                <div class="panel-tools">
                                                    <butotn class="btn btn-xs btn-link"><i class="fa fa-refresh"></i></butotn>
                                                </div>
                                            </div>
                                            <div class="panel-body borderOrange">

                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Name<span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient_name" name="recipient_name" value="<?php echo $row['r_name']; ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Company<span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient_company" name="recipient_company" value="<?php echo $row['r_company']; ?>" required>
                                                </div>



                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Email <span class="symbol required"></span>
                                                    </label>
                                                    <input class="form-control" type="email" required id="recipient_mail" name="recipient_email" value="<?php echo $row['r_email']; ?>">
                                                </div>




                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Address 1<span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" required class="form-control" id="recipient_addr" name="recipient_addr1" value="<?php echo $row['r_address1']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Address 2
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient_addr" name="recipient_addr2" value="<?php echo $row['r_address2']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Recipient Address 3
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient_addr" name="recipient_addr3" value="<?php echo $row['r_address3']; ?>">
                                                </div>



                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Rec Country Zip Code <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" required class="form-control" id="recipient_zipcode" name="recipient_zipcode" value="<?php echo $row['r_zip']; ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Recipient Phone <span class="symbol required"></span>
                                                        </label>
                                                        <input type="text" class="form-control" name="recipient_phone" id="recipient_phone" value="<?php echo $row['r_phone']; ?>">
                                                    </div>



                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Recipient Mobile <span class="symbol required"></span>
                                                        </label>
                                                        <input type="text" required class="form-control" id="recipient_mobile" name="recipient_mobile" value="<?php echo $row['r_mobile']; ?>">
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
                                </div>

                                <!-- RECIPIENT ENDS -->





                                <!-- Goods part starts -->
                                <div class="row">
                                    <div class="col-md-2"></div>

                                    <div id="corporate" style="display: block;">
                                        <div class="col-md-8 center-block">
                                            <div class="panel panel-default">
                                                <div class="panel-heading bdOrange">
                                                    <i class="fa fa-external-link-square"></i>Goods Information for Corporate
                                                    <div class="panel-tools">
                                                        <butotn class="btn btn-xs btn-link"><i class="fa fa-refresh"></i></butotn>
                                                    </div>
                                                </div>
                                                <div class="panel-body borderOrange">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Goods Title <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="goods_title" id="goods_title" placeholder="Contents" value="<?php echo $row['g_title']; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">

                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient City
                                                                </label>
                                                                <input type="textarea" class="form-control" id="recipient_addr" name="recipient_city" value="<?php echo $row['r_city']; ?>" required>
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
																	    if ($selectcnty) { while ($getcntry=$selectcnty->fetch_assoc()) {
                                                                            
                                                                            if($getcntry['country_tag'] == $row['r_country']){
                                                                                
                                                                                ?>
                                                                    <option value="<?php echo $getcntry['country_tag']; ?>" selected><?php echo $getcntry['country_name']; ?></option>
                                                                    <?php
                                                                                
                                                                            }else{
                                                                               
                                                                    
                                                                    ?>

                                                                    <option value="<?php echo $getcntry['country_tag']; ?>"><?php echo $getcntry['country_name']; ?></option>

                                                                    <?php  
                                                                            } } }else{} ?>
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
                                                                            Local Product Code <span class="symbol required"></span>
                                                                        </label>
                                                                        <select name="goods_type" id="goods_type" class="form-control" required>
                                                                            <option value="">--</option>
                                                                            <?php
                                                                                if($row['g_type'] == "P"){
                                                                                    ?>
                                                                                    <option value="P" selected>Parcel</option>
                                                                                    <option value="D">Document</option>
                                                                                    <?php
                                                                                }else{
                                                                                    ?>
                                                                                    <option value="P">Parcel</option>
                                                                                    <option value="D" selected>Document</option>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                            
                                                                            
                                                                            

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Goods Weight <span class="symbol required"></span>
                                                                        </label>
                                                                        <select name="goods_weight" id="goods_weight" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                                            <option value="">--</option>
                                                                            <?php 
																			$slectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
																				 $execweight =  $Corpoclients->selectCorpoClient($slectweight);
																		if ($execweight) { while ($findweight=$execweight->fetch_assoc()) { 
                                                                            
                                                                            if($row['g_weight'] == $findweight['weight']){
                                                                                ?>
                                                                                <option value="<?php echo $findweight['weight']; ?>" selected><?php echo $findweight['weight']; ?></option>
                                                                                <?php
                                                                            }else{
                                                                            
                                                                            ?>
                                                                           
                                                                           
                                                                            <option value="<?php echo $findweight['weight']; ?>"><?php echo $findweight['weight']; ?></option>
                                                                            
                                                                            
                                                                            <?php 
                                                                                
                                                                            } } }else{} ?>

                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Shipping Charge <span class="symbol required"></span>
                                                                        </label>
                                                                        <input style="text-align: right;" type="text" class="form-control" name="shipping_charge" id="shipping_charge" value="<?php echo $row['g_shipment_charge']; ?>" readonly>
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
                                                                    <input type="number" class="form-control" name="shimpent_pieces" id="shimpent_pieces" min='1' value="<?php echo $row['g_pieces']; ?>" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Declared Value/Custom's Value<span class="symbol required"></span>
                                                                        </label>
                                                                        <input type="text" class="form-control" name="shimpent_declared_value" id="shimpent_declared_value" value="<?php echo $row['g_customs_value']; ?>" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Tracking ID <span class="symbol required"></span>
                                                                        </label>
                                                                        <input style="cursor: pointer;" type="text" class="form-control" name="trackID" id="trackID" value="<?php echo $row['tracking_id']; ?>" readonly>
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
                                                                    <input type="text" class="form-control" name="custom_trackId" id="custom_trackId" value="<?php echo $row['awb_no']; ?>" placeholder="AWB NO" required>
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
include('includes/footer.php');
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

        //ACTIVING THE CLIENT DROPDOWN WHEN CORPORATE SELECTED ENDS




        //GETTING CLIENT DATA WHEN SELECTING THE OPTION 
        //	$("#corpo_clients").change(function(){
        //		event.preventDefault();
        //
        //		var clients = $("#corpo_clients").find(":selected").val();
        //		$("#loader2").show();
        //		//getCorpClientPrice(clients,income_or_outgo,sender_name,dest_country,goods_type,goods_weight);
        //        
        //        
        //        $.ajax({
        //            url:"getCorpoClient.php",
        //            method:"POST",
        //            data:{clientId:clients},
        //            success:function(data){
        //                $("#loader2").hide();
        //                
        //                consol.log(data);
        //            }
        //        });
        //        
        ////        $.ajax({  
        ////	        url:"getCorpoClient.php",
        ////	        method:"POST",
        ////            data:{clientId:clients},
        ////            success:function(data){  
        ////		        	$("#loader2").hide();
        ////		        //alert(data);
        //////				var sender_name = $("#sender_name").val(data.client_name);
        //////				var sender_company = $("#sender_company").val(data.client_company);
        //////				var client_mail = $("#client_mail").val(data.client_email);
        //////				var sender_contact = $("#sender_contact").val(data.contact);
        //////				var sender_country = $("#sender_country").val(data.client_name);
        //////				var dicount = $("#dicount").val(data.discount);
        //////				var client_address = $("#sender_addr").val(data.client_address);
        //////				//to set  assign to option ,that stff is setted with corporate client
        //////				var client_assignee = $("#stuff_asign").val(data.stuff_id);
        //////				$("#stuff_asign option[value='+client_assignee +']").attr("selected", true);
        ////
        ////				//var clientCustomPrice = $("#clientPrice").val(data);
        ////                    
        ////                    
        ////				
        ////		        }  
        ////	   		});
        //        
        ////		function getCorpoClient(){
        ////			
        ////            
        ////		
        ////		}
        //
        //	});

        //GETTING CLIENT DATA WHEN SELECTING THE OPTION ENDS





        //GETTING CLIENT CUSTOM PRICE WHEN SELECTING THE OPTION 

        //        $("#findprice select").change(function() {
        //            event.preventDefault();
        //            var income_or_outgo = $("#income_or_outgo").val();
        //            var dest_country = $("#dest_country").val();
        //            var goods_weight = $("#goods_weight").val();
        //            var goods_type = $("#goods_type").val();
        //            var clients = $("#corpo_clients").find(":selected").val();
        //
        //
        //            function getGenPr() {
        //                $("#loader").show();
        //                $.ajax({
        //                    url: "getClientPrice.php",
        //                    method: "POST",
        //                    data: {
        //                        action: 'getgenprice',
        //                        clientId: clients,
        //                        dest_country: dest_country,
        //                        income_or_outgo: income_or_outgo,
        //                        goods_type: goods_type,
        //                        unit: goods_weight
        //                    },
        //                    //dataType: "JSON",
        //                    success: function(data) {
        //                        $("#loader").hide();
        //                        $("#clientPrice").val(data);
        //                        $("#showclientprice").text("This comes from General price");
        //                    }
        //                });
        //            }
        //
        //
        //
        //
        //            getCorpClientPrice();
        //
        //            function getCorpClientPrice() {
        //                $("#loader").show();
        //                $.ajax({
        //                    url: "getClientPrice.php",
        //                    method: "POST",
        //                    data: {
        //                        action: 'getClientPrice',
        //                        clientId: clients,
        //                        dest_country: dest_country,
        //                        income_or_outgo: income_or_outgo,
        //                        goods_type: goods_type,
        //                        unit: goods_weight
        //                    },
        //                    //dataType: "JSON",
        //                    success: function(data) {
        //                        $("#loader").hide();
        //                        //alert(data);exit();
        //                        if (data == '') {
        //                            getGenPr();
        //                        } else {
        //                            var clientCustomPrice = $("#clientPrice").val(data);
        //                            $("#showclientprice").text("This comes from Client Custom price");
        //                        }
        //
        //                    }
        //
        //                });
        //            }
        //
        //
        //
        //
        //        });


        //GETTING CLIENT CUSTOM PRICE WHEN SELECTING THE OPTION ENDS






        //FUNCTION FOR GETTING THE GENERAL PRICE STARTS
        // $("#form_cons_booking select").change(function(){
        // 	event.preventDefault();
        // 	getGenPrice();
        // });

        // function getGenPrice(){
        // 	   $.ajax({  
        //         url:"getGenPrice.php",  
        //         method:"POST",  
        //         data:{action:'getgenpr',route:dest_country,corp_client:corpo_clients,income_or_outgo:income_or_outgo,goods_type:goods_type,unit:goods_weight},  
        // 			//dataType: "JSON",
        // 	        success:function(data){  
        // 	            $("#price").val(data);
        // 				$("#showgenprice").text("General price of correspondent data is : " + data);
        // 	        }  
        //    		});  
        // }
        //FUNCTION FOR GETTING THE GENERAL PRICE ENDS



        //FUNCTION FOR GETTING THE GENERAL PRICE STARTS
        // $("#corpoPriceSetForm select").change(function(){
        // 	event.preventDefault();
        // 	getGenPrice();
        // });

        // function getGenPrice(){
        // 	var route = $("#route_code").val();
        // 	var corp_client = $("#corp_client").val();
        // 	var income_or_outgo = $("#income_or_outgo").val();
        // 	var goods_type = $("#goods_type").val();
        // 	var unit = $("#unit").val();
        // 	   $.ajax({  
        //         url:"getGenPrice.php",  
        //         method:"POST",  
        //         data:{action:'getgenpr',route:route,corp_client:corp_client,income_or_outgo:income_or_outgo,goods_type:goods_type,unit:unit},  
        // 			//dataType: "JSON",
        // 	        success:function(data){  
        // 	            $("#price").val(data);
        // 				$("#showgenprice").text("The general price of correspondent data is : " + data);
        // 	        }  
        //    		});  
        // }
        //FUNCTION FOR GETTING THE GENERAL PRICE ENDS









    })

</script>
