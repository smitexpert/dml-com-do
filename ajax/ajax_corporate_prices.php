<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

if(isset($_POST['get_corporate_mail'])){
    $get_corporate_mail = $_POST['get_corporate_mail'];
    $sl_corporate = "SELECT email FROM corporate_clients WHERE id='$get_corporate_mail'";
    $ql_corporate = $db->link->query($sl_corporate);
    $row_corporate = $ql_corporate->fetch_row();
    echo $row_corporate[0];
}

if(isset($_POST['corporate_setprice_email'])){
    $corporate_mail = $_POST['corporate_setprice_email'];
    
    $sql = "SELECT DISTINCT zone FROM dml_zone ORDER BY zone ASC";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        ?>
        <option value="">--</option>
        <?php
        while($row = $query->fetch_assoc()){
            ?>
    <option value="<?php echo $row['zone']; ?>"><?php echo $row['zone']; ?></option>
    <?php
        }
    }else{
        ?>
        <option value="">--</option>
        <?php
    }
}
if(isset($_POST['selected_zone_id'])){
    $selected_id = $_POST['selected_zone_id'];
    $selected_email = $_POST['selected_corporate_email'];

    $get_zone_id = "SELECT DISTINCT zone FROM corporate_client_price WHERE corporate_client_email = '$selected_email' AND zone = '$selected_id'";
    $get_result = $db->link->query($get_zone_id);

    if($get_result->num_rows > 0){
        echo 1;
    }else{
        echo 0;
    }
   
}
//for insert into database named : corporate_client_price
if(isset($_POST['corporate_email_set_general_price'])){
    $corporate_email = $_POST['corporate_email_set_general_price'];
    $zone = $_POST['zone'];
    $d_weight = $_POST['d_weight'];
    $d_price = $_POST['d_price'];
    
    $p_weight = $_POST['p_weight'];
    $p_price = $_POST['p_price'];
    
    $result = "";

    // print_r($p_price);
    
    for($i=0; $i<count($d_weight); $i++){
        $weight = $d_weight[$i];
        $price = $d_price[$i];
        if($i==0){
            $insert_d = "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'D', '$zone', '$weight', '$price');";
        }else if($i == count($d_weight)-1){
            $insert_d .= "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'D', '$zone', '$weight', '$price')";
        }else{
            $insert_d .= "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'D', '$zone', '$weight', '$price');";
        }
    }
    
    $query_d = $db->link->multi_query($insert_d);
    
    if($query_d){
        $result = $result."DP";
    }else{
        $result = $result." ".$db->link->error." "."DF";
    }
    
    for($i=0; $i<count($p_weight); $i++){
        $weight = $p_weight[$i];
        $price = $p_price[$i];
        if($i==0){
            $insert_p = "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'P', '$zone', '$weight', '$price');";
        }else if($i == count($p_weight)-1){
            $insert_p .= "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'P', '$zone', '$weight', '$price')";
        }else{
            $insert_p .= "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'P', '$zone', '$weight', '$price');";
        }
    }
    
    $query_p = $dbn->link->multi_query($insert_p);
    
    if($query_p){
        $result = $result." PP";
    }else{
        $result = $result." ".$dbn->link->error." "."PF";
    }
    
    echo $result;
}




if(isset($_POST['get_zone_agent_mail'])){
    
    $principal_id = $_POST['get_zone_principal'];
    $agent_client_email = $_POST['get_zone_agent_mail'];
    
//    $zone = array();
//    
//    
//    $select = "SELECT DISTINCT zone FROM dml_zone ORDER BY ZONE ASC";
//    $sql = $db->link->query($select);
//    if($sql->num_rows > 0){
//        while($row = $sql->fetch_assoc()){
//            $zone[] = $row['zone'];
//        }
//    }
//    
//    $agent_sql = "SELECT DISTINCT zone FROM agent_client_price WHERE agent_client_email='$agent_client_email' AND principal_id='$principal_id'";
//    
//    $agent_query = $db->link->query($agent_sql);
//    
//    if($agent_query->num_rows > 0){
//        while($agent_row = $agent_query->fetch_assoc()){
//            $agent_principal = $agent_row['zone'];
//            if(($key = array_search($agent_principal, $zone)) !== false){
//                unset($zone[$key]);
//            }
//        }
//    }
    
    $sql = "SELECT DISTINCT zone FROM dml_zone WHERE NOT EXISTS (SELECT DISTINCT zone FROM agent_client_price WHERE agent_client_email='$agent_client_email' AND principal_id='$principal_id' AND dml_zone.zone = agent_client_price.zone) ORDER BY zone ASC";
    
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['zone']; ?>"><?php echo $row['zone']; ?></option>
            <?php
        }
    }
}





