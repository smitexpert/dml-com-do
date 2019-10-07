<?php
include("../../lib/Session.php");
include("../../lib/Database.php");



Session::checkAgentSession();

$agent_email = Session::get('agent_email');
$db = new Database();

if(isset($_POST['country_tag'])){
    $country_tag =  $_POST['country_tag'];
    $weight =  $_POST['weight'];

    //get price from agent_client_price
    $getAgentPrice = "SELECT DISTINCT agent_client_price.*,principals_name.principal_name FROM agent_client_price INNER JOIN dml_zone ON dml_zone.zone = agent_client_price.zone INNER JOIN principals_name on agent_client_price.principal_id = principals_name.id WHERE agent_client_price.zone = '1' AND agent_client_price.agent_client_email = 'smit@dml.com.bd' AND agent_client_price.weight = '0.5' ORDER BY agent_client_price.price ASC";
    // $getPrice = $db->link->query($getAgentPrice);

    echo $getAgentPrice;

}