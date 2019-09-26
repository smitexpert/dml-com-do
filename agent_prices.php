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
                                    <label class="control-label" style="font-size: 16px">Select Agent<span class="symbol required"></span>
                                    </label>
                                    <select name="agent_select" required id="agent_select" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                        <option value="">--</option>
                                        <?php
			$selectclientname = "SELECT * FROM agent_clients WHERE status='1'";
				$findclientname =  $db->link->query($selectclientname);
		if ($findclientname->num_rows > 0) { while ($getclientname=$findclientname->fetch_assoc()) { ?>
                                        <option id="cour_comp_name" value="<?php echo $getclientname['id']; ?>"><?php echo $getclientname['company_name']; ?></option>
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
                                        <li><a id="copyagent" href="#">COPY</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="viewpanel" id="view_setprice" style="display: none">
                <form id="agent_zone_set_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Agent Set Price
                                </div>
                                <div class="panel-body">

                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group connected-group">
                                                <label for="principal">Select Principal</label>
                                                <select name="principal" id="principal" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                    <option value="">--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group connected-group">
                                                <label for="zone">Select Zone</label>
                                                <select name="zone" id="zone" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                    <option value="">--</option>
                                                </select>
                                                <input type="hidden" id="agent_email" name="agent_email">
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
                                                        <input type="text" class="form-control" name="d_price[]" placeholder="0">
                                                    </div>
                                                </div>
                                                <?php
                                                
                                                
                                                
                                        for($i=0.50; $i<=3.00; $i+=0.50){
                                    ?>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><?php echo number_format($i, 2).' kg'; ?></span>
                                                        <input type="hidden" value="<?php echo $i; ?>" name="d_weight[]">
                                                        <input type="text" class="form-control" name="d_price[]" placeholder="0">
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
                                                        <input type="text" class="form-control" name="p_price[]" placeholder="0">
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
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group connected-group">
                            <label for="view_principal">Select Principal</label>
                            <select name="view_principal" id="view_principal" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                <option value="">--</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="load_price">

                </div>
                <br>
            </div>

            <div class="viewpanel" id="view_updateprice" style="display: none">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                Agent Update Price
                            </div>
                            <div class="panel-body">
                                <form onsubmit="update_agent_submit(event)" action="">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group connected-group">
                                                <label for="upzoneprincipal">Select Principal</label>
                                                <select name="upzoneprincipal" id="upzoneprincipal" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                    <option value="">--</option>
                                                </select>
                                            </div>
                                        </div>
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
                                    <div id="load_update_price">
                                        
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
