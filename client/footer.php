		<!-- start: FOOTER -->
		<div class="footer clearfix">
		    <div class="footer-inner">
		        2014 &copy; clip-one by cliptheme.
		    </div>
		    <div class="footer-items">
		        <span class="go-top"><i class="clip-chevron-up"></i></span>
		    </div>
		</div>
		<!-- end: FOOTER -->

		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<![endif]-->


		<script src="../assets/jQuery/jquery-3.3.1.min.js"></script>

		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="../assets/DataTables/datatables.js"></script>

		<script src="../assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="../assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="../assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="../assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="../assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="../assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="../assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="../assets/js/main.js"></script>

		<script type="text/javascript" src="../assets/js/jquery.datepicker.js"></script>


		<script src="../assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script src="../assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
		<script src="../assets/js/ui-modals.js"></script>

		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="../assets/plugins/bootstrap-paginator/src/bootstrap-paginator.js"></script>
		<script src="../assets/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
		<script src="../assets/plugins/gritter/js/jquery.gritter.min.js"></script>
		<script src="../assets/js/ui-elements.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="../assets/js/form-elements.js"></script>
		<script src="../assets/js/bootstrap-select.js"></script>

		<link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.js">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/r-2.2.2/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>



		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="../assets/date/jquery-ui.min.js"></script>
		<?php
			$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		?>
		<script>
		    jQuery(document).ready(function() {

		    
		        //ADD CLASS TO LI BASED ON URL STARTS
		        var fullpath = window.location.pathname;
		        var filename = fullpath.replace(/^.*[\\\/]/, '');
		        //alert(filename);
		        var currentLink = $('a[href="' + filename + '"]');
		        currentLink.closest('.linav').addClass("active open");
		        //ADDING CLASS TO LI BASED ON URL

		        // Main.init();
		        // Index.init();

		    });

			//CONSIGNMENT LIST TAB VIEW
			$(".nav_view li").click(function(){
				$('.nav_view li').removeClass('active');
				$(this).addClass('active');
			})
		</script>


<?php
	if($uri_parts[0] == '/client/agent_client_view_price.php'){
		?>
		<script>
			$(".nav_view li").click(function(){
				$(".nav_view li").removeClass('active');
				$(this).addClass('active');
				var id = $(this).find('a').attr("id");

				$(".view_panel").css("display", "none");
				$("#view_"+id).css("display", "block");
			});

			$("#principal").change(function(){
				var principal = $("#principal").find(":selected").val();
				$("#price_view_table").find("*").remove();
				$.ajax({
					url: "ajax/ajax_agent_general_price.php",
					method: "POST",
					data: {
						view_price_principal: principal
					},
					success: function(data){
						$("#price_view_table").append(data);
					}
				})
			})

			$("#special_principal").change(function(){
				var principal = $("#special_principal").find(":selected").val();
				
				$.ajax({
					url: "ajax/ajax_agent_special_price.php",
					method: "POST",
					data: {
						special_country_list: principal
					},
					success: function(data){
						$("#country").find("*").remove();
						$("#country").append(data);
						$("#country").selectpicker("refresh");
					}
				})
			})

			$("#country").change(function(){
				var tag = $("#country").find(":selected").val();
				var principal = $("#special_principal").find(":selected").val();
				
				$.ajax({
					url: "ajax/ajax_agent_special_price.php",
					method: "POST",
					data: {
						agent_special_price_principal: principal,
						agent_special_price_tag: tag
					},
					success: function(data){
						$("#special_view_panel").find("*").remove();
						$("#special_view_panel").append(data);
					}
				})
			})
		</script>
		<?php
	}
?>

