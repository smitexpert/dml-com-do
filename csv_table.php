<?php

$fields = array('DHL AWB NO', 'SHIPPER REFERENCE', 'SHIPPER COMPANY', 'SHIPPER ATTN NAME', 'SHIPPER COUNTRY', 'RECEIVER COMPANY', 'RECEIVER ATTN', ' RECEIVER ADD 1', 'RECEIVER ADD 2', 'RECEIVER ADD 3', 'RECEIVER CITY', 'RECEIVER POSTAL CODE', 'RECEIVER COUNTRY CODE', 'RECEIVER PHONE', 'RECEIVER MOBILE', 'SHIPMENT PIECES', 'SHIPMENT WEIGHT', 'LOCAL PRODUCT CODE', 'CONTENTS ', 'ROUNDED WEIGHT', 'SHIPMENT DECLARED VALUE');

function csv_table(){
   $table = '<table>';
   $table .= '<tr>';
   $table .= '<td>DHL AWB NO</td>';
   $table .= '<td>SHIPPER REFERENCE</td>';
   $table .= '<td>SHIPPER COMPANY</td>';
   $table .= '<td>SHIPPER ATTN NAME</td>';
   $table .= '<td>SHIPPER COUNTRY</td>';
   $table .= '<td>RECEIVER COMPANY</td>';
   $table .= '<td>RECEIVER ATTN</td>';
   $table .= '<td>RECEIVER ADD 1</td>';
    
    return $table;
}

?>