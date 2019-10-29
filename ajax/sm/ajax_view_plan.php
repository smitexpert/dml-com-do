<?php
require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['app_view_modal'])){
    $id = $_POST['app_view_modal'];
    
    $sql = "SELECT marketing_appointment_plan.*, corporate_company.company_name, corporate_company.address, marketing_contact_person.* FROM marketing_appointment_plan INNER JOIN corporate_company ON marketing_appointment_plan.company_id = corporate_company.company_id INNER JOIN marketing_contact_person ON marketing_contact_person.id = marketing_appointment_plan.contact_person WHERE marketing_appointment_plan.id = '$id'";

    $query = $db->link->query($sql);
    $row = $query->fetch_array();
    if(($row['status'] == '1') && ($row['app_date'] < date("Y-m-d"))){
        $row['status'] = '3';
        $row['action'] = '0';
    }else if(($row['status'] == '1') && ($row['app_date'] == date("Y-m-d"))){
        $row['action'] = '1';
    }else{
        $row['action'] = '0';
    }
    echo json_encode($row);
}

if(isset($_POST['plan_view_modal'])){
    $id = $_POST['plan_view_modal'];
    
    $sql = "SELECT marketing_add_plan.*, corporate_company.company_name, corporate_company.address FROM marketing_add_plan INNER JOIN corporate_company ON corporate_company.company_id = marketing_add_plan.company_id WHERE marketing_add_plan.id='$id'";

    $query = $db->link->query($sql);

    $row = $query->fetch_array();
    if(($row['status'] == '1') && ($row['plan_date'] < date("Y-m-d"))){
        $row['status'] = '3';
        $row['action'] = '0';
    }else if(($row['status'] == '1') && ($row['plan_date'] == date("Y-m-d"))){
        $row['action'] = '1';
    }else{
        $row['action'] = '0';
    }
    echo json_encode($row);
}

// var_dump($_REQUEST);