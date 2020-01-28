<?php

include("header.php");



$sql = "SELECT DISTINCT agent_client_price.principal_id, agent_services.service_name FROM agent_services INNER JOIN agent_client_price ON agent_client_price.principal_id = agent_services.id WHERE agent_client_price.agent_client_email = '$agent_email' ORDER BY agent_services.id ASC";
$query = $db->link->query($sql);


?>

    
    <div class="main-content">
        <div class="container"><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="nav_view" style="display: block;">
                        <ul class="nav nav-pills">
                            <li class="active"><a id="general" href="#">GENERAL PRICE</a></li>
                            <li><a id="special" href="#">SPECIAL PRICE</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="view_panel" id="view_general" style="display: block;">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-external-link-square"></i>
                                VIEW GENERAL PRICE  
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Select Service</label>
                                            <select name="" id="principal" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php
                                                    if($query->num_rows > 0){
                                                        while($row = $query->fetch_assoc()){
                                                            ?>
                                                            <option value="<?php echo $row['principal_id']; ?>"><?php echo $row['service_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="price_view_table">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view_panel" id="view_special" style="display: none;">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-external-link-square"></i>
                                VIEW SPECIAL PRICE
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Select Service</label>
                                            <select name="" id="special_principal" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                                <?php
                                                $new_query = $db->link->query($sql);
                                                    if($new_query->num_rows > 0){
                                                        while($new_row = $new_query->fetch_assoc()){
                                                            ?>
                                                            <option value="<?php echo $new_row['principal_id']; ?>"><?php echo $new_row['service_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Select Country</label>
                                            <select name="" id="country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="">--</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="special_view_panel">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php

include("footer.php");

?>
