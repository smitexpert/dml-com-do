<?php ob_start(); ?>

<?php 
include('includes/extra-page-header.php');
include('ajax/tracking/track_url.php');
?>
<style>
    .modal {
        width: 750px;
        margin-left: -375px;;
    }
</style>

		<!-- start: MAIN CONTAINER -->
<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>
<input type="hidden" id="local_ip">
<div class="main-content">
        <div class="container"><br><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tracking Table
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>DML AWN</th>
                                                        <th>ORG. AWN</th>
                                                        <th>SERVICE</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                        
                                                        $sql = "SELECT * FROM test_track ORDER BY id DESC";
                                                        $query = $db->link->query($sql);
                                                        if($query->num_rows > 0){
                                                            while($row = $query->fetch_assoc()){
                                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['dml_awn']; ?></td>
                                                        <td onclick="editOrg(event)"><?php echo $row['org_awn']; ?></td>
                                                        <td><?php echo $row['principal']; ?></td>
                                                        <td style="text-align:right;">
                                                            <button class="btn btn-sm btn-warning edit_btn" id="edit_btn_<?php echo $row['dml_awn']; ?>" onclick="add_track_up(event)" data-toggle="modal" data-target="#myModal"><span class="fa fa-pencil-square-o"></span></button>
                                                            <button class="btn btn-sm btn-warning select_btn" id="select_btn_<?php echo $row['dml_awn']; ?>" onclick="select_track_up(event)" data-toggle="modal" data-target="#statusSelectModal"><span class="fa fa-bookmark-o"></span></button>
                                                            <button id="dlt_dml_<?php echo $row['dml_awn']; ?>" class="btn btn-sm btn-danger dlt_cls" onclick="get_track_up(event)" data-toggle="modal" data-target="#viewUpdateModal"><span class="fa fa-search"></span></button>
                                                            <a class="btn btn-sm btn-info" target="_blank" href="track/index.php?awn=<?php echo $row['dml_awn']; ?>"><i class="glyphicon glyphicon-new-window"></i></a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Tracking Update</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <form class="" id="add_tracking_update_from">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="hidden" id="dml_awn" name="dml_awn">
                                        <input id="date" type="date" value="<?php echo date('Y-m-d') ?>" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="time">Time</label>
                                        <input name="time" id="time" type="time" value="<?php echo date('H:i') ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input name="location" id="location" type="text" value="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="activities">Activities</label>
                                        <input name="activities" id="activities" type="text" value="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-warning btn-block">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="statusSelectModal" class="modal fade" role="dialog">
    <div class="">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Tracking Update</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <form class="" id="add_static_tracking_update_from">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="hidden" id="sel_dml_awn" name="dml_awn">
                                        <input id="date" type="date" value="<?php echo date('Y-m-d') ?>" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="time">Time</label>
                                        <input name="time" id="time" type="time" value="<?php echo date('H:i') ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input name="location" id="location" type="text" value="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="activities">Activities</label>
                                        <select class="form-control" name="activities" id="activities" required>
                                            <option value="">--</option>
                                            <option value="Shipment Arrived">Shipment Arrived</option>
                                            <option value="Shipment Arrived at Origin Scan">Shipment Arrived at Origin Scan</option>
                                            <option value="Shipment Out for Delivery">Shipment Out for Delivery</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Ready For Loading">Ready For Loading</option>
                                            <option value="Consignment Received at Transit Point">Consignment Received at Transit Point</option>
                                            <option value="Shipment Received at Reparation Facility">Shipment Received at reparation facility</option>  
                                            <option value="Delivery Address Incorrect/ Incomplete / Missing">Delivery Address Incorrect/ Incomplete / Missing </option>
                                            <option value="Change of Delivery Address">Change of Delivery Address</option>
                                            <option value="Unable to Locate Consignee Address">Unable to Locate Consignee Address </option>
                                            <option value="Customs Inspection"> Customs Inspection</option>
                                            <option value="Clearance Delay"> Clearance Delay</option>
                                            <option value="Delay for Bad Weather">Delay for Bad Weather</option>
                                            <option value="Shipment Held for Customer Pickup">Shipment Held for Customer Pickup</option>
                                            <option value="Shipment Destroyed by Customer Request">Shipment Destroyed by Customer Request</option>
                                            <option value="Shipment Under Custom Processing">Shipment Under Custom Processing</option>
                                            <option value="Shipment Picked Up">Shipment Picked Up</option>
                                            <option value="Shipment Departed Dhaka">Shipment Departed Dhaka</option>
                                            <option value="Import Received">Import Received </option>
                                            <option value="Shipment Billing Information Received">Shipment Billing Information Received</option>
                                            <option value="Shipment Information Received">Shipment Information Received</option>
                                            <option value="Schedule for Arrive"> Schedule for Arrive</option>
                                            <option value="Shipment Released From Customs">Shipment Released From Customs</option>
                                            <option value="Document Delivered to Consignee/Broker for Clearance">Document Delivered to Consignee/Broker for Clearance</option>
                                            <option value="Consignee address and contact no incorrect">Consignee address and contact no incorrect</option>
                                            <option value="Delivery Attempt, Consignee Not at Home">Delivery Attempt, Consignee Not at Home</option>
                                            <option value="Consignee's Premises Closed">Consignee's Premises Closed</option>
                                            <option value="Recipient Refused Delivery">Recipient Refused Delivery</option>
                                            <option value="Awaiting pickup by Recipient Requested">Awaiting pickup by Recipient Requested</option>
                                            <option value="Shipment Return to Shipper">Shipment Return to Shipper</option>
                                            <option value="Receiver on Holiday"> Receiver on Holiday</option>    
                                            <option value="Shipment Received Damaged">Shipment Received Damaged</option>
                                            <option value="Driver Unable to Delivery Due to Time Restriction">Driver Unable to Delivery Due to Time Restriction</option>
                                            <option value="Shipment Held at Customs, Awaiting Clearance Instruction from Receiver">Shipment Held at Customs, Awaiting Clearance Instruction from Receiver</option>
                                            <option value="Shipment Hold for Payment Duty /Tax">Shipment Hold for Payment Duty/Tax</option>
                                            <option value="Consignee Refused to Pay Freight Charge">Consignee Refused to Pay Freight Charge</option>
                                            <option value="Shipment Return to Origin">Shipment Return to Origin </option>
                                            <option value="Shipment Off-load due to Space Problem">Shipment Off-load due to Space Problem</option>
                                            <option value="Shipment Missing">Shipment Missing </option>
                                            <option value="Shipment Arrived at Wrong Facility Send to Correct Destination">Shipment Arrived at Wrong Facility Send to Correct Destination</option>
                                            <option value="Shipment Departed from Origin to Dhaka"> Shipment Departed from Origin to Dhaka</option>
                                            <option value="Posted By Mail- No POD"> Posted By Mail- No POD</option>
                                            <option value="Posted By Mail-POD Available on Request"> Posted By Mail-POD Available on Request </option>
                                            <option value="Shipment Held at Customs due to Wrong Declaration">Shipment Held at Customs due to Wrong Declaration </option>
                                            <option value="Consignee Refuse to Pay Duty / Tax">Consignee Refuse to Pay Duty/Tax</option>
                                            <option value="Connecting Flight Delay">Connecting Flight Delay </option>
                                            <option value="Delivery Delay due to Bad Weather">Delivery Delay due to Bad Weather</option>
                                            <option value="Delivery Delay due to Car Accident / Traffic Jam">Delivery Delay due to Car Accident / Traffic Jam </option>
                                            <option value="Shipment Forwarded Chittagong To Dhaka">Shipment Forwarded Chittagong To Dhaka</option>
                                            <option value="Shipment Forwarded Dhaka to Dubai">Shipment Forwarded Dhaka to Dubai</option>
                                            <option value="Shipment Forwarded Dhaka to Singapore">Shipment Forwarded Dhaka to Singapore</option>
                                            <option value="Shipment Forwarded Dhaka to Hong Kong">Shipment Forwarded Dhaka to Hong Kong</option>
                                            <option value="Shipment Forwarded Dhaka to UK">Shipment Forwarded Dhaka to UK </option>  
                                            <option value="Shipment Forwarded Dhaka to Korea">Shipment Forwarded Dhaka to Korea</option>
                                            <option value="Shipment Forwarded Dhaka to Indonesia">Shipment Forwarded Dhaka to Indonesia</option>
                                            <option value="Shipment Forwarded Dhaka to Taiwan">Shipment Forwarded Dhaka to Taiwan</option>
                                            <option value="Shipment Forwarded Dhaka to Vietnam">Shipment Forwarded Dhaka to Vietnam</option>
                                            <option value="Shipment Forwarded Dhaka to Destination">Shipment Forwarded Dhaka to Destination</option>  
                                            <option value="Shipment In transit to Destination">Shipment In transit to Destination</option>
                                            <option value="Shipment In Transit">Shipment In Transit </option>
                                            <option value="Consignee Moved/Shifted - Need New Address of Consignee">Consignee Moved/Shifted - Need New Address of Consignee</option>
                                            <option value="Contact Number No Response/Wrong - Need Alternate Phone No">Contact Number No Response/Wrong - Need Alternate Phone No</option>
                                            <option value="Company/House Closed - Delivery Will Attempt Next Working Day">Company/House Closed - Delivery Will Attempt Next Working Day</option>
                                            <option value="Schedule For Delivery">Schedule For Delivery </option>
                                            <option value="Shipment On Forwarded for Delivery">Shipment On Forwarded for Delivery </option>
                                            <option value="Delivery Address Incorrect - Need Correct Address">Delivery Address Incorrect - Need Correct Address</option>  
                                            <option value="Shipment Arrived at Wrong Facility Sent to Correct Destination">Shipment Arrived at Wrong Facility Sent to Correct Destination</option>
                                            <option value="Awaiting Pickup by Recipient Requested">Awaiting Pickup by Recipient Requested </option>
                                            <option value="Receiver on Leave">Receiver on Leave </option>  
                                            <option value="Shipment Hold - Required City Name/ Zip Code/Tel No">Shipment Hold - Required City Name/ Zip Code/Tel No</option>
                                            <option value="Shipment in Warehouse">Shipment in Warehouse </option>
                                            <option value="Bag Found, Processing for Connect.....">Bag Found, Processing for Connect.....</option>
                                            <option value="Delivery Delay Due to Strike">Delivery Delay Due to Strike </option>
                                            <option value="Delivery Delay due to Heavy Rain">Delivery Delay due to Heavy Rain</option>
                                            <option value="Consignment Re-route to Destination">Consignment Re-route to Destination</option>
                                            <option value="Please Contact Local Office">Please Contact Local Office</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-warning btn-block">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="viewUpdateModal" class="modal fade" role="dialog">
    <div class="">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Tracking Update</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Location</th>
                                            <th>Activities</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="view_track_status">
                                        <tr>
                                            <td>12/06/08</td>
                                            <td>12:15 AM</td>
                                            <td>Dhaka BD</td>
                                            <td>Picked Up</td>
                                            <td><button class="btn btn-danger">DEL</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

<script src="scripts/up_tracking.js"></script>