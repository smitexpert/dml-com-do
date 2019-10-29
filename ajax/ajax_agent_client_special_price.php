<?php

require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['get_agent_principals'])){
    $agent_mail = $_POST['get_agent_principals'];
    
    $sql = "SELECT DISTINCT agent_services.service_name, agent_services.id FROM agent_services INNER JOIN agent_client_price ON agent_client_price.principal_id = agent_services.id WHERE agent_client_price.agent_client_email = '$agent_mail' ORDER BY agent_services.id";
    
    $query = $db->link->query($sql);
    
    ?>
    <option value="">--</option>
    <?php
    
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['service_name']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['get_agent_principals_price'])){
    $agent_mail = $_POST['get_agent_principals_price'];
    
    $sql = "SELECT DISTINCT agent_client_special_rate.principal_id, agent_services.service_name FROM agent_client_special_rate INNER JOIN agent_services ON agent_client_special_rate.principal_id = agent_services.id WHERE agent_client_special_rate.agent_client_email='$agent_mail' ORDER BY agent_services.id";
    
    $query = $db->link->query($sql);
    
    ?>
    <option value="">--</option>
    <?php
    
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['principal_id']; ?>"><?php echo $row['service_name']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['get_principals_country'])){
    $pid = $_POST['get_principals_country'];
    
//    $sql = "SELECT tbl_country.country_name, principal_zone.country_tag FROM principal_zone INNER JOIN tbl_country ON tbl_country.country_tag = principal_zone.country_tag WHERE principal_zone.principal_id='$pid' ORDER BY tbl_country.country_name ASC";
    
    $sql = "SELECT tbl_country.country_name, principal_zone.country_tag FROM principal_zone INNER JOIN tbl_country on tbl_country.country_tag = principal_zone.country_tag WHERE NOT EXISTS (SELECT DISTINCT agent_client_special_rate.country_tag FROM agent_client_special_rate WHERE agent_client_special_rate.principal_id = '$pid' AND agent_client_special_rate.country_tag = principal_zone.country_tag) AND principal_zone.principal_id = '$pid' ORDER BY tbl_country.country_name ASC";
    
    $query = $db->link->query($sql);
    
    ?>
    <option value="">--</option>
    <?php
    
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
            <?php
        }
    }
}


if(isset($_POST['principal'])){
    $principal_id = $_POST['principal'];
    $tag = $_POST['country'];
    $agent_email = $_POST['agent_email'];
    
    $start_date = $_POST['agent_start_date'];
    $end_date = $_POST['agent_end_date'];
    
    $d_weight = $_POST['d_weight'];
    $d_price = $_POST['d_price'];
    
    $p_weight = $_POST['p_weight'];
    $p_price = $_POST['p_price'];
    
    $res = 0;

    for($i=0; $i<count($d_weight); $i++){
        $weight_d = $d_weight[$i];
        $price_d = $d_price[$i];
        if($i == 0){
            $sql_d = "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1');";
        }else if($i == count($d_price)-1){
            $sql_d .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1')";
        }else{
            $sql_d .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1');";
        }
    }
    
    $query_d = $db->link->multi_query($sql_d);
    
    for($i=0; $i<count($p_price); $i++){
        $weight_p = $p_weight[$i];
        $price_p = $p_price[$i];
        if($i == 0){
            $sql_p = "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1');";
        }else if($i == count($p_price)-1){
            $sql_p .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1')";
        }else{
            $sql_p .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1');";
        }
    }
    
    $query_p = $dbn->link->multi_query($sql_p);
    
    if($query_d){
        $res++;
    }else{
        echo $db->link->error;
    }
    
    if($query_p){
        $res++;
    }else{
        echo $dbn->link->error;
    }
    
    echo $res;
    
    
}

if(isset($_POST['view_agent_principal'])){
    $agent_mail = $_POST['view_agent_principal'];
    
    $sql = "SELECT DISTINCT agent_client_special_rate.principal_id, agent_services.service_name FROM agent_client_special_rate INNER JOIN agent_services ON agent_client_special_rate.principal_id = agent_services.id WHERE agent_client_special_rate.agent_client_email = '$agent_mail' ORDER BY agent_client_special_rate.principal_id ASC";
    
    $query = $db->link->query($sql);
    ?>
    <option value="">--</option>
    <?php
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['principal_id']; ?>"><?php echo $row['service_name']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['view_agent_mail'])){
    
    $agent_mail = $_POST['view_agent_mail'];
    $principal_id = $_POST['view_agent_pid'];
    
    $sql = "SELECT DISTINCT agent_client_special_rate.country_tag, tbl_country.country_name FROM agent_client_special_rate INNER JOIN tbl_country ON tbl_country.country_tag = agent_client_special_rate.country_tag WHERE agent_client_special_rate.agent_client_email='$agent_mail' AND agent_client_special_rate.principal_id='$principal_id' ORDER BY tbl_country.country_name ASC";
    
    $query = $db->link->query($sql);
    
    ?>
    <option value="">--</option>
    <?php
    
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
            <?php
        }
    }
}