if(isset($_POST['zone_no'])){
    $zone = $_POST['zone_no'];
    $agent_id = $_POST['agent_id'];
    $principal_id = $_POST['principal_id'];
    
    $sl_agent = "SELECT email FROM agent_clients WHERE id='$agent_id'";
    $ql_agent = $db->link->query($sl_agent);
    $row_agent = $ql_agent->fetch_row();
    
    
    $select = "SELECT zone FROM agent_client_price WHERE agent_client_email='$row_agent[0]' AND principal_id = '$principal_id' AND zone='$zone'";
    $query = $db->link->query($select);
    
    if($query->num_rows > 0){
        echo 1;
    }else{
        echo 0;
    }
    
}



if(isset($_POST['get_view_price_principal'])){
    $agent_mail = $_POST['get_view_price_principal'];
    $sql = "SELECT DISTINCT agent_client_price.principal_id, principals_name.principal_name FROM agent_client_price INNER JOIN principals_name ON agent_client_price.principal_id=principals_name.id  WHERE agent_client_price.agent_client_email='$agent_mail'";
    $query = $db->link->query($sql);
    ?>
    <option value="">--</option>
    <?php
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['principal_id']; ?>"><?php echo $row['principal_name']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['agent_zone_price'])){
    
    $zone_price = array();
    $tParc = 0;
    
    $sel_zone = "SELECT DISTINCT zone FROM dml_zone ORDER BY zone ASC";
    $res_zone = $db->link->query($sel_zone);
    if($res_zone->num_rows > 0){
        while($row_zone = $res_zone->fetch_assoc()){
            $rel_zone = $row_zone['zone'];
            
            $l = 0.25;
            while($l<=3.00){
                $zone_price[$rel_zone]['D']["$l"] = 0;
                if($l == 0.25 )
                    $l+=0.25;
                else
                    $l+=0.50;
            }
            
            
            $sel_weight = "SELECT * FROM tbl_weight WHERE status=1";
            $res_weight = $db->link->query($sel_weight);
            if($res_weight->num_rows > 0){
                while($row_weight = $res_weight->fetch_assoc()){
                    $rel_weight = $row_weight['weight'];
                    $zone_price[$rel_zone]['P'][$rel_weight] = 0;
                    $tParc++;
                }
            }
        }
    }
    
    
    
    $get_agent_mail = $_POST['agent_zone_price'];
    $view_price_principal = $_POST['view_price_principal'];
    $sl_agent = "SELECT email FROM agent_clients WHERE id='$get_agent_mail'";
    $ql_agent = $db->link->query($sl_agent);
    $row_agent = $ql_agent->fetch_row();
    $agent_mail = $row_agent[0];
    
    
    
    
    $select_price = "SELECT dml_zone.zone, agent_client_price.goods_type, agent_client_price.weight, agent_client_price.price FROM dml_zone INNER JOIN agent_client_price on dml_zone.zone = agent_client_price.zone WHERE agent_client_price.agent_client_email = '$agent_mail' AND agent_client_price.principal_id = '$view_price_principal'";
    
    $query_price = $db->link->query($select_price);
    
    if($query_price->num_rows > 0){
        while($row_price = $query_price->fetch_assoc()){
            $zone = $row_price['zone'];
            $goods_type = $row_price['goods_type'];
            $weight = $row_price['weight'];
            $price = $row_price['price'];
            
            $zone_price[$zone][$goods_type][$weight] = $price;
            
        }
    }
    
    ?>
<!--    <p style="text-align:enter;" id="text_info"></p>-->
<table style="text-align: center;" class="table table-bordered price-table table-striped table-hover">
    <thead>
        <tr>
            <th rowspan="2">GOODS TYPE</th>
            <th></th>
            <?php
                                $sl_dml_zone = "SELECT DISTINCT zone FROM dml_zone ORDER BY zone ASC";
                                $rl_dml_zone = $db->link->query($sl_dml_zone);
                                $count = 0;
                                if($rl_dml_zone->num_rows > 0){
                                    while($row_dml_zone = $rl_dml_zone->fetch_assoc()){
                                        ?>
            <th>ZONE: <?php echo $row_dml_zone['zone']; ?></th>
            <?php
                                        $count++;
                                    }
                                }
                                ?>

        </tr>
        <tr>
            <th>WEIGHT</th>
            <?php for($i=1; $i<=$count; $i++)
                                        echo "<th>Rate (USD)</th>";
                                ?>

        </tr>
    </thead>
    <tbody>
        <?php
                                $i = 0.25;
                                while($i<=3.00){
                                    ?>
        <tr>
            <?php
                                    
                                    if($i == 0.25)
                                        echo '<th rowspan="7">DOX</th>';    
                                ?>


            <th style="text-align: center"><?php echo number_format($i, 2); ?></th>
            <?php
                                    
                                $sl_dml_zone = "SELECT DISTINCT zone FROM dml_zone ORDER BY zone ASC";
                                $rl_dml_zone = $db->link->query($sl_dml_zone);
                                    
                                    while($row_dml_zone = $rl_dml_zone->fetch_assoc()){
                                        $current_zone = $row_dml_zone['zone'];
                                        ?>
            <td><?php if($zone_price[$current_zone]['D']["$i"] != 0){ echo number_format($zone_price[$current_zone]['D']["$i"], 2); } ?></td>
            <?php
                                    }
                                    ?>


        </tr>
        <?php

                                    if($i==0.25)
                                        $i+=0.25;
                                    else
                                        $i+=0.50;
                                }
    $t=0;
                            $sl_zone_weight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
                            $rl_zone_weight = $db->link->query($sl_zone_weight);
                            if($rl_zone_weight->num_rows > 0){
                                while($row_zone_weight = $rl_zone_weight->fetch_assoc()){
                                    $zone_weight = $row_zone_weight['weight'];
                                    ?>
        <tr>
            <?php
                                    
                                    if($t==0){
                                        ?>
            <th rowspan="<?php echo $tParc; ?>" style="vertical-align: top;">SPX</th>
            <?php
                                    }
                                    
                                        ?>
            <th style="text-align: center;"><?php echo number_format($zone_weight, 2); ?></th>
            <?php
                                    $sl_dml_zone = "SELECT DISTINCT zone FROM dml_zone ORDER BY zone ASC";
                                    $rl_dml_zone = $db->link->query($sl_dml_zone);

                                        while($row_dml_zone = $rl_dml_zone->fetch_assoc()){
                                            $current_zone = $row_dml_zone['zone'];
                                            ?>
            <td><?php if($zone_price[$current_zone]['P'][$zone_weight] != 0){ echo number_format($zone_price[$current_zone]['P'][$zone_weight], 2); } ?></td>
            <?php
                                        }
                                    ?>
        </tr>
        <?php
                                    $t++;
                                }
                            }
    
                            ?>

    </tbody>
</table>
<?php
}


