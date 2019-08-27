<?php 
include('includes/header.php'); 

	$query = "SELECT * FROM tbl_country WHERE status=1 ORDER BY country_name ASC";
    $selectCountry = $Countryset->selectCountry($query);
?>

		<div class="main-container">
<?php include('includes/sidebar-menu.php'); ?>

			<div class="main-content">
				<div class="container"><br><br>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Country Lists:
								</div>

								<div class="panel-body table-responsive">
									<div class="tbl">
									<table class="table table-striped table-bordered table-hover table-full-width" id="cntylisttable">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Name</th>
												<th>Route</th>
												<th>status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>

									   <?php $i=0; if ($selectCountry) { while ($getcountry=$selectCountry->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcountry['country_name']; ?></td>
												<td><?php echo $getcountry['country_route']; ?></td>
												<td class="text-center"><?php echo $getcountry['status']; ?></td>
												<td class="center">
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
										 <?php } }else { echo "Data not found";}  ?> 
										</tbody>
											        <tfoot>
            								<tr>
											<th class="center">#</th>
												<th>Name</th>
												<th>Route</th>
												<th>status</th>
												<th></th>
            								</tr>
        </tfoot>
									</table>
									</div>
								</div>
							</div>


							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->


		</div>
		<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
