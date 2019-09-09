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
                            <li><a id="setspecialprice" href="#">SET SPECIAL PRICE</a></li>
                            <li><a id="viewspecialprice" href="#">VIEW SPECIAL PRICE</a></li>
                        </ul>
                    </div>
                </div>
                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>
            <br>
            <div id="callback">
                <div id="setspecialprice_body" class="view_body" style="display: none">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- start: FORM VALIDATION 1 PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Set Principal Special Price of : <span class="principal_name">principal_name</span>
                                </div>

                                <div class="panel-body">
                                    <form action="" id="principal_set_special_price">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Select Country</label>
                                                    <div class="country_form">
                                                        <input type="hidden" id="userId" name="userId" value="">
                                                        <select name="country" id="country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
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
                                                    <button id="price_submit_btn" type="submit" class="btn btn-md btn-warning btn-block" disabled>SUBMIT</button>
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
                <div id="viewspecialprice_body" class="view_body" style="display: none;">
                    <h2>Hello</h2>
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
