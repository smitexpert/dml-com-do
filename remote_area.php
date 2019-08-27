<?php
include('includes/header.php');
	// if (isset($_POST['submit'])) {
	//    $insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);
	// }
?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <!-- CLIENT PRICE SEARCH PORTION STARTS -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group connected-group" style="margin-left: -20px;">
                                    <label class="control-label" style="font-size: 16px">Select Principal<span class="symbol required"></span>
                                    </label>
                                    <select name="cour_company" required id="cour_company" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                        <option value="">--</option>
                                        <?php
			$selectclientname = "SELECT * FROM principals_name";
                                        $query = $db->link->query($selectclientname);
                                        
                                        while($row = $query->fetch_assoc()){
                                            ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo  $row['principal_name']; ?></option>
                                            <?php
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br>
                                <div class="nav_view" style="display: none;">
                                    <ul class="nav nav-pills">
                                        <li><a id="setremotearea" href="#">SET REMOTE AREA</a></li>
                                        <li><a id="viewremotearea" href="#">VIEW REMOTE AREA</a></li>
                                        <li><a id="editremotearea" href="#">SET EXTRA COST</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <br>
            <div id="remote_body">
                <div id="set_remote_body" class="remote_view" style="display: none;">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="panel panel-default">

                                <div class="panel-heading">

                                    <i class="fa fa-external-link-square"></i>

                                    SET REMOTE AREA

                                </div>

                                <div class="panel-body">
                                    <div class="input-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Country</label>
                                                    <select name="remote_country" id="remote_country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                        <option value="">--</option>
                                                        <?php 
                                                        $zoneSql = "SELECT * FROM tbl_country WHERE status='1' ORDER BY country_name ASC";
                                                
                                                        
                                                        $zoneReslut = $db->link->query($zoneSql);

                                                        while($zoneRow = $zoneReslut->fetch_assoc()){
                                                             ?>
                                                        <option value="<?php echo $zoneRow['country_tag']; ?>"><?php echo $zoneRow['country_name']; ?></option>
                                                        <?php
                                                            
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label for="">ZIP/POSTAL CODE</label>
                                                    <input type="text" name="remote_zip_code" id="remote_zip_code" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label for="">CITY</label>
                                                    <input type="text" name="remote_city" id="remote_city" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <br>
                                                <button id="add_remote_area" class="btn btn-sm btn-warning btn-block">ADD</button>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <br>

                                    <form action="" id="remoteareaform" autocomplete="off">
                                        <div class="input-list">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Country</th>
                                                                <th>ZIP/POSTEL CODE</th>
                                                                <th>CITY</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="remote-list">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button id="remote_submit" class="btn btn-md btn-warning btn-block" disabled>SUBMIT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div id="view_remote_body" class="remote_view" style="display: none;">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="panel panel-default">

                                <div class="panel-heading">

                                    <i class="fa fa-external-link-square"></i>

                                    VIEW REMOTE AREA

                                </div>

                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Country</th>
                                                <th>ZIP/POSTEL CODE </th>
                                                <th>CITY</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="remote_price_list">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div id="edit_remote_body" class="remote_view" style="display: none;">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="panel panel-default">

                                <div class="panel-heading">

                                    <i class="fa fa-external-link-square"></i>

                                    SET EXTRA COST

                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">SET EXTRA COST</label>
                                                <input type="text" class="form-control" id="extracost" name="extracost">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <br>
                                            <button class="btn btn-md btn-block btn-warning" id="extracostbtn">SET</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>

            <br><br>

        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
