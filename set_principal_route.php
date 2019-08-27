<?php 
include('includes/header.php'); 


if (isset($_POST['submit'])) {
    $insertcourcompprice = $Courcompanyset->insertCourcompRoute($_POST);
}

if (isset($_POST['prinicipalprice'])) {
    $insertcourcompprice = $Courcompanyset->insertPrincipalPrice($_POST);
}

$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id AND p.country_id = c.country_id";
$selectcourcomp = $Courcompanyset->selectcourComp($query);


?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br><br><br>



<!-- PRICE SETTINGS MODAL CODE -->
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-10">
											<div id="principalpricemodbtn" class="modal fade " tabindex="-1" data-width="760" style="display: none;">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title">PRINCIPAL PRICE SETTINGS : <span style="color: orange;font-weight: bold" id="clnamemdelhead"></span></h4>
											</div>
											<div class="modal-body">
												<div class="panel-body">

									<form  action="/" role="form" id="principriceinsForm">
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
													<label class="control-label">Courier Company<span class="symbol required"></span>
													</label>
												<select name="cour_comp2" required id="courcmomselect2" class="form-control">
														<option id="selectedcour_comp2" value=""></option>
												</select>
												</div>
											</div>	

										


											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Choose Option<span class="symbol required"></span> 

													<div class="center-block text-center" id="loader" style="display: none;">
													<span>Data is loading.. please wait for while</span><br>
													<img  src="assets/images/dataloader.gif" alt="ddd" width="25">
													</div>
													</label>
												
													<div id="showcntry2" style="padding: 4px;border: 1px solid #f3f3f3;background: #D9EDF7;"></div>
												</div>
											</div>
										


											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Where<span class="symbol required"></span>
													</label>
													<select name="income_or_outgo2" id="income_or_outgo2" class="form-control" required>
														<option value="">--</option>
														<option value="incoming">Incoming</option>
														<option value="outgoing">Outgoing</option>
													</select>
												</div>
											</div>	

										</div>	

										<div class="row">							

											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Goods Type<span class="symbol required"></span>
													</label>
													<select name="goods_type2" id="goods_type2" class="form-control" required>
														<option value="">--</option>
														<option value="doc">Document</option>
														<option value="sample">Sample</option>
													</select>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Unit<span class="symbol required"></span>
													</label>
													<select name="unit2" required id="unit2" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
														<option value="">--</option>

											<?php 
												$slectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
													 $execweight =  $Courcompanyset->selectcourComp($slectweight);
											while ($findweight=$execweight->fetch_assoc()) { ?>
												<option value="<?php echo $findweight['weight']; ?>"><?php echo $findweight['weight']; ?></option>
											<?php }?>

													</select>
												</div>
											</div>


											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label">
														Price <span class="symbol required"></span>
													</label>
													<input required type="text" class="form-control" id="price2" name="price2">
													<img class="center-block text-center" id="loader2" style="display: none;" src="assets/images/dataloader.gif" alt="ddd" width="25">
													<span style="font-size: 12px;" id="shwpriceprinci"></span>
												</div>

											</div>
										</div>

										<br>
										<div class="row">
											<div class="col-md-4"></div>
											<div class="col-md-4">
												<input class="btn btn-lg btn-green btn-block" id="submitpricebtn" type="submit" name="submit" value="submit">
												<!-- <a href="#" class="btn btn-lg btn-green btn-block" id="submitprincipricee">Submit</a> -->
											</div>
										</div>
										<div class="col-md-4"></div>

									</form>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" data-dismiss="modal"  class="btn btn-light-grey">
													Close
												</button>
											</div>
											</div>
										</div>
										<div class="col-md-1"></div>
									</div>
<!-- PRICE SETTINGS MODAL CODE -->





