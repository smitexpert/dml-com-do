<?php include('includes/header.php'); 

$logged_user = Session::get('adminId');

$date = date('Y-m-d');

$sql_plan = "SELECT marketing_add_plan.*, corporate_company.company_name FROM marketing_add_plan INNER JOIN corporate_company ON corporate_company.company_id = marketing_add_plan.company_id WHERE user_id='$logged_user' AND plan_date=date('$date') ORDER BY marketing_add_plan.plan_time ASC";

$query_plan = $db->link->query($sql_plan);

$sql_app = "SELECT marketing_appointment_plan.*, corporate_company.company_name, marketing_contact_person.name FROM marketing_appointment_plan INNER JOIN corporate_company ON corporate_company.company_id = marketing_appointment_plan.company_id INNER JOIN marketing_contact_person ON marketing_contact_person.id = marketing_appointment_plan.contact_person WHERE marketing_appointment_plan.user_id='$logged_user' AND marketing_appointment_plan.app_date=date('$date') ORDER BY marketing_appointment_plan.app_time ASC";

$query_app = $db->link->query($sql_app);


?>
<style> 
/* .modal {
    width: 700px;
    margin-left: -350px;
} */
</style>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="row">
                        <form action="" id="todo_view_form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="todo_select_date">SELECT DATE</label>
                                    <input id="todo_select_date" name="todo_select_date" type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button class="btn btn-sm btn-warning btn-block">VIEW</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            APPOINMENT PLAN
                        </div>
                        <div class="panel-body">
                            <table class="table" id="todo_app">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company</th>
                                        <th>Person</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($query_app->num_rows > 0){
                                        $j = 0;
                                        while($row_app = $query_app->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <th><?php echo ++$j; ?></th>
                                                <td><?php echo $row_app['company_name']; ?></td>
                                                <td><?php echo $row_app['name']; ?></td>
                                                <td><?php echo $row_app['comment']; ?></td>
                                                <td><?php echo $row_app['app_date']; ?></td>
                                                <td><?php echo $row_app['app_time']; ?></td>
                                                <td>
                                                    <?php
                                                        if($row_app['status'] == '1'){
                                                            echo "Scheduled";
                                                        }else if($row_app['status'] == '2'){
                                                            echo "Completed";
                                                        }else if($row_app['status'] == '3'){
                                                            echo "Missed";
                                                        }else if($row_app['status'] == '4'){
                                                            echo "Canceled By You";
                                                        }else if($row_app['status'] == '5'){
                                                            echo "Canceled By DML";
                                                        }else if($row_app['status'] == '0'){
                                                            echo "Canceled By Company";
                                                        }
                                                    ?>
                                                </td>
                                                <td><a href="#" onclick="app_view(event)" id="app_<?php echo $row_app['id']; ?>" class="btn btn-sm btn-warning app_view" data-toggle="modal" data-target="#appModal">#</a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            VISIT PLAN
                        </div>
                        <div class="panel-body">
                            <table class="table" id="todo_plan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if($query_plan->num_rows > 0){
                                            $i=1;
                                            while($row_plan = $query_plan->fetch_assoc()){
                                                ?>
                                                <tr>
                                                    <th><?php echo $i; ?></th>
                                                    <td><?php echo $row_plan['company_name']; ?></td>
                                                    <td><?php echo $row_plan['comment']; ?></td>
                                                    <td><?php echo $row_plan['plan_date']; ?></td>
                                                    <td><?php echo $row_plan['plan_time']; ?></td>
                                                    <td>
                                                        <?php
                                                            if($row_plan['status'] == '1'){
                                                                echo "Scheduled";
                                                            }else if($row_plan['status'] == '2'){
                                                                echo "Completed";
                                                            }else if($row_plan['status'] == '3'){
                                                                echo "Missed";
                                                            }else if($row_plan['status'] == '4'){
                                                                echo "Canceled By You";
                                                            }else if($row_plan['status'] == '0'){
                                                                echo "Canceled By Company";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="#" onclick="plan_view(event)" id="plan_<?php echo $row_plan['id']; ?>" class="btn btn-sm btn-warning plan_view" data-toggle="modal" data-target="#planModal">#</a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- end: PAGE -->

        

    </div>
    <!-- end: MAIN CONTAINER -->
<div id="planModal" class="modal fade" role="dialog">
  <div class="">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Plan Modal</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 20%;">Company Name</th>
                            <td style="width: 20px;">:</td>
                            <td id="visit_company"></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>:</td>
                            <td id="visit_address"></td>
                        </tr>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>:</td>
                            <td id="visit_date"></td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td>:</td>
                            <td id="visit_time"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <form action="" id="visit_report_form">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Update Status</label>
                        <input type="hidden" name="visit_plan_id", id="visit_plan_id">
                        <select name="visit_status" id="visit_status" class="form-control">
                            <option value="1">SCHEDULED</option>
                            <option value="2">COMPLETED</option>
                            <option value="3">MISSED</option>
                            <option value="4">CANCEL</option>
                            <option value="0">CANCELED BY COMPANY</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Write Report</label>
                        <textarea name="visit_report" id="visit_report" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <button id="visit_submit" class="btn btn-sm btn-warning btn-block">SUBMIT</button>
                </div>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="appModal" class="modal fade" role="dialog">
  <div class="">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Appoinment Modal</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 20%;">Company Name</th>
                            <td style="width: 20px;">:</td>
                            <td id="app_company_name"></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>:</td>
                            <td id="app_address"></td>
                        </tr>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>:</td>
                            <td id="app_date"></td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td>:</td>
                            <td id="app_time"></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 25%;">Contact Person</th>
                            <td style="width: 20px;">:</td>
                            <td id="app_contact_name"></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <tbody>
                        <tr>
                            <th  style="width: 15%;">Phone : </th>
                            <td id="app_mobile"></td>
                            <th  style="width: 15%;">Email : </th>
                            <td id="app_email">email@mail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <form action="" id="app_report_form">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Update Status</label>
                        <input type="hidden" id="app_id" name="app_id">
                        <select name="app_status" id="app_status" class="form-control">
                            <option value="1">SCHEDULED</option>
                            <option value="2">COMPLETED</option>
                            <option value="3">MISSED</option>
                            <option value="4">CANCEL</option>
                            <option value="0">CANCELED BY COMPANY</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Write Report</label>
                        <textarea name="app_report" id="app_report" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <button id="app_submit" class="btn btn-sm btn-warning btn-block">SUBMIT</button>
                </div>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php 
    include('includes/footer.php');
?>
<script src="scripts/view_todo_taks.js"></script>