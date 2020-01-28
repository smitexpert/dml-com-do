<?php 
include('header.php'); 

//get all consignment those are not assigned.
$getConsignmentList = "SELECT consignment_booking.*, custom_tracking_no.custom_id, tbl_country.country_name FROM consignment_booking INNER JOIN custom_tracking_no ON consignment_booking.tracking_id = custom_tracking_no.tracking_id INNER JOIN tbl_country ON consignment_booking.r_country = tbl_country.country_tag WHERE consignment_booking.client_id = '$id' AND consignment_booking.s_type = 'agent' AND consignment_booking.status = '1'";
$getList = $db->link->query($getConsignmentList);

//get all consignment those are not assigned.
$getConsignmentList_booked = "SELECT consignment_booking.*, custom_tracking_no.custom_id, tbl_country.country_name FROM consignment_booking INNER JOIN custom_tracking_no ON consignment_booking.tracking_id = custom_tracking_no.tracking_id INNER JOIN tbl_country ON consignment_booking.r_country = tbl_country.country_tag WHERE consignment_booking.client_id = '$id' AND consignment_booking.s_type = 'agent' AND consignment_booking.status = '2'";
$getList_booked = $db->link->query($getConsignmentList_booked);

//get all consignment those are not assigned.
$getConsignmentList_delivered = "SELECT consignment_booking.*, custom_tracking_no.custom_id, tbl_country.country_name FROM consignment_booking INNER JOIN custom_tracking_no ON consignment_booking.tracking_id = custom_tracking_no.tracking_id INNER JOIN tbl_country ON consignment_booking.r_country = tbl_country.country_tag WHERE consignment_booking.client_id = '$id' AND consignment_booking.s_type = 'agent' AND consignment_booking.status = '3'";
$getConsignmentList_delivered = $db->link->query($getConsignmentList_delivered);

//get all consignment those are not assigned.
$getConsignmentList_deleted = "SELECT consignment_booking.*, custom_tracking_no.custom_id, tbl_country.country_name FROM consignment_booking INNER JOIN custom_tracking_no ON consignment_booking.tracking_id = custom_tracking_no.tracking_id INNER JOIN tbl_country ON consignment_booking.r_country = tbl_country.country_tag WHERE consignment_booking.client_id = '$id' AND consignment_booking.s_type = 'agent' AND consignment_booking.status = '0'";
$getList_deleted = $db->link->query($getConsignmentList_deleted);

