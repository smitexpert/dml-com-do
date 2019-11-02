<?php
include('includes/header.php');

$sql = "SELECT corporate_company.company_id, corporate_company.company_name, (SELECT COUNT(marketing_contact_person.company_id) FROM marketing_contact_person WHERE marketing_contact_person.company_id = corporate_company.company_id) contact_persons, (SELECT COUNT(marketing_add_plan.company_id) FROM marketing_add_plan WHERE marketing_add_plan.company_id=corporate_company.company_id AND marketing_add_plan.status='2') total_visit, (SELECT COUNT(marketing_appointment_plan.company_id) FROM marketing_appointment_plan WHERE marketing_appointment_plan.company_id = corporate_company.company_id AND marketing_appointment_plan.status='2') appointemts, user.name FROM corporate_company INNER JOIN user ON user.userId = corporate_company.assign_to ORDER BY corporate_company.id DESC";

?>

<style>

.modal {
    width: 750px;
    margin-left: -375px;
}

</style>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <!-- CLIENT PRICE SEARCH PORTION STARTS -->
            <div class="row">
                <div class="col-md-12">
                    <h3>All Customer Details</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="customer_table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company Name</th>
                                <th>Contact Persons</th>
                                <th>Total Visit</th>
                                <th>Appointments</th>
                                <th>Assigned</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $db->link->query($sql);
                                if($query->num_rows > 0){
                                    while($row = $query->fetch_assoc()){
                                        ?>
                                            <tr>
                                                <th><?php echo $row['company_id']; ?></th>
                                                <td><?php echo $row['company_name']; ?></td>
                                                <td><a href="#" class="contact_person" id="contact_person_<?php echo $row['company_id']; ?>" data-toggle="modal" data-target="#contact_person_modal"><?php echo $row['contact_persons']; ?></a></td>
                                                <td>
                                                <a href="#" class="total_visit" id="total_visit_<?php echo $row['company_id']; ?>" data-toggle="modal" data-target="#total_visit_modal"><?php echo $row['total_visit']; ?></a></td>
                                                <td>
                                                <a href="#" class="appointment" id="appointment_<?php echo $row['company_id']; ?>" data-toggle="modal" data-target="#appointment_modal"><?php echo $row['appointemts']; ?></a></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning edit" id="edit_<?php echo $row['company_id']; ?>">#</a>
                                                </td>
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
    </div>
</div>

<div id="contact_person_modal" class="modal fade" role="dialog" style="">
  <div class="">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Persons</h4>
      </div>
      <div class="modal-body" id="contact_perosns_body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="total_visit_modal" class="modal fade" role="dialog" style="">
  <div class="">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Total Visit History</h4>
      </div>
      <div class="modal-body" id="total_visit_body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="appointment_modal" class="modal fade" role="dialog" style="">
  <div class="">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Appointments History</h4>
      </div>
      <div class="modal-body" id="appointment_body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php include('includes/footer.php'); ?>
<script src="scripts/admin_view_all_customer.js"></script>