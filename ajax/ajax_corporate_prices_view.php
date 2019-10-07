<?php

require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['get_view_price_corporate_email'])){
    $corporate_email = $_POST['get_view_price_corporate_email'];

    //get all zone from corporate client pricev table
    $get_zone = "SELECT DISTINCT zone FROM corporate_client_price WHERE corporate_client_email = '$corporate_email' ORDER BY zone ASC";
    $get_zone_1 = $db->link->query($get_zone);

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

    $get_corporate_price = "SELECT  *FROM corporate_client_price WHERE corporate_client_email = '$corporate_email'";
    $get_price = $db->link->query($get_corporate_price);

    if($get_price->num_rows > 0){
        while($row = $get_price->fetch_assoc()){
            $zone = $row['zone'];
            $goods_type = $row['goods_type'];
            $weight = $row['weight'];
            $price = $row['price'];
            
            $zone_price[$zone][$goods_type][$weight] = $price;
        }
    }


    $count_zone = 0;
    // print_r($get_price);

    ?>
    <div id="showpricetable">

    <table class="table table-bordered price-table table-striped table-hover">
        <thead>     
            <tr>
                <th rowspan="2">Goods Type</th>
                <th></th>
                <?php 
                if($get_zone_1){
                    while($row = $get_zone_1->fetch_assoc()){
                        ?>
                        <th>Zone :<?php echo " ".$row['zone']; ?></th>
                        <?php
                        $count_zone++;
                    }
                }
                ?>
            </tr> 
            <tr>
                <th>Weight</th>
                <?php 
                    while($count_zone){
                        ?>
                        <th>Rate(USD)</th>
                        <?php
                        $count_zone--;
                    }
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
                                    
                                $sl_dml_zone = "SELECT DISTINCT zone FROM corporate_client_price WHERE corporate_client_email = '$corporate_email' ORDER BY zone ASC";
                                $rl_dml_zone = $db->link->query($sl_dml_zone);
                                    
                                    while($row_dml_zone = $rl_dml_zone->fetch_assoc()){
                                        $current_zone = $row_dml_zone['zone'];
                                        ?>
            <!-- <td><?php 
                if($zone_price[$current_zone]['D']["$i"] != 0){ 
                echo number_format($zone_price[$current_zone]['D']["$i"], 2); 
                } ?></td> -->

            <td><?php 
                
                echo number_format($zone_price[$current_zone]['D']["$i"], 2); 
                 ?></td>
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
                                    $sl_dml_zone = "SELECT DISTINCT zone FROM corporate_client_price WHERE corporate_client_email = '$corporate_email' ORDER BY zone ASC";
                                    $rl_dml_zone = $db->link->query($sl_dml_zone);

                                        while($row_dml_zone = $rl_dml_zone->fetch_assoc()){
                                            $current_zone = $row_dml_zone['zone'];
                                            ?>
            <!-- <td><?php if($zone_price[$current_zone]['P'][$zone_weight] != 0){ echo number_format($zone_price[$current_zone]['P'][$zone_weight], 2); } ?></td> -->

            <td><?php echo number_format($zone_price[$current_zone]['P'][$zone_weight], 2);  ?></td>
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
</div>
    <?php
}   
?>