<!-- ROUTE SETTINGS MODAL CODE -->
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-10" id="clientpricesetmodal">
											<div id="principalroutemodbtn" class="modal fade " tabindex="-1" data-width="760" style="display: none;">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title">PRINCIPAL ROUTE SETTINGS : <span style="color: orange;font-weight: bold" id="clnamemdelhead"></span></h4>
											</div>
											<div class="modal-body">
												<div class="panel-body">
												<!-- <form action="set_principal_route.php" method="POST" role="form" id="princiroutinsform"> -->
													<form action="/" role="form" id="princiroutinsform">
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

											<div class="row" id="princiroutsetmodal">


												<div class="col-md-3">
													<div class="form-group connected-group">
														<label class="control-label">Courier Company<span class="symbol required"></span>
														</label>
														<select name="cour_comp" id="courcomp4" required  class="form-control">
														<option id="selectedcour_comp" value=""></option>
														</select>
													</div>
												</div>	

												<div class="col-md-3">
													<div class="form-group connected-group">
														<label class="control-label">Route<span class="symbol required"></span>
														</label>
													<select name="route_code" required id="route_code4" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
															<option value="">--</option>
															<?php 
																$selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
																	 $execroute =  $Courcompanyset->selectcourComp($selectroute);
															while ($findroute=$execroute->fetch_assoc()) { ?>
																<option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
															<?php }?>

													</select>
													</div>
												</div>											

												<div class="col-md-3">
													<div class="form-group connected-group">

													<div class="center-block text-center" id="loader4" style="display: none;">
													<span>Data is loading.. please wait for while</span><br>
													<img  src="assets/images/dataloader.gif" alt="ddd" width="25">
													</div>

														<label class="control-label">Country<span class="symbol required"></span>
														</label>

													<div id="showcntry4" style="padding: 4px;border: 1px solid #f3f3f3;background: #D9EDF7;"></div>
													<!-- <select name="country" required id="country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
															<option value=""></option>
															<?php 
																//$selectcountry = "SELECT * FROM tbl_country WHERE status=1 ORDER BY country_name ASC";
																	// $execcountry =  $Courcompanyset->selectcourComp($selectcountry);
															//while ($findcountry=$execcountry->fetch_assoc())// { ?>
															 option id="dd" value="<?php //echo $findcountry['country_id']; ?>"><?php //echo $findcountry['country_name']; ?>
															</option> -->
															<!-- <?php// }?> -->

													<!-- </select> --> 
													</div>
												</div>



												<div class="col-md-3">
													<div class="form-group connected-group">
														<label class="control-label">Status<span class="symbol required"></span>
														</label>
														<select name="status" id="status" class="form-control" required>
															<option value="">--</option>
															<option value="1">publish</option>
															<option value="2">pending</option>
														</select>
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
												<button type="button" data-dismiss="modal"  class="btn btn-light-grey">
													Close
												</button>
											</div>
											</div>
										</div>
										<div class="col-md-1"></div>
									</div>
<!-- ROUTE SETTINGS MODAL CODE -->



					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>PRINCIPAL'S SETTINGS
								</div>
								<div class="panel-body">									
									<div class="row">
										<div class="col-md-12">
										<?php 
											if (isset($insertcourcompprice)) { ?>
												<div class="alert alert-info fade in">
												    <a href="#" class="close" data-dismiss="alert">&times;</a>
												    <strong><?php echo $insertcourcompprice; ?></strong>
												</div>
										<?php } ?>
										</div>
									</div>


<!-- SELECT CORPO CLIENT OPTION -->

								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<div class="form-group connected-group text-center">
											<label class="control-label offer">SELECT COURIER COMPANY<span class="symbol required"></span>
											</label>
										<select name="cour_comp" required id="cour_comp" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
												<option value="">--</option>
												<?php 
													$selcourcomp = "SELECT * FROM tbl_courier_companies WHERE status=1 ORDER BY cour_comp_name ASC";
														 $execcourcomp =  $Courcompanyset->selectcourComp($selcourcomp);
												while ($findcourcomp=$execcourcomp->fetch_assoc()) { ?>
													<option id="dd" value="<?php echo $findcourcomp['cour_comp_id']; ?>"><?php echo $findcourcomp['cour_comp_name']; ?></option>
												<?php }?>

										</select>
										</div>
										<div class="center-block text-center" id="loader3" style="display: none;">
											<span>Data is loading.. please wait for while</span><br>
											<img  src="assets/images/dataloader.gif" alt="ddd" width="25">
										</div>
									</div>	
									<div class="col-md-4"></div>
								</div>

