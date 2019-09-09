<?php 
include('includes/extra-page-header.php'); 


if(isset($_GET['agent_id'])){
    $agent_id = $_GET['agent_id'];
    $query = "SELECT * FROM  agent_clients WHERE id='$agent_id'";
    $result = $db->link->query($query);   
    

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $company_name = $row['company_name'];
            $agent_client_email = $row['email'];
        }
    }else{
        header('location: agent_client_special_price.php');
    }

}else{
    header('location: agent_client_special_price.php');
}

function getPrincipalName($id){
    $db = new Database();
    $principalId = $id;
    $query = "SELECT * FROM  principals_name WHERE id='$principalId'";
    $result = $db->link->query($query);
    
     if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $principalName = $row['principal_name'];
        }
    }
    
    return $principalName;
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
            <div class="loading-img">
               <img src="img/loading.gif" alt="Plaese Wait">                
            </div>


            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            UPDATE SPECIAL PRICE FOR : <?php echo  $company_name; ?>
                        </div>

                        <div class="panel-body">
                            <form action="" id="agent_client_price" method="post">
                               <input type="hidden" name="agent_email" id="agent_email" value="<?php echo $agent_client_email; ?>">
                                <div class="row">
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Select Principal</label>
                                            <div class="country_form">
                                               <input type="hidden" name="primcipal" value="0">
                                                <select name="agent_principal" id="agent_principal" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                                    <option value="">--</option>
                                                    <?php 
                                                          $zoneSql = "SELECT DISTINCT principal_id FROM agent_client_price WHERE agent_client_email = '$agent_client_email'";   
    
                                                          $zoneReslut = $db->link->query($zoneSql); 


                                                          while($zoneRow = $zoneReslut->fetch_assoc()){
                                                    ?>
                                                    <option value="<?php echo $zoneRow['principal_id']; ?>"><?php echo getPrincipalName($zoneRow['principal_id']); ?></option>
                                                    <?php
                                                              }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Select Country</label>
                                            <div class="country_form">
                                               <input type="hidden" name="country" value="0">
                                                <select name="client_country_update" id="client_country_update" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                                    <option value="">--</option>
                                                    

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="agent_goods_type">Select Type</label>
                                            <select name="agent_goods_type" id="agent_goods_type" class="form-control" required>
                                                <option value="">--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="client_good_type">Start Date</label>
                                            <input type="text" class="form-control" id="startdatepicker" name="startdatepicker" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="client_good_type">End Date</label>
                                            <input type="text" class="form-control" id="enddatepicker" name="enddatepicker" required>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <?php
                                    $sqlW = "SELECT * FROM tbl_weight WHERE status='1' ORDER BY weight ASC";
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
                                    </div 
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