<?php 
if($uri_parts[0] == '/client/search_price.php'){
	?>
	<script>
		$("#get_price").click(function(){
			var country_tag = $("#country").val();
			var weight = $("#weight").val();

			if(country_tag != ""){				
				$("#load_price").find("*").remove();
				$.ajax({
					url:"ajax/ajax_search_price.php",
					method:"POST",
					data:{
						country_tag:country_tag,
						weight:weight
					},
					success:function(result){
						$("#load_price").append(result);
						
					}
				})
			}
		})
	</script>
	<?php
}
?>
<?php 
if($uri_parts[0] == '/client/booking.php'){
	?>
	<script>
		function get_tracking_id(event) {
			// console.log("Clicked");
		        if ($(event.target).val() != "")
		            return 0;

		        $.ajax({
		            url: "ajax/ajax_tracking_id.php",
		            method: "POST",
		            data: "",
		            success: function(data) {
						$(event.target).val(data);
						$("#refference_no").val(data);
						// console.log("Hello");
		            }
		        });
		    }

			function get_agent_price() {
		        var agent_dest_country = $("#agent_dest_country").find(":selected").val();
		        var agent_goods_type = $("#agent_goods_type").find(":selected").val();
		        var agent_goods_weight = $("#agent_goods_weight").find(":selected").val();
		        var agent_principal = $("#agent_principal").find(":selected").val();
		        var agent_sender_mail = $("#agent_sender_mail").val();

		        if ((agent_dest_country != "") && (agent_goods_type != "") && (agent_goods_weight != "") && (agent_principal != "") && (agent_sender_mail != "")) {

					// console.log(agent_dest_country);
					// console.log(agent_goods_type);
					// console.log(agent_goods_weight);
					// console.log(agent_principal);
					// console.log(agent_sender_mail);


		            $.ajax({
		                url: "ajax/ajax_shiping_charge.php",
		                method: "POST",
		                data: {
		                    agent_dest_country: agent_dest_country,
		                    agent_goods_type: agent_goods_type,
		                    agent_goods_weight: agent_goods_weight,
		                    agent_principal: agent_principal,
		                    agent_sender_mail: agent_sender_mail
		                },
		                success: function(data) {

							console.log(data);
		                    if (data == 'NOTHING') {
								alert("No Price Found, Please contact to DML");

		                        $("#agent_shipping_charge").val("");
		                        // var con = confirm("No Price Found! Do you want to input Price Manually?");
		                        // if (con == true) {
		                        //     $("#agent_shipping_charge").prop('readonly', false);
		                        //     agent_convert_to_bdt()
		                        // }
		                    } else {
		                        $("#agent_shipping_charge").prop('readonly', true);
		                        $("#agent_shipping_charge").val(data);
		                        agent_convert_to_bdt()
		                    }
		                }
		            });

		        }else{
					$("#agent_shipping_charge").val("");
				}
		    }

		    function agent_convert_to_bdt() {
		        var shiping_charge = $("#agent_shipping_charge").val();
		        $("#agent_bdt").text("");
		        if (shiping_charge != "") {
		            $.ajax({
		                url: "ajax/ajax_shiping_charge.php",
		                method: "POST",
		                data: {
		                    shiping_charge_bdt: shiping_charge
		                },
		                success: function(data) {
		                    $("#agent_bdt").text(data);
		                }
		            });
		        }
		    }

			$("#agent_consignment_submit").submit(function(e){
				e.preventDefault();
				var formData = $(this).serialize();

				//get price field for varification
				var shiping_charge = $("#agent_shipping_charge").val();
				var agent_tracking_id = $(".agent_tracking_id").val();

				if((shiping_charge != "") && (agent_tracking_id != "")){
					var con = confirm("Are you sure?");
				if(con == 1){
					$.ajax({
						url: "ajax/ajax_shiping_charge.php",
		                method: "POST",
		                data: formData,
		                success: function(data) {
		                    alert("Consigned Booking Successfully!");
							document.getElementById("agent_consignment_submit").reset();
							$('.selectpicker').selectpicker('refresh');
		                }
					})
				}
				}else{
					alert("Please Fill-up All Required Filled");
				}
				
			})
	</script>
	<?php
}
?>

