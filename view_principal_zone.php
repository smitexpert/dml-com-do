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
                            <i class="fa fa-external-link-square"></i>ZONE WISE COUNTRY LIST
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
                                            <label class="control-label">Select Principal <span class="symbol required"></span>
                                            </label>
                                            <select name="principal" required id="principal" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php 
															$selcourcomp = "SELECT * FROM principals_name ORDER BY principal_name ASC";
                                                            $result = $db->link->query($selcourcomp);
														while ($findcourcomp=$result->fetch_assoc()) { ?>
                                                <option value="<?php echo $findcourcomp['id']; ?>"><?php echo $findcourcomp['principal_name']; ?></option>
                                                <?php }?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group connected-group">
                                            <label class="control-label">Select Zone<span class="symbol required"></span>
                                            </label>
                                            <select name="zone_code" required id="zone_code" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php 
															$selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
																 $execroute =  $Courcompanyset->selectcourComp($selectroute);
														while ($findroute=$execroute->fetch_assoc()) { ?>
                                                <option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
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
                        <div style="font-weight:bold; padding-bottom:5px;">Country List For: <span style="font-style:italic" id='principalName'></span> &amp; Zone: <span style="font-style:italic" id='zoneCode'></span></div>
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
                                <th class='center'>Country Name</th>
                                <th class='center'>Country Tag</th>
                                <th class='center'>Action</th>
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
