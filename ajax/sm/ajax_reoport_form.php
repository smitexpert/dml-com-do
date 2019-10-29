<?php
require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['app_get_report'])){
    $id = $_POST['app_get_report'];
    $sql = "SELECT * FROM marketing_appointment_plan_report WHERE app_plan_id='$id'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        echo json_encode($query->fetch_array());
    }else{
        $arr['report'] = "";
        echo  json_encode($arr);
    }
}

if(isset($_POST['visit_get_report'])){
    $id = $_POST['visit_get_report'];
    $sql = "SELECT * FROM marketing_add_plan_report WHERE visit_plan_id='$id'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        echo json_encode($query->fetch_array());
    }else{
        $arr['report'] = "";
        echo  json_encode($arr);
    }
}

if(isset($_POST['app_status'])){
    $app_status = $_POST['app_status'];
    $app_report = $_POST['app_report'];
    $app_id = $_POST['app_id'];
    if(($app_status != '1') && ($app_report != "")){
        $sql = "INSERT INTO marketing_appointment_plan_report (app_plan_id, report) VALUES ('$app_id', '$app_report'); UPDATE marketing_appointment_plan SET status='$app_status' WHERE id='$app_id'";

        $query = $db->link->multi_query($sql);

        if($query){
            echo '1';
        }else{
            echo $db->link->error;
        }
    }else{
        echo '0';
    }
}

if(isset($_POST['visit_status'])){
    $visit_status = $_POST['visit_status'];
    $visit_report = $_POST['visit_report'];
    $visit_plan_id = $_POST['visit_plan_id'];

    if(($visit_status != "1") && ($visit_report != "")){
        $sql = "INSERT INTO marketing_add_plan_report (visit_plan_id, report) VALUES ('$visit_plan_id', '$visit_report'); UPDATE marketing_add_plan SET status = '$visit_status' WHERE id='$visit_plan_id'";

        $query = $db->link->multi_query($sql);

        if($query){
            echo '1';
        }else{
            echo $db->link->error;
        }
    }else{
        echo '0';
    }
}