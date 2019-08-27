<?php 
include('includes/clientheader.php'); 
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

$clientID = Session::get('ClientID');

$query = "SELECT * FROM consignment_booking WHERE client_Id='$clientID' AND status < 2";
$result = $db->link->query($query);


?>



<div class="main-container">

    <?php include('includes/client-sidebar-menu.php'); ?>



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
                                            <th>AWB No</th>
                                            <th>Recipient</th>
                                            <th>Shipping Country</th>
                                            <th>Charge Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while($row = $result->fetch_assoc()){
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $row['tracking_id']; ?></td>
                                            <td><?php echo $row['awb_no']; ?></td>
                                            <td><?php echo $row['r_name']; ?></td>
                                            <td><?php echo $row['r_country']; ?></td>
                                            <td><?php echo $row['g_shipment_charge']; ?></td>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                if($status == 0){
                                                    echo 'SIR';
                                                }
                                                ?>
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


</div>

<!-- end: MAIN CONTAINER -->




<?php 

include('includes/clientfooter.php');

?>
