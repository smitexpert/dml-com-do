<?php
include("../../lib/Session.php");
include("../../lib/Database.php");



Session::checkAgentSession();

$agent_email = Session::get('agent_email');
$db = new Database();


if(isset($_POST['special_country_list'])){
    $principal_id = $_POST['special_country_list'];

    $sql = "SELECT DISTINCT agent_client_special_rate.country_tag, tbl_country.country_name FROM tbl_country INNER JOIN agent_client_special_rate ON agent_client_special_rate.country_tag = tbl_country.country_tag WHERE agent_client_special_rate.agent_client_email='$agent_email' AND agent_client_special_rate.principal_id='$principal_id' ORDER BY tbl_country.country_name ASC";

    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        ?>
            <option value=""></option>
        <?php
        while($row = $query->fetch_assoc()){
            ?>
            <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
            <?php
        }
    }

}

if(isset($_POST['agent_special_price_principal'])){
    $agent_mail = $agent_email;
    $principal_id = $_POST['agent_special_price_principal'];
    $tag = $_POST['agent_special_price_tag'];

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



?>