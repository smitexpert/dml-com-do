<?php

require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['get_customer_info'])){
    $id = $_POST['get_customer_info'];
    
    $sql = "SELECT * FROM corporate_company WHERE company_id='$id'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        $row = $query->fetch_array();
        echo json_encode($row);
    }
}

if(isset($_POST['edit_company_id'])){
    $edit_company_id = $_POST['edit_company_id'];
    $edit_company_name = $_POST['edit_company_name'];
    $edit_company_contact = $_POST['edit_company_contact'];
    $edit_contact = $_POST['edit_contact'];
    $edit_email_address = $_POST['edit_email_address'];
    $edit_address = $_POST['edit_address'];
    $edit_assigne = $_POST['edit_assigne'];

    $sql = "UPDATE corporate_company SET name='$edit_company_contact', email='$edit_email_address', company_name='$edit_company_name', address='$edit_address', contact='$edit_contact', assign_to='$edit_assigne' WHERE company_id='$edit_company_id'";

    $query = $db->link->query($sql);

    if($query){
        echo '1';
    }else{
        echo $db->link->error;
    }
}

?>