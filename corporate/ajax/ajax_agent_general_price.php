<?php
include("../../lib/Session.php");
include("../../lib/Database.php");



Session::checkAgentSession();

$agent_email = Session::get('agent_email');
$db = new Database();

if(isset($_POST['view_price_principal'])){
    
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
    
    
    
    $view_price_principal = $_POST['view_price_principal'];
    $agent_mail = $agent_email;
    
    
    
    
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