<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM tbl_country WHERE status=1 ORDER BY country_name ASC";
    $selectCountry = $Countryset->selectCountry($query);
if (isset($_POST['submit'])) {
    $insertcountry = $Countryset->insertCountry($_POST);
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
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>CREATE COUNTRY
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
											if (isset($insertcountry)) { ?>
                                    <div class="alert alert-info fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong><?php echo $insertcountry; ?></strong>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <form action="add_country.php" method="POST" role="form" id="form">
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
                                        <div class="form-group">
                                            <label class="control-label">
                                                Country Name <span class="symbol required"></span>
                                            </label>
                                            <input required type="text" class="form-control" id="countryName" name="countryName">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Country Tag <span class="symbol required"></span>
                                            </label>
                                            <input required type="text" class="form-control" id="countryTag" name="countryTag">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group connected-group">
                                            <label class="control-label">Routes<span class="symbol required"></span>
                                            </label>
                                            <select name="route_code" id="route_code" class="form-control selectpicker select" data-live-search="true" required>

                                                <option value="">--</option>
                                                <?php 
															$selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
																 $execroute =  $Countryset->selectCountry($selectroute);
														if ($execroute) {  while ($findroute=$execroute->fetch_assoc()) { ?>
                                                <option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
                                                <?php } }else{} ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group connected-group">
                                            <label class="control-label">Status<span class="symbol required"></span>
                                            </label>
                                            <select name="status" required id="status" class="form-control">
                                                <option value="">--</option>
                                                <option value="1">publish</option>
                                                <option value="2">pending</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <br>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            COUNTRY LIST
                        </div>

                        <div class="panel-body table-responsive">
                            <div class="tbl">
                                <table class="table table-striped table-bordered table-hover table-full-width" id="countrytbl">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Name</th>
                                            <th>Country Tag</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i=0; if ($selectCountry) { while ($getcountry=$selectCountry->fetch_assoc()) { $i++; ?>
                                        <tr>
                                            <td class="center"><?php echo $i; ?></td>
                                            <td><?php echo $getcountry['country_name']; ?></td>
                                            <td><?php echo $getcountry['country_tag']; ?></td>                                            
                                            <td>
                                            <button data-toggle="modal" data-target="#myModal" id="<?php echo $getcountry['country_id']; ?>" type="button" class="btn btn-xs btn-teal tooltips editBtn"><i class="fa fa-edit"></i></button>
                                        </td>
                                        </tr>
                                        <?php } }else { echo "Data not found";} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- end: FORM VALIDATION 1 PANEL -->
                <div class="col-md-1"></div>
            </div>
            <!-- end: PAGE CONTENT-->
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
                <h4 class="modal-title">Update Country</h4>
            </div>
            <div class="modal-body">
                <form action="" id="upCountry">
                    <input type="text" id="upCountryId" name="upCountryId" value="" hidden>
                    <label for="upCountryName">Country Name</label>
                    <input type="text" placeholder="Country Name" id="upCountryName" class="form-control" name="upCountryName" required>
                    <br>

                    <label for="upCountryTag">Country Tag</label>
                    <input type="text" placeholder="Country Tag" id="upCountryTag" class="form-control" name="upCountryTag" required><br>
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
    $(document).ready(function() {

        // 	$("#route_code").change(function(){
        // 		event.preventDefault();
        // 		getGenVal();
        // 	});

        // 	function getGenVal(){
        // 	   $.ajax({  
        //         url:"get_gen_price.php",  
        //         method:"POST",  
        //         //data:{incomeid:incomeid, income_value:income_value},  
        // 		//dataType: "JSON",
        //         success:function(data){  
        //              //alert(data[3]);

        //              $('#countryName').val(data[2]);
        //              //alert(data);  
        //         }  
        //    		});  

        // 	}



        // data table with pdf csv excel print copy
        table = $('#countrytbl').DataTable({

            // paging: false,
            // info: false,
            //  dom: 'Bfrtip',
            //       buttons: [
            //           'copy', 'csv', 'excel', 'pdf', 'print'
            //       ]
        });



    })

</script>
