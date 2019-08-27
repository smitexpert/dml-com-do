<?php 
include('includes/header.php'); 

 $query = "SELECT cons.*,cntry.country_name FROM tbl_consignment as cons,tbl_country as cntry WHERE cons.dest_country = cntry.country_id ORDER BY cons.booking_date DESC";
$selectcourcomp = $Courcompanyset->selectcourComp($query);


?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br><br><br>





					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									<STRONG>MENIFEST SEARCH</STRONG>
								</div>
								<div class="panel-body table-responsive">


								<div class="row">
									<div class="col-md-3">
										<div class="form-group connected-group">
											<label class="control-label">Courier Company<span class="symbol required"></span>
											</label>
										<select name="corcompany" required id="corcompany" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
												<option value="">--</option>
												<?php 
													$selcourcomp = "SELECT * FROM tbl_courier_companies WHERE status=1 ORDER BY cour_comp_name ASC";
														 $execcourcomp =  $Courcompanyset->selectcourComp($selcourcomp);
												while ($findcourcomp=$execcourcomp->fetch_assoc()) { ?>
													<option id="dd" value="<?php echo $findcourcomp['cour_comp_id']; ?>"><?php echo $findcourcomp['cour_comp_name']; ?></option>
												<?php }?>

										</select>
										</div>
									</div>
									<div class="col-md-3"></div>
									<div class="col-md-3"></div>
									<div class="col-md-3"></div>
								</div>




<!-- SERACH BY DATE BAR STARTS  -->
										<div class="row-fluid" id="datesearch">
											<div class="col-md-7"></div>
											<div class="col-md-2">
												<div class="input-group">
													<input type="text" class="form-control" placeholder="From" name="datefrom" id="datefrom" data-select="datepicker" >
													<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
												</div>
											</div>

												<div class="col-md-2">
													<div class="input-group">
													<input type="text" class="form-control" placeholder="To" name="dateto" id="dateto" data-select="datepicker" >
													<span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>
													</div>
												</div>
												<div class="col-md-1">
													<div class="input-group text-left">
													<a href="#" id="btnsrchbydate" class="btn-default btn">SEARCH</a></div>
													</div>
												</div><br><br><br>
										
<!-- SERACH BY DATE BAR ENDS  -->

									<div class="tbl">
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample-table-1">


										<thead>
											<tr>
												<th class="center">#</th>
												<th>Company Name</th>
												<th>Zone</th>
												<th>Country</th>
												<th>Where</th>
												<th>Goods Type</th>
												<th>Unit</th>
												<th>Price</th>
												<th>Booking Date</th>
												<th>Status</th>
												<th>actions</th>
										
											</tr>
										</thead>
										<tbody id="showmanifestedcons">
										<div class="center-block text-center" id="loader" style="display: none;">
											<strong>Data is loading.. please wait for while</strong><br>
											<img  src="assets/images/dataloader.gif" alt="ddd" width="25"><br><br>
										</div>



										</tbody>
									</table>




									</div>
								</div>
							</div>


							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->

					</div>


				</div>
			</div>
			<!-- end: PAGE -->


		</div>
		<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>

<script type="text/javascript">



	jQuery(document).ready(function($) {
	$("#datesearch").hide();
		$('#corcompany').on('change', function(event) {
			event.preventDefault();
			findprincipalprice();
		});

		function findprincipalprice(){
			$("#loader").show();
				var corcompany = $('#corcompany').val();
				$.ajax({
					url: 'ajaxSearch.php',
					type: 'POST',
					//: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					data: {action: 'manifestedcons',corcompany : corcompany},
				})
				.done(function(data) {
					$("#loader").hide();
					$('#showmanifestedcons').html(data);
					$("#datesearch").show();
				})
				.fail(function() {

				})
				.always(function() {

				});
		}




// SEARCH BY DATE STARTS ####################################################

		$('#btnsrchbydate').on('click', function(event) {
			event.preventDefault();
			srchconsbydate();
		});

		function srchconsbydate(){
			
				//$("#loader").show();
				var corcompany = $('#corcompany').val();

				if (corcompany != '') {
					var dateForm = $('#datefrom').val();
					var dateTo = $('#dateto').val();

					$.ajax({
						url: 'ajaxSearch.php',
						type: 'POST',
						//: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
						data: {action: 'srchconsbydate',corcompany : corcompany,dateForm : dateForm,dateTo : dateTo},
					})
					.done(function(data) {
						$("#loader").hide();
						$('#showmanifestedcons').html(data);
						$("#datesearch").show();
					})
					.fail(function() {

					})
					.always(function() {

					});

				}else{alert('Select Courier Company First');}

				}

		

// $("#btnsrchbydate").on("click",function(){
// 					var dateForm = $('#datefrom').val();
// 					var dateTo = $('#dateto').val();
// 	alert(dateForm);die();
// });







	});
</script>