<?php

require '../../lib/Session.php';
require "../../lib/Database.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

$logged_user = Session::get('adminId');

if(isset($_POST['get_contact_person'])){
    $id = $_POST['get_contact_person'];

    ?>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Designation</th>
            <th>Moblie</th>
            <th>Email</th>
        </tr>
        <?php

    $sql = "SELECT * FROM marketing_contact_person WHERE company_id='$id'";
    $query = $db->link->query($sql);
    
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['designation']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <?php
}

if(isset($_POST['total_visit'])){
    $id = $_POST['total_visit'];

    ?>
    <table class="table">
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Reports</th>
        </tr>
    <?php

    $sql = "SELECT marketing_add_plan.*, (SELECT marketing_add_plan_report.report FROM marketing_add_plan_report WHERE marketing_add_plan_report.visit_plan_id = marketing_add_plan.id) report FROM marketing_add_plan WHERE marketing_add_plan.company_id='$id'";

    $query = $db->link->query($sql);

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            if(($row['status'] == '1') && ($row['plan_date'] < date("Y-m-d"))){
                $row['status'] = "MISSED";
            }else if($row['status'] == '2'){
                $row['status'] = "COMPLETED";
            }else if($row['status'] == '3'){
                $row['status'] = "MISSED";
            }else if($row['status'] == '4'){
                $row['status'] = "Canceled By User";
            }else if($row['status'] == '0'){
                $row['status'] = "Canceled By Company";
            }else if($row['status'] == '5'){
                $row['status'] = "Canceled By DML";
            }else{
                $row['status'] = "SCHEDULED";
            }
            ?>
            <tr>
                <td><?php echo $row['plan_date']; ?></td>
                <td><?php echo $row['plan_time']; ?></td>
                <td><?php echo $row['comment']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['report']; ?></td>
            </tr>
            <?php
        }
    }

    ?>

    
</table>

<?php


}

if(isset($_POST['appointment'])){
    $id = $_POST['appointment'];

    $sql = "SELECT marketing_appointment_plan.*, marketing_contact_person.*, (SELECT marketing_appointment_plan_report.report FROM marketing_appointment_plan_report WHERE marketing_appointment_plan_report.app_plan_id=marketing_appointment_plan.id) report FROM marketing_appointment_plan INNER JOIN marketing_contact_person ON marketing_contact_person.id=marketing_appointment_plan.contact_person
    WHERE marketing_appointment_plan.company_id='$id'";

    ?>
    <table class="table">
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Comment</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Reports</th>
            <th>Status</th>
        </tr>
        <?php
            $query = $db->link->query($sql);
            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    if(($row['status'] == '1') && ($row['app_date'] < date("Y-m-d"))){
                        $row['status'] = "MISSED";
                    }else if($row['status'] == '2'){
                        $row['status'] = "COMPLETED";
                    }else if($row['status'] == '3'){
                        $row['status'] = "MISSED";
                    }else if($row['status'] == '4'){
                        $row['status'] = "Canceled By User";
                    }else if($row['status'] == '0'){
                        $row['status'] = "Canceled By Company";
                    }else if($row['status'] == '5'){
                        $row['status'] = "Canceled By DML";
                    }else{
                        $row['status'] = "SCHEDULED";
                    }
                    ?>
                <tr>
                    <td><?php echo $row['app_date']; ?></td>
                    <td><?php echo $row['app_time']; ?></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['report']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
                    <?php
                }
            }
        ?>
    </table>
    <?php
}