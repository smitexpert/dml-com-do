<?php 
include('includes/header.php'); 

	if (isset($_POST['submit'])) {
	   $insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);
	}



?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>

			<!-- start: PAGE -->
			<div class="main-content">
				<div class="container"><br><br><br><br>
					<!-- start: PAGE CONTENT -->


<!-- CORPORATE CLIENT PRICE SET IN MODAL START -->
					<div class="row">
						<div class="col-md-4"></div>
							<div class="col-md-4 text-center" id="pulsate-regular" style="padding:5px;">		
								<a href="#responsive" data-toggle="modal" class="btn btn-blue btn-block">
									SET CLIENT PRICE <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						<div class="col-md-4"></div>
					</div><br>
					<!-- modal portion -->
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<div id="responsive" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title">CORPORATE CLIENT PRICE SETTING FORM</h4>
									</div>
									<div class="modal-body">
										<div class="panel-body">


													<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" role="form" id="corpoPriceSetForm">
														<div class="row">
															<div class="col-md-12">
																<div class="errorHandler alert alert-danger no-display">
																	<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
																</div>
																<div class="successHandler alert alert-success no-display">
																	<i class="fa fa-ok"></i> Your form validation is successful!
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group connected-group">
																	<label class="control-label">Corporate Client<span class="symbol required"></span>
																	</label>
																	<select name="corp_client" required id="corp_client" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
																			<option value="">--</option>
																			<?php 
																				$selectclientname2 = "SELECT client_id,client_name FROM tbl_corporate_clients WHERE status=1";
				   																 $findclientname2 =  $Corpoclients->selectCorpoClient($selectclientname2);
																			while ($getclient2=$findclientname2->fetch_assoc()) { ?>
																				<option value="<?php echo $getclient2['client_id']; ?>"><?php echo $getclient2['client_name']; ?></option>
																			<?php }?>
																	</select>
																</div>
															</div>											


															<div class="col-md-3">
																<div class="form-group connected-group">
																	<label class="control-label">Route<span class="symbol required"></span>
																	</label>
																<select name="route_code" required id="route_code"  class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
																		<option >--</option>

															<?php 
																$selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
																	 $execroute =  $Corpoclients->selectCorpoClient($selectroute);
															while ($findroute=$execroute->fetch_assoc()) { ?>
																<option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
															<?php }?>


																</select>
																</div>
															</div>


															<div class="col-md-3">
																<div class="form-group connected-group">
																	<label class="control-label">Where<span class="symbol required"></span>
																	</label>
																	<select name="income_or_outgo" id="income_or_outgo" class="form-control" required>
																		<option value="outgoing">Outgoing</option>
																		<option value="incoming">Incoming</option>
																		
																	</select>
																</div>
															</div>									


															<div class="col-md-3">
																<div class="form-group connected-group">
																	<label class="control-label">Goods Type<span class="symbol required"></span>
																	</label>
																	<select name="goods_type" id="goods_type" class="form-control" required>
																		<option value="sample">Sample</option>
																		<option value="doc">Document</option>
																		
																	</select>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group connected-group">
																	<label class="control-label">Unit<span class="symbol required"></span>
																	</label>
																	<select name="unit" required id="unit" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
																		<option value="">--</option>

															<?php 
																$slectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
																	 $execweight =  $Corpoclients->selectCorpoClient($slectweight);
															while ($findweight=$execweight->fetch_assoc()) { ?>
																<option value="<?php echo $findweight['weight_id']; ?>"><?php echo $findweight['weight']; ?></option>
															<?php }?>

																	</select>
																</div>
															</div>


															<div class="col-md-3">
																<div class="form-group">
																	<label class="control-label">
																		Price <span class="symbol required"></span>
																	</label>
																	<input required type="text" class="form-control" id="price" name="price">
																	<span style="color: #6B6B6D" id="showgenprice"></span>
																</div>
															</div>


														</div>

														<br>
														<div class="row">
															<div class="col-md-4"></div>
															<div class="col-md-4">
																<input class="btn btn-lg btn-green btn-block" type="submit" name="submit" value="submit">
															</div>
														</div>
														<div class="col-md-4"></div>

													</form>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-light-grey">
											Close
										</button>
									</div>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>

