<?php

require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['contact_name'])){
    $contact_name = $_POST['contact_name'];
    $contact_designation = $_POST['contact_designation'];
    $contact_mobile = $_POST['contact_mobile'];
    $contact_email = $_POST['contact_email'];
    $company_id = $_POST['company_id'];

    $sql = "INSERT INTO marketing_contact_person (company_id, name, designation, mobile, email, created_by) VALUES ('$company_id', '$contact_name', '$contact_designation', '$contact_mobile', '$contact_email', '$logged_user')";

    $query = $db->link->query($sql);

    if($query){
        echo "1";
    }else{
        echo $db->link->error;
    }
}

if(isset($_POST['get_contact_person_list_table'])){
    $company_id = $_POST['get_contact_person_list_table'];

    $sql = "SELECT * FROM marketing_contact_person WHERE company_id='$company_id'";
    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        $rows = array();
        while($row = $query->fetch_array()){
            $rows[] = $row;
        }

        echo json_encode($rows);
        
    }else{
        echo 0;
    }
}

if(isset($_POST['get_contact_person_list'])){
    $company_id = $_POST['get_contact_person_list'];
    $sql = "SELECT * FROM marketing_contact_person WHERE company_id='$company_id'";
    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        ?>
            <option value="">--</option>
        <?php
        while($row = $query->fetch_array()){
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> (<?php echo $row['designation']; ?>)</option>
            <?php
        }
        
    }
}

if(isset($_POST['plan_date'])){
    $plan_date = $_POST['plan_date'];
    $plan_time = $_POST['plan_time'];
    $plan_comment = $_POST['plan_comment'];
    $plan_comment = $db->link->real_escape_string($plan_comment);
    $plan_company_id = $_POST['plan_company_id'];

    $sql = "INSERT INTO marketing_add_plan (plan_date, plan_time, comment, company_id, user_id, status, created_by) VALUES ('$plan_date', '$plan_time', '$plan_comment', '$plan_company_id', '$logged_user', '1', '$logged_user')";


    $query = $db->link->query($sql);

    if($query){
        echo 1;
    }else{
        echo $db->link->error;
    }

//     INSERT INTO table_listnames (name, address, tele)
// SELECT * FROM (SELECT 'name1', 'add', '022') AS tmp
// WHERE NOT EXISTS (
//     SELECT name FROM table_listnames WHERE name = 'name1'
// ) LIMIT 1;
}


if(isset($_POST['app_date'])){
    $app_date = $_POST['app_date'];
    $app_time = $_POST['app_time'];
    $contact_person = $_POST['contact_person'];
    $comment = $_POST['comment'];
    $comment = $db->link->real_escape_string($comment);
    $app_company_id = $_POST['app_company_id'];

    $sql = "INSERT INTO marketing_appointment_plan (app_date, app_time, comment, contact_person, company_id, user_id, status, created_by) VALUES ('$app_date', '$app_time', '$comment', '$contact_person', '$app_company_id', '$logged_user', '1', '$logged_user')";

    $query = $db->link->query($sql);

    if($query){
        echo '1';
    }else{
        echo $db->link->error;
    }
    
}

?>