/*if(isset($_POST['update_zone'])){
    $zone_id = $_POST['update_zone'];
    $agent_mail = $_POST['up_zone_mail'];
    
    $sql1 = "SELECT DISTINCT zone FROM agent_client_price WHERE agent_client_email = '$agent_mail' AND zone = '$zone_id'";
    $query1 = $db->link->query($sql1);
    if($query1->num_rows > 0){
        
        $zone_price_up = array();
        
         $l = 0.25;
            while($l<=3.00){
                $zone_price_up[$zone_id]['D']["$l"] = 0;
                if($l == 0.25 )
                    $l+=0.25;
                else
                    $l+=0.50;
            }
        
        $sel_weight = "SELECT * FROM tbl_weight WHERE status=1";
        $res_weight = $db->link->query($sel_weight);
        if($res_weight->num_rows > 0){
            while($row_weight = $res_weight->fetch_assoc()){
                $rel_weight = $row_weight['weight'];
                $zone_price_up[$zone_id]['P'][$rel_weight] = 0;
//                $tParc++;
            }
        }
        
        
        $price_sql = "SELECT zone, goods_type, weight, price FROM agent_client_price WHERE agent_client_email='$agent_mail' AND zone='$zone_id'";
        $price_res = $db->link->query($price_sql);
        if($price_res->num_rows > 0){
            while($row = $price_res->fetch_assoc()){
                $zone = $row['zone'];
                $goods_type = $row['goods_type'];
                $weight = $row['weight'];
                $price = $row['price'];
                $zone_price_up[$zone][$goods_type][$weight] = $price;
            }
        }
        
        ?>
<!--<div class="row">
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
                    <span class="input-group-addon">0.25 kg</span>
                    <input type="hidden" value="0.25" name="d_weight[]">
                    <input type="text" class="form-control" name="d_price[]" value="0.25" placeholder="0">
                </div>
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
                    <span class="input-group-addon">0.25 kg</span>
                    <input type="hidden" value="0.25" name="d_weight[]">
                    <input type="text" class="form-control" name="d_price[]" value="0.25" placeholder="0">
                </div>
            </div>
        </div>
    </div>
</div>-->

<?php
        
        
        
    }else{
        echo '0';
    }
    
}*/

