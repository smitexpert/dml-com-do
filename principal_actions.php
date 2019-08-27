
<?php 

require __DIR__."/classes/Courcompanyset.php";
$Courcompanyset = new Courcompanyset();
//$insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);



if ($_POST['action']=='getprincidata') {
	if (isset($_POST['cour_comp'])) {
	$cour_comp=$_POST['cour_comp'];
?>

<!-- SHOW PRICE TABLE HERE -->

						<div class="col-md-12">

								<div style="width: 130px text-align:right;margin-bottom: 6px;  float: right;" >	
									<!-- id="pulsate-regular" -->	
									<a href="#principalpricemodbtn" data-toggle="modal" class="btn btn-blue btn-sm text-right">
										SET PRINCIPAL PRICE <i class="fa fa-arrow-circle-right"></i>
									</a>
								</div>	


									<table class="table table-striped table-bordered table-hover table-full-width" id="principriceTbl">
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
												<th>status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>

							<?php
								$record_per_page = 5; $page = '';
								if(isset($_GET["page"])){ $page = $_GET["page"]; }else{$page = 1;}
								$start_from = ($page-1)*$record_per_page;

								$query = "SELECT p.*,r.cour_comp_name FROM tbl_principal_price as p,tbl_courier_companies as r WHERE p.cour_company = r.cour_comp_id AND p.cour_company =$cour_comp ORDER BY p.id DESC";
								// $query = "SELECT p.*,r.cour_comp_name FROM tbl_principal_price as p,tbl_courier_companies as r WHERE p.cour_company = r.cour_comp_id AND p.cour_company =$cour_comp ORDER BY p.unit DESC LIMIT $start_from, $record_per_page";
								if ($query) {
									$selectcourcomp = $Courcompanyset->selectcourComp($query);
									if ($selectcourcomp) {?> 
	
									   <?php $i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $getcourcomp['id']; ///echo $i; ?></td>
												<td><?php echo $getcourcomp['cour_comp_name']; ?></td>

												<td><?php if(isset($getcourcomp['route_code'])){ echo $getcourcomp['route_code'];} ?></td>

												<td><?php if(isset($getcourcomp['country_id'])){ 
													$cntryy = $getcourcomp['country_id'];
												$queryy = "SELECT country_name FROM tbl_country WHERE country_id=$cntryy";
												$selectcourcomppp = $Courcompanyset->selectcourComp($queryy);
												$getcourcomppp=$selectcourcomppp->fetch_assoc();
													echo $getcourcomppp['country_name'];

												} ?></td>


												<td><?php echo $getcourcomp['income_or_outgo']; ?></td>
												<td><?php echo $getcourcomp['goods_type']; ?></td>
												<td><?php echo $getcourcomp['unit']; ?></td>
												<td><?php echo $getcourcomp['price']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['status']; ?></td>
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

										 <?php } } else{ $msg = "no data found"; echo $msg; } } ?>
										</tbody>
									        <tfoot>
									            <tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>

												
									            </tr>
									        </tfoot>
									</table>

<!-- pagination code here starts-->
								<div class="row">
									<div class="col-md-12 text-right">
										<?php   
											// $page_query = "SELECT * FROM tbl_principal_price WHERE cour_company =$cour_comp ORDER BY id DESC";
											// if ($page_query) {
											//     $page_result = $Courcompanyset->selectcourComp($page_query);
											//     if ($page_result) {
											//     $total_records = mysqli_num_rows($page_result);
											//     $total_pages = ceil($total_records/$record_per_page);
											//     for($i=1; $i<=$total_pages; $i++)
											//     {     
											//      echo "<a class='page' href='set_principal_route.php?cour_comp=".$cour_comp."&&page=".$i."'>".$i."</a>";
											//     } 
											//     }
											// }else{echo "";}
										 ?>			
									</div>
								</div><br>
<!-- pagination code here ends-->
						</div>



<!-- SHOW ROUTE TABLE HERE -->						

						<div class="col-md-12">
							<div class="row text-center">
							<div class="col-md-12"><label class="control-label"></label><h5 class="offer" >PRINCIPAL ROUTE SECTION</h5></div>
							</div>
								<div style="width: 130px text-align:right;margin-bottom: 6px;  float: right;" >	
									<!-- id="pulsate-regular" -->	
									<a href="#principalroutemodbtn" data-toggle="modal" class="btn btn-blue btn-sm text-right">
										SET PRINCIPAL ROUTE <i class="fa fa-arrow-circle-right"></i>
									</a>
								</div>							
								<table class="table table-striped table-bordered table-hover table-full-width" id="princiRouteTbl">
									<thead>
										<tr>
											<th class="center">#</th>
											<th>Company Name</th>
											<th>Zone</th>
											<th>Country</th>
											<th>Created At</th>
											<th>status</th>
											<th></th>
										</tr>
									</thead>
							<?php 
								$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_cour_comp_route as p,tbl_courier_companies as r,tbl_country as c WHERE p.company_id = r.cour_comp_id AND p.cntry_id = c.country_id AND p.company_id =$cour_comp  ORDER BY p.id DESC";
								if ($query) {
									$selectcourcomp = $Courcompanyset->selectcourComp($query);
									if ($selectcourcomp) {?> 

	
									   <?php $i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcourcomp['cour_comp_name']; ?></td>
												<td><?php echo $getcourcomp['route_code']; ?></td>
												<td><?php echo $getcourcomp['country_name']; ?></td>
												<td><?php echo $getcourcomp['dated']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['status']; ?></td>
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
										 <?php } } else{ $msg = "no data found"; echo $msg; } } ?>
									</table>
						</div>



    									
