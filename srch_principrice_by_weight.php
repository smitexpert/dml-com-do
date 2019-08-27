<?php 
include('includes/header.php'); 


if (isset($_POST['submit'])) {
    $insertcourcompprice = $Courcompanyset->insertPrincipalPrice($_POST);
}

// $query = "SELECT p.*,r.cour_comp_name,c.weight FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_weight as c WHERE p.cour_company = r.cour_comp_id AND p.unit = c.weight_id";
// $selectcourcomp = $Courcompanyset->selectcourComp($query);

 
?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br>

				
										<div class="row" style="">
											<div class="col-md-1"></div>
											<div class="col-md-10">
												
										<div class="header">
												<h3 style="color: green;border-bottom: 1px solid;padding-bottom: 8px">Principal Price Comparison</h3>
										</div><br>

										<div class="row styled">							
											<div class="col-md-3">
													<div class="form-group connected-group">
														<label class="control-label">Route<span class="symbol required"></span>
														</label>
													<select name="route_code" required id="route_code2" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
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
													<label class="control-label">Where<span class="symbol required"></span>
													</label>
													<select name="income_or_outgo2" id="income_or_outgo2" class="form-control" required>
														<option value="">--</option>
														<option value="incoming">Incoming</option>
														<option value="outgoing">Outgoing</option>
													</select>
												</div>
											</div>	

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

										</div>
									</div>
									<div class="col-md-1"></div>
								</div>

<!-- SHOW COMPARISON TABLE -->
										<div class="row">
											<div class="col-md-12">
													<img class="center-block text-center" id="loader2" style="display: none;" src="assets/images/dataloader.gif" alt="ddd" width="25">
												<div id="whowcomparisontbl">
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
<style type="text/css">
	tfoot {
    position: absolute;
    top: -37px;
}
.dataTables_filter label {
    position: absolute;
    right: 2px;
    top: -72px;
}
div#principricetable_length {
    margin-top: -66px;
}
.showpriceweight {
    float: left;
    border: 1px solid gray;
    margin-right: 15px;
    margin-bottom: 10px;
    background: khaki;
}
.showpriceweight ul {
    float: left;
    width: 100%;
    padding: 6px;
}
.showpriceweight ul {list-style: none;}
.styled{
	    background: #656586;
    color: white;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 20px;
}
.bootstrap-select>.btn {
    background: #656586 !IMPORTANT;
    color: white !IMPORTANT;
}
/*select.form-control{color: white !IMPORTANT}*/
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {


// ############################################ GET SETTED PRICE OF COUR COMP ############################################
	// $("body").on("change",".route_code2forrouted",function(){


	$("#route_code2,#income_or_outgo2,#goods_type2,#unit2").change(function(){

		event.preventDefault();		
		var route_code2 = $("#route_code2").val();
		var income_or_outgo2 = $("#income_or_outgo2").val();
		var goods_type2 = $("#goods_type2").val();
		var unit2 = $("#unit2").val();

		getprincipalComparison();


		function getprincipalComparison(){

					$("#loader2").show();
				   $.ajax({  
			        url:"principal_price_comparison.php",  
			        method:"POST",  
			        data:{action:'getprincipalComparison',route_code2:route_code2,income_or_outgo2:income_or_outgo2,goods_type2:goods_type2,unit2:unit2}, 
						//dataType: "JSON",
						cache: false,
				        success:function(data){  
				        $("#loader2").hide();
				        //alert(data);exit();

				   		$("#whowcomparisontbl").html(data);

				        }  
			   		});  
		}

	})
	// })
// #################################### GET SETTED PRICE OF COUR COMP ENDS ############################################















 
	$('body').on('click','.delactionbtn', function() {
		deletedata();
	});
	function deletedata(){
		//$delid = $(".delactionbtn").attr('deldata');
		var delid = $(".delactionbtn").attr("deldata");
		var phpquery = "DELETE FROM tbl_principal_price WHERE id="+delid;

		$.ajax({
	      type:'POST',
	      url:'del_edit_ajax.php',
	      data: {action: 'deletedata',delid : delid,query : phpquery},
	      success:function(data) {

	        if(data) {
	        	alert(data);
	        	findprincipalprice();
	       	 } else { 

	      	}


	      }
	  	});



	}




//table by wieght data show
		findprincipalpricebyweight();
		function findprincipalpricebyweight(){
			$("#loader2").show();
				//var weight = $('#weight').val();
				$.ajax({
					url: 'ajaxgetdatabyweight.php',
					method: 'POST',
					data: {action: 'showdaintablebyweight'},
					success:function(data){
						
					$("#loader2").hide();
					$('#sowprice').html(data);
					}

				});
		}








// ############################################ get principal routed weight for price modal############################################ 
		// $('#corcompany').on('change', function(event) {
		// 	event.preventDefault();
		// 	srchPrinciweight();
		// });
		// function srchPrinciweight(){
		// 			$("#loader").show();
		// 			$('#showcntry').hide();
		// 			var corcompany2 = $('#corcompany').val();
		// 			//var route_code2 = $('#route_code2').val();

		// 			$.ajax({
		// 				url: 'actions.php',
		// 				type: 'POST',
		// 				data: {action:'serchprincicntry',corcompany:corcompany2},
		// 				cache: false,
		// 			})
		// 			.done(function(data) {
		// 				$("#loader").hide();
		// 				$('#showcntry2').html(data);
		// 				//all time will be selected this options
  //      					//$('#princicnty option').prop('selected', true);
						
		// 			})
		// 			.fail(function() {
		// 			})
		// 			.always(function() {
		// 			});


		// 		}









	});
</script>