<?php 

require __DIR__."/classes/Corporateclients.php";
$Corpoclients = new Corporateclients();
//$insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);

echo $clientId = $_POST['corp_client'];
?>

									<?php  
									 $i=0;
									   $srchquery = "SELECT p.*,c.client_name FROM tbl_corpo_client_price as p,tbl_corporate_clients as c WHERE p.corpo_client_id = c.client_id  AND p.corpo_client_id=$clientId ORDER BY p.route_code ASC,p.unit ASC";
										$runsrchquery =  $Corpoclients->selectCorpoClient($srchquery);
										 //$row_cnt = $runsrchquery->num_rows;
										if ($runsrchquery) { ?>
								    	<div class="row">
												<div class="col-md-12">
														<div style="width: 130px text-align:right;margin-bottom: 6px;  float: right;" >	
														<!-- id="pulsate-regular" -->	
														<a href="#responsive" data-toggle="modal" class="btn btn-blue btn-sm text-right">
															SET PRICE FOR THIS CLIENT <i class="fa fa-arrow-circle-right"></i>
														</a>
														</div>
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
    									<?php }else{ ?>
    									
    										<div class="row">
												<div class="col-md-12 text-center"><br>
													<span>NO CUSTOM PRICE SETTED YET FOR THIS CLIENT.</span><br><br>
														<div style="width: 400px" class="center-block">	
														<!-- id="pulsate-regular" -->	
														<a href="#responsive" data-toggle="modal" class="btn btn-blue btn-sm center-block">
															SET PRICE FOR THIS CLIENT <i class="fa fa-arrow-circle-right"></i>
														</a>
														</div>
													</div>
												</div>
    									<?php } ?>