<!-- SELECT CORPO CLIENT OPTION ENDS  -->




							<div class="row text-center">
							<div class="col-md-12" id="headprinci" style="display: none;"><label class="control-label"></label><h5 class="offer" >PRINCIPAL PRICE SECTION</h5></div>
							</div>
<!-- SEARCH PRICE BY UNIT AND COUNTRY STARTS -->
		<!-- 							<a href="#" class="btn btn-sm btn-default" id="srchbtn" style="display: none;">search price</a>
									<p></p>
									<div class="row" id="srchcontent" style="display: none;">
										<div id="srchselect">
											<div class="col-md-2">
													<select name="unit3" required id="unit3" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
													<option value="">select unit</option>
													<?php 
														//$slectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
													//		 $execweight =  $Courcompanyset->selectcourComp($slectweight);
													//while ($findweight=$execweight->fetch_assoc()) { ?>
														<option value="<?php// echo $findweight['weight']; ?>"><?php// echo $findweight['weight']; ?></option>
													<?php // } ?>
													</select>
											</div>
											<div class="col-md-2">
												<select name="country3" required id="country3" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
														<option value="">select country</option>
														<?php 
															//$selectcountry = "SELECT * FROM tbl_country WHERE status=1 ORDER BY country_name ASC";
																// $execcountry =  $Courcompanyset->selectcourComp($selectcountry);
														//while ($findcountry=$execcountry->fetch_assoc()) { ?>
															<option id="dd" value="<?php //echo $findcountry['country_id']; ?>"><?php //echo $findcountry['country_name']; ?></option>
														<?php //}?>
												</select>
											</div>
										</div>

										<div class="col-md-5"></div>
										<div class="col-md-3 text-right"></div>
									</div> -->
<!-- SEARCH PRICE BY UNIT AND COUNTRY END -->
								
								<div class="row" id="showprincidata"></div>
								
								</div>
							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
						<div class="col-md-1"></div>
					</div><br>
		

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



//########################### GET DATA OF PRINCIPAL SETTINGS############################################ 
	$("#cour_comp").change(function(){
		event.preventDefault();
		$("#headprinci").show();
		$("#srchbtn").show();
		getprincidata();
		var cour_comp = $("#cour_comp").val();
		var nameofcour_comp= $('#cour_comp option:selected').html();
		$("#selectedcour_comp2").val(cour_comp);
		$("#selectedcour_comp2").html(nameofcour_comp);
	});


	function getprincidata(){
		$("#loader3").show();
		var cour_comp = $("#cour_comp").val();
		var nameofcour_comp= $('#cour_comp option:selected').html();
		$("#selectedcour_comp").val(cour_comp);
		$("#selectedcour_comp").html(nameofcour_comp);
		// $("#clnamemdelhead").html(nameofclient);

		//alert(corp_client);exit();
		   $.ajax({  
	        url:"principal_actions.php",  
	        method:"POST",  
	        data:{action:'getprincidata',cour_comp:cour_comp},  
	        cache: false,
				//dataType: "JSON",
		        success:function(data){  
		        	$("#loader3").hide();
					$("#showprincidata").html(data);
		        }  
	   		});  
	}
//############################################ GET DATA OF PRINCIPAL SETTINGS ENDS############################################ 







