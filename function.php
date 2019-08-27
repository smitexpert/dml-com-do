<?php

function principal_check(){
    $sql = "SELECT * FROM PRINCIPAL";
    $result = $sql;
    return date("Y-m-d");
}


?>