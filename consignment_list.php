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


$query = "SELECT * FROM consignment_booking ORDER BY tracking_id DESC";
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
                                            <th>AWB No</th>
                                            <th>Sender</th>
                                            <th>Receiver</th>
                                            <th>Receiver Company</th>
                                            <th>Receiver Country</th>
                                            <th>ZIP CODE</th>
                                            <th>Charge Prices</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while($row = $result->fetch_assoc()){
                                            
                                            if($row['status'] == 1){
                                                 ?>
                                        <tr>
                                            <td class="rclrm"><?php echo $row['tracking_id']; ?></td>
                                            <td class="rclr"><?php echo $row['awb_no']; ?></td>
                                            <td class="rclr"><?php echo $row['s_name']; ?></td>
                                            <td class="rclr"><?php echo $row['r_name']; ?></td>
                                            <td class="rclr"><?php echo $row['r_company']; ?></td>
                                            <td class="rclr"><?php echo $row['r_country']; ?></td>
                                            <td class="rclr"><?php echo $row['r_zip']; ?></td>
                                            <td class="rclr"><?php echo $row['g_shipment_charge']; ?></td>

                                            <td class="rbtn">
                                                <div class="">
                                                    <a href="update_consignment.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit" title="Update"><i class="fa fa-edit"></i></a>
                                                    <a id="<?php echo $row['id']; ?>" href="#" class="btn btn-xs btn-bricky tooltips rts" data-placement="top" data-original-title="Remove" title="Return to shipper"><i class="fa fa-share"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                                
                                            }else if($row['status'] == 0){
                                                 ?>
                                        <tr>
                                            <td style="background-color: #636e72;"><?php echo $row['tracking_id']; ?></td>
                                            <td  style="background-color: #dfe6e9;"><?php echo $row['awb_no']; ?></td>
                                            <td  style="background-color: #dfe6e9;"><?php echo $row['s_name']; ?></td>
                                            <td  style="background-color: #dfe6e9;"><?php echo $row['r_name']; ?></td>
                                            <td  style="background-color: #dfe6e9;"><?php echo $row['r_company']; ?></td>
                                            <td  style="background-color: #dfe6e9;"><?php echo $row['r_country']; ?></td>
                                            <td  style="background-color: #dfe6e9;"><?php echo $row['r_zip']; ?></td>
                                            <td  style="background-color: #dfe6e9;"><?php echo $row['g_shipment_charge']; ?></td>

                                            <td>
                                               Return To Shipper 
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                        
                                       
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
