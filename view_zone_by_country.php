<?php 
include('includes/header.php'); 


/*if (isset($_POST['submit'])) {
    $insertcourcompprice = $Courcompanyset->insertPrincipalPrice($_POST);
}

$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id AND p.country_id = c.country_id";
$selectcourcomp = $Courcompanyset->selectcourComp($query);*/


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
                            <i class="fa fa-external-link-square"></i>SELECT COUNTRY TO FIND ZONE
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
											if (isset($insertcourcompprice)) { ?>
                                    <div class="alert alert-info fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong><?php echo $insertcourcompprice; ?></strong>
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
                                            <label class="control-label">Select Country <span class="symbol required"></span>
                                            </label>
                                            <select name="country" required id="country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php 
															$select = "SELECT * FROM tbl_country ORDER BY country_name ASC";
                                                            $result = $db->link->query($select);
														while ($row=$result->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
                                                <?php }?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group connected-group">
                                            <br>
                                            <button id="viewZone" style="margin-top: 3px;" type="button" class="btn btn-warning btn-block">VIEW</button>
                                        </div>
                                    </div>

                                


                            </div>



                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
                <div class="col-md-1"></div>
            </div><br>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="#">
                        <div style="font-weight:bold; padding-bottom:5px;">View Zone By Country</div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample-table-1">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class='center'>Principal Name</th>
                                <th class='center'>Zone</th>
                            </tr>
                        </thead>
                        <tbody id="zoneBody">
                            
                        </tbody>



                    </table>


                </div>
                <div class="col-md-1"></div>
            </div>



        </div>
    </div>
    <!-- end: PAGE -->


</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
