<?php 

require __DIR__.'../lib/Session.php';
require __DIR__.'../lib/Database.php';

Session::checkSession();

$db = new Database;


	if(isset($_GET['principal_id'])){
        $principal_id = $_GET['principal_id'];
        $query = "SELECT * FROM  principals_name WHERE id='$principal_id'";
        $result = $db->link->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $principal_name = $row['principal_name'];
            }
        }else{
                    header('location: principal_settings.php');
        }
        
    }else{
        header('location: principal_settings.php');
    }
?>



            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            Set Principal Zone of : <?php echo  $principal_name; ?>
                        </div>

                        <div class="panel-body">
                            <form action="" id="principal_zone">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Select Zone</label>
                                            <div class="country_form">
                                               <input type="hidden" name="userId" value="<?php echo $_GET['principal_id']; ?>">
                                                <select name="zone_id" id="zone_id" class="form-control" data-show-subtext="true" data-live-search="true" required>
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
                                            <select name="p_z_c_tag" id="p_z_c_tag" class="form-control " data-show-subtext="true" data-live-search="true" required>
                                                <option value="">--</option>
                                                       <?php 
                                                        $zoneSql = "SELECT * FROM tbl_country WHERE status='1' ORDER BY country_name ASC";
                                                
                                                        
                                                        $zoneReslut = $db->link->query($zoneSql);

                                                        while($zoneRow = $zoneReslut->fetch_assoc()){
                                                            $matchTag = $zoneRow['country_tag'];
                                                            $query_country = "SELECT country_tag FROM  principal_zone WHERE principal_id='$principal_id' AND country_tag='$matchTag'";
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
                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>