<?php
if($uri_parts[0] == '/client/consignment_view.php' ){
	?>
	<script>
		$(document).ready(function(){
			// $("#consListTable").DataTable();
			$('#consListTable').DataTable( {
				"language":{
					"emptyTable" : "No Data Founds!"
				},
				"columnDefs": [
					{
						"targets": [ 2 ],
						"visible": false,
						"searchable": true
					}
				]
    		} );
		})
		$(document).ready(function(){
			// $("#consListTable").DataTable();
			$('#consListTable_booked').DataTable( {
				"language":{
					"emptyTable" : "No Data Founds!"
				},
				"columnDefs": [
					{
						"targets": [ 2 ],
						"visible": false,
						"searchable": true
					}
				]
    		} );
		})
		$(document).ready(function(){
			// $("#consListTable").DataTable();
			$('#consListTable_delivered').DataTable( {
				"language":{
					"emptyTable" : "No Data Founds!"
				},
				"columnDefs": [
					{
						"targets": [ 2 ],
						"visible": false,
						"searchable": true
					}
				]
    		} );
		})
		$(document).ready(function(){
			// $("#consListTable").DataTable();
			$('#consListTable_deleted').DataTable( {
				"language":{
					"emptyTable" : "No Data Founds!"
				},
				"columnDefs": [
					{
						"targets": [ 2 ],
						"visible": false,
						"searchable": true
					}
				]
    		} );
		})
		$("#booked").click(function(){
			$("#personal_body").css("display", "block");
			$("#personal_body_booked").css("display", "none");
			$("#personal_body_delivered").css("display", "none");
			$("#personal_body_deleted").css("display", "none");
		})
		$("#assinged").click(function(){
			$("#personal_body").css("display", "none");
			$("#personal_body_booked").css("display", "block");
			$("#personal_body_delivered").css("display", "none");
			$("#personal_body_deleted").css("display", "none");
		})
		$("#delivered").click(function(){
			$("#personal_body").css("display", "none");
			$("#personal_body_booked").css("display", "none");
			$("#personal_body_delivered").css("display", "block");
			$("#personal_body_deleted").css("display", "none");
		})
		$("#canceled").click(function(){
			$("#personal_body").css("display", "none");
			$("#personal_body_booked").css("display", "none");
			$("#personal_body_delivered").css("display", "none");
			$("#personal_body_deleted").css("display", "block");
		});

		function deleteConsignment(e){
				var tracking_id = e;
				console.log(tracking_id);
				var con = confirm("Are you confirm to Delete?");

				if(con == 1){
					//delete selected consignment
					$.ajax({
						url:"ajax/delete_consignment.php",
						method:"POST",
						data:{
							tracking_number : tracking_id
						},
						success:function(result){
							if(result == 1){
								$("#"+tracking_id).closest("tr").remove();
							}
						}
					})
				}else{

				}			
		}

		// $(".deleteConsignment").click(function(){
		// 		var tracking_id = $(this).attr("id");
		// 		var con = confirm("Are you confirm to Delete?");

		// 		if(con == 1){
		// 			//delete selected consignment
		// 			$.ajax({
		// 				url:"ajax/delete_consignment.php",
		// 				method:"POST",
		// 				data:{
		// 					tracking_number : tracking_id
		// 				},
		// 				success:function(result){
		// 					if(result == 1){
		// 						$("#"+tracking_id).closest("tr").remove();
		// 					}
		// 				}
		// 			})
		// 		}else{

		// 		}
		// 	})

		$(".undoDeleteConsignment").click(function(){
				var tracking_id = $(this).attr("id");
				var con = confirm("Are you confirm to Undo?");

				if(con == 1){
					//undo delete selected consignment
					$.ajax({
						url:"ajax/delete_consignment.php",
						method:"POST",
						data:{
							undo_tracking_number : tracking_id
						},
						success:function(result){
							if(result == 1){
								$("#"+tracking_id).closest("tr").remove();
							}
						}
					})
					//delete selected consignment
					$.ajax({
						url:"ajax/delete_consignment.php",
						method:"POST",
						data:{
							undo_tracking_number_fetch : tracking_id
						},
						dataType : "JSON",
						success:function(result){
							// location.reload();
							// console.log(result);
							var data = $("#consListTable").DataTable();
							data.row.add([
								result.tracking_id,
								result.custom_id,
								result.awb_no,
								result.s_name,
								result.r_name,
								result.country_name,
								result.g_shipment_charge,
								"<a href='agent_cons_update.php?id="+result.id+"' class='btn btn-xs btn-teal tooltips' data-placement='top' data-original-title='Edit' title='UPDATE CONSIGNMENT'><i class='fa fa-edit'></i></a> <button onclick='deleteConsignment("+result.tracking_id+")' class='btn btn-xs btn-bricky tooltips rts deleteConsignment' data-placement='top' data-original-title='Remove' title='CANCEL CONSIGNMENT'><i class='fa fa-times'></i></button>"

							]).draw(false);
						}
					})
				}else{

				}
			})
	</script>
	<?php
}
?>
<?php
if($uri_parts[0] == '/client/agent_cons_update.php'){
	?>
	<script>
		$(document).ready(function(){
			var id = <?php echo $_GET['id']; ?>

			$.ajax({
				url:'ajax/ajax_agent_cons_update.php',
				method:"POST",
				data:{
					consignment_id : id
				},
				dataType:"JSON",
				success:function(r){
					// console.log(r);
					$("#sender_name").val(r.s_name);
					$("#sender_company").val(r.s_company);
					$("#sender_mail").val(r.s_email);
					$("#sender_contact").val(r.s_contact);
					$("#sender_addr").val(r.s_address);
					$("#sender_country").val(r.s_country);

					$("#recipient_name").val(r.r_name);
					$("#recipient_company").val(r.r_company);
					$("#recipient_mail").val(r.r_email);
					$("#recipient_addr1").val(r.r_address1);
					$("#recipient_addr2").val(r.r_address2);
					$("#recipient_addr3").val(r.r_address3);
					$("#recipient_phone").val(r.r_phone);
					$("#recipient_mobile").val(r.r_mobile);
					$("#recipient_city").val(r.r_city);
					$("#agent_dest_country").val(r.r_country).selectpicker('refresh');
					$("#recipient_zip").val(r.r_zip);

					
					$("#goods_title").val(r.g_title);
					$("#agent_goods_type").val(r.g_type).selectpicker('refresh');;
					$("#agent_goods_weight").val(r.g_weight).selectpicker('refresh');
					$("#shimpent_pieces").val(r.g_pieces);
					$("#shimpent_declared_value").val(r.g_customs_value);
					$("#custom_trackId").val(r.awb_no);
					$("#agent_principal").val(r.service_id).selectpicker('refresh');
					$("#trackID").val(r.tracking_id);
					$("#refference_no").val(r.custom_id);
					$("#agent_shipping_charge").val(r.g_shipment_charge);
					$("#agent_shipping_charge_old").val(r.g_shipment_charge);

					$.ajax({
						url:'ajax/ajax_agent_cons_update.php',
						method:"POST",
						data:{
							shiping_charge_bdt: r.g_shipment_charge
						},
						success:function(bdt_price){
							$("#agent_bdt").text(bdt_price);
						}
					});

				}
			});
			
		});

		

		function get_agent_price() {
		        var agent_dest_country = $("#agent_dest_country").find(":selected").val();
		        var agent_goods_type = $("#agent_goods_type").find(":selected").val();
		        var agent_goods_weight = $("#agent_goods_weight").find(":selected").val();
		        var agent_principal = $("#agent_principal").find(":selected").val();
		        var agent_sender_mail = $("#agent_sender_mail").val();

		        if ((agent_dest_country != "") && (agent_goods_type != "") && (agent_goods_weight != "") && (agent_principal != "") && (agent_sender_mail != "")) {

					// console.log(agent_dest_country);
					// console.log(agent_goods_type);
					// console.log(agent_goods_weight);
					// console.log(agent_principal);
					// console.log(agent_sender_mail);


		            $.ajax({
		                url: "ajax/ajax_shiping_charge.php",
		                method: "POST",
		                data: {
		                    agent_dest_country: agent_dest_country,
		                    agent_goods_type: agent_goods_type,
		                    agent_goods_weight: agent_goods_weight,
		                    agent_principal: agent_principal,
		                    agent_sender_mail: agent_sender_mail
		                },
		                success: function(data) {

							// console.log(data);
		                    if (data == 'NOTHING') {
								alert("Please Contact to DML");
		                        $("#agent_shipping_charge").val("");
								agent_convert_to_bdt();
		                        // var con = confirm("No Price Found! Do you want to input Price Manually?");
		                        // if (con == true) {
		                        //     $("#agent_shipping_charge").prop('readonly', false);
		                        //     agent_convert_to_bdt()
		                        // }
		                    } else {
		                        $("#agent_shipping_charge").prop('readonly', true);
		                        $("#agent_shipping_charge").val(data);
		                        agent_convert_to_bdt();
		                    }
		                }
		            });

		        }else{
					$("#agent_shipping_charge").val("");
					agent_convert_to_bdt();
				}
		    }

			function agent_convert_to_bdt() {
		        var shiping_charge = $("#agent_shipping_charge").val();
		        $("#agent_bdt").text("");
		        if (shiping_charge != "") {
		            $.ajax({
		                url: "ajax/ajax_shiping_charge.php",
		                method: "POST",
		                data: {
		                    shiping_charge_bdt: shiping_charge
		                },
		                success: function(data) {
		                    $("#agent_bdt").text(data);
		                }
		            });
		        }
		    }

			$("#agent_consignment_submit").submit(function(e){
				e.preventDefault();
				var formData = $(this).serialize();

				//get price field for varification
				var shiping_charge = $("#agent_shipping_charge").val();
				var agent_tracking_id = $(".agent_tracking_id").val();

				if((shiping_charge != "") && (agent_tracking_id != "")){
					var con = confirm("Are you sure?");
				if(con == 1){

					// console.log("Hello");
					$.ajax({
						url: "ajax/ajax_agent_cons_update.php",
		                method: "POST",
		                data: formData,
		                success: function(data) {
		                    alert("Consignment Update Successfully!");
							window.location.replace('/client/consignment_view.php');
		                }
					})
				}
				}else{
					alert("Please Fill-up All Required Filled");
				}
				
			})	

			
	</script>
	<?php
}
?>

