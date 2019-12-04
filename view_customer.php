<?php include('includes/header.php'); 

$logged_user = Session::get('adminId');

$sql = "SELECT * FROM corporate_company WHERE assign_to='$logged_user'";


?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
			
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="company_list">Select Company</label>
						<select name="company_list" id="company_list" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
						<option value="">--</option>
						<?php
						$query = $db->link->query($sql);
						if($query->num_rows > 0){
							while($row = $query->fetch_assoc()){
								?>
						<option value="<?php echo $row['company_id']; ?>"><?php echo "(".$row['company_id'].") ".$row['company_name']; ?></option>
								<?php
							}
						}
						?>
					</select>
					</div>
				</div>

				<div class="col-md-9">
					<div class="nav_view" style="display: none;">
						<ul class="nav nav-pills">
							<li class="active"><a id="task" href="#">SET PLAN</a></li>
							<li><a id="history" href="#">HISTORY</a></li>
							<li><a id="contact" href="#">CONTACT PERSON</a></li>
						</ul>
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="view_body" id="body_task" style="display: none">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-external-link-square"></i> NEW TASK
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												Add Visit Plan
											</div>
											<div class="panel-body">
												<form action="" id="add_visit_plan">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="plan_date">Date</label>
																<input type="text" class="form-control date" id="plan_date" name="plan_date" required readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="plan_time">Time</label>
																<input type="text" class="form-control time" id="plan_time" name="plan_time" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="plan_comment">Comment</label>
																<textarea name="plan_comment" id="plan_comment" cols="30" rows="5" class="form-control"></textarea required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<button class="btn btn-sm btn-warning btn-block">ADD</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												Add Appointment
											</div>
											<div class="panel-body">
												<form action="" id="add_app_plan">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="app_date">Date</label>
																<input type="text" class="form-control date" id="app_date" name="app_date" required readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="app_time">Time</label>
																<input type="text" class="form-control time" id="app_time" name="app_time" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="contact_person">Select Contact Person</label>
																<select name="contact_person" id="contact_person" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
																	<option value="">--</option>
																</select>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="comment">Comment</label>
																<textarea name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<button class="btn btn-sm btn-warning btn-block">ADD</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="view_body" id="body_history" style="display: none">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-external-link-square"></i> YOUR HISTORY
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
											<div class="form-group">
												<label for="history_date">Select Date</label>
												<input type="text" id="history_date"  name="history_date" class="form-control">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												Visit History
											</div>
											<div class="panel-body">
												<div>
													<table class="table" id="view-visit-history">
														<tr>
															<th>#</th>
															<th>Date</th>
															<th>Time</th>
															<th>Comment</th>
															<th>Status</th>
														</tr>
														<tr>
															<th>1</th>
															<td>12-09-2019</td>
															<td>11:10</td>
															<td>Jabo</td>
															<td>Scheduled</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												Appointment History
											</div>
											<div class="panel-body">
												<table class="table" id="view-app-history">
													<tr>
														<th>#</th>
														<th>Con. Person</th>
														<th>Date</th>
														<th>Time</th>
														<th>Comment</th>
														<th>Status</th>
													</tr>
													<tr>
														<th>1</th>
														<td>Name Of Person</td>
														<td>12-09-2019</td>
														<td>11:10</td>
														<td>Jabo</td>
														<td>Scheduled</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="view_body" id="body_contact" style="display: none">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-external-link-square"></i> CONTACT PERSON
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<table class="table" id="contact_person_list">
											<caption>List Of Contact Person</caption>
											<thead>
												<tr>
													<th>#</th>
													<th>Name</th>
													<th>Designation</th>
													<th>Mobile No.</th>
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
									<div class="col-md-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												Add New Contact Person
											</div>
											<div class="panel-body">
												<form action="" id="add_contact_person">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="contact_name">Name</label>
																<input type="text" class="form-control" id="contact_name" name="contact_name" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="contact_designation">Designation</label>
																<input type="text" class="form-control" id="contact_designation" name="contact_designation" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="contact_mobile">Mobile</label>
																<input type="text" class="form-control" id="contact_mobile" name="contact_mobile" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="contact_email">Email</label>
																<input type="text" class="form-control" id="contact_email" name="contact_email" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<button class="btn btn-warning btn-sm btn-block">ADD</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
        </div>
        <!-- end: PAGE -->


    </div>
    <!-- end: MAIN CONTAINER -->


    <?php 
include('includes/footer.php');
?>
<script src="scripts/view_customer.js"></script>

