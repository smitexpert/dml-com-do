<?php 
include('includes/header.php'); 
	$query = "SELECT cc.*,s.stuff_name FROM tbl_corporate_clients as cc,tbl_stuff as s
	 WHERE status=1 ORDER BY dated DESC";
    $selectCorpoClient = $Corpoclients->selectCorpoClient($query);
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
									<table class="table table-striped table-bordered table-hover table-full-width" id="corpoClientTable2">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Client Name</th>
												<th>Client Company</th>
												<th>Address</th>
												<th>Contact</th>											
												<th>Type</th>
												<th>Discount Offer</th>
												<th>Assignee</th>
												<th>status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
									   <?php $i=0;  if ($selectCorpoClient) {while ($getcropoclnt=$selectCorpoClient->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcropoclnt['client_name']; ?></td>
												<td><?php echo $getcropoclnt['client_company']; ?></td>
												<td><?php echo $getcropoclnt['client_address']; ?></td>
												<td><?php echo $getcropoclnt['contact']; ?></td>
												<td><?php echo $getcropoclnt['type']; ?></td>
												<td><?php echo $getcropoclnt['discount']; ?></td>
												<td><?php echo $getcropoclnt['stuff_name']; ?></td>
												<td><?php echo $getcropoclnt['status']; ?></td>
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
										 <?php } }else{ echo "Data not found";} ?> 
										</tbody>
										<tfoot>
											t
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
<script type="text/javascript">
	jQuery( document ).ready(function( $ ) {
UIElements.init();
	    $('#corpoClientTable2').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
				column.data().unique().sort().each( function ( d, j ) {
				    if(column.search() === '^'+d+'$'){
				        select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
				    } else {
				        select.append( '<option value="'+d+'">'+d+'</option>' )
				    }
				} );
            } );
        }
    } );
	    })
</script>