<?php 
	} }




if ($_POST['action'] == 'insertprinciprice') {

	 $courcompval2 		= $_POST['courcompval2'];
	 if (isset($_POST['courcomcntry'])) {$courcomcntry= $_POST['courcomcntry'];}
	 if (isset($_POST['route_code2'])) {$route_code2= $_POST['route_code2'];}
	 $income_or_outgo2 	= $_POST['income_or_outgo2'];
	 $goods_type2 		= $_POST['goods_type2'];
	 $unit2 			= $_POST['unit2'];
	 $price2 			= $_POST['price2'];
 
	$insertCoropprice =  $Courcompanyset->insertPrincipalPrice($courcompval2 ,$courcomcntry ,$route_code2,$income_or_outgo2,$goods_type2,$unit2,$price2);

	if ($insertCoropprice) {
		echo $insertCoropprice;
	}

}


// INSERT  PRINCIPAL ROUTE

if ($_POST['action'] == 'insertPrinciroute') {

	  $courcomp4 		= $_POST['courcomp4'];
	  $route_code4		= $_POST['route_code4'];
	  $showcntry4		= $_POST['showcntry4'];
	  $status 			= $_POST['status'];

 
	$insertprinciroute =  $Courcompanyset->insertCourcompRoute($courcomp4 ,$route_code4 ,$showcntry4,$status);

	if ($insertprinciroute) {
		echo $insertprinciroute;
	}

}



if ($_POST['action'] == 'getprinciprice') {

$courcompval2 = $_REQUEST['courcompval2'];
if (isset($_REQUEST['route_code2'])) {
$route_code2 = $_REQUEST['route_code2'];
}else{echo "";}

$income_or_outgo2 = $_REQUEST['income_or_outgo2'];
$goods_type2 = $_REQUEST['goods_type2'];
$unit2 = $_REQUEST['unit2'];

	if (!empty($courcompval2) && !empty($route_code2) && !empty($income_or_outgo2) && !empty($goods_type2) && !empty($unit2)) {
		$selectprinciprice = "SELECT price FROM tbl_principal_price WHERE cour_company=$courcompval2 AND route_code=$route_code2 AND income_or_outgo='$income_or_outgo2' AND goods_type='$goods_type2' AND unit=$unit2";

		if ($selectprinciprice !=false) {
		 		$exectprinciprice=$Courcompanyset->selectcourComp($selectprinciprice);
				if (isset($exectprinciprice)) {
					$findprinciprice=$exectprinciprice->fetch_assoc();
					if (count($findprinciprice)>0) {
					 echo $principrice = $findprinciprice['price'];
					 die();
					}else { die();}

				}else{ die();}
		}

	}else{ die();}


}




