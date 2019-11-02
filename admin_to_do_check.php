<?php
include('includes/header.php');

$sql = "SELECT * FROM user WHERE rule <> '1'";

?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <!-- CLIENT PRICE SEARCH PORTION STARTS -->
            <div class="row">
                <div class="col-md-3">
                    <label for="select_staff">Select Staff</label>

                    <select name="select_staff" id="select_staff" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="">--</option>
                        <?php
                        $query = $db->link->query($sql);
                        if ($query->num_rows > 0) {
                            while ($row = $query->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['userId']; ?>"><?php echo $row['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <br>
            <div class="view_item" style="display: none;">
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="row">
                            <form action="" id="todo_view_form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="todo_select_date">SELECT DATE</label>
                                        <input id="todo_select_date" name="todo_select_date" type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly="">
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
                                <table class="table" id="app_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>COMPANY</th>
                                            <th>PERSON</th>
                                            <th>COMMENT</th>
                                            <th>DATE</th>
                                            <th>TIME</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
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
                                <table class="table" id="visit_plan">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>COMPANY</th>
                                            <th>COMMENT</th>
                                            <th>DATE</th>
                                            <th>TIME</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>FFC</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <option value="4">CANCELED BY USER</option>
                            <option value="5">CANCELED BY DML</option>
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
                            <option value="4">CANCELED BY USER</option>
                            <option value="5">CANCELED BY DML</option>
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

<?php include('includes/footer.php'); ?>
<script src="scripts/admin_to_do_check.js"></script>