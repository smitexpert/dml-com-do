<?php

require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$db2 = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['get_corporate_email'])){
    $corporate_id = $_POST['get_corporate_email'];
    $corporate_email ="";

    $get_corporate_email = "SELECT email FROM corporate_clients WHERE id = '$corporate_id'";
    $get_email = $db->link->query($get_corporate_email);

    if($get_email){
        while($row = $get_email->fetch_assoc()){
            $corporate_email = $row['email'];
        }
    }

    echo $corporate_email;
}

if(isset($_POST['get_corporate_country_list'])){
    $corporate_email = $_POST['get_corporate_country_list'];

    //get country list from coroporate_client_price

    $get_country_list = "SELECT DISTINCT tbl_country.country_name, dml_zone.country_tag FROM tbl_country INNER JOIN dml_zone ON tbl_country.country_tag = dml_zone.country_tag INNER JOIN corporate_client_price ON dml_zone.zone = corporate_client_price.zone WHERE corporate_client_price.corporate_client_email = '$corporate_email' ORDER BY tbl_country.country_name ASC";

    $get_list = $db->link->query($get_country_list);
    ?>
    <option value="">--</option>
    <?php

    if($get_list->num_rows > 0){
        while($row = $get_list->fetch_assoc()){
            ?>
            <option value="<?php echo $row['country_tag'] ?>"><?php echo $row['country_name'] ?></option>
            <?php
        }
    }
}

