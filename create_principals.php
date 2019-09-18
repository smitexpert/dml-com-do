<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM  principals_name ORDER BY id DESC";
    $selectcourcom = $Courcompanyset->selectcourComp($query);
if (isset($_POST['submit'])) {
    $insertcourcomp = $Courcompanyset->insertcourComp($_POST);
     $selectcourcom = $Courcompanyset->selectcourComp($query);
}
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
                        <div class="panel-heading">CREATE PRINCIPAL
                            <i class="fa fa-external-link-square"></i>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
											if (isset($insertcourcomp)) { ?>
                                    <div class="alert alert-info fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong><?php echo $insertcourcomp; ?></strong>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" role="form" id="form">
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
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Principal Name <span class="symbol required"></span>
                                            </label>
                                            <input required type="text" class="form-control" id="courcompname" name="courcompname">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Zone/Country Based<span class="symbol required"></span>
                                            </label>
                                            <select name="based" required id="based" class="form-control">
                                                <option value="">--</option>
                                                <option value="1">Zone Wise</option>
                                                <option value="0">Country Wise</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group connected-group">
                                            <label class="control-label">Currency <span class="symbol required"></span>
                                            </label>
                                            <select name="currency" required id="currency" class="form-control">
                                                <option value="">--</option>
                                                <?php
                                                
                                                    $result = $db->select("SELECT * FROM currency");
                                                    while($row = $result->fetch_assoc()){
                                                        ?>
                                                <option value="<?php echo $row['currency_name']; ?>"><?php echo $row['currency_name']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Fuel Cost <span class="symbol required"></span></label>
                                        <input type="text" class="form-control" id="fuelcost" name="fuelcost" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Airlines Cost <span class="symbol required"></span></label>
                                        <input type="text" class="form-control" id="airlinescost" name="airlinescost" required>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="submit">
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            PRINCIPAL LIST
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="couriertbl">

                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Principals Name</th>
                                        <th>Zone/Country Based</th>
                                        <th>Fuel Cost</th>
                                        <th>Airlines Cost (USD)</th>
                                        <th>Currency</th>
                                        <th>Update By</th>
                                        <th>Dated</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i=0; if ($selectcourcom) { while ($getcourcomp=$selectcourcom->fetch_assoc()) { $i++; ?>
                                    <tr>
                                        <td class="center"><?php echo $getcourcomp['id'];  ?></td>
                                        <td><?php echo $getcourcomp['principal_name']; ?></td>
                                        <!--<td>
												<a href="#" rel="nofollow" target="_blank">
													<?php // echo $getcourcomp['status']; ?>
												</a></td>-->
                                        <td class="hidden-xs"><?php if($getcourcomp['based'] == 1){echo 'Zone Wise';}else{echo "Country Wise";} ?></td>

                                        <td class="hidden-xs"><?php echo $getcourcomp['fuel_cost']; ?>%</td>
                                        <td class="hidden-xs"><?php echo $getcourcomp['airlines_cost']; ?></td>
                                        <td class="hidden-xs"><?php echo $getcourcomp['currency']; ?></td>
                                        <td class="hidden-xs"><?php echo $db->getUserName($getcourcomp['user']); ?></td>
                                        <td class="hidden-xs"><?php echo $getcourcomp['dated']; ?></td>
                                        <td>
                                            <button data-toggle="modal" data-target="#myModal" id="<?php echo $getcourcomp['id']; ?>" type="button" class="btn btn-xs btn-teal tooltips editBtn"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <!--
												<td class="center">
												<div class="visible-md visible-lg hidden-sm hidden-xs">
													<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
													<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
													<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
												</div>
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-share"></i> Share
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-times"></i> Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
                                        -->
                                    </tr>
                                    <?php } }else{ echo "Data not found";} ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>
        </div>
    </div>
    <!-- end: PAGE -->


</div>
<!-- end: MAIN CONTAINER -->


<div class="">
    <div class="modal modal-dialog fade" id="myModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Principal</h4>
            </div>
            <div class="modal-body">
                <form action="" id="upPrincipal">
                    <input type="text" id="upPrincipalId" name="upPrincipalId" hidden>
                    <label for="upPrincipalName">Principal Name</label>
                    <input type="text" placeholder="Principal Name" id="upPrincipalName" class="form-control" name="upPrincipalName" required>
                    <br>
                    <label for="upPrincipalBased">Zone/Country Based</label>
                    <select name="upPrincipalBased" id="upPrincipalBased" class="form-control">
<!--                       printr(upPrincipalBased);-->
                        <option value="1">Zone Wise</option>
                        <option value="0">Country Wise</option>
                    </select><br>

                    <label for="upCurrency">Currency</label>
                    <select name="upCurrency" id="upCurrency" class="form-control">
                        <option value="">--</option>
                        <?php
                                                
                                                    $result = $db->select("SELECT * FROM currency");
                                                    while($row = $result->fetch_assoc()){
                                                        ?>
                        <option value="<?php echo $row['currency_name']; ?>"><?php echo $row['currency_name']; ?></option>
                        <?php
                                                    }
                                                ?>
                    </select>
                    <br>
                    <label for="upFuelCost">Fuel Cost</label>
                    <input type="text" placeholder="Fuel Cost" id="upFuelCost" class="form-control" name="upFuelCost" required><br>

                    <label for="upAirlinesCost">Airlines Cost Per Unite (USD)</label>
                    <input type="text" placeholder="Airlines Cost" id="upAirlinesCost" class="form-control" name="upAirlinesCost" required><br>
                    <input type="submit" value="Update" class="btn btn-sm btn-warning btn-block">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<?php 
include('includes/footer.php');
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        UIElements.init();


        // data table with pdf csv excel print copy
        table = $('#couriertbl').DataTable({

            // paging: false,
            // info: false,
            //  dom: 'Bfrtip',
            //       buttons: [
            //           'copy', 'csv', 'excel', 'pdf', 'print'
            //       ]
        });
    })

</script>