<!-- CORPORATE CLIENT PRICE SET IN MODAL END -->



<!-- after insertion price showing msg -->
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
						<?php 
							if (isset($insertCoropprice)) { ?>
							<div class="alert alert-success">
								<button data-dismiss="alert" class="close">×</button>
								<i class="fa fa-check-circle"></i>
								<strong><?php echo $insertCoropprice; ?></strong>
							</div>
						<?php } ?>
						</div>
						<div class="col-md-2"></div>
					</div>
<!-- after insertion price showing msg  ends-->



<!-- CLIENT PRICE SEARCH PORTION STARTS -->
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Search Setted Corporate Client Price
								</div>
								<div class="panel-body">
									<form action="<?php $_SERVER['PHP_SELF']; ?>" role="form" id="fcorpo_orm" method="POST">
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-4">
												<div class="form-group connected-group">
													<label class="control-label" style="font-size: 16px">Select Client<span class="symbol required"></span>
													</label>
													<select name="CorpoClient" required id="CorpoClient" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
															<option value="">--</option>
															<?php 
																$selectclientname = "SELECT client_id,client_name FROM tbl_corporate_clients WHERE status=1";
   																 $findclientname =  $Corpoclients->selectCorpoClient($selectclientname);	
															while ($getclientname=$findclientname->fetch_assoc()) { ?>
																<option class="cl" value="<?php echo $getclientname['client_id']; ?>"><?php echo $getclientname['client_name']; ?></option>
																<!-- <option data-subtext="<?php //echo $getclientname['client_name']; ?>" class="cl" value="<?php //echo $getclientname['client_id']; ?>"><?php //echo $getclientname['client_name']; ?></option> -->
															<?php }?>
													</select>

												</div>
												<!-- <input type="text" id="showclient" name="" value=""> -->
											</div>

											<div class="col-md-4"><br>
												<div class="form-group connected-group">
													<h5></h5>
													<input class="btn btn-md btn-teal btn-block" type="submit" name="srchsubmit" value="search">
												</div>
											</div>

											<div class="col-md-2"></div>
										</div>
									</form><br>


									<?php  
									 $i=0;
										if (isset($_POST['srchsubmit'])) {
												$corpoClient = $_POST['CorpoClient'];
											   $srchquery = "SELECT p.*,c.client_name FROM tbl_corpo_client_price as p,tbl_corporate_clients as c WHERE p.corpo_client_id = c.client_id  AND p.corpo_client_id=$corpoClient ORDER BY p.route_code ASC,p.unit ASC";
    											$runsrchquery =  $Corpoclients->selectCorpoClient($srchquery);
    											 //$row_cnt = $runsrchquery->num_rows;
    											if ($runsrchquery) { ?>
								    	<div class="row">
 
												<div class="col-md-12">
												<table class="table table-hover" id="showclienttbl">
													
													<thead>	
														<tr style="color:white">
															<th class="center">#</th>
															<th>Route</th>
															<th>How</th>
															<th>Goods Type</th>
															<th>Unit</th>
															<th>Price</th>
															<th>status</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>	

													<?php //$dd=$runsrchquery->fetch_assoc(); ?> 
													<!-- <div class="alert alert-danger" style="border-radius: 0;margin:0px">
														<strong>CUSTOM PRICE LIST OF : <span style="color: green"><?php //echo $dd['client_name']; ?></strong>
													</div> -->
													<?php 
													$j=0;
													while ($getsrchdata=$runsrchquery->fetch_assoc()) { $j++; ?>
													<tr>
														<td class="yellow"><?php echo $j; ?></td>
														<td  class="yellow"><?php echo $getsrchdata['route_code']; ?></td>
														<td><?php echo $getsrchdata['income_or_outgo']; ?></td>
														<td><?php echo $getsrchdata['goods_type']; ?></td>
														<td><?php echo $getsrchdata['unit']; ?></td>
														<td><?php echo $getsrchdata['price']; ?></td>
														<td><?php echo $getsrchdata['status']; ?></td>

														<td class="center yellow">
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
															<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
															<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
														</div>
														<div class="visible-xs visible-sm hidden-md hidden-lg">
															<div class="btn-group">
																<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																	<i class="fa fa-cog"></i> <span class="caret"></span>
																</a>
																<ul role="menu" class="dropdown-menu pull-right">
																	<li role="presentation">
																		<a role="menuitem" tabindex="-1" href="#">
																			<i class="fa fa-edit"></i> Edit
																		</a>
																	</li>
																	<li role="presentation">
																		<a role="menuitem" tabindex="-1" href="#">
																			<i class="fa fa-share"></i> Share
																		</a>
																	</li>
																	<li role="presentation">
																		<a role="menuitem" tabindex="-1" href="#">
																			<i class="fa fa-times"></i> Remove
																		</a>
																	</li>
																</ul>
															</div>
														</div></td>
													</tr>
													 <?php } ?> 
														</tbody>
													</table>
    												</div>
    											<div class="col-md-1"></div>
    											</div>
    												<?php }else{echo "<h4 class='text-center'>No Custom Price Setted For This Client</h4>";} }?>

										</div>
									</div>
						</div>

					</div><br>