if(isset($_POST['view_agent_price_mail'])){
    $agent_mail = $_POST['view_agent_price_mail'];
    $principal_id = $_POST['view_agent_price_pid'];
    $tag = $_POST['view_agent_price_tag'];

?>

<div class="row">
    <div class="col-md-12">
        <div class="#">
            <div style="font-weight:bold; padding-bottom:5px;">VIEW PRICE FOR DOCUMENT</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <?php
            $sql_d = "SELECT weight, price FROM agent_client_special_rate WHERE principal_id='$principal_id' AND agent_client_email='$agent_mail' AND country_tag='$tag' AND goods_type='D'";

            $query_d = $db->link->query($sql_d);

            if($query_d->num_rows > 0){
                while($row_d = $query_d->fetch_assoc()){
                    ?>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $row_d['weight'] ?></span>
                            <input type="text" class="form-control" name="d_price[]" placeholder="0" value="<?php echo $row_d['price'] ?>" disabled>
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
        <div class="#">
            <div style="font-weight:bold; padding-bottom:5px;">VIEW PRICE FOR DOCUMENT</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <?php
            $sql_p = "SELECT weight, price FROM agent_client_special_rate WHERE principal_id='$principal_id' AND agent_client_email='$agent_mail' AND country_tag='$tag' AND goods_type='P'";

            $query_p = $db->link->query($sql_p);

            if($query_p->num_rows > 0){
                while($row_p = $query_p->fetch_assoc()){
                    ?>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $row_p['weight'] ?></span>
                            <input type="text" class="form-control" name="d_price[]" placeholder="0" value="<?php echo $row_p['price'] ?>" disabled>
                        </div>
                    </div>
                    <?php
                }
            }

            ?>
            
        </div>
    </div>
</div>
<?php

}

if(isset($_POST['up_agent_mail'])){
    $agent_mail = $_POST['up_agent_mail'];
    $principal_id = $_POST['up_agent_pid'];

    $sql = "SELECT DISTINCT agent_client_special_rate.country_tag, tbl_country.country_name FROM agent_client_special_rate INNER JOIN tbl_country ON tbl_country.country_tag = agent_client_special_rate.country_tag WHERE agent_client_special_rate.principal_id='$principal_id' AND agent_client_special_rate.agent_client_email='$agent_mail'";

    $query = $db->link->query($sql);
    ?>
    <option value="">--</option>
    <?php
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['get_up_mail'])){
    $agent_mail = $_POST['get_up_mail'];
    $principal_id = $_POST['get_up_pid'];
    $tag = $_POST['get_up_tag'];

    $up_agent_price = array();
    
    $dw = 0.25;
    
    while($dw <= 3){
        
        $up_agent_price[$tag]['D']["$dw"] = 0;
        
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
            $up_agent_price[$tag]['P']["$pw"] = 0;
        }
    }
    
    $d_sql = "SELECT * FROM agent_client_special_rate WHERE agent_client_email='$agent_mail' AND principal_id='$principal_id' AND country_tag='$tag' AND goods_type='D' ORDER BY weight ASC";
    
    $d_query = $db->link->query($d_sql);
    if($d_query->num_rows > 0){
        while($d_row = $d_query->fetch_assoc()){
            $d_weight = $d_row['weight'];
            $d_price = $d_row['price'];
            
            $up_agent_price[$tag]['D']["$d_weight"] = $d_price;
            
        }
    }
    
    $p_sql = "SELECT * FROM agent_client_special_rate WHERE agent_client_email='$agent_mail' AND principal_id='$principal_id' AND country_tag='$tag' AND goods_type='P' ORDER BY weight ASC";
    
    $p_query = $db->link->query($p_sql);
    if($p_query->num_rows > 0){
        while($p_row = $p_query->fetch_assoc()){
            $p_weight = $p_row['weight'];
            $p_price = $p_row['price'];
            
            $up_agent_price[$tag]['P']["$p_weight"] = $p_price;
            
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
                foreach($up_agent_price[$tag]['D'] AS  $zone_weight => $value){
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
                foreach($up_agent_price[$tag]['P'] AS  $zone_weight => $value){
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



if(isset($_POST['view_agent_price_mail_date'])){
    $agent_mail = $_POST['view_agent_price_mail_date'];
    $principal_id = $_POST['view_agent_price_pid_date'];
    $tag = $_POST['view_agent_price_tag_date'];

    $sql = "SELECT DISTINCT start_date, end_date FROM agent_client_special_rate WHERE principal_id='$principal_id' AND agent_client_email='$agent_mail' AND country_tag='$tag'";

    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        $row = $query->fetch_array();
        echo json_encode($row);
    }
}

if(isset($_POST['up_agent_principal'])){

    $agent_email = $_POST['up_agent_sub'];
    $principal_id = $_POST['up_agent_principal'];
    $tag = $_POST['up_country'];
    $start_date = $_POST['up_start_date'];
    $end_date = $_POST['up_end_date'];
    $d_weight = $_POST['d_weight'];
    $p_weight = $_POST['p_weight'];
    $d_price = $_POST['d_price'];
    $p_price = $_POST['p_price'];

    $res = 0;

    $sql_del = "DELETE FROM agent_client_special_rate WHERE agent_client_email='$agent_email' AND principal_id='$principal_id' AND country_tag='$tag'";

    $query_del = $db->link->query($sql_del);

    if($query_del){
        $res++;
    }else{
        echo $db->link->error;
    }

    for($i=0; $i<count($d_weight); $i++){
        $weight_d = $d_weight[$i];
        $price_d = $d_price[$i];
        if($i == 0){
            $sql_d = "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1');";
        }else if($i == count($d_price)-1){
            $sql_d .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1')";
        }else{
            $sql_d .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1');";
        }
    }
    
    $query_d = $db->link->multi_query($sql_d);
    
    for($i=0; $i<count($p_price); $i++){
        $weight_p = $p_weight[$i];
        $price_p = $p_price[$i];
        if($i == 0){
            $sql_p = "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1');";
        }else if($i == count($p_price)-1){
            $sql_p .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1')";
        }else{
            $sql_p .= "INSERT INTO agent_client_special_rate (principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$principal_id', '$agent_email', '$tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1');";
        }
    }
    
    $query_p = $dbn->link->multi_query($sql_p);

    if($query_d){
        $res++;
    }else{
        echo $db->link->error;
    }

    if($query_p){
        $res++;
    }else{
        echo $dbn->link->error;
    }

    echo $res;

}

if(isset($_POST['copy_from_principal_country'])){
    $principal_id = $_POST['copy_from_principal_country'];
    $agent_mail = $_POST['copy_from_agent_country'];

    $sql = "SELECT DISTINCT agent_client_special_rate.country_tag, tbl_country.country_name FROM agent_client_special_rate INNER JOIN tbl_country ON tbl_country.country_tag = agent_client_special_rate.country_tag WHERE agent_client_special_rate.agent_client_email='$agent_mail' AND agent_client_special_rate.principal_id='$principal_id' ORDER BY tbl_country.country_name";

    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        ?>
        <div class="col-md-12">
            <input id="all_country" type="checkbox" onclick="select_all_country()">
            <label for="all_country">Select All Country</label>
        </div>
        <br>
        <br>
        <?php
        while($row = $query->fetch_assoc()){
            ?>
        <div class="col-md-3">
            <input name="country_tags[]" class="country_tag" id="<?php echo $row['country_tag']; ?>" type="checkbox" value="<?php echo $row['country_tag']; ?>" onclick="check_all_country()">
            <label for="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></label>
        </div>
            <?php
        }
    }

}

if(isset($_POST['copy_to_principal_id'])){
    $to_agent_id = $_POST['copy_to_agent_id'];
    $to_principal_id = $_POST['copy_to_principal_id'];

    $from_agent_id = $_POST['copy_from_agent_id'];
    $from_principal_id = $_POST['copy_from_principal_id'];

    $start = $_POST['copy_start'];
    $end = $_POST['copy_end'];

    $tags = $_POST['country_tags'];

    $msg = "done";

    for($i=0; $i<count($tags); $i++){
        $r=0;
        $tag = $tags[$i];

        $sql_del = "DELETE FROM agent_client_special_rate WHERE agent_client_email='$to_agent_id' AND principal_id='$to_principal_id' AND country_tag='$tag'";

        $sql = "INSERT INTO agent_client_special_rate(principal_id, agent_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) SELECT '$to_principal_id', '$to_agent_id', '$tag', goods_type, weight, price, '$start', '$end', '$logged_user', status FROM agent_client_special_rate WHERE agent_client_email='$from_agent_id' AND principal_id='$from_principal_id' AND country_tag='$tag'";

        $query_del = $db->link->query($sql_del);
        $query = $db->link->query($sql);

        if($query){
            $r++;
        }

        if($query_del){
            $r++;
        }

        if($r==2){
            continue;
        }else{
            $msg = $db->link->error;
            break;
        }

        // $db->link->close();
    }

    echo $msg;
}

?>