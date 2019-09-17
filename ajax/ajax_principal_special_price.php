<?php

require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');


if(isset($_POST['check_country'])){
    $tag = $_POST['check_country'];
    $principal_id = $_POST['check_principal_id'];
    
    $sql = "SELECT * FROM principal_special_rate WHERE principal_id='$principal_id' AND country_tag='$tag'";
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        echo '1';
    }else{
        echo '0';
    }
}

if(isset($_POST['add_principal_id'])){
    $principal_id = $_POST['add_principal_id'];
    $tag = $_POST['country'];
    
    $d_price = $_POST['d_price'];
    $d_weight = $_POST['d_weight'];
    
    $p_price = $_POST['p_price'];
    $p_weight = $_POST['p_weight'];
    
    $res = 0;

    for($i=0; $i<count($d_price); $i++){
        $weight_d = $d_weight[$i];
        $price_d = $d_price[$i];
        if($i == 0){
            $sql_d = "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'D', '$weight_d', '$price_d', '$logged_user', '1');";
        }else if($i == count($d_price)-1){
            $sql_d .= "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'D', '$weight_d', '$price_d', '$logged_user', '1')";
        }else{
            $sql_d .= "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'D', '$weight_d', '$price_d', '$logged_user', '1');";
        }
    }
    
    $query_d = $db->link->multi_query($sql_d);
    
    for($i=0; $i<count($p_price); $i++){
        $weight_p = $p_weight[$i];
        $price_p = $p_price[$i];
        if($i == 0){
            $sql_p = "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'P', '$weight_p', '$price_p', '$logged_user', '1');";
        }else if($i == count($p_price)-1){
            $sql_p .= "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'P', '$weight_p', '$price_p', '$logged_user', '1')";
        }else{
            $sql_p .= "INSERT INTO principal_special_rate (principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$principal_id', '$tag', 'P', '$weight_p', '$price_p', '$logged_user', '1');";
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

if(isset($_POST['view_price_pid'])){
    $pid = $_POST['view_price_pid'];
    $tag = $_POST['view_price_tag'];
    
    $sql = "SELECT * FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$tag'";
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        $sql_d = "SELECT * FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$tag' AND goods_type='D'";
        $query_d = $db->link->query($sql_d);
        if($query_d->num_rows > 0){
            ?>
<div class="row">
    <div class="col-md-12">
        <div class="#">
            <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR DOCUMENT</div>
        </div>
    </div>
</div>
<div class="row">
    <?php
            while($row_d = $query_d->fetch_assoc()){
                ?>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon"><?php echo $row_d['weight']; ?> kg</span>
            <input type="text" class="form-control up_price" name="d_price[]" placeholder="0" value="<?php echo $row_d['price']; ?>" disabled>
        </div>
    </div>
    <?php
            }
            ?>
</div>
<?php
        }
        
        $sql_p = $sql = "SELECT * FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$tag' AND goods_type='P'";
        $query_p = $db->link->query($sql_p);
        if($query_p->num_rows > 0){
            ?>
            <br>
<div class="row">
    <div class="col-md-12">
        <div class="#">
            <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR DOCUMENT</div>
        </div>
    </div>
</div>
<div class="row">
    <?php            
            while($row_p = $query_p->fetch_assoc()){
                ?>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon"><?php echo $row_p['weight']; ?> kg</span>
            <input type="text" class="form-control up_price" name="d_price[]" placeholder="0" value="<?php echo $row_p['price']; ?>" disabled>
        </div>
    </div>
    <?php
            }
            ?>
</div>
<?php
        }
    }else{
        echo '0';
    }
}

if(isset($_POST['get_principal_country'])){
    $pid = $_POST['get_principal_country'];
    
    $sql = "SELECT DISTINCT principal_special_rate.country_tag, tbl_country.country_name FROM principal_special_rate INNER JOIN tbl_country ON principal_special_rate.country_tag = tbl_country.country_tag WHERE principal_special_rate.principal_id='$pid'";
    
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

if(isset($_POST['update_principal_id'])){
    $pid = $_POST['update_principal_id'];
    $country = $_POST['up_country'];
    
    $d_i = 0.25;
    $p_w = array();
    $d_w = array();
    
    while($d_i <= 3.0){
        $d_w["$d_i"] = 0;
        if($d_i == 0.25){
            $d_i = 0.5;
        }else{
            $d_i+=0.5;
        }
    }
    
    $sql_w = "SELECT * FROM tbl_weight WHERE status='1' ORDER BY weight ASC";
    $query_w = $db->link->query($sql_w);
    if($query_w->num_rows > 0){
        while($row_w = $query_w->fetch_assoc()){
            $rw = $row_w['weight'];
            $p_w["$rw"] = 0;
        }
    }
    
    $sql_p = "SELECT * FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$country' AND goods_type='P'";
    $query_p = $db->link->query($sql_p);
    
    if($query_p->num_rows > 0){
        while($row_p = $query_p->fetch_assoc()){
            $r_w = $row_p['weight'];
            $p_w["$r_w"] = $row_p['price'];
        }
    }
    
    $sql_d = "SELECT * FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$country' AND goods_type='D'";
    $query_d = $db->link->query($sql_d);
    
    if($query_d->num_rows > 0){
        while($row_d = $query_d->fetch_assoc()){
            $r_w = $row_d['weight'];
            $d_w["$r_w"] = $row_d['price'];
        }
    }
    
    ?>
    <br>
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
                $d = 0.25;
                while($d <= 3.0){
                ?>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $d; ?> kg</span>
                        <input type="hidden" value="<?php echo $d; ?>" name="d_weight[]">
                        <input type="text" class="form-control" name="d_price[]" value="<?php echo $d_w["$d"]; ?>" placeholder="0">
                    </div>
                </div>
                <?php
                    
                    if($d == 0.25)
                        $d = 0.5;
                    else
                        $d += 0.5;
                    
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
                $query_w = $db->link->query($sql_w);
                if($query_w->num_rows > 0){
                    while($row_w = $query_w->fetch_assoc()){
                        $rw = $row_w['weight'];
                ?>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $rw; ?> kg</span>
                        <input type="hidden" value="<?php echo $rw; ?>" name="p_weight[]">
                        <input type="text" class="form-control" name="p_price[]" value="<?php echo $p_w["$rw"]; ?>" placeholder="0">
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
            <button type="submit" class="btn btn-warning btn-block">SUBMIT</button>
        </div>
    </div>
    
    <?php
}

if(isset($_POST['up_principal_id'])){
    
    $t=0;
    
    $pid = $_POST['up_principal_id'];
    $d_price = $_POST['d_price'];
    $d_weight = $_POST['d_weight'];
    
    $p_price = $_POST['p_price'];
    $p_weight = $_POST['p_weight'];
    $tag = $_POST['select_country_update'];
    
    $sql = "DELETE FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$tag'";
    $query = $db->link->query($sql);
    if($query){
        $t++;
        
        for($i = 0; $i<count($d_price); $i++){
            $dw = $d_weight[$i];
            $dp = $d_price[$i];
            if($i == 0){
                $sql_d = "INSERT INTO principal_special_rate(principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$pid', '$tag', 'D', '$dw', '$dp', '$logged_user', '1');";
            }else if($i == count($d_price)-1){
                $sql_d .= "INSERT INTO principal_special_rate(principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$pid', '$tag', 'D', '$dw', '$dp', '$logged_user', '1')";
            }else{
                $sql_d .= "INSERT INTO principal_special_rate(principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$pid', '$tag', 'D', '$dw', '$dp', '$logged_user', '1');";
            }
        }
        
        $query_d = $db->link->multi_query($sql_d);
        
        if($query_d){
            $t++;
        }
        
        for($i=0; $i<count($p_price); $i++){
            $pw = $p_weight[$i];
            $pp = $p_price[$i];
            
            if($i == 0){
                $sql_p = "INSERT INTO principal_special_rate(principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$pid', '$tag', 'P', '$pw', '$pp', '$logged_user', '1');";
            }else if($i == count($p_price)-1){
                $sql_p .= "INSERT INTO principal_special_rate(principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$pid', '$tag', 'P', '$pw', '$pp', '$logged_user', '1')";
            }else{
                $sql_p .= "INSERT INTO principal_special_rate(principal_id, country_tag, goods_type, weight, price, entry_by, status) VALUES ('$pid', '$tag', 'P', '$pw', '$pp', '$logged_user', '1');";
            }
        }
        
        $query_p = $dbn->link->multi_query($sql_p);
        
        if($query_p){
            $t++;
        }
        
    }
    
    echo $t;
}

if(isset($_POST['no_price_country'])){
    $pid = $_POST['no_price_country'];
    
    $sql = "SELECT * FROM tbl_country WHERE NOT EXISTS (SELECT country_tag FROM principal_special_rate WHERE tbl_country.country_tag = principal_special_rate.country_tag AND principal_special_rate.principal_id = '$pid') ORDER BY country_name ASC";
    
    $query = $db->link->query($sql);
    
    if($query->num_rows > 0){
        ?>
        <option value="">--</option>
        <?php
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
            <?php
        }
    }
}

if(isset($_POST['copy_from_pid'])){
    
    $pid = $_POST['copy_from_pid'];
    $country = $_POST['copy_from_tag'];
    
    $d_i = 0.25;
    $p_w = array();
    $d_w = array();
    
    while($d_i <= 3.0){
        $d_w["$d_i"] = 0;
        if($d_i == 0.25){
            $d_i = 0.5;
        }else{
            $d_i+=0.5;
        }
    }
    
    $sql_w = "SELECT * FROM tbl_weight WHERE status='1' ORDER BY weight ASC";
    $query_w = $db->link->query($sql_w);
    if($query_w->num_rows > 0){
        while($row_w = $query_w->fetch_assoc()){
            $rw = $row_w['weight'];
            $p_w["$rw"] = 0;
        }
    }
    
    $sql_p = "SELECT * FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$country' AND goods_type='P'";
    $query_p = $db->link->query($sql_p);
    
    if($query_p->num_rows > 0){
        while($row_p = $query_p->fetch_assoc()){
            $r_w = $row_p['weight'];
            $p_w["$r_w"] = $row_p['price'];
        }
    }
    
    $sql_d = "SELECT * FROM principal_special_rate WHERE principal_id='$pid' AND country_tag='$country' AND goods_type='D'";
    $query_d = $db->link->query($sql_d);
    
    if($query_d->num_rows > 0){
        while($row_d = $query_d->fetch_assoc()){
            $r_w = $row_d['weight'];
            $d_w["$r_w"] = $row_d['price'];
        }
    }
    
    ?>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="#">
                <div style="font-weight:bold; padding-bottom:5px;">COPY PRICE FOR DOCUMENT</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
               <?php
                $d = 0.25;
                while($d <= 3.0){
                ?>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $d; ?> kg</span>
                        <input type="hidden" value="<?php echo $d; ?>" name="d_weight[]">
                        <input type="text" class="form-control" name="d_price[]" value="<?php echo $d_w["$d"]; ?>" placeholder="0">
                    </div>
                </div>
                <?php
                    
                    if($d == 0.25)
                        $d = 0.5;
                    else
                        $d += 0.5;
                    
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="#">
                <div style="font-weight:bold; padding-bottom:5px;">COPY PRICE FOR PARCEL</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
               <?php
                $query_w = $db->link->query($sql_w);
                if($query_w->num_rows > 0){
                    while($row_w = $query_w->fetch_assoc()){
                        $rw = $row_w['weight'];
                ?>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $rw; ?> kg</span>
                        <input type="hidden" value="<?php echo $rw; ?>" name="p_weight[]">
                        <input type="text" class="form-control" name="p_price[]" value="<?php echo $p_w["$rw"]; ?>" placeholder="0">
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
            <button type="submit" class="btn btn-warning btn-block">SUBMIT</button>
        </div>
    </div>
    
    <?php
    
}

?>
