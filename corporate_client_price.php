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
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group connected-group" style="margin-left: -20px;">
                                    <label class="control-label" style="font-size: 16px">Select Corporate Client<span class="symbol required"></span>
                                    </label>
                                    <select name="corporate_select" required id="corporate_select" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                        <option value="">--</option>
                                        <?php
			$selectCorporateInfo = "SELECT * FROM corporate_clients WHERE status='1'";
				$findCorporate =  $db->link->query($selectCorporateInfo);
		if ($findCorporate->num_rows > 0) { while ($row = $findCorporate->fetch_assoc()) { ?>
                                        <option id="corporate_client_name" value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                        <!-- <option data-subtext="<?php //echo $getclientname['cour_comp_name']; ?>" class="cl" value="<?php //echo $getclientname['client_id']; ?>"><?php //echo $getclientname['cour_comp_name']; ?></option> -->
                                        <?php } }else{} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br>
                                <div class="nav_view" style="display: none;">
                                    <ul class="nav nav-pills">
                                        <li><a id="setprice" href="#">SET PRICE</a></li>
                                        <li><a id="viewprice" href="#">VIEW PRICE</a></li>
                                        <li><a id="updateprice" href="#">UPDATE PRICE</a></li>
                                        <li><a id="copyCorporate" href="#">COPY</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="viewpanel" id="view_setprice" style="display: none">
                <form id="corporate_zone_set_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Corporate Client Set Price
                                </div>
                                <div class="panel-body">

                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group connected-group">
                                                <label for="zone">Select Zone</label>
                                                <select name="zone" id="zone" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                    <option value="">--</option>
                                                </select>
                                                <input type="hidden" id="corporate_email" name="corporate_email_set_general_price">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="#">
                                                <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR DOCUMENT</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><?php echo '0.25 kg'; ?></span>
                                                        <input type="hidden" value="<?php echo 0.25; ?>" name="d_weight[]">
                                                        <input type="text" class="form-control corpo_price" name="d_price[]" placeholder="0">
                                                    </div>
                                                </div>
                                                <?php
                                                
                                                
                                                
                                        for($i=0.50; $i<=3.00; $i+=0.50){
                                    ?>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><?php echo number_format($i, 2).' kg'; ?></span>
                                                        <input type="hidden" value="<?php echo $i; ?>" name="d_weight[]">
                                                        <input type="text" class="form-control corpo_price" name="d_price[]" placeholder="0">
                                                    </div>
                                                </div>
                                                <?php
                                        }
                                    ?>


                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="#">
                                                <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR PARCEL</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <?php
                                    $sqlW = "SELECT * FROM tbl_weight WHERE status='1' ORDER BY weight ASC";
                                    $queryW = $db->link->query($sqlW);
                                    if($queryW->num_rows > 0){
                                        while($rowW = $queryW->fetch_assoc()){
                                    ?>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><?php echo $rowW['weight'].' kg'; ?></span>
                                                        <input type="hidden" value="<?php echo $rowW['weight']; ?>" name="p_weight[]">
                                                        <input type="text" class="form-control corpo_price" name="p_price[]" placeholder="0">
                                                    </div>
                                                </div>
                                                <?php
                                        }
                                    }
                                    ?>


                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button id="submit_zone_price" type="submit" class="btn btn-lg btn-warning btn-block" disabled>SUBMIT</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="viewpanel" id="view_viewprice" style="display: none">                
                <hr>
                <div id="showpricetable">
                                   
                </div>
                <br>
            </div>

            <div class="viewpanel" id="view_updateprice" style="display: none">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                Corporate Client Update Price
                            </div>

                            <div class="panel-body">
                                <form id="update_corporate_price_submit" action="">
                                    <br>
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group connected-group">
                                                <label for="upzone">Select Zone</label>
                                                <select name="upzone" id="upzone" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                    <option value="">--</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="viewpriceview-loading" style="display: none;">
                        <img style="position: fixed;z-index: 999;bottom: 30px;left: -128px;margin-left: 50%;" src="img/loading.gif" alt="">
            </div>
                                    <div id="load_corporate_general_price">

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="viewpanel" id="view_copyagent" style="display: none">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                Copy Agent Price
                            </div>
                            <div class="panel-body">
                               <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                           <label for="">To Principal</label>
                                            <select name="copy_to_principal_id" id="copy_to_principal_id" class="form-control selectpicker"  data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <h3>FROM</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">From Agent</label>
                                            <select name="copy_from_agent_id" id="copy_from_agent_id" class="form-control selectpicker"  data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php
                                                 $copy_query = $db->link->query($selectclientname);
                                                if($copy_query->num_rows > 0){
                                                    while($copy_row = $copy_query->fetch_assoc()){
                                                        ?>
                                                        <option value="<?php echo $copy_row['email']; ?>"><?php echo $copy_row['company_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">From Principal</label>
                                            <select name="copy_from_principal_id" id="copy_from_principal_id" class="form-control selectpicker"  data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <button id="copy_btn" style="margin-top: 8px;" class="btn btn-sm btn-warning">COPY</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <br><br>

        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