if(isset($_POST['country'])){

    $corporate_email = $_POST['corporate_email'];
    $country_tag = $_POST['country'];
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
            $sql_d = "INSERT INTO corporate_client_special_rate (corporate_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$corporate_email', '$country_tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1');";
        }else if($i == count($d_price)-1){
            $sql_d .= "INSERT INTO corporate_client_special_rate (corporate_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$corporate_email', '$country_tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1')";
        }else{
            $sql_d .= "INSERT INTO corporate_client_special_rate (corporate_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$corporate_email', '$country_tag', 'D', '$weight_d', '$price_d', '$start_date', '$end_date', '$logged_user', '1');";
        }
    }
    
    $query_d = $db->link->multi_query($sql_d);
    
    for($i=0; $i<count($p_price); $i++){
        $weight_p = $p_weight[$i];
        $price_p = $p_price[$i];
        if($i == 0){
            $sql_p = "INSERT INTO corporate_client_special_rate (corporate_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$corporate_email', '$country_tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1');";
        }else if($i == count($p_price)-1){
            $sql_p .= "INSERT INTO corporate_client_special_rate (corporate_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$corporate_email', '$country_tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1')";
        }else{
            $sql_p .= "INSERT INTO corporate_client_special_rate (corporate_client_email, country_tag, goods_type, weight, price, start_date, end_date, entry_by, status) VALUES ('$corporate_email', '$country_tag', 'P', '$weight_p', '$price_p', '$start_date', '$end_date', '$logged_user', '1');";
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

if(isset($_POST['get_corporate_country_list_view'])){
    $corporate_email = $_POST['get_corporate_country_list_view'];

    $get_country_list = "SELECT DISTINCT tbl_country.country_name, corporate_client_special_rate.country_tag FROM tbl_country INNER JOIN corporate_client_special_rate ON corporate_client_special_rate.country_tag = tbl_country.country_tag WHERE corporate_client_special_rate.corporate_client_email = '$corporate_email' ORDER BY tbl_country.country_name ASC ";

    $get_list = $db->link->query($get_country_list);
    ?>
    <option value="">--</option>
    <?php

    if($get_list->num_rows > 0){
        while($row = $get_list->fetch_assoc()){
            ?>
            <option value="<?php echo $row['country_tag'] ?>"><?php echo $row['country_name'] ?></option>
            <?php
        }
    }
}


if(isset($_POST['corporate_country_tag_view_price'])){

    $corporate_country_tag = $_POST['corporate_country_tag_view_price'];
    $corporate_email = $_POST['corporate_email_view_price'];

    //select all price for a single country and single principal
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
            $sql_d = "SELECT weight, price FROM corporate_client_special_rate WHERE corporate_client_email='$corporate_email' AND country_tag='$corporate_country_tag' AND goods_type='D'";

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
            $sql_p = "SELECT weight, price FROM corporate_client_special_rate WHERE corporate_client_email='$corporate_email' AND country_tag='$corporate_country_tag' AND goods_type='P'";

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

if(isset($_POST['getCountryList'])){
    $corporate_client_email = $_POST['getCountryList'];

    //get all country those already set special price
    $getCountryList = "SELECT DISTINCT tbl_country.country_name, tbl_country.country_tag FROM tbl_country INNER JOIN corporate_client_special_rate ON tbl_country.country_tag = corporate_client_special_rate.country_tag WHERE corporate_client_email = '$corporate_client_email' ORDER BY tbl_country.country_name ASC";

    // echo $getCountryList;

    $getList = $db->link->query($getCountryList);
    ?>
    <option value="">--</option>
    <?php

    if($getList->num_rows > 0){
        while($row = $getList->fetch_assoc()){
            ?>
            <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
            
            <?php
        }
    }else{
        echo "Hello";
    }
   

}

if(isset($_POST['countryName'])){
    $countryName = $_POST['countryName'];
    $corporateEmail = $_POST['corporateEmail'];

    $getInfo = "SELECT DISTINCT start_date,end_date from corporate_client_special_rate where corporate_client_special_rate.corporate_client_email = '$corporateEmail' AND corporate_client_special_rate.country_tag = '$countryName'";

    $getInfo_details = $db->link->query($getInfo);

    // print_r($getInfo_details);

    if($getInfo_details->num_rows > 0){
       echo json_encode($getInfo_details->fetch_array()); 
    }
}

if(isset($_POST['countryName_price'])){    
    $countryName_price = $_POST['countryName_price'];
    $corporateEmail_price = $_POST['corporateEmail_price'];

    
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
    
    $sql_p = "SELECT * FROM corporate_client_special_rate WHERE corporate_client_email='$corporateEmail_price' AND country_tag='$countryName_price' AND goods_type='P'";
    $query_p = $db->link->query($sql_p);
    
    if($query_p->num_rows > 0){
        while($row_p = $query_p->fetch_assoc()){
            $r_w = $row_p['weight'];
            $p_w["$r_w"] = $row_p['price'];
        }
    }
    
    $sql_d = "SELECT * FROM corporate_client_special_rate WHERE corporate_client_email='$corporateEmail_price' AND country_tag='$countryName_price' AND goods_type='D'";
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

if(isset($_POST['up_country'])){
    $country_tag = $_POST['up_country'];
    $corporate_email = $_POST['corporate_email'];
    $end_date = $_POST['up_end_date'];
    $start_date = $_POST['up_start_date'];

    $d_weight = $_POST['d_weight'];
    $d_price = $_POST['d_price'];

    $p_weight = $_POST['p_weight'];
    $p_price = $_POST['p_price'];
    
    //update multi-query
    $ret = 0;
    
    $del_zone = "DELETE FROM corporate_client_special_rate WHERE corporate_client_email='$corporate_email' AND country_tag = '$country_tag'";
    
    
    if($db->link->query($del_zone)){
        $ret++;
    }

 
    
    
    for($i=0; $i<count($d_price); $i++){
        
        $price = $d_price[$i];
        $weight = $d_weight[$i];
        
        if($i==0){
            $upDoc = "INSERT INTO corporate_client_special_rate(corporate_client_email, goods_type, country_tag, weight, price, start_date, end_date, entry_by, status) VALUES ('$corporate_email', 'D', '$country_tag', '$weight', '$price', '$start_date', '$end_date','$logged_user', '1');";
        }else if($i==count($d_price)-1){
            $upDoc .= "INSERT INTO corporate_client_special_rate(corporate_client_email, goods_type, country_tag, weight, price,  start_date, end_date, entry_by, status) VALUES ('$corporate_email', 'D', '$country_tag', '$weight', '$price', '$start_date', '$end_date','$logged_user', '1')";
        }else{
            $upDoc .= "INSERT INTO corporate_client_special_rate(corporate_client_email, goods_type, country_tag, weight, price,  start_date, end_date, entry_by, status) VALUES ('$corporate_email', 'D', '$country_tag', '$weight', '$price', '$start_date', '$end_date','$logged_user', '1');";
        }
        
    }
    
    
    if($db->link->multi_query($upDoc) === TRUE){
        $ret++;
    }else{
        echo $db->link->error;
    }

    
    
    
    for($j=0; $j<count($p_price); $j++){
        $weight = $p_weight[$j];
        $price = $p_price[$j];
        if($j==0){
            $upPer = "INSERT INTO corporate_client_special_rate (corporate_client_email, goods_type, country_tag, weight, price, start_date, end_date, entry_by, status) VALUES ('$corporate_email', 'P', '$country_tag', '$weight', '$price', '$start_date', '$end_date','$logged_user', '1');";
        }else if($j == count($p_weight)-1){
            $upPer .= "INSERT INTO corporate_client_special_rate (corporate_client_email, goods_type, country_tag, weight, price,  start_date, end_date, entry_by, status) VALUES ('$corporate_email', 'P', '$country_tag', '$weight', '$price', '$start_date', '$end_date','$logged_user', '1')";
        }else{
            $upPer .= "INSERT INTO corporate_client_special_rate (corporate_client_email, goods_type, country_tag, weight, price,  start_date, end_date, entry_by, status) VALUES ('$corporate_email', 'P', '$country_tag', '$weight', '$price', '$start_date', '$end_date','$logged_user', '1');";
        }
        
    }
    
    
    if($db2->link->multi_query($upPer) === TRUE){
        $ret++;
    }else{
        echo $db2->link->error;
    }
    
    echo $ret;
}
 ?>