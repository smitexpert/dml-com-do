<?php

require __DIR__.'/lib/Session.php';
require __DIR__."/lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

?>
<?php

if(isset($_POST['principalid'])){
    
    $principalid = $_POST['principalid'];
    
    $sqlP = "SELECT * FROM principals_name WHERE id = '$principalid'";
    $rltP = $db->link->query($sqlP);
    $rowP = $rltP->fetch_assoc();
    
    $currency_name = $rowP['currency'];
    $fuel_cost = $rowP['fuel_cost'];
    $airlines_cost = $rowP['airlines_cost'];
    
    $p_i = 1;
    
    for($pi=0.5; $pi<=3.00; $pi+=0.50){
        $p_i++;
    }
    
    
    $sqlCurrency = "SELECT * FROM currency";
    $rltCurrency = $db->link->query($sqlCurrency);
    
    $usd = "";
    $base_currency = "";
    
    while($rowCurrency = $rltCurrency->fetch_assoc()){
        if($rowCurrency['currency_name'] == 'USD'){
            $usd =$rowCurrency['currency_rate'];
        }
        
        if($rowCurrency['currency_name'] == $currency_name){
            $base_currency = $rowCurrency['currency_rate'];
        }
    }
    
    
    
    
?>

<style>
    /*#stickytable {
        overflow: auto;
        height: 100vh;
    }

    

    #stickytable table {
      border-collapse: collapse;
    }

    #stickytable td, #toptable th {
        width: 30px;
        border: 1px solid #000 !important;
    }
    
    #stickytable thead th {
        border-right: 5px solid red;
          background:white;
          background-clip: padding-box;
    }*/
    
    

</style>




<div id="stickytable">

    <table class="table table-bordered price-table table-striped table-hover">
        <thead>
            <tr style="align: center;">
                <th rowspan="2">GOODS TYPE</th>
                <th></th>
                <?php
        $sqlZone = "SELECT DISTINCT zone FROM principal_zone WHERE principal_id='$principalid' ORDER BY zone ASC";
        $rltZone = $db->link->query($sqlZone);
        while($rowZone = $rltZone->fetch_assoc()){
            ?>

                <th onclick="zone_click(event)" id="zone_<?php echo $rowZone['zone']; ?>" colspan="3"><?php echo 'ZONE: '. $rowZone['zone']; ?></th>

                <?php
        }
        ?>
            </tr>
            <tr>
                <th>WEIGHT (kg)</th>

                <?php
        $sqlZone = "SELECT DISTINCT zone FROM principal_zone WHERE principal_id='$principalid' ORDER BY zone ASC";
        $rltZone = $db->link->query($sqlZone);
        while($rowZone = $rltZone->fetch_assoc()){
            ?>

                <th>Rate (<?php echo $currency_name; ?>)</th>
                <th>Rate (USD)</th>
                <th>Costing (USD)</th>

                <?php
        }
        ?>


            </tr>
        </thead>

        <tbody>
            <?php
    
    $i=0.25;
    
    while($i<=3.0){
        ?>

            <tr>

                <?php
        if($i==0.25){
            ?>
                <th rowspan="<?php echo $p_i; ?>">DOCUMENT</th>
                <?php
        }
        ?>

                <th onclick="weight_click(event)" id="weight_<?php echo str_replace(".","_","$i"); ?>"><?php echo number_format($i, 2); ?></th>

                <?php
        
        $sqlZoneP = "SELECT DISTINCT zone FROM principal_zone WHERE principal_id='$principalid' ORDER BY zone ASC";
        $rltZoneP = $db->link->query($sqlZoneP);
        while($rowZoneP = $rltZoneP->fetch_assoc()){
            $zone = $rowZoneP['zone'];
            
            $sqlR = "SELECT price FROM principal_price WHERE principal_id='$principalid' AND weight='$i' AND zone='$zone' AND goods_type='D'";
            $rltR = $db->link->query($sqlR);
            $rowR = $rltR->fetch_assoc();
            
            $showR = 1;
            
            if(($rowR['price'] == null) || ($rowR['price'] == 0)){
                $showR = 0;
            }
            
            ?>
                <td class="zone_<?php echo $zone ?> weight_<?php echo str_replace(".","_","$i"); ?>"><?php 
            if($showR != 0)
                echo number_format($rowR['price'], 2);
                    ?></td>
                
                <td class="zone_<?php echo $zone ?> weight_<?php echo str_replace(".","_","$i"); ?>"><?php
            if($showR != 0)
                echo number_format($db->converttousd($principalid, $rowR['price']), 2);
                ?></td>

                    

                <td class="zone_<?php echo $zone ?> weight_<?php echo str_replace(".","_","$i"); ?>"><?php 
            
                if($i == 0.25){
                    $unit = $i/0.5;
                }else{
                    $unit = $i/0.5;
                }
            
                
                
            if($rowR['price'] != 0){
                $final_costing = ((($rowR['price']*$base_currency)/$usd)+((($rowR['price']*$base_currency)/$usd)*$fuel_cost)/100)+($unit*$airlines_cost);
                echo number_format($final_costing, 2);
            }
                
                ?></td>
                <?php
            
            
        }
        
        ?>

            </tr>




            <?php
        if($i==0.25){
            $i=0.50;
        }else{
            $i+=0.50;
        }
    }
    
    $sqlTotalW = "SELECT * FROM tbl_weight ORDER BY weight ASC";
    $rltTotalW = $db->link->query($sqlTotalW);
    
    $totalW = $rltTotalW->num_rows;
    
    $l=1;
    
    while($rowW = $rltTotalW->fetch_assoc()){
        $weight = $rowW['weight'];
        ?>
            <tr>
                <?php if($l==1){ ?>
                <th rowspan="<?php echo $totalW; ?>" style="vertical-align: top;">PARCEL</th>
                <?php } $l++; ?>

                <th onclick="weight_click(event)" id="weight_<?php echo str_replace(".","_","$weight"); ?>"><?php echo $weight; ?></th>

                <?php
        
            $sqlZoneD = "SELECT DISTINCT zone FROM principal_zone WHERE principal_id='$principalid' ORDER BY zone ASC";
            $rltZoneD = $db->link->query($sqlZoneD);
            while($rowZoneD = $rltZoneD->fetch_assoc()){
                $zone = $rowZoneD['zone'];
                $sqlPrice = "SELECT price FROM principal_price WHERE principal_id='$principalid' AND weight='$weight' AND zone='$zone' AND goods_type='P'";
                $rltPrice = $db->link->query($sqlPrice);
                $rowPrice = $rltPrice->fetch_assoc();
                
                $show = 1;
                
                if(($rowPrice['price'] == null) || ($rowPrice['price'] == 0)){
                    $show = 0;
                }
                
                ?>
                <td class="zone_<?php echo $zone ?> weight_<?php echo str_replace(".","_","$weight"); ?>"><?php
                
                if($show == 1)
                    echo number_format($rowPrice['price'], 2);
                
                    ?></td>
                <td class="zone_<?php echo $zone ?> weight_<?php echo str_replace(".","_","$weight"); ?>"><?php 
                
                if($show == 1)
                    echo $db->converttousd($principalid, $rowPrice['price']);
                    
                    ?></td>

                <td class="zone_<?php echo $zone ?> weight_<?php echo str_replace(".","_","$weight"); ?>"><?php 
                
                
                $priceD = $rowPrice['price'];
                $unitD = $weight/0.5;
            
                
                
            if(($rowPrice['price'] != NULL) && ($rowPrice['price'] != 0)){
                $final_costingD = ((($rowPrice['price']*$base_currency)/$usd)+((($rowPrice['price']*$base_currency)/$usd)*$fuel_cost)/100)+($unitD*$airlines_cost);
                echo number_format($final_costingD, 2);
            }
                
                ?></td>

                <?php
            }
            ?>

            </tr>
            <?php
    }
    
        ?>
        </tbody>


    </table>
</div>

<?php
    
}


