<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM  corporate_clients order by id desc";
    $result = $db->link->query($query);
    
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
									CORPORATE CLIENT SETTINGS
								</div>

								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover table-full-width" id="couriertbl">
										
										<thead>
											<tr>
												<th class="center">#</th>
												<th  class="center">Name of Corporate Clients</th>
												<th  class="center">Action</th>
											</tr>
										</thead>
										<tbody>

									   <?php $i=0; if ($result->num_rows > 0) {
                                                while($row=$result->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $row['company_name']; ?></td>
												<!--<td>
												<a href="#" rel="nofollow" target="_blank">
													<?php // echo $getcourcomp['status']; ?>
												</a></td>-->
												
												<td class="center">
												<div class="">
													
													<a href="set_corporate_client_price.php?client_id=<?php echo $row['id']; ?>" class="btn btn-xs btn-warning tooltips" data-placement="top" data-original-title="Remove">SET PRICE</a>
													<a href="view_corporate_client_price.php?client_id=<?php echo $row['id']; ?>" class="btn btn-xs btn-warning tooltips" data-placement="top" data-original-title="Remove">VIEW PRICE</a>
													<a href="set_principal_price.php?principal_id=<?php echo $row['id']; ?>" class="btn btn-xs btn-info tooltips" data-placement="top" data-original-title="Remove">UPDATE PRICE</a>
												</div>
												</td>
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
