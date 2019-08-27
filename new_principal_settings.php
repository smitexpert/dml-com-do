<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM  principals_name order by id desc";
    $selectcourcom = $Courcompanyset->selectcourComp($query);
?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group connected-group">
                        <label class="control-label" style="font-size: 16px">Select Principal<span class="symbol required"></span>
                        </label>
                        <select name="principalid" required id="principalid" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <option value="">--</option>
                            <?php 
																$select_principal = "SELECT * FROM principals_name ORDER BY dated";
   																 $query =  $db->link->query($select_principal);	
															if ($query) { while ($row=$query->fetch_assoc()) { ?>
                            <option id="principal_name" class="<?php echo $row['stuff_name']; ?>" value="<?php echo $row['id']; ?>"><?php echo  $row['principal_name']; ?></option>
                            <!-- <option data-subtext="<?php //echo $getclientname['client_name']; ?>" class="cl" value="<?php //echo $getclientname['client_id']; ?>"><?php //echo $getclientname['client_name']; ?></option> -->
                            <?php } }else{} ?>
                        </select>

                    </div>
                </div>
                <div class="col-md-9">
                    <br>
                    <div class="nav_view" style="display: none;">
                        <ul class="nav nav-pills">
                            <li><a id="setzone" href="#">SET ZONE</a></li>
                            <li><a id="viewzone" href="#">VIEW ZONE</a></li>
                            <li><a id="setprice" href="#">SET PRICE</a></li>
                            <li><a id="viewprice" href="#">VIEW PRICE</a></li>
                            <li><a id="updateprice" href="#">UPDATE PRICE</a></li>
                            <li><a id="editprincipal" href="#">UPDATE PRINCIPAL</a></li>
                        </ul>
                    </div>
                </div>
                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>
            <br>
            <div id="callback">
                <div id="setzoneview" style="display: none">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- start: FORM VALIDATION 1 PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Set Principal Zone of : <span id="setzoneviewprincipal">principal_name</span>
                                </div>

                                <div class="panel-body">
                                    <form action="" id="principal_zone">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Select Zone</label>
                                                    <div class="country_form">
                                                        <input type="hidden" id="userId" name="userId" value="">
                                                        <select name="zone_id" id="zone_id" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
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
                                                    <select name="p_z_c_tag" id="p_z_c_tag" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
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

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <br><label for=""></label>
                                                    <button type="button" class="btn btn-warning" id="zoneaddbtn">ADD</button>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                </div>
                <div id="viewzoneview" style="display: none">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- start: FORM VALIDATION 1 PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    View Principal Zone of : <span class="setzoneviewprincipal">principal_name</span>
                                </div>

                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group connected-group">
                                                <label class="control-label">Select Zone<span class="symbol required"></span>
                                                </label>
                                                <select name="zone_code" required id="zone_code" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                    <option value="">--</option>
                                                    <?php 
															$selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
																 $execroute =  $Courcompanyset->selectcourComp($selectroute);
														while ($findroute=$execroute->fetch_assoc()) { ?>
                                                    <option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
                                                    <?php }?>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group connected-group">
                                                <br>
                                                <button id="viewZone" style="margin-top: 3px;" type="button" class="btn btn-warning btn-block">VIEW</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="#">
                                                <div style="font-weight:bold; padding-bottom:5px;">Country List For: <span style="font-style:italic" id='principalName'></span> &amp; Zone: <span style="font-style:italic" id='zoneCode'></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-hover table-full-width" id="sample-table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="center">#</th>
                                                        <th class='center'>Country Name</th>
                                                        <th class='center'>Country Tag</th>
                                                        <th class='center'>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="zoneBody">

                                                </tbody>



                                            </table>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: FORM VALIDATION 1 PANEL -->
                    </div>
                </div>
                <div id="setpriceview" style="display: none">
                    <form action="" id="setpriceform">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- start: FORM VALIDATION 1 PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <i class="fa fa-external-link-square"></i>
                                        Set Principal Price of : <span class="setzoneviewprincipal">principal_name</span>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group connected-group">
                                                    <label class="control-label">Select Zone<span class="symbol required"></span>
                                                    </label>
                                                    <input type="hidden" id="setzoneprincipalid" name="setzoneprincipalid" value="">
                                                    <select name="zone_code_price" required id="zone_code_price" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                        <option value="">--</option>
                                                        <?php 
															$selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
																 $execroute =  $Courcompanyset->selectcourComp($selectroute);
														while ($findroute=$execroute->fetch_assoc()) { ?>
                                                        <option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
                                                        <?php }?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="#">
                                                    <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR DOCUMENT</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><?php echo '0.25 kg'; ?></span>
                                                            <input type="hidden" value="<?php echo 0.25; ?>" name="d_weight[]">
                                                            <input type="text" class="form-control" name="d_price[]" placeholder="0">
                                                        </div>
                                                    </div>
                                                    <?php
                                                
                                                
                                                
                                        for($i=0.50; $i<=3.00; $i+=0.50){
                                    ?>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><?php echo number_format($i, 2).' kg'; ?></span>
                                                            <input type="hidden" value="<?php echo $i; ?>" name="d_weight[]">
                                                            <input type="text" class="form-control" name="d_price[]" placeholder="0">
                                                        </div>
                                                    </div>
                                                    <?php
                                        }
                                    ?>


                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="#">
                                                    <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR PARCEL</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <?php
                                    $sqlW = "SELECT * FROM tbl_weight WHERE status='1' ORDER BY weight ASC";
                                    $queryW = $db->link->query($sqlW);
                                    if($queryW->num_rows > 0){
                                        while($rowW = $queryW->fetch_assoc()){
                                    ?>
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><?php echo $rowW['weight'].' kg'; ?></span>
                                                            <input type="hidden" value="<?php echo $rowW['weight']; ?>" name="p_weight[]">
                                                            <input type="text" class="form-control" name="p_price[]" placeholder="0">
                                                        </div>
                                                    </div>
                                                    <?php
                                        }
                                    }
                                    ?>


                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button id="submit_zone_price" type="submit" class="btn btn-lg btn-warning btn-block" disabled>SUBMIT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end: FORM VALIDATION 1 PANEL -->
                        </div>
                    </form>
                </div>
                <div id="viewpriceview" style="display: none">

                    <div id="viewpriceview-loading" style="display: none;">
                        <img src="img/loading.gif" alt="">
                    </div>
                    
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div id="showpricetable">
                                
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <div id="updatepriceview" style="display: none">
                    <form action="" id="updatepriceform">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- start: FORM VALIDATION 1 PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <i class="fa fa-external-link-square"></i>
                                        Update Principal Price of : <span class="setzoneviewprincipal">principal_name</span>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group connected-group">
                                                    <label class="control-label">Select Zone<span class="symbol required"></span>
                                                    </label>
                                                    <input type="hidden" id="upzoneprincipalid" name="upzoneprincipalid" value="">
                                                    <select name="zone_code_update" required id="zone_code_update" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                        <option value="">--</option>
                                                        <?php 
															$selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
																 $execroute =  $Courcompanyset->selectcourComp($selectroute);
														while ($findroute=$execroute->fetch_assoc()) { ?>
                                                        <option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
                                                        <?php }?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        
                                        <div class="loading-img" style="display: none;">
                                            <img src="img/loading.gif" alt="">
                                        </div>
                                        
                                        <div id="updatepricesection">
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end: FORM VALIDATION 1 PANEL -->
                        </div>
                    </form>
                </div>
                <div id="editprincipalview" style="display: none">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Update Principal: <span class="setzoneviewprincipal">principal_name</span>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="upPrincipal" action="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="usermail" class="control-label">
                                                                Zone/Country Based <span class="symbol required"></span>
                                                            </label>
                                                            <input type="hidden" id="upPrincipalId" name="upPrincipalId">
                                                            <input type="hidden" id="upPrincipalName" name="upPrincipalName">
                                                            <select name="upPrincipalBased" id="upPrincipalBased" class="form-control">
                                                                <option value="">--</option>
                                                                <option value="1">Zone Wise</option>
                                                                <option value="0">Country Wise</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="usermail" class="control-label">
                                                                Currency <span class="symbol required"></span>
                                                            </label>
                                                            <select name="upCurrency" id="upCurrency" class="form-control">
                                                                <option value="">--</option>
                                                                <?php
                                                
                                                                $result = $db->select("SELECT * FROM currency");
                                                                while($row = $result->fetch_assoc()){
                                                                    ?>

                                                                <option value="<?php echo $row['currency_name']; ?>"><?php echo $row['currency_name']; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Fuel Cost %</label>
                                                            <input type="text" class="form-control" name="upFuelCost" id="upFuelCost">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Airlines Cost (USD)</label>
                                                            <input type="text" class="form-control" name="upAirlinesCost" id="upAirlinesCost">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-md btn-warning btn-block">UPDATE</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
    <!-- end: PAGE -->


</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        UIElements.init();


        // data table with pdf csv excel print copy
        table = $('#couriertbl').DataTable({

            // paging: false,
            // info: false,
            //  dom: 'Bfrtip',
            //       buttons: [
            //           'copy', 'csv', 'excel', 'pdf', 'print'
            //       ]
        });
    })

</script>
