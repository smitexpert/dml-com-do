<?php 
include('includes/extra-page-header.php'); 


if(isset($_GET['client_id'])){
    $client_id = $_GET['client_id'];
    $query = "SELECT * FROM  corporate_clients WHERE id='$client_id'";
    $result = $db->link->query($query);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $company_name = $row['company_name'];
            $corporate_client_email = $row['email'];
        }
    }else{
        header('location: corporate_client_price.php');
    }

}else{
    header('location: corporate_client_price.php');
}
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
                            Set Special Price For : <?php echo  $company_name; ?>
                        </div>

                        <div class="panel-body">
                            <form action="" id="corporate_client_price" method="post">
                               <input type="hidden" name="client_price_id" id="client_price_id" value="<?php echo $corporate_client_email; ?>">
                                <div class="row">
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Select Country</label>
                                            <div class="country_form">
                                               <input type="hidden" name="country" value="0">
                                                <select name="client_zone_id" id="client_zone_id" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                                    <option value="">--</option>
                                                    <?php 
                                                          $zoneSql = "SELECT * FROM tbl_country ORDER BY country_name ASC";
    
    
                                                          $zoneReslut = $db->link->query($zoneSql);
    


                                                          while($zoneRow = $zoneReslut->fetch_assoc()){
                                                              
                                                              $zone_row = $zoneRow['country_tag'];
                                                              $ret = 1;
                                                              
                                                            $checkZoneIdP = "SELECT DISTINCT country_tag FROM corporate_client_special_rate WHERE corporate_client_email='$corporate_client_email' AND country_tag='$zone_row' AND product_type='P'";
                                                            $resultZoneIdP = $db->link->query($checkZoneIdP);
                                                            if($resultZoneIdP->num_rows > 0){
                                                                $ret = $ret+1;
                                                            }
                                                              
                                                            $checkZoneIdD = "SELECT DISTINCT country_tag FROM corporate_client_special_rate WHERE corporate_client_email='$corporate_client_email' AND country_tag='$zone_row' AND product_type='D'";
                                                            $resultZoneIdD = $db->link->query($checkZoneIdD);
                                                            if($resultZoneIdD->num_rows > 0){
                                                                $ret = $ret+1;
                                                            }
                                                              
                                                              if($ret == 3){
                                                                  continue;
                                                              }else{
                                                                   ?>
                                                    <option value="<?php echo $zoneRow['country_tag']; ?>"><?php echo $zoneRow['country_name']; ?></option>
                                                    <?php
                                                              }

                                                    
                                                          }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="client_good_type">Select Type</label>
                                            <select name="client_good_type" id="client_good_type" class="form-control" required>
                                                <option value="">--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="client_good_type">Start Date</label>
                                            <input type="text" class="form-control" id="startdatepicker" name="startdatepicker" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="client_good_type">End Date</label>
                                            <input type="text" class="form-control" id="enddatepicker" name="enddatepicker" required>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <?php
                                    $sqlW = "SELECT * FROM tbl_weight WHERE status='1'";
                                    $queryW = $db->link->query($sqlW);
                                    if($queryW->num_rows > 0){
                                        while($rowW = $queryW->fetch_assoc()){
                                    ?>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $rowW['weight']; ?></span>
                                            <input type="hidden" value="<?php echo $rowW['weight']; ?>" name="weight[]">
                                            <input type="text" class="form-control" name="price[]" placeholder="0">
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-warning btn-block">SUBMIT</button>
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
