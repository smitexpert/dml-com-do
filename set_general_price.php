<?php 
include('includes/header.php'); 
if (isset($_POST['submit'])) {
    $insertrouteprice = $priceset->insertPrice($_POST);
}
?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br><br><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>GENERAL PRICE SETTING
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
											if (isset($insertrouteprice)) { ?>
                                    <div class="alert alert-info fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong><?php echo $insertrouteprice; ?></strong>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <form action="" id="general_price">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="errorHandler alert alert-danger no-display">
                                            <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                        </div>
                                        <div class="successHandler alert alert-success no-display">
                                            <i class="fa fa-ok"></i> Your form validation is successful!
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group connected-group">
                                            <label class="control-label">SELECT ZONE<span class="symbol required"></span>
                                            </label>
                                            <select name="general_zone" required id="general_zone" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php 
                                                    $slZone = "SELECT DISTINCT zone FROM dml_zone ORDER BY zone ASC";
                                                    $slQuery = $db->link->query($slZone);
                                                
                                                    while($row = $slQuery->fetch_assoc()){
                                                        ?>
                                                <option value="<?php echo $row['zone']; ?>"><?php echo $row['zone']; ?></option>
                                                <?php
                                                    }
                                                    
                                                ?>

                                            </select>
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


                            </form>
                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
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