if(isset($_POST['up_agent_mail'])){
    $agent_mail = $_POST['up_agent_mail'];
    $principal = $_POST['up_agent_principal'];
    
    $sql = "SELECT DISTINCT zone FROM agent_client_price WHERE agent_client_email='$agent_mail' AND principal_id='$principal' ORDER BY zone ASC";
    
    $query = $db->link->query($sql);
    ?>
    <option value="">--</option>
    <?php
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['zone']; ?>"><?php echo $row['zone']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['up_zone_principal_id'])){
    $principal_id = $_POST['up_zone_principal_id'];
    $up_zone_mail = $_POST['up_zone_mail'];
    $update_zone = $_POST['update_zone'];
    
    $up_agent_price = array();
    
    $dw = 0.25;
    
    while($dw <= 3){
        
        $up_agent_price[$update_zone]['D']["$dw"] = 0;
        
        if($dw == 0.25)
            $dw = 0.50;
        else
            $dw+=0.50;
    }
    
    $sql_weight = "SELECT * FROM tbl_weight WHERE status='1' ORDER BY weight ASC";
    $query_weight = $db->link->query($sql_weight);
    if($query_weight->num_rows > 0){
        while($row_weight = $query_weight->fetch_assoc()){
            $pw = $row_weight['weight'];
            $up_agent_price[$update_zone]['P']["$pw"] = 0;
        }
    }
    
    $d_sql = "SELECT * FROM agent_client_price WHERE agent_client_email='$up_zone_mail' AND principal_id='$principal_id' AND zone='$update_zone' AND goods_type='D' ORDER BY weight ASC";
    
    $d_query = $db->link->query($d_sql);
    if($d_query->num_rows > 0){
        while($d_row = $d_query->fetch_assoc()){
            $d_weight = $d_row['weight'];
            $d_price = $d_row['price'];
            
            $up_agent_price[$update_zone]['D']["$d_weight"] = $d_price;
            
        }
    }
    
    $p_sql = "SELECT * FROM agent_client_price WHERE agent_client_email='$up_zone_mail' AND principal_id='$principal_id' AND zone='$update_zone' AND goods_type='P' ORDER BY weight ASC";
    
    $p_query = $db->link->query($p_sql);
    if($p_query->num_rows > 0){
        while($p_row = $p_query->fetch_assoc()){
            $p_weight = $p_row['weight'];
            $p_price = $p_row['price'];
            
            $up_agent_price[$update_zone]['P']["$p_weight"] = $p_price;
            
        }
    }
    
    ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="#">
            <div style="font-weight:bold; padding-bottom:5px;">UPDATE PRICE FOR DOCUMENT</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
           <?php
                foreach($up_agent_price[$update_zone]['D'] AS  $zone_weight => $value){
            ?>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><?php echo number_format($zone_weight, 2); ?></span>
                    <input type="hidden" value="<?php echo $zone_weight; ?>" name="d_weight[]">
                    <input type="text" class="form-control" name="d_price[]" value="<?php echo $value; ?>" placeholder="0">
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
            <div style="font-weight:bold; padding-bottom:5px;">UPDATE PRICE FOR PARCEL</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
           <?php
                foreach($up_agent_price[$update_zone]['P'] AS  $zone_weight => $value){
            ?>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><?php echo number_format($zone_weight, 2); ?></span>
                    <input type="hidden" value="<?php echo $zone_weight; ?>" name="p_weight[]">
                    <input type="text" class="form-control" name="p_price[]" value="<?php echo $value; ?>" placeholder="0">
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<br>
<button type="submit" class="btn btn-block btn-warning btn-bg">SUBMIT</button>
   
    <?php
    
    
}


if(isset($_POST['upzoneprincipal'])){
    $principal_id = $_POST['upzoneprincipal'];
    $upzone = $_POST['upzone'];
    $update_agent_mail = $_POST['update_agent_mail'];
    
    $dweight = $_POST['d_weight'];
    $dprice = $_POST['d_price'];
    
    $pweight = $_POST['p_weight'];
    $pprice = $_POST['p_price'];
    
    $dl_sql = "DELETE FROM agent_client_price WHERE agent_client_email='$update_agent_mail' AND principal_id='$principal_id' AND zone='$upzone'";
    
    $dl_query = $db->link->query($dl_sql);
    
    if($dl_query){
        for($i=0; $i<count($dweight); $i++){
            $dwe = $dweight[$i];
            $dpr = $dprice[$i];
            if($i==0){
                $up_sql = "INSERT INTO agent_client_price(agent_client_email, principal_id, goods_type, zone, weight, price) VALUES ('$update_agent_mail', '$principal_id', 'D', '$upzone', '$dwe', '$dpr');";
            }else{
                $up_sql .= "INSERT INTO agent_client_price(agent_client_email, principal_id, goods_type, zone, weight, price) VALUES ('$update_agent_mail', '$principal_id', 'D', '$upzone', '$dwe', '$dpr');";
            }
        }

        for($i=0; $i<count($pweight); $i++){
            $pwe = $pweight[$i];
            $ppr = $pprice[$i];
            if($i==count($pweight)-1){
                $up_sql .= "INSERT INTO agent_client_price(agent_client_email, principal_id, goods_type, zone, weight, price) VALUES ('$update_agent_mail', '$principal_id', 'P', '$upzone', '$pwe', '$ppr')";
            }else{
                $up_sql .= "INSERT INTO agent_client_price(agent_client_email, principal_id, goods_type, zone, weight, price) VALUES ('$update_agent_mail', '$principal_id', 'P', '$upzone', '$pwe', '$ppr');";
            }
        }
        
        $mul_insert = $db->link->multi_query($up_sql);
        
        if($mul_insert){
            echo 'OK';
        }else{
            echo 'ERROR';
        }
    }else{
        echo $db->link->error;
    }
    
    
    
    
}


if(isset($_POST['agent_copyprice_mail'])){
    $agent_mail = $_POST['agent_copyprice_mail'];
    
    $sql = "SELECT DISTINCT principals_name.principal_name, principals_name.id FROM principals_name INNER JOIN agent_client_price ON agent_client_price.principal_id = principals_name.id WHERE agent_client_price.agent_client_email='$agent_mail' ORDER BY agent_client_price.principal_id ASC";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        ?>
        <option value="">--</option>
        <?php
        while($row = $query->fetch_assoc()){
            ?>
    <option value="<?php echo $row['id']; ?>"><?php echo $row['principal_name']; ?></option>
    <?php
        }
    }else{
        ?>
        <option value="">--</option>
        <?php
    }
}

if(isset($_POST['copy_to_agent'])){
    
    $copy_to_agent = $_POST['copy_to_agent'];
    $copy_to_principal = $_POST['copy_to_principal'];
    $copy_from_agent = $_POST['copy_from_agent'];
    $copy_from_principal = $_POST['copy_from_principal'];
    
    $sql_del = "DELETE FROM agent_client_price WHERE agent_client_email='$copy_to_agent' AND principal_id='$copy_to_principal'";
    $query_del = $db->link->query($sql_del);
    
    if($query_del){
        $sql = "INSERT INTO agent_client_price(agent_client_email, principal_id, goods_type, zone, weight, price) SELECT '$copy_to_agent', '$copy_to_principal', goods_type, zone, weight, price FROM agent_client_price WHERE agent_client_email = '$copy_from_agent' AND principal_id = '$copy_from_principal'";
    
        $query = $db->link->query($sql);

        if($query){
            echo '1';
        }else{
            echo $db->link->error;
        }
        
    }else{
        echo $db->link->error;
    }
}

?>
