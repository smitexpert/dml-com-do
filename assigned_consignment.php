<?php 
include('includes/header.php'); 
	// $query = "SELECT cons.*,cntry.country_name,cour.cour_comp_name

	//  FROM tbl_consignment as cons,tbl_country as cntry,tbl_courier_companies as cour

	//  WHERE cons.dest_country = cntry.country_id AND cons.assigned_to = cour.cour_comp_id ORDER BY cons.booking_date DESC";	
	 //$query = "SELECT cons.*,cntry.country_name FROM tbl_consignment as cons,tbl_country as cntry WHERE cons.dest_country = cntry.country_id ORDER BY cons.booking_date DESC";

	 //$query = "SELECT cons.*,cntry.country_name FROM tbl_consignment as cons,tbl_country as cntry WHERE cons.dest_country = cntry.country_id ORDER BY cons.booking_date DESC";
//	$query = "SELECT cons.*,cntry.country_name,stuff.stuff_id,stuff.stuff_name FROM tbl_consignment as cons,tbl_country as cntry,tbl_stuff as stuff WHERE cons.dest_country = cntry.country_id AND cons.assigned_to=stuff.stuff_id ORDER BY cons.booking_date DESC";
//	 if ($query) {
//    	$selectCons = $Consignment->selectConsignment($query);
//    if ($selectCons) {
//
//    }else{}
//
//	 }else{ echo "oops"; }


$query = "SELECT * FROM consignment_booked WHERE status='0'";
$result = $db->link->query($query);


?>



<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>



    <div class="main-content">

        <div class="container"><br><br>

            <div class="row">

                <div class="col-md-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <i class="fa fa-external-link-square"></i>

                            Consignment Lists:

                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">

                                <!--<?php if (isset($_REQUEST['msg'])) {?>
                                <div style="padding: 4px;width: 100%;margin: 0 auto;background: salmon">
                                    <?php echo $msg=$_REQUEST['msg']; ?>
                                </div><br>
                                <?php } ?>-->

                                <table id="consListTable" class="display table-striped table-bordered table-hover" style="width:100%">
                                    <thead style="font-size: 10px;color: orange">
                                        <tr>
                                            <th>Tracking ID</th>
                                            <th>Principal</th>
                                            <th>Charged Ammount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while($row = $result->fetch_assoc()){
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $row['tracking_id']; ?></td>
                                            <td><?php echo $db->getPrincipalName($row['principal_id']); ?></td>
                                            <td style="text-align: right;"><?php echo $row['booking_price']." (USD)"; ?></td>
                                            <td style="text-align: center;">
                                                <!--<div class="assign_id">
                                                   <input type="hidden" value="<?php echo $row['id'];  ?>">
                                                    <a id="<?php echo $row['id'];  ?>" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-teal tooltips assign"><i class="fa fa-search-plus"></i></a>
                                                </div>-->
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- end: FORM VALIDATION 1 PANEL -->

            </div>

        </div>

        <!-- end: PAGE CONTENT-->

    </div>

</div>


<!-- end: PAGE -->



<!-- end: MAIN CONTAINER -->



<?php 

include('includes/footer.php');

?>