?>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="nav_view">
                            <ul class="nav nav-pills">
                                <li class="active"><a id="booked" href="#">BOOKED</a></li>
                                <li><a id="assinged" href="#">ASSINGED</a></li>
                                <li><a id="delivered" href="#">DELIVERED</a></li>
                                <li><a id="canceled" href="#">CANCELED</a></li>
                            </ul>        
                    </div>
                </div>
            </div>
            <BR>
            <!-- end main tab bar code -->
            <div class="row">
            <!-- Start View Consignment Area -->
            <!-- Normal Bookimn Part Start -->
                <div id="personal_body" style="display:block">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    LIST OF BOOKED CONSIGNMENT
                                </div>                                
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
                                            <th>TRACKING NO.</th>
                                            <th>DML TR. NO.</th>
                                            <th>AWB No</th>
                                            <th>Sender Name</th>
                                            <th>Receiver</th>
                                            <th>Destination Country</th>
                                            <th>Shiping Charge</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while($row = $getList->fetch_assoc()){
                                            
                                            if($row['status'] == 1){
                                                 ?>
                                        <tr>
                                            <td class="rclrm"><?php echo $row['custom_id']; ?></td>
                                            <td class="rclr"><?php echo $row['tracking_id']; ?></td>
                                            <td class="rclr"><?php echo $row['awb_no']; ?></td>
                                            <td class="rclr"><?php echo $row['s_name']; ?></td>
                                            <td class="rclr"><?php echo $row['r_name']; ?></td>
                                            <td class="rclr"><?php echo $row['country_name']; ?></td>
                                            <td class="rclr"><?php echo $row['g_shipment_charge']; ?></td>

                                            <td class="rbtn">
                                                <div class="">
                                                    <a href="agent_cons_update.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit" title="UPDATE CONSIGNMENT"><i class="fa fa-edit"></i></a>
                                                    <button id="<?php echo $row['tracking_id']; ?>" class="btn btn-xs btn-bricky tooltips rts deleteConsignment" onclick="deleteConsignment(<?php echo $row['tracking_id']; ?>)" data-placement="top" data-original-title="Remove" title="CANCEL CONSIGNMENT"><i class="fa fa-times"></i></button>
                                                </div>
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
                <div id="personal_body_booked" style="display:none">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    LIST OF ASSIGNED CONSIGNMENT
                                </div>                                
                            </div>
                            <div class="panel-body">
                            <div class="table-responsive">

                                <!--<?php if (isset($_REQUEST['msg'])) {?>
                                <div style="padding: 4px;width: 100%;margin: 0 auto;background: salmon">
                                    <?php echo $msg=$_REQUEST['msg']; ?>
                                </div><br>
                                <?php } ?>-->

                                <table id="consListTable_booked" class="display table-striped table-bordered table-hover" style="width:100%">
                                    <thead style="font-size: 10px;color: orange">
                                        <tr>
                                            <th>TRACKING NO.</th>
                                            <th>DML TR. NO.</th>
                                            <th>AWB No</th>
                                            <th>Sender Name</th>
                                            <th>Receiver</th>
                                            <th>Destination Country</th>
                                            <th>Shiping Charge</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while($row = $getList_booked->fetch_assoc()){
                                            
                                            if($row['status'] == 0){
                                                 ?>
                                        <tr>
                                            <td class="rclrm"><?php echo $row['custom_id']; ?></td>
                                            <td class="rclr"><?php echo $row['tracking_id']; ?></td>
                                            <td class="rclr"><?php echo $row['awb_no']; ?></td>
                                            <td class="rclr"><?php echo $row['s_name']; ?></td>
                                            <td class="rclr"><?php echo $row['r_name']; ?></td>
                                            <td class="rclr"><?php echo $row['country_name']; ?></td>
                                            <td class="rclr"><?php echo $row['g_shipment_charge']; ?></td>

                                            <td class="rbtn">
                                                <div class="">
                                                    <a href="agent_cons_update.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit" title="UPDATE CONSIGNMENT"><i class="fa fa-edit"></i></a>
                                                    <button id="<?php echo $row['tracking_id']; ?>" class="btn btn-xs btn-bricky tooltips rts deleteConsignment" data-placement="top" data-original-title="Remove" title="CANCEL CONSIGNMENT"><i class="fa fa-times"></i></button>
                                                </div>
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
                <div id="personal_body_delivered" style="display:none">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    LIST OF DELIVERED CONSIGNMENT
                                </div>                                
                            </div>
                            <div class="panel-body">
                            <div class="table-responsive">

                                <!--<?php if (isset($_REQUEST['msg'])) {?>
                                <div style="padding: 4px;width: 100%;margin: 0 auto;background: salmon">
                                    <?php echo $msg=$_REQUEST['msg']; ?>
                                </div><br>
                                <?php } ?>-->

                                <table id="consListTable_delivered" class="display table-striped table-bordered table-hover" style="width:100%">
                                    <thead style="font-size: 10px;color: orange">
                                        <tr>
                                            <th>TRACKING NO.</th>
                                            <th>DML TR. NO.</th>
                                            <th>AWB No</th>
                                            <th>Sender Name</th>
                                            <th>Receiver</th>
                                            <th>Destination Country</th>
                                            <th>Shiping Charge</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while($row = $getConsignmentList_delivered->fetch_assoc()){
                                            
                                            if($row['status'] == 3){
                                                 ?>
                                        <tr>
                                            <td class="rclrm"><?php echo $row['custom_id']; ?></td>
                                            <td class="rclr"><?php echo $row['tracking_id']; ?></td>
                                            <td class="rclr"><?php echo $row['awb_no']; ?></td>
                                            <td class="rclr"><?php echo $row['s_name']; ?></td>
                                            <td class="rclr"><?php echo $row['r_name']; ?></td>
                                            <td class="rclr"><?php echo $row['country_name']; ?></td>
                                            <td class="rclr"><?php echo $row['g_shipment_charge']; ?></td>

                                            <td class="rbtn">
                                                Delivered
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
                <div id="personal_body_deleted" style="display:none">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    LIST OF CANCELED CONSIGNMENT
                                </div>                                
                            </div>
                            <div class="panel-body">
                            <div class="table-responsive">

                                <!--<?php if (isset($_REQUEST['msg'])) {?>
                                <div style="padding: 4px;width: 100%;margin: 0 auto;background: salmon">
                                    <?php echo $msg=$_REQUEST['msg']; ?>
                                </div><br>
                                <?php } ?>-->

                                <table id="consListTable_deleted" class="display table-striped table-bordered table-hover" style="width:100%">
                                    <thead style="font-size: 10px;color: orange">
                                        <tr>
                                            <th>TRACKING NO.</th>
                                            <th>DML TR. NO.</th>
                                            <th>AWB No</th>
                                            <th>Sender Name</th>
                                            <th>Receiver</th>
                                            <th>Destination Country</th>
                                            <th>Shiping Charge</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while($row = $getList_deleted->fetch_assoc()){
                                            
                                            if($row['status'] == 0){
                                                 ?>
                                        <tr>
                                            <td class="rclrm"><?php echo $row['custom_id']; ?></td>
                                            <td class="rclr"><?php echo $row['tracking_id']; ?></td>
                                            <td class="rclr"><?php echo $row['awb_no']; ?></td>
                                            <td class="rclr"><?php echo $row['s_name']; ?></td>
                                            <td class="rclr"><?php echo $row['r_name']; ?></td>
                                            <td class="rclr"><?php echo $row['country_name']; ?></td>
                                            <td class="rclr"><?php echo $row['g_shipment_charge']; ?></td>

                                            <td class="rbtn">
                                                <div class="">
                                                    <a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit" title="UPDATE CONSIGNMENT"><i class="fa fa-edit"></i></a>
                                                    <button id="<?php echo $row['tracking_id']; ?>" class="btn btn-xs btn-green tooltips rts undoDeleteConsignment"  data-placement="top" data-original-title="Remove" title="UNDO DELETE" >UNDO</button>
                                                </div>
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
            <!-- Normal Bookimn Part End -->
            </div>
            <!-- End View Consignment Area -->
        </div>
    </div>

<?php 
include('footer.php');
?>