//############################################ PRINCIPAL PRICE PRICE INSERT  MDOAL CODE STARTS############################################ 

	$('#principriceinsForm').submit(function(event) {
		event.preventDefault();
		insertPrinciPrice();
	}); 

	function insertPrinciPrice(){
		var courcompval2 = $("#selectedcour_comp2").val();
		var courcomcntry = $("#princicnty").val();
		var route_code2 = $("#route_code2").val();
		var income_or_outgo2 = $("#income_or_outgo2").val();
		var goods_type2 = $("#goods_type2").val();
		var unit2 = $("#unit2").val();
		var price2 = $("#price2").val();

                $.ajax({
                url: "principal_actions.php",
                method: "POST",
	       		data:{action:'insertprinciprice',courcompval2:courcompval2,courcomcntry:courcomcntry,route_code2:route_code2,income_or_outgo2:income_or_outgo2,goods_type2:goods_type2,unit2:unit2,price2:price2},  
	       		cache: false,
                success: function(data) {
                	//alert(data);
                	if (data !=="") {
                		alert('Data Inserted');
                		getprincidata();
                	}
                    
                }
            })
		
	 }

//############################################ PRINCIPAL PRICE PRICE INSERT  MDOAL CODE  ENDS############################################ 









//PRINCIPAL ROUTE INSERT 


	$('#princiroutinsform').submit(function(event) {
		event.preventDefault();
		insertPrinciroute();
	}); 

	function insertPrinciroute(){

		var courcomp4 = $("#courcomp4").val();
		var route_code4 = $("#route_code4").val();
		var showcntry4 = $("#princicnty").val();
		var status = $("#status").val();
                $.ajax({
                url: "principal_actions.php",
                method: "POST",
	       		data:{action:'insertPrinciroute',courcomp4:courcomp4,route_code4:route_code4,showcntry4:showcntry4,status:status},  
	       		cache: false,
                success: function(data) {
                	//alert(data);
                	if (data !=="getprincidata") {
                		alert('Data Inserted');
                		getprincidata();
                	}
                    
                }
            })
		
	 }



//PRINCIPAL ROUTE INSERT 






// ############################################ get principal routed country for price modal############################################ 
		$('#cour_comp').on('change', function(event) {
			event.preventDefault();
			srchPrincicountry();
		});
		function srchPrincicountry(){
			
					$("#loader").show();
					$('#showcntry').hide();
					var corcompany2 = $('#cour_comp').val();
					//var route_code2 = $('#route_code2').val();

					$.ajax({
						url: 'actions.php',
						type: 'POST',
						data: {action:'serchprincicntry',corcompany:corcompany2},
						cache: false,
					})
					.done(function(data) {
						$("#loader").hide();
						$('#showcntry2').html(data);
						//all time will be selected this options
       					//$('#princicnty option').prop('selected', true);
						
					})
					.fail(function() {
					})
					.always(function() {
					});


				}




// ############################################ GET SETTED PRICE OF COUR COMP ############################################
	$("body").on("change",".route_code2forrouted",function(){
	
	$("#route_code2,#income_or_outgo2,#goods_type2,#unit2").change(function(){
		event.preventDefault();		
		var courcompval2 = $("#selectedcour_comp2").val();
		//var courcomcntry = $("#princicnty").val();
		var route_code2 = $("#route_code2").val();
		var income_or_outgo2 = $("#income_or_outgo2").val();
		var goods_type2 = $("#goods_type2").val();
		var unit2 = $("#unit2").val();
		getprinciprice();

		function getprinciprice(){

					$("#loader2").show();
				   $.ajax({  
			        url:"principal_actions.php",  
			        method:"POST",  
			        data:{action:'getprinciprice',courcompval2:courcompval2,route_code2:route_code2,income_or_outgo2:income_or_outgo2,goods_type2:goods_type2,unit2:unit2}, 
						//dataType: "JSON",
						cache: false,
				        success:function(data){  
				        $("#loader2").hide();
				        //alert(data);exit();
				   		$("#price2").val(data);

					   			var pr = $("#price2").val();
						   		if (pr){
									$("#shwpriceprinci").text("this is the price of those data");	
									$("#submitpricebtn").hide();
						   		}else{
						   			$("#shwpriceprinci").text("");	
						   			$("#submitpricebtn").show();
						   		}



				        }  
			   		});  
		}

	})
	})
