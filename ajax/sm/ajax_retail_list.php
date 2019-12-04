<?php

require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $company_name = $_POST['company_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $types = $_POST['types'];
    $weight = $_POST['weight'];
    $destination = $_POST['destination'];
    $cost = $_POST['cost'];

    $sql = "INSERT INTO retail_customer(name, company_name, email, phone, address, destination, types, weight, cost, created_by) VALUES ('$name', '$company_name', '$email', '$mobile', '$address', '$destination', '$types', '$weight', '$cost', '$logged_user')";

    $query = $db->link->query($sql);

    if($query){
        echo "1";
    }else{
        echo $db->link->error;
    }
}