<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM  principals_name order by id desc";
    $selectcourcom = $Courcompanyset->selectcourComp($query);
?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br><br>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					
					
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Principal Lists
								</div>

								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover table-full-width" id="couriertbl">
										
										<thead>
											<tr>
												<th class="center">#</th>
												<th  class="center">Principals Name</th>
												<th  class="center">Action</th>
											</tr>
										</thead>
										<tbody>

									   <?php $i=0; if ($selectcourcom) { while ($getcourcomp=$selectcourcom->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcourcomp['principal_name']; ?></td>
												<!--<td>
												<a href="#" rel="nofollow" target="_blank">
													<?php // echo $getcourcomp['status']; ?>
												</a></td>-->
												
												<td class="center">
												<div class="visible-md visible-lg hidden-sm hidden-xs">
													<?php if($getcourcomp['based'] == 1){
                                                        ?>
                                                          <a href="set_principal_zone.php?principal_id=<?php echo $getcourcomp['id']; ?>" class="btn btn-xs btn-warning tooltips" data-placement="top" data-original-title="Remove">SET ZONE</a>
                                                           <?php
                                                            }else{
                                                            ?>
                                                            <a href="#" class="btn btn-xs btn-warning tooltips disabled">SET ZONE</a>
                                                            <?php
                                                            }
                                                    ?>
													<a href="set_principal_price.php?principal_id=<?php echo $getcourcomp['id']; ?>" class="btn btn-xs btn-warning tooltips" data-placement="top" data-original-title="Remove">SET PRICE</a>
												</div>
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="set_principal_zone.php">
																	SET ZONE
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	SET PRICE
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
										 <?php } }else{ echo "Data not found";} ?> 

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
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
jQuery( document ).ready(function( $ ) {
UIElements.init();


// data table with pdf csv excel print copy
table = $('#couriertbl').DataTable({

  // paging: false,
  // info: false,
  //  dom: 'Bfrtip',
  //       buttons: [
  //           'copy', 'csv', 'excel', 'pdf', 'print'
  //       ]
});
})


</script>
