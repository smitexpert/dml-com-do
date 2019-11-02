<?php

require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['visit_plan_ajax'])){

    $date = $_POST['to_do_date'];
    $staff_id = $_POST['staff_id'];

    $sql_plan = "SELECT marketing_add_plan.*, corporate_company.company_name FROM marketing_add_plan INNER JOIN corporate_company ON corporate_company.company_id = marketing_add_plan.company_id WHERE user_id='$staff_id' AND plan_date=date('$date') ORDER BY marketing_add_plan.plan_time ASC";

    $query_plan = $db->link->query($sql_plan);
    $view_plan = array();

    if($query_plan->num_rows > 0){
        while($row_plan = $query_plan->fetch_assoc()){
            if(($row_plan['status'] == '1') && ($row_plan['plan_date'] < date("Y-m-d"))){
                $row_plan['status'] = "MISSED";
            }else if($row_plan['status'] == '2'){
                $row_plan['status'] = "COMPLETED";
            }else if($row_plan['status'] == '3'){
                $row_plan['status'] = "MISSED";
            }else if($row_plan['status'] == '4'){
                $row_plan['status'] = "Canceled By User";
            }else if($row_plan['status'] == '0'){
                $row_plan['status'] = "Canceled By Company";
            }else if($row_plan['status'] == '5'){
                $row_plan['status'] = "Canceled By DML";
            }else{
                $row_plan['status'] = "SCHEDULED";
            }
            $view_plan[] = $row_plan;
        }
    }

    echo json_encode($view_plan);
}

if(isset($_POST['app_plan_ajax'])){

    $staff_id = $_POST['staff_id'];
    $date = $_POST['to_do_date'];

    $sql_app = "SELECT marketing_appointment_plan.*, corporate_company.company_name, marketing_contact_person.name FROM marketing_appointment_plan INNER JOIN corporate_company ON corporate_company.company_id = marketing_appointment_plan.company_id INNER JOIN marketing_contact_person ON marketing_contact_person.id = marketing_appointment_plan.contact_person WHERE marketing_appointment_plan.user_id='$staff_id' AND marketing_appointment_plan.app_date=date('$date') ORDER BY marketing_appointment_plan.app_time ASC";

    $query_app = $db->link->query($sql_app);
    
    $view_plan = array();

    if($query_app->num_rows > 0){
        while($row_plan = $query_app->fetch_assoc()){
            if(($row_plan['status'] == '1') && ($row_plan['app_date'] < date("Y-m-d"))){
                $row_plan['status'] = "MISSED";
            }else if($row_plan['status'] == '2'){
                $row_plan['status'] = "COMPLETED";
            }else if($row_plan['status'] == '3'){
                $row_plan['status'] = "MISSED";
            }else if($row_plan['status'] == '4'){
                $row_plan['status'] = "Canceled By User";
            }else if($row_plan['status'] == '0'){
                $row_plan['status'] = "Canceled By Company";
            }else if($row_plan['status'] == '5'){
                $row_plan['status'] = "Canceled By DML";
            }else{
                $row_plan['status'] = "SCHEDULED";
            }
            $view_plan[] = $row_plan;
        }
    }

    echo json_encode($view_plan);
}

?>