<?php

require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$db2 = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['select_corporate_zone'])){

    $corporate_email = $_POST['select_corporate_zone'];

    //select all zone from general price
    $get_zone = "SELECT DISTINCT zone FROM corporate_client_price WHERE corporate_client_email = '$corporate_email' ORDER BY zone ASC";
    $get_zone_list = $db->link->query($get_zone);

    if($get_zone_list -> num_rows > 0){
        ?>
        <option value="">--</option>
        <?php
        while($row = $get_zone_list->fetch_assoc()){
            ?>
            <option value="<?php echo $row['zone']; ?>"><?php echo $row['zone']; ?></option>
            <?php
        }
    }

}

if(isset($_POST['selected_zone'])){
    $selected_zone = $_POST['selected_zone'];
    $corporate_email = $_POST['selected_corporate'];
?>
    <!-- print corporate general price for update -->
    <div id="updatetable">
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
                <?php
        
                $dw = 0.25;
                while( $dw<=3.0){
                    
                    
                    $sql_d = "SELECT price FROM corporate_client_price WHERE corporate_client_email='$corporate_email' AND zone='$selected_zone' AND weight='$dw' AND goods_type='D' ORDER BY weight ASC";
                    
                    $rlt_d = $db->link->query($sql_d);
                    while($row_d = $rlt_d->fetch_assoc()){                          

                ?>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo number_format($dw, 2).' kg'; ?></span>
                            <input type="hidden" value="<?php echo $dw; ?>" name="d_weight[]">
                            <input type="text" class="form-control up_price" name="d_price[]" placeholder="0" value="<?php echo round($row_d['price'], 2); ?>">
                        </div>
                    </div>
                    <?php

                    }
                    
                    
                    if($dw == 0.25){
                        $dw = 0.50;
                    }else{
                        $dw += 0.50;
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
                <div style="font-weight:bold; padding-bottom:5px;">SET PRICE FOR PARCEL</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php
                    $sql_p_w = "SELECT weight FROM tbl_weight ORDER BY weight ASC";
                    $sql_p_r = $db->link->query($sql_p_w);
                    while($row_p_w = $sql_p_r->fetch_assoc()){
                        $pw = $row_p_w['weight'];
                        
                        $sql_p = "SELECT * FROM corporate_client_price WHERE corporate_client_email='$corporate_email' AND zone='$selected_zone' AND weight='$pw' AND goods_type='P' ORDER BY weight ASC";
                       $rlt_p = $db->link->query($sql_p);
                        if($rlt_p->num_rows > 0){
                             while($row_p = $rlt_p->fetch_assoc()){
                                        ?>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo number_format($pw, 2).' kg'; ?></span>
                            <input type="hidden" value="<?php echo $pw; ?>" name="p_weight[]">
                            <input type="text" class="form-control up_price" name="p_price[]" placeholder="0" value="<?php echo round($row_p['price'], 2); ?>">
                        </div>
                    </div>
                    <?php
                                            }
                        }else{
                            ?>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo number_format($pw, 2).' kg'; ?></span>
                            <input type="hidden" value="<?php echo $pw; ?>" name="p_weight[]">
                            <input type="text" class="form-control up_price" name="p_price[]" placeholder="<?php echo 0; ?>">
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
                <button id="" type="submit" class="btn btn-lg btn-warning btn-block">UPDATE</button>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

<?php
if(isset($_POST['upzone'])){
    $zone =  $_POST['upzone'];
    $corporate_email = $_POST['corporate_email'];
    $d_weight = $_POST['d_weight'];
    $d_price = $_POST['d_price'];
    $p_weight = $_POST['p_weight'];
    $p_price = $_POST['p_price'];

    //update multi-query
    $ret = 0;
    
    $del_zone = "DELETE FROM corporate_client_price WHERE corporate_client_email='$corporate_email' AND zone = '$zone'";
    
    
    if($db->link->query($del_zone)){
        $ret++;
    }


    
    
    
    
    for($i=0; $i<count($d_price); $i++){
        
        $price = $d_price[$i];
        $weight = $d_weight[$i];
        
        if($i==0){
            $upDoc = "INSERT INTO corporate_client_price(corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'D', '$zone', '$weight', '$price');";
        }else if($i==count($d_price)-1){
            $upDoc .= "INSERT INTO corporate_client_price(corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'D', '$zone', '$weight', '$price')";
        }else{
            $upDoc .= "INSERT INTO corporate_client_price(corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'D', '$zone', '$weight', '$price');";
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
            $upPer = "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'P', '$zone', '$weight', '$price');";
        }else if($j == count($p_weight)-1){
            $upPer .= "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'P', '$zone', '$weight', '$price')";
        }else{
            $upPer .= "INSERT INTO corporate_client_price (corporate_client_email, goods_type, zone, weight, price) VALUES ('$corporate_email', 'P', '$zone', '$weight', '$price');";
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