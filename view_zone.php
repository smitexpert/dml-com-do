<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM  principals_name order by id desc";
    $selectcourcom = $Courcompanyset->selectcourComp($query);
?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br>
            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            View DML Zone
                        </div>

                        <div class="panel-body">
                            <div class="row">

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
                            <br>

                            
                            <div class="row">
                                <div class="col-md-12">
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>


        </div>
        <!-- end: MAIN CONTAINER -->


        <?php 
include('includes/footer.php');
?>
