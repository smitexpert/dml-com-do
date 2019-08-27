<?php 
include('includes/header.php'); 


if (isset($_POST['submit'])) {
    $insertcourcompprice = $Courcompanyset->insertPrincipalPrice($_POST);
}

$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id AND p.country_id = c.country_id";
$selectcourcomp = $Courcompanyset->selectcourComp($query);


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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <a href="view_all_document_price.php" class="btn btn-warning btn-sm">View Document Price</a>
                    <a href="view_all_parcel_price.php" class="btn btn-warning btn-sm">View Parcel Price</a>
                </div>
                <div class="col-md-1"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>VIEW PRINCIPAL PRICE
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
                                    if (isset($insertcourcompprice)) { ?>
                                    <div class="alert alert-info fade in">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong><?php echo $insertcourcompprice; ?></strong>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="errorHandler alert alert-danger no-display">
                                        <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                    </div>
                                    <div class="successHandler alert alert-success no-display">
                                        <i class="fa fa-ok"></i> Your form validation is successful!
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <?php
                                    $slPrincipal = "SELECT * FROM principals_name";
                                    $rlPrincipal = $db->link->query($slPrincipal);
                                
                                    while($row = $rlPrincipal->fetch_assoc()){
                                        ?>

                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label><input id="<?php echo str_replace(' ', '', $row['principal_name']); ?>" type="checkbox" value="" checked><?php echo $row['principal_name'] ?></label>
                                    </div>
                                </div>

                                <?php
                                    }
                                ?>

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
                    
                    <table class="table table-bordered colored">
                       <tr>
                          <?php
                           
                            $cnWeight = "SELECT COUNT(weight_id) FROM tbl_weight";
                            $cnWeight = $db->link->query($cnWeight);
                            $num = $cnWeight->fetch_row();
                           
                           ?>
                           <th></th>
                           <th></th>
                           <?php
                                $rl = 1;
                                $i=0.25;
                                while($i<=3.0){
                                    if($i==0.25){
                                        $rl++;
                                        $i=0.50;
                                    }else{
                                        $rl++;
                                        $i+=0.50;
                                    }     
                                }
                            ?>
                           <th colspan="<?php echo 7; ?>">DOCUMENT</th>
                           <th></th>
                           <th colspan="<?php echo $num[0]; ?>">
                               PARCEL
                           </th>
                       </tr>
                        <tr>
                            <th>COUNTRY</th>
                            <th>PRINCIPAL_NAME</th>
                            <?php
                                $i=0.25;
                                while( $i<=3.0){
                                    if($i==0.25){
                                        ?>
                                        <th><?php echo $i; ?></th>
                                        <?php
                                        $i=0.50;
                                    }else{
                                        ?>
                                        <th><?php echo $i; ?></th>
                                        <?php
                                        $i+=0.50;
                                    }
                                }
                            ?>
                            <th></th>
                            
                            <?php
                            
                            $slWeight = "SELECT weight FROM tbl_weight ORDER BY weight ASC";
                            $rlWeight = $db->link->query($slWeight);
                            
                            while($rowWeight = $rlWeight->fetch_assoc()){
                                ?>
                                <th><?php echo $rowWeight['weight']; ?></th>
                                <?php
                            }
                            
                            ?>
                            
                        </tr>
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
