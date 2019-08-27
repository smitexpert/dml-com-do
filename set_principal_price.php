<?php 
include('includes/extra-page-header.php'); 

if(Session::get('role') != 1){
    
    $getUrl = '/principal_settings.php';

    $usrMenuId = Session::get('adminId');

    $countMenu = "SELECT COUNT(id) FROM menu_$usrMenuId";

    $tmr = $db->link->query($countMenu);

    $row_menu = $tmr->fetch_row();

    $menuSession = Session::get('menus');

    $isUrlActive = false;

    for($i=0; $i<$row_menu[0]; $i++){
        $menuUrl = '/'.$menuSession[$i];
        if( $menuUrl == $getUrl ){
            $isUrlActive = true;
        }
    }

    if($getUrl != '/dashboard.php'){
        if($isUrlActive != true){
            header("location: dashboard.php");
        }
    }
}

if(isset($_GET['principal_id'])){
    $principal_id = $_GET['principal_id'];
    $query = "SELECT * FROM  principals_name WHERE id='$principal_id'";
    $result = $db->link->query($query);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $principal_name = $row['principal_name'];
            $based = $row['based'];
        }
    }else{
        header('location: principal_settings.php');
    }

}else{
    header('location: principal_settings.php');
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
                            Set Price For : <?php echo  $principal_name; ?>
                        </div>

                        <div class="panel-body">
                            <form action="" id="principal_price" method="post">
                               <input type="hidden" name="principal_price_id" id="principal_price_id" value="<?php echo $_GET['principal_id']; ?>">
                                <div class="row">
                                    <?php if($based == 1){ ?>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Select Zone</label>
                                            <div class="country_form">
                                               <input type="hidden" name="country" value="0">
                                                <select name="zone_id" id="zone_id" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                                    <option value="">--</option>
                                                    <?php 
                                                          $zoneSql = "SELECT DISTINCT zone FROM principal_zone WHERE principal_id='$principal_id' ORDER BY zone ASC";
    
    
                                                          $zoneReslut = $db->link->query($zoneSql);
    


                                                          while($zoneRow = $zoneReslut->fetch_assoc()){
                                                              
                                                              $zone_row = $zoneRow['zone'];
                                                              $ret = 1;
                                                              
                                                            $checkZoneIdP = "SELECT DISTINCT zone FROM principal_price WHERE principal_id='$principal_id' AND zone='$zone_row' AND goods_type='P'";
                                                            $resultZoneIdP = $db->link->query($checkZoneIdP);
                                                            if($resultZoneIdP->num_rows > 0){
                                                                $ret = $ret+1;
                                                            }
                                                              
                                                            $checkZoneIdD = "SELECT DISTINCT zone FROM principal_price WHERE principal_id='$principal_id' AND zone='$zone_row' AND goods_type='D'";
                                                            $resultZoneIdD = $db->link->query($checkZoneIdD);
                                                            if($resultZoneIdD->num_rows > 0){
                                                                $ret = $ret+1;
                                                            }
                                                              
                                                              if($ret == 3){
                                                                  continue;
                                                              }else{
                                                                   ?>
                                                    <option value="<?php echo $zoneRow['zone']; ?>"><?php echo $zoneRow['zone']; ?></option>
                                                    <?php
                                                              }

                                                    
                                                          }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Select Country</label>
                                            <input type="hidden" name="zone_id" value="0">
                                            <select name="country" id="country" class="form-control " data-show-subtext="true" data-live-search="true" required>
                                                <option value="">--</option>
                                                <?php 
    $zoneSql = "SELECT * FROM tbl_country WHERE status='1' ORDER BY country_name ASC";


    $zoneReslut = $db->link->query($zoneSql);

    while($zoneRow = $zoneReslut->fetch_assoc()){
        $matchTag = $zoneRow['country_tag'];
        $ret = 1;
        
        $checkZoneIdP = "SELECT DISTINCT country FROM principal_price WHERE principal_id='$principal_id' AND country='$matchTag' AND goods_type='P'";
        $resultZoneIdP = $db->link->query($checkZoneIdP);
        if($resultZoneIdP->num_rows > 0){
            $ret = $ret+1;
        }
        
        $checkZoneIdP = "SELECT DISTINCT country FROM principal_price WHERE principal_id='$principal_id' AND country='$matchTag' AND goods_type='D'";
        $resultZoneIdP = $db->link->query($checkZoneIdP);
        if($resultZoneIdP->num_rows > 0){
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

                                    <?php } ?>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="type">Select Type</label>
                                            <select name="good_type" id="type" class="form-control" required>
                                                <option value="">--</option>
                                            </select>
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
