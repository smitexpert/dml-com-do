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
				$.ajax({
					url:"ajax/ajax_search_price.php",
					method:"POST",
					data:{
						country_tag:country_tag,
						weight:weight
					},
					success:function(result){
						console.log(result);
					}
				})
			}
		})
	</script>
	<?php
}
?>


</body>

</html>