<?php 
if($uri_parts[0] == '/client/agent_accounts.php'){
?>
<script>
	$("#overview").click(function(){		
		$("#overviewbody").css("display", "block");
		$("#limitbody").css("display", "none");
		$("#transectionbody").css("display", "none");
		$("#paymentbody").css("display", "none");
		$("#balancebody").css("display", "none");
	});
	
	$("#limit").click(function(){
		var agent_email = $("#agent_email").val();
		var agent_id = $("#agent_id").val();

		$("#overviewbody").css("display", "none");
		$("#limitbody").css("display", "block");
		$("#transectionbody").css("display", "none");
		$("#paymentbody").css("display", "none");
		$("#balancebody").css("display", "none");

		// console.log(agent_email);
		// console.log(agent_id);
		$(".loading-img").css("display", "block");

		$.ajax({
			url:"ajax/ajax_agent_accounts.php",
			method:"POST",
			data:{
				agent_email:agent_email,
			},
			success:function(result){
				$("#agent_limit_table").html(result);
		        $(".loading-img").css("display", "none");
			}
		})
	});
	$("#transection").click(function(){
		var agent_email = $("#agent_email").val();
		var client_table_id = $("#client_table_id").val();

		$("#overviewbody").css("display", "none");
		$("#limitbody").css("display", "none");
		$("#transectionbody").css("display", "block");
		$("#paymentbody").css("display", "none");
		$("#balancebody").css("display", "none");

		$(function(){
		$("#formdate").datepicker({
			dateFormat:"yy-mm-dd"
		});
		$("#todate").datepicker({
			dateFormat:"yy-mm-dd"
		});
		})

		
		

		
		// if($("#formdate").val() != ""){
		// 	$("#view_button").prop("disabled", "true");
		// }
		// $.ajax({
		// 	url:"ajax/ajax_agent_accounts.php",
		// 	method: "POST",
		// 	data:{
		// 		agent_email_transaction:agent_email,
		// 		client_table_id:client_table_id
		// 	},
		// 	success:function(result){
		// 		$("#agent_transection_table").html(result);
		// 		// console.log(result);
		// 	}
		// })
	});
	$("#payment").click(function(){
		$("#overviewbody").css("display", "none");
		$("#limitbody").css("display", "none");
		$("#transectionbody").css("display", "none");
		$("#paymentbody").css("display", "block");
		$("#balancebody").css("display", "none");

		$(function(){
		$("#formdate_pay").datepicker({
			dateFormat:"yy-mm-dd"
		});
		$("#todate_pay").datepicker({
			dateFormat:"yy-mm-dd"
		});
		})
	});
	$("#balance").click(function(){
		$("#overviewbody").css("display", "none");
		$("#limitbody").css("display", "none");
		$("#transectionbody").css("display", "none");
		$("#paymentbody").css("display", "none");
		$("#balancebody").css("display", "block");
		
		var agent_email = $("#agent_email").val();
		$(".loading-img").css("display", "block");

		$.ajax({
			url:"ajax/ajax_agent_accounts.php",
			method:"POST",
			data:{
				agent_email_balance:agent_email,
			},
			success:function(result){
				$("#agent_balance_table").html(result);
		        $(".loading-img").css("display", "none");
			}
		})
	});

	function dateField(event){
			var fromDate = $("#formdate").val();
			var todate = $("#todate").val();
			
			if((fromDate != "") && (todate != "")){
				$("#view_button").prop("disabled", false);
			}
		}

		$("#view_button").click(function(e){
			e.preventDefault();

			
		var agent_email = $("#agent_email").val();
		var client_table_id = $("#client_table_id").val();

			var fromDate = $("#formdate").val();
			var todate = $("#todate").val();

			$.ajax({
			url:"ajax/ajax_agent_accounts.php",
			method: "POST",
			data:{
				agent_email_transaction:agent_email,
				client_table_id:client_table_id,
				fromdate : fromDate,
				todate : todate
			},
			success:function(result){
				$("#agent_transection_table").html(result);
				// console.log(result);
			}
			})
		})

		function  fromDatePay(event){
			var fromDate_pay = $("#formdate_pay").val();
			var todate_pay = $("#todate_pay").val();
			
			if((fromDate_pay != "") && (todate_pay != "")){
				$("#payment_view").prop("disabled", false);
			}
		}

		$("#payment_view").click(function(e){
			e.preventDefault();

			
		var agent_email = $("#agent_email").val();
		var client_table_id = $("#client_table_id").val();

			var formdate_pay = $("#formdate_pay").val();
			var todate_pay = $("#todate_pay").val();

			$.ajax({
			url:"ajax/ajax_agent_accounts.php",
			method: "POST",
			data:{
				agent_email_payment:agent_email,
				client_table_id:client_table_id,
				formdate_pay : formdate_pay,
				todate_pay : todate_pay
			},
			success:function(result){
				$("#agent_payment_table").html(result);
				// console.log(result);
			}
			})
		})


	

</script>
<?php
}
?>


</body>

</html>