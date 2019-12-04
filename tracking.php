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
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Tracking Info
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <form class="" id="awn_form">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dml">DML AWB No.:</label>
                                                    <input type="text" class="form-control" id="dml" placeholder="Enter DML AWN" name="dml" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="org">LINK AWB No.:</label>
                                                    <input type="text" class="form-control" id="org" placeholder="Enter ORG AWN" name="org">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="principal">SELECT:</label>
                                                    <select class="form-control" name="principal" id="principal" required>
                                                        <option value="">--</option>
                                                        <option value="DHL">DHL</option>
                                                        <option value="FEDEX">FEDEX</option>
                                                        <option value="ARAMEX">ARAMEX</option>
                                                        <option value="FIRSTFLIGHT">FIRST FLIGHT</option>
                                                        <option value="NICEEXPRESS">NICE EXPRESS</option>
                                                        <option value="DPEX">DPEX</option>
                                                        <option value="DPD">DPD</option>
                                                        <option value="SKYNET">SKYNET</option>
                                                        <option value="OCS">OCS</option>
                                                        <option value="BLUEDART">BLUE DART</option>
                                                        <option value="TNT">TNT</option>
                                                        <option value="SF">SF EXPRESS</option>
                                                        <option value="AIRBORNE">ELITE AIR BORNE</option>
                                                        <option value="UPS">UPS</option>
                                                        <option value="GULF">GULF WORLDWIDE EXPRESS</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="shipper_name">SHIPPER NAME</label>
                                                    <input type="text" class="form-control" id="shipper_name" placeholder="SHIPPER NAME" name="shipper_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="origin">Origin</label>
                                                    <input type="text" class="form-control" id="origin" placeholder="Origin" name="origin" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="destination">Destination</label>
                                                    <!--<input type="text" class="form-control" id="destination" placeholder="Destination" name="destination" required>-->
                                                    <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="destination" id="destination" required>
                                                        <option value="">--</option>
                                                        <?php
                                                        $sql = "SELECT * FROM tbl_country";
                                                        $query = $db->link->query($sql);
                                                        if($query->num_rows > 0){
                                                            while($row = $query->fetch_assoc()){
                                                                // $name = $row['country_name'];
                                                                ?>
                                                            <option value="<?php echo $row['country_name'];?>"><?php echo $row['country_name'];?></option>
                                                            <?php
                                                            }
                                                        }
                                                        
                                                        ?>
                                                        <!--<option value="ALB"></option>-->
                                                        <!--<option value="DZ">Algeria</option>-->
                                                        <!--<option value="DPEX">DPEX</option>-->
                                                        <!--<option value="DPD">DPD</option>-->
                                                        <!--<option value="SKYNET">SKYNET</option>-->
                                                        <!--<option value="OCS">OCS</option>-->
                                                        <!--<option value="BLUEDART">BLUE DART</option>-->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="consignee_name">Consignee Name</label>
                                                    <input type="text" class="form-control" id="consignee_name" placeholder="Consignee Name" name="consignee_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="pcs">Pcs</label>
                                                    <input type="number" min="1" class="form-control" id="pcs" placeholder="Pcs" name="pcs" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ship_content">Ship Content</label>
                                                    <select type="text" class="form-control" id="ship_content" placeholder="Ship Content" name="ship_content" required>
                                                        <option value="">--</option>
                                                        <option value="DOX">DOX</option>
                                                        <option value="SPX">SPX</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="booking_date">Booking Date</label>
                                                    <input type="date" class="form-control" id="booking_date" placeholder="Booking Date" name="booking_date" value="<?php echo date('Y-m-d'); ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning btn-block">Submit</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
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
                                                        <th style="width: 500px;">Action</th>
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
                                                        <td><button class="btn btn-sm btn-warning edit_btn" id="edit_btn_<?php echo $row['dml_awn']; ?>" onclick="edit_track(event)" data-toggle="modal" data-target="#myModal"><span class="fa fa-pencil-square-o"></span></button> <button id="dlt_dml_<?php echo $row['dml_awn']; ?>" class="btn btn-sm btn-danger dlt_cls" onclick="dlt_item(event)"><span class="glyphicon glyphicon-trash"></span></button> <a class="btn btn-sm btn-info" target="_blank" href="track/index.php?awn=<?php echo $row['dml_awn']; ?>"><i class="glyphicon glyphicon-new-window"></i></a></td>
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
                    <h4 class="modal-title">Edit Tracking Info</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <form class="" id="update_awn_form">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dml">DML AWB No.:</label>
                                            <input type="hidden" name="up_id" id="up_id">
                                            <input type="text" class="form-control" id="up_dml" placeholder="Enter DML AWN" name="up_dml" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="org">LINK AWB No.:</label>
                                            <input type="text" class="form-control" id="up_org" placeholder="Enter ORG AWN" name="up_org">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="principal">SELECT:</label>
                                            <select class="form-control" name="up_principal" id="up_principal" required>
                                                <option value="">--</option>
                                                <option value="DHL">DHL</option>
                                                <option value="FEDEX">FEDEX</option>
                                                <option value="ARAMEX">ARAMEX</option>
                                                <option value="FIRSTFLIGHT">FIRST FLIGHT</option>
                                                <option value="NICEEXPRESS">NICE EXPRESS</option>
                                                <option value="DPEX">DPEX</option>
                                                <option value="DPD">DPD</option>
                                                <option value="SKYNET">SKYNET</option>
                                                <option value="OCS">OCS</option>
                                                <option value="BLUEDART">BLUE DART</option>
                                                <option value="TNT">TNT</option>
                                                <option value="SF">SF EXPRESS</option>
                                                <option value="AIRBORNE">ELITE AIR BORNE</option>
                                                <option value="UPS">UPS</option>
                                                <option value="GULF">GULF WORLDWIDE EXPRESS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="shipper_name">SHIPPER NAME</label>
                                            <input type="text" class="form-control" id="up_shipper_name" placeholder="SHIPPER NAME" name="up_shipper_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="origin">Origin</label>
                                            <input type="text" class="form-control" id="up_origin" placeholder="Origin" name="up_origin" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="destination">Destination</label>
                                            <!--<input type="text" class="form-control" id="destination" placeholder="Destination" name="destination" required>-->
                                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="up_destination" id="up_destination" required>
                                                <option value="">--</option>
                                                <?php
                                                $sql = "SELECT * FROM tbl_country";
                                                $query = $db->link->query($sql);
                                                if($query->num_rows > 0){
                                                    while($row = $query->fetch_assoc()){
                                                        // $name = $row['country_name'];
                                                        ?>
                                                                <option value="<?php echo $row['country_name'];?>"><?php echo $row['country_name'];?></option>
                                                                <?php
                                                    }
                                                }
                                    
                                                ?>
                                                <!--<option value="ALB"></option>-->
                                                <!--<option value="DZ">Algeria</option>-->
                                                <!--<option value="DPEX">DPEX</option>-->
                                                <!--<option value="DPD">DPD</option>-->
                                                <!--<option value="SKYNET">SKYNET</option>-->
                                                <!--<option value="OCS">OCS</option>-->
                                                <!--<option value="BLUEDART">BLUE DART</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="consignee_name">Consignee Name</label>
                                            <input type="text" class="form-control" id="up_consignee_name" placeholder="Consignee Name" name="up_consignee_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pcs">Pcs</label>
                                            <input type="number" min="1" class="form-control" id="up_pcs" placeholder="Pcs" name="up_pcs" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ship_content">Ship Content</label>
                                            <select type="text" class="form-control" id="up_ship_content" placeholder="Ship Content" name="up_ship_content" required>
                                                <option value="">--</option>
                                                <option value="DOX">DOX</option>
                                                <option value="SPX">SPX</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="booking_date">Booking Date</label>
                                            <input type="date" class="form-control" id="up_booking_date" placeholder="Booking Date" name="up_booking_date" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning btn-block">Submit</button>
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

<?php 
include('includes/footer.php');
?>

<script src="scripts/tracking.js"></script>