<?php
include("../../lib/Session.php");
include("../../lib/Database.php");



Session::checkAgentSession();

$agent_email = Session::get('agent_email');
$db = new Database();

if(isset($_POST['country_tag'])){
    $agent_email = Session::get('agent_email');
    $country_tag =  $_POST['country_tag'];
    $weight =  $_POST['weight'];

    //get price from agent_client_price Document
    $getAgentPrice = "SELECT agent_client_price.*, principals_name.principal_name FROM agent_client_price INNER JOIN dml_zone ON agent_client_price.zone = dml_zone.zone INNER JOIN principals_name ON agent_client_price.principal_id = principals_name.id WHERE dml_zone.country_tag = '$country_tag' AND agent_client_price.weight = '$weight' AND agent_client_price.agent_client_email = '$agent_email' AND agent_client_price.goods_type = 'D' AND agent_client_price.price > 0 ORDER BY agent_client_price.price ASC";

    $getPrice = $db->link->query($getAgentPrice);

    //get special price

    $getAgentSpecialPrice = "SELECT agent_client_special_rate.*, principals_name.principal_name FROM agent_client_special_rate INNER JOIN principals_name ON agent_client_special_rate.principal_id = principals_name.id WHERE agent_client_special_rate.country_tag = '$country_tag' AND agent_client_special_rate.weight = '$weight' AND agent_client_special_rate.agent_client_email = '$agent_email' AND agent_client_special_rate.goods_type = 'D' AND agent_client_special_rate.price > 0 ORDER BY agent_client_special_rate.price ASC";

    $getSpecialPrice = $db->link->query($getAgentSpecialPrice);


    //get price from agent_client_price Percel
    $getAgentPrice_P = "SELECT agent_client_price.*, principals_name.principal_name FROM agent_client_price INNER JOIN dml_zone ON agent_client_price.zone = dml_zone.zone INNER JOIN principals_name ON agent_client_price.principal_id = principals_name.id WHERE dml_zone.country_tag = '$country_tag' AND agent_client_price.weight = '$weight' AND agent_client_price.agent_client_email = '$agent_email' AND agent_client_price.goods_type = 'P' AND agent_client_price.price > 0 ORDER BY agent_client_price.price ASC";

    $getPrice_P = $db->link->query($getAgentPrice_P);

    //get special price for Percel

    $getAgentSpecialPrice_P = "SELECT agent_client_special_rate.*, principals_name.principal_name FROM agent_client_special_rate INNER JOIN principals_name ON agent_client_special_rate.principal_id = principals_name.id WHERE agent_client_special_rate.country_tag = '$country_tag' AND agent_client_special_rate.weight = '$weight' AND agent_client_special_rate.agent_client_email = '$agent_email' AND agent_client_special_rate.goods_type = 'P' AND agent_client_special_rate.price > 0 ORDER BY agent_client_special_rate.price ASC";

    $getSpecialPrice_P = $db->link->query($getAgentSpecialPrice_P);

    // echo $getAgentSpecialPrice;
    if($getPrice->num_rows > 0){
?>
<style>
    .first_row {
        font-size: 18px;
        background-color: yellow;
        color: red;
        font-weight: bold;
    }
</style>
    <div class="all_price">
    <table class="table table-bordered table-hover">
        <caption style="text-align: left;font-size: 18px;font-weight: bold;color: green;">DOX</caption>
        <tr>
            <th rowspan="2" style="text-align:center">SERVICE NAME</th>
            <th rowspan="2" style="text-align:center">WEIGHT(KG)</th>
            <th colspan="2" style="text-align:center">GENERAL PRICE</th>
            <th colspan="2" style="text-align:center">SPECIAL PRICE</th>
        </tr>
        <tr>
            <th style="text-align:center">PRICE (USD)</th>
            <th style="text-align:center">PRICE (BDT)</th>
            <th style="text-align:center">PRICE (USD)</th>
            <th style="text-align:center">PRICE (BDT)</th>
        </tr>

        <?php
        $count = 1;
    while($getPrice_D = $getPrice->fetch_array()){
            $getSpecialPrice_D = $getSpecialPrice->fetch_assoc();
            if($count == 1){
            ?>
        <tr class="first_row">
            <td title="Lowest Price"><?php echo $getPrice_D['principal_name']; ?></td>
            <td style="text-align:center"><?php echo $weight; ?></td>
            <td style="text-align: right;"><?php echo $getPrice_D['price']; ?></td>
            <td style="text-align: right;"><?php echo $db->converttobdt('usd', $getPrice_D['price']); ?></td>
            
            <td style="text-align: right;"><?php echo $getSpecialPrice_D['price']; ?></td>
            <td style="text-align: right;"><?php echo $db->converttobdt('usd', $getSpecialPrice_D['price']); ?></td>
        </tr>
        <?php
            }else{
        ?>
        <tr>
            <td title="Lowest Price"><?php echo $getPrice_D['principal_name']; ?></td>
            <td style="text-align:center"><?php echo $weight; ?></td>
            <td style="text-align: right;"><?php echo $getPrice_D['price']; ?></td>
            <td style="text-align: right;"><?php echo $db->converttobdt('usd', $getPrice_D['price']); ?></td>
            
            <td style="text-align: right;"><?php echo $getSpecialPrice_D['price']; ?></td>
            <td style="text-align: right;"><?php echo $db->converttobdt('usd', $getSpecialPrice_D['price']); ?></td>
        </tr>
        <?php
        }
        
        $count++;
    }
    
}
if($getPrice_P->num_rows > 0){
?>

    </table>
    <table class="table table-bordered table-hover">
        <caption style="text-align: left;font-size: 22px;font-weight: bold;color: green;">SPX</caption>
        <tr>
            <th rowspan="2" style="text-align:center">SERVICE NAME</th>
            <th rowspan="2" style="text-align:center">WEIGHT(KG)</th>
            <th colspan="2" style="text-align:center">GENERAL PRICE</th>
            <th colspan="2" style="text-align:center">SPECIAL PRICE</th>
        </tr>
        <tr>
            <th style="text-align:center">PRICE (USD)</th>
            <th style="text-align:center">PRICE (BDT)</th>
            <th style="text-align:center">PRICE (USD)</th>
            <th style="text-align:center">PRICE (BDT)</th>
        </tr>

        <?php
    $count = 1;
    while($getPrice_PP = $getPrice_P->fetch_assoc()){
        $getSpecialPrice_PP = $getSpecialPrice_P->fetch_assoc();
        if($count == 1){
            ?>
            <tr class="first_row">
                <td title="Lowest Price"><?php echo $getPrice_PP['principal_name']; ?></td>
                <td style="text-align:center"><?php echo $weight; ?></td>
                <td style="text-align: right;"><?php echo $getPrice_PP['price']; ?></td>
                <td style="text-align: right;"><?php echo $db->converttobdt('usd', $getPrice_PP['price']); ?></td>
                
                <td style="text-align: right;"><?php echo $getSpecialPrice_PP['price']; ?></td>
                <td style="text-align: right;"><?php echo $db->converttobdt('usd', $getSpecialPrice_PP['price']); ?></td>
            </tr>
            <?php
        }else{
            ?>
            <tr>
                <td title="Lowest Price"><?php echo $getPrice_PP['principal_name']; ?></td>
                <td style="text-align:center"><?php echo $weight; ?></td>
                <td style="text-align: right;"><?php echo $getPrice_PP['price']; ?></td>
                <td style="text-align: right;"><?php echo $db->converttobdt('usd', $getPrice_PP['price']); ?></td>
                
                <td style="text-align: right;"><?php echo $getSpecialPrice_PP['price']; ?></td>
                <td style="text-align: right;"><?php echo $db->converttobdt('usd', $getSpecialPrice_PP['price']); ?></td>
            </tr>
            <?php
        }

        $count++;
        
        }
    
?>

    </table>
</div>

<?php
        }else{
            ?>
            <div class="all_price">
                PRICE NOT SET YET ! PLEASE SET PRICE FIRST.
            </div>
            <?php
        }
        

}
?>