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


$query = "SELECT * FROM consignment_booking WHERE status='1'";
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
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $row['tracking_id']; ?></td>
                                            <td><?php echo $row['awb_no']; ?></td>
                                            <td><?php echo $row['s_name']; ?></td>
                                            <td><?php echo $row['r_name']; ?></td>
                                            <td><?php echo $row['r_company']; ?></td>
                                            <td><?php echo $row['r_country']; ?></td>
                                            <td><?php echo $row['r_zip']; ?></td>
                                            <td><?php echo $row['g_shipment_charge']; ?></td>

                                            <td style="text-align: center;">
                                                <div class="assign_id">
                                                   <input type="hidden" value="<?php echo $row['id'];  ?>">
                                                    <a id="<?php echo $row['id'];  ?>" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-teal tooltips assign"><i class="fa fa-search-plus"></i></a>
                                                </div>
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

<div class="">
    <div class="modal modal-dialog fade modal-lg" id="myModal" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assign Consignment</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table" border="1">
                            <caption>GOODS INFORMATION</caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Tracking ID</th>
                                    <td>:</td>
                                    <td id="trackid">000</td>
                                </tr>
                                <tr>
                                    <th>Destination Country
                                    <input type="hidden" id="country_tag">
                                    </th>
                                    <td>:</td>
                                    <td id="destcountry">000
                                    </td>
                                </tr>
                                <tr>
                                    <th>CITY</th>
                                    <td>:</td>
                                    <td id="city">000</td>
                                </tr>
                                <tr>
                                    <th>ZIP/POSTAL CODE</th>
                                    <td>:</td>
                                    <td id="zip">000</td>
                                </tr>
                                <tr>
                                    <th>GOODS TYPE</th>
                                    <td>:</td>
                                    <td id="type">000</td>
                                </tr>
                                <tr>
                                    <th>GOODS WEIGHT</th>
                                    <td>:</td>
                                    <td id="weight">000</td>
                                </tr>
                                <tr>
                                    <th>SHIPPING CHARGE</th>
                                    <td>:</td>
                                    <td id="shipcharge">000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table" border="1">
                            <caption>PRINCIPAL INFORMATION</caption>
                            <thead>
                                <tr>
                                    <th>Principal Name</th>
                                    <th>Costing (USD)</th>
                                    <th>Remote Area</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody id="principal_list">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       <div id="remote_poss">
                           
                       </div>
                    </div>
                </div>
            </div>
            <div class="loading-img">
                <img src="img/loading.gif" alt="">
            </div>
            <div class="modal-footer">
                <button id="assing-btn" type="button" class="btn btn-default btn-warning" style="padding: 5px 60px; font-weight: bold;">Assign</button>
            </div>
        </div>

    </div>
</div>



<!-- end: MAIN CONTAINER -->



<?php 

include('includes/footer.php');

?>
