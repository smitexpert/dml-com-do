    <?php 
    include('header.php'); 

    //select country for a search price
    $getCountryList = "SELECT tbl_country.country_name, tbl_country.country_tag FROM tbl_country ORDER BY country_name ASC";

    $getList = $db->link->query($getCountryList);

    ?>


        <!-- start: PAGE -->
        <div class="main-content">
            <!-- end: SPANEL CONFIGURATION MODAL FORM -->
            <div class="container">
                <div class="row">
                    <br>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                <STRONG>PRICE SEARCH WINDOW</STRONG>
                            </div>
                            <div class="panel-body table-responsive">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group connected-group">
                                            <label class="control-label">DESTINATION COUNTRY<span class="symbol required"></span>
                                            </label>
                                            <select name="country" required id="country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php 
                                                    if($getList->num_rows > 0 ){
                                                        while($row = $getList->fetch_assoc()){
                                                            ?>
                                                            <option value="<?php echo $row['country_tag'] ?>"><?php echo $row['country_name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Weight<span class="symbol required"></span>
                                            </label>
                                            <select name="weight" required id="weight" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php 
                                                                $selectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
                                                                    $execweight =  $db->link->query($selectweight);
                                                            if ($execweight) {while ($findweight=$execweight->fetch_assoc()) { ?>
                                                <option id="dd" value="<?php echo $findweight['weight']; ?>"><?php echo $findweight['weight']; ?></option>
                                                <?php } }else{ } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <br>
                                        <div class="gap" style="width: 100%; float: left; margin-top: 5px;"></div>
                                        <button id="get_price" class="btn btn-warning btn-md btn-block">VIEW</button>
                                    </div>
                                    <br>
                                </div><br><br><br>
                                <div id="load_price">                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: PAGE -->


    </div>
    <!-- end: MAIN CONTAINER -->


    <?php 
    include('footer.php');
    ?>