// #################################### GET SETTED PRICE OF COUR COMP ENDS ############################################





 // ############################################ GET SETTED PRICE OF COUR COMP THAT COMPANY NOT SETTED CONTRY TO ROUTES

	$("body").on("change",".cntryselctforsrch",function(){
		$("#princicnty,#income_or_outgo2,#goods_type2,#unit2").change(function(){
			event.preventDefault();		
			var courcompval2 = $("#selectedcour_comp2").val();
			var courcomcntry = $("#princicnty").val();
			var income_or_outgo2 = $("#income_or_outgo2").val();
			var goods_type2 = $("#goods_type2").val();
			var unit2 = $("#unit2").val();
			getprincipriceofcntry();

			function getprincipriceofcntry(){
						$("#loader2").show();
					   $.ajax({  
				        url:"principal_actions.php",  
				        method:"POST",  
				        data:{action:'getprincipriceofcntry',courcompval2:courcompval2,courcomcntry:courcomcntry,income_or_outgo2:income_or_outgo2,goods_type2:goods_type2,unit2:unit2}, 
							//dataType: "JSON",
							cache: false,
					        success:function(data){  
					        $("#loader2").hide();
					        //alert(data);exit();
					   		$("#price2").val(data);

					   			var pr = $("#price2").val();
						   		if (pr){
									$("#shwpriceprinci").text("this is the price of those data");	
									$("#submitpricebtn").hide();
						   		}else{
						   			$("#shwpriceprinci").text("");	
						   			$("#submitpricebtn").show();
						   		}


					        }  
				   		});  
			}

		})
	})
// ########################## GET SETTED PRICE OF COUR COMP THAT COMPANY NOT SETTED CONTRY TO ROUT######################### 






// ####################################SEARCH PRICE BY COUNTRY AND UNIT STARTS############################################


		$('body').on('change','#srchselect select', function(event) {
			event.preventDefault();
			srchprinciprice();
		});
		function srchprinciprice(){
			var cour_comp = $("#cour_comp").val();
			var unit3 = $("#unit3").val();
			var cntry3 = $("#country3").val();
			//alert(corp_client);exit();
			   $.ajax({  
		        url:"principal_actions.php",  
		        method:"POST",  
		        data:{action:'getspecpricedata',unit3:unit3,cntry3:cntry3,cour_comp:cour_comp},  
					//dataType: "JSON",
					cache: false,
			        success:function(data){  
						$("#showprincidata").html(data);
			        }  
		   		}); 
		}

		$("#srchbtn").on('click',function(event) {
			event.preventDefault();
			$("#srchcontent").toggle();
		});
// ####################################SEARCH PRICE BY COUNTRY AND UNIT ENDS############################################






// ############################################ get principal country For route modal############################################ 

		$('#route_code4').on('change', function(event) {
			event.preventDefault();
			srchPrincicountryforroute();
		});

		function srchPrincicountryforroute(){
					$("#loader4").show();
					//$('#showcntry').hide();
					//var showcntry4 = $("#showcntry4").val();
					var courcomp4 = $("#selectedcour_comp").val();
					var route_code4 = $("#route_code4").val();
					$.ajax({
						url: 'actions.php',
						type: 'POST',
						data: {action:'srchprincicntryforroute',courcomp4:courcomp4,route_code4:route_code4},
						cache: false,
					})
					.done(function(data) {
						$("#loader4").hide();
						$('#showcntry4').html(data);
						//all time will be selected this options
       					//$('#princicnty option').prop('selected', true);
						
					})
					.fail(function() {
					})
					.always(function() {
					});

				}




});






</script>