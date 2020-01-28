<?php
require "../lib/Database.php";

$db = New Database();

if(isset($_GET['country'])){
    $country = $_GET['country'];

    $country = strtoupper($country);

    $sql = "SELECT country_name, country_tag FROM tbl_country WHERE country_name LIKE '%$country%'";
    $query = $db->link->query($sql);
    
    $result = array();

    if($query->num_rows > 0){
        while($rows = $query->fetch_assoc()){
            $result[] = $rows;
        }
    }

    echo json_encode($result);
    
}

?>