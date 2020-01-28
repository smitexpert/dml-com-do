    <?php 
        include('header.php'); 

        //select all country from tbl_country
        $getCountryList = "SELECT *FROM tbl_country ORDER BY country_name ASC";
        $getCountry = $db->link->query($getCountryList);

        //get all weight form weight table
        $getWeightAll = "SELECT * FROM tbl_weight ORDER BY weight ASC";
        $getWeight = $db->link->query($getWeightAll);

        //select all principal for the agent
        // $getPrincipalName = "SELECT agent_services.id, agent_services.service_name FROM agent_services INNER JOIN agent_principal ON agent_services.id = agent_principal.principal_id WHERE agent_principal.agent_email = '$agent_email' AND agent_principal.status = '1' ORDER BY agent_services.service_name ASC";
        // $getName = $db->link->query($getPrincipalName);
        // $getPrincipalName = "SELECT principals_name.id, principals_name.principal_name FROM principals_name INNER JOIN agent_principal ON principals_name.id = agent_principal.principal_id WHERE agent_principal.agent_email = '$agent_email' ORDER BY principals_name.principal_name ASC";
        // $getName = $db->link->query($getPrincipalName);

        //get agent table agent id
        // $getClientId = "SELECT client_table.table_id from client_table INNER JOIN agent_clients ON agent_clients.id = client_table.table_id WHERE client_table.client_id = '$agent_id'";
        // $getId = $db->link->query($getClientId);

        // if($getId->num_rows > 0){
        //     while($rows = $getId->fetch_assoc()){
        //         $client_id = $rows['table_id'];
        //     }
        // }
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
                                    <STRONG>CONSIGNMENT BOOKING FORM</STRONG>
                                </div>
                                <!-- Start booking form design here  -->
                                <div class="panel-body">            
                                    <form action="" id="agent_consignment_submit">
                                    <div class="row">                            
                                        <div class="col-md-6">  
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    SENDER INFORMATION
                                                </div>
                                                
                                                        <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Name <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="sender_name" name="sender_name" value="<?=$corporate_name ?>" required="">
                                                                <input type="hidden" class="form-control" id="corporate_id" name="corporate_id" value="<?=$corporate_id ?>" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Company <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="sender_company" name="sender_company" value="<?=$corporate_company; ?>" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Email <span class="symbol required"></span>
                                                                </label>
                                                                <input type="email" class="form-control" id="sender_mail" name="sender_mail" value="<?=$corporate_email?>" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Contact <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="sender_contact" name="sender_contact" value="<?=$contact?>" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Address <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="sender_addr" name="sender_addr" value="<?=$address?>" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Sender Country <span class="symbol required"></span>
                                                                </label>
                                                                <!--                                                            <input type="text"  id="sender_country" name="sender_country" required="">-->
                                                                <select class="form-control" name="sender_country" id="sender_country" required>
                                                                    <option value="BD" selected>Bangladesh</option>
                                                                    <option value="IN">India</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                       
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    RECIPIENT INFORMATION
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Name <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_name" name="recipient_name" required="">
                                                                <!-- <input type="hidden" class="form-control" id="agent_sender_mail" name="agent_sender_mail" value="<?php echo $corporate_email; ?>"> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Company <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_company" name="recipient_company" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Email <span class="symbol required"></span>
                                                                </label>
                                                                <input type="email" class="form-control" id="recipient_mail" name="recipient_mail" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 1 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr1" name="recipient_addr1" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 2 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr2" name="recipient_addr2" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Address 3 <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_addr3" name="recipient_addr3" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Phone <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient Mobile <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" id="recipient_mobile" name="recipient_mobile" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Recipient City
                                                                </label>
                                                                <input type="textarea" class="form-control" id="recipient_addr" name="recipient_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group connected-group">
                                                                <label class="control-label">Destination Country<span class="symbol required"></span>
                                                                </label>
                                                                <select onchange="get_agent_price()" name="dest_country" id="agent_dest_country" class="form-control selectpicker agent_dest_country" data-show-subtext="true" data-live-search="true">
                                                                    <option value="">--</option>
                                                                    <?php
                                                                    if($getCountry){
                                                                        while($row = $getCountry->fetch_assoc()){
                                                                            ?>
                                                                            <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                    } 
                                                                     ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">ZIP</label>
                                                                <input type="text" class="form-control" name="recipient_zip">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-external-link-square"></i>
                                                    GOODS INFORMATION
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="goods_title">Goods Title<span class="symbol required"></span></label>
                                                                <input type="text" class="form-control" id="goods_title" placeholder="Goods Title" name="goods_title" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Local Product Code <span class="symbol required"></span>
                                                                </label>
                                                                <select onchange="get_agent_price()" name="goods_type" id="agent_goods_type" class="form-control" required>
                                                                    <option value="">--</option>
                                                                    <option value="P">Parcel</option>
                                                                    <option value="D">Document</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Goods Weight <span class="symbol required"></span>
                                                                </label>
                                                                <select onchange="get_agent_price()" name="goods_weight" id="agent_goods_weight" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                                    <option value="">--</option>
                                                                    <?php
                                                                    if($getWeight->num_rows > 0){
                                                                        while($row = $getWeight->fetch_assoc()){
                                                                            ?>
                                                                            <option value="<?php echo $row['weight'] ?>"><?php echo $row['weight']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                     ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Shipment Pieces<span class="symbol required"></span>
                                                                </label>
                                                                <input type="number" class="form-control" name="shimpent_pieces" id="shimpent_pieces" min='1' required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Declared Value/Custom's Value<span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="shimpent_declared_value" id="shimpent_declared_value" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    AWB NO
                                                                </label>
                                                                <input type="text" class="form-control" name="custom_trackId" id="custom_trackId" value="" placeholder="AWB NO">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                       
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Tracking ID <span class="symbol required"></span>
                                                                </label>
                                                                <input onclick="get_tracking_id(event)" style="cursor: pointer;" type="text" class="form-control agent_tracking_id" name="trackID" value="" readonly>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Refference No. <span class="symbol required"></span>
                                                                </label>
                                                                <input type="text" class="form-control" name="refference_no" id="refference_no" required>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Shipping Charge <span class="symbol required"></span>
                                                                </label>
                                                                <input onkeyup="agent_convert_to_bdt()" style="text-align: right;" type="text" class="form-control" name="shipping_charge" id="agent_shipping_charge" readonly>
                                                                <span id="showgenprice"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                           <br>
                                                            <p>IN BDT = <span id="agent_bdt"></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-block btn-warning">SUBMIT</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>

                                <!-- End booking form design here  -->                                
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
