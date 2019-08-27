<?php 
include('includes/header.php'); 

?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>UPDATE PRICE
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

                                <div id="updatePrice">
                                    
                                </div>


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