if ($_POST['action'] == 'getprincipriceofcntry') {

$courcompval2 = $_REQUEST['courcompval2'];
$courcomcntry = $_REQUEST['courcomcntry'];
$income_or_outgo2 = $_REQUEST['income_or_outgo2'];
$goods_type2 = $_REQUEST['goods_type2'];
$unit2 = $_REQUEST['unit2'];

	if (!empty($courcompval2) && !empty($income_or_outgo2) && !empty($goods_type2) && !empty($unit2)) {
		$selectprinciprice = "SELECT price FROM tbl_principal_price WHERE cour_company=$courcompval2 AND country_id=$courcomcntry AND income_or_outgo='$income_or_outgo2' AND goods_type='$goods_type2' AND unit=$unit2";

		if ($selectprinciprice !=false) {
		 		$exectprinciprice=$Courcompanyset->selectcourComp($selectprinciprice);
				if (isset($exectprinciprice)) {
					$findprinciprice=$exectprinciprice->fetch_assoc();
					if (count($findprinciprice)>0) {
					 echo $principrice = $findprinciprice['price'];
					 die();
					}else{die();}

				}else{die();}
		}

	}else{die();}


}









//SEARCH PRICE BY UNIT AND COUNTRY

if ($_POST['action'] == 'getspecpricedata') {

$cour_comp = $_POST['cour_comp'];
$unit3 = $_POST['unit3'];
$cntry3 = $_POST['cntry3'];

?>

						<div class="col-md-12">
									<a href="#principalpricemodbtn" data-toggle="modal" class="btn btn-blue btn-sm text-right" style="float: right;margin-bottom: 8px;">
										SET PRINCIPAL PRICE <i class="fa fa-arrow-circle-right"></i>
									</a>
									<table class="table table-striped table-bordered table-hover table-full-width" id="courcompPriceSrcTbl">
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
												<th>status</th>
												<th></th>
											</tr>
										</thead>
							<?php
								if(!empty($cour_comp) && !empty($unit3) && !empty($cntry3)){

								$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id AND p.country_id = c.country_id AND p.cour_company =$cour_comp AND p.country_id =$cntry3 AND p.unit=$unit3";
								if ($query) {
									$selectcourcomp = $Courcompanyset->selectcourComp($query);
									if (count($selectcourcomp)>0) {?> 
	
									   <?php $i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcourcomp['cour_comp_name']; ?></td>
												<td><?php echo $getcourcomp['route_code']; ?></td>
												<td><?php echo $getcourcomp['country_name']; ?></td>
												<td><?php echo $getcourcomp['income_or_outgo']; ?></td>
												<td><?php echo $getcourcomp['goods_type']; ?></td>
												<td><?php echo $getcourcomp['unit']; ?></td>
												<td><?php echo $getcourcomp['price']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['status']; ?></td>
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
										 <?php } } else{ echo "no data found";} }else{ echo "something wrong"; } }elseif(empty($cour_comp)){echo " please select Courrier compmany";}elseif(empty($unit3)){echo "select unit";} elseif(empty($cntry3)){ echo "please select country"; }else{ echo "please select options to search"; } ?>
									</table>
							</div>

<?php } ?>


<script type="text/javascript">
jQuery(document).ready(function($) {

//DATA TABLE CODE
    $('#principriceTbl').DataTable( {
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


//DATA TABLE CODE FOR SET PRINICIPAL ROUTE
	
    $('#princiRouteTbl').DataTable( {
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




});
</script>