<!-- CLIENT PRICE SEARCH PORTION ENDS -->




<!-- SHOW ALL THE GENERAL PRICE  -->
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">

							<div class="panel panel-default">
								<div class="panel-heading">LIST OF GENERAL PRICES :
									<i class="fa fa-external-link-square"></i>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
											<div class="genpricehead"> <h4>GENERAL PRICE LIST</h4> </div>

<?php 
$selectgenpr = "SELECT * FROM tbl_route_price WHERE status=1 ORDER BY route_code ASC,unit ASC";
$execgenpr =  $Corpoclients->selectCorpoClient($selectgenpr);
?>
											<table class="table table-hover" id="showgenpricetbl">
												<thead>
													<tr>
														<th>Zone</th>
														<th>IN or OUT</th>
														<th>Goods Type</th>
														<th>Unit</th>
														<th>Price</th>
													</tr>
												</thead>
												<tbody>

												<?php while ($findgenpr=$execgenpr->fetch_assoc()) { ?>
													<tr>
														<td class="yellow"><?php echo $findgenpr['route_code']; ?></td>
														<td><?php echo $findgenpr['income_or_outgo']; ?></td>
														<td><?php echo $findgenpr['goods_type']; ?></td>
														<td><?php echo $findgenpr['unit']; ?>1</td>
														<td><?php echo $findgenpr['price']; ?>1</td>
													</tr>
												<?php } ?>


												</tbody>
											</table>
										</div>
								</div>
							</div>

						</div>
						<div class="col-md-1"></div>
					</div>
<!-- SHOW ALL THE GENERAL PRICE ENDS -->

					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->

		</div>
		<!-- end: MAIN CONTAINER -->


<?php include('includes/footer.php'); ?>
<script type="text/javascript">

jQuery( document ).ready(function( $ ) {
UIElements.init();


//FUNCTION FOR GETTING THE GENERAL PRICE STARTS
	$("#corpoPriceSetForm select").change(function(){
		event.preventDefault();
		getGenPrice();
	});

	function getGenPrice(){
		var route = $("#route_code").val();
		var corp_client = $("#corp_client").val();
		var income_or_outgo = $("#income_or_outgo").val();
		var goods_type = $("#goods_type").val();
		var unit = $("#unit").val();
		   $.ajax({  
	        url:"getGenPrice.php",  
	        method:"POST",  
	        data:{action:'getgenpr',route:route,corp_client:corp_client,income_or_outgo:income_or_outgo,goods_type:goods_type,unit:unit},  
				//dataType: "JSON",
		        success:function(data){  
		            $("#price").val(data);
					$("#showgenprice").text("The general price of correspondent data is : " + data);
		        }  
	   		});  
	}
//FUNCTION FOR GETTING THE GENERAL PRICE ENDS



});

</script>
<style type="text/css">
.genpricehead,#showclienttbl thead{
background: #FF0000;
padding: 4px 10px;
color: #fff;
}#showclienttbl,#showgenpricetbl thead,.yellow {
background: #FFFF00;
padding: 4px;
color: #000;
}
#showclienttbl,#showgenpricetbl tbody tr{
background:#FFFF99;
}
</style>