if(isset($_POST['update_zone_price'])){
    
    $zone_code = $_POST['update_zone_price'];
    $prinicipal_Id = $_POST['prinicipal_Id'];
    
    $sql_c = "SELECT DISTINCT zone FROM principal_price WHERE principal_id='$prinicipal_Id' and zone='$zone_code'";
    $rlt_c = $db->link->query($sql_c);
    
    $row_c = $rlt_c->fetch_row();
    
    
    if($row_c[0] == null){
        echo 'null';
    }else{
        
    
    ?>


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
                    $dm_price = 0;
                    ?>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo number_format($dw, 2).' kg'; ?></span>
                            <input type="hidden" value="<?php echo $dw; ?>" name="d_weight[]">
                    <?php
                    
                    $sql_d = "SELECT price FROM principal_price WHERE principal_id='$prinicipal_Id' AND zone='$zone_code' AND weight='$dw' AND goods_type='D' ORDER BY weight ASC";
                    
                    $rlt_d = $db->link->query($sql_d);
                    while($row_d = $rlt_d->fetch_assoc()){                          
                        $dm_price = $row_d['price'];
                        

                    }
                ?>
                    
                            <input type="text" class="form-control up_price" name="d_price[]" placeholder="0" value="<?php echo round($dm_price, 2); ?>">
                        </div>
                    </div>
                    <?php
                    
                    
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
                        
                        $sql_p = "SELECT * FROM principal_price WHERE principal_id='$prinicipal_Id' AND zone='$zone_code' AND weight='$pw' AND goods_type='P' ORDER BY weight ASC";
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
    }

if(isset($_POST['upzoneprincipalid'])){
    
    $upzoneprincipalid = $_POST['upzoneprincipalid'];
    $zone_code_update = $_POST['zone_code_update'];
    $p_price = $_POST['p_price'];
    $p_weight = $_POST['p_weight'];
    
    $d_price = $_POST['d_price'];
    $d_weight = $_POST['d_weight'];

    // print_r($p_price);
    
    $ret = 0;
    
    $del_zone = "DELETE FROM principal_price WHERE principal_id='$upzoneprincipalid' AND zone = '$zone_code_update'";
    
    
    
    if($db->link->query($del_zone)){
        $ret++;
    }

    // echo $del_zone;
    
    
    
    
    for($i=0; $i<count($d_price); $i++){
        
        $d_pr = $d_price[$i];
        $d_we = $d_weight[$i];
        
        if($i==0){
            $upDoc = "INSERT INTO principal_price(principal_id, zone, country, goods_type, weight, price, status) VALUES ('$upzoneprincipalid', '$zone_code_update', '0', 'D', '$d_we', '$d_pr', '1');";
        }else if($i==count($d_price)-1){
            $upDoc .= "INSERT INTO principal_price(principal_id, zone, country, goods_type, weight, price, status) VALUES ('$upzoneprincipalid', '$zone_code_update', '0', 'D', '$d_we', '$d_pr', '1')";
        }else{
            $upDoc .= "INSERT INTO principal_price(principal_id, zone, country, goods_type, weight, price, status) VALUES ('$upzoneprincipalid', '$zone_code_update', '0', 'D', '$d_we', '$d_pr', '1');";
        }
        
    }

    // echo $upDoc;
    
    
    if($db->link->multi_query($upDoc)){
        $ret++;
    }else{
        echo $db->link->error;
    }
    
    
    
    for($j=0; $j<count($p_price); $j++){
        
        $p_pr = $p_price[$j];
        $p_we = $p_weight[$j];
        
        if($j==0){
            $upPer = "INSERT INTO principal_price(principal_id, zone, country, goods_type, weight, price, status) VALUES ('$upzoneprincipalid', '$zone_code_update', '0', 'P', '$p_we', '$p_pr', '1');";
        }else if($j==count($p_price)-1){
            $upPer .= "INSERT INTO principal_price(principal_id, zone, country, goods_type, weight, price, status) VALUES ('$upzoneprincipalid', '$zone_code_update', '0', 'P', '$p_we', '$p_pr', '1')";
        }else{
            $upPer .= "INSERT INTO principal_price(principal_id, zone, country, goods_type, weight, price, status) VALUES ('$upzoneprincipalid', '$zone_code_update', '0', 'P', '$p_we', '$p_pr', '1');";
        }

        
        
    }

    // echo $upPer;
    
    
    if($dbn->link->multi_query($upPer)){
        $ret++;
    }else{
        echo $dbn->link->error;
    }
    
    echo $ret;
    
    
}


?>
