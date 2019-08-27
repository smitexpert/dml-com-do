<?php 
include('includes/extra-page-header.php');


if(Session::get('role') != 1){
    
    $getUrl = '/corporate_client_price.php';

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
        <div class="container"><br><br><br><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>VIEW CORPORATE CLIENT PRICE OF: <?php echo $company_name; ?>
                        </div>
                        <div class="panel-body">
                            
                            
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="form-group connected-group">
                                        <label class="control-label">Select Zone/Conuntry
                                        </label>
                                        <input type="hidden" name="client_email" id="client_email" value="<?php echo $corporate_client_email ?>">
                                        <select name="client_zone" required id="client_zone" class="form-control">
                                            <option value="">--</option>
                                            <?php
                                            $zoneQuery = "SELECT DISTINCT zone FROM corporate_client_price WHERE corporate_client_email='$corporate_client_email'";
                                            $zoneResult = $db->link->query($zoneQuery);
                                            while($zoneRow = $zoneResult->fetch_assoc()){
                                                ?>
                                                <option value="<?php echo $zoneRow["zone"]; ?>"><?php echo $zoneRow["zone"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group connected-group">
                                        <label class="control-label">Select Weight
                                        </label>
                                        <select name="client_zone_weight" id="client_zone_weight" class="form-control" required>
                                            <option value="">--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group connected-group">
                                        <label class="control-label">Select Types
                                        </label>
                                        <select name="client_good_type" id="client_good_type" class="form-control" required>
                                            <option value="">--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
                <div class="col-md-1"></div>
            </div><br>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="#">
                        <!--<div style="font-weight:bold; padding-bottom:5px;">Country List For: <span style="font-style:italic" id='principalName'></span> &amp; Zone: <span style="font-style:italic" id='zoneCode'></span></div>-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-bordered table-hover" id="view_client_price" class="center">
                        <thead>
                            <tr class="center">
                                <th class="center">#</th>
                                <td>Parcel/Document</td>
                                <td>Weight</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tbody id="client_price_table">
                        
                        </tbody>
                    </table>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<?php 
include('includes/footer.php');
?>