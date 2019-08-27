<?php 
include('includes/header.php'); 

?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->


            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            Set DML Zone
                        </div>

                        <div class="panel-body">
                            <form action="" id="dml_zone">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Select Zone</label>
                                            <div class="country_form">
                                                <select name="dml_zone_id" id="dml_zone_id" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                                   <option value="">--</option>
                                                    <?php 
                                                        $zoneSql = "SELECT * FROM tbl_route WHERE status='1' ORDER BY route_code ASC";
                                                        $zoneReslut = $db->link->query($zoneSql);

                                                        while($zoneRow = $zoneReslut->fetch_assoc()){
                                                            
            
                                                            ?>
                                                    <option value="<?php echo $zoneRow['route_code']; ?>"><?php echo $zoneRow['route_code']; ?></option>
                                                    <?php
                                                        }
                                                        ?>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Select Country</label>
                                            <select name="dml_country_tag" id="dml_country_tag" class="form-control " data-show-subtext="true" data-live-search="true" required>
                                                <option value="">--</option>
                                                       <?php 
                                                        $zoneSql = "SELECT * FROM tbl_country WHERE status='1' ORDER BY country_name ASC";
                                                
                                                        
                                                        $zoneReslut = $db->link->query($zoneSql);

                                                        while($zoneRow = $zoneReslut->fetch_assoc()){
                                                            $matchTag = $zoneRow['country_tag'];
                                                            $query_country = "SELECT country_tag FROM  dml_zone WHERE country_tag='$matchTag'";
                                                            $result_country = $db->link->query($query_country);
                                                            $row_country = $result_country->fetch_row();
                                                            if($row_country[0] != $zoneRow['country_tag']){
                                                                ?>
                                                <option value="<?php echo $zoneRow['country_tag']; ?>"><?php echo $zoneRow['country_name']; ?></option>
                                                <?php
                                                            }
                                                            
                                                        }
                                                        ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <lable>Selected Country</lable>
                                            <div style="margin-top: 5px;" class="">
                                                <div id="selected_country">
                                                   
                                                    <!--<div class="row">
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="country[]" readonly>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <a href="#" class="btn btn-sm btn-warning">DELETE</a>
                                                        </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-warning btn-block">SUBMIT</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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


<?php 
include('includes/footer.php');
?>
