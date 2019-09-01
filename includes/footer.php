		<!-- start: FOOTER -->
		<div class="footer clearfix">
		    <div class="footer-inner">
		        <?php echo date('Y'); ?> &copy; DML International.
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


		<script src="assets/jQuery/jquery-3.3.1.min.js"></script>

		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.js"></script>

		<script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="assets/js/main.js"></script>

		<script type="text/javascript" src="assets/js/jquery.datepicker.js"></script>


		<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
		<script src="assets/js/ui-modals.js"></script>

		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="assets/plugins/bootstrap-paginator/src/bootstrap-paginator.js"></script>
		<script src="assets/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
		<script src="assets/plugins/gritter/js/jquery.gritter.min.js"></script>
		<script src="assets/js/ui-elements.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="assets/js/form-elements.js"></script>
		<script src="assets/js/bootstrap-select.js"></script>

		<link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.js">
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

		<script src="assets/date/jquery-ui.min.js"></script>

		<?php
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

?>

		<script>
		    jQuery(document).ready(function() {

		        //DATA TABLE FOR CONSIGNEMENT LIST
		        $('#consListTable').DataTable({
		            // "scrollY": 200,
		            "scrollX": true,
		            "order": [
		                [0, "desc"]
		            ]
		        });

		        // //table for pricncipal price srch of search_principal_price.php
		        // $('#principricetable').DataTable();

		        //DATA TABLE
		        $('#example').DataTable();


		        //DATATABLE  : SHOW ALL THE COUNTRY
		        $('#cntylisttable').DataTable({
		            initComplete: function() {
		                this.api().columns().every(function() {
		                    var column = this;
		                    var select = $('<select><option value=""></option></select>')
		                        .appendTo($(column.footer()).empty())
		                        .on('change', function() {
		                            var val = $.fn.dataTable.util.escapeRegex(
		                                $(this).val()
		                            );
		                            column
		                                .search(val ? '^' + val + '$' : '', true, false)
		                                .draw();
		                        });
		                    column.data().unique().sort().each(function(d, j) {
		                        if (column.search() === '^' + d + '$') {
		                            select.append('<option value="' + d + '" selected="selected">' + d + '</option>')
		                        } else {
		                            select.append('<option value="' + d + '">' + d + '</option>')
		                        }
		                    });
		                });
		            }
		        });


		        //ADD CLASS TO LI BASED ON URL STARTS
		        var fullpath = window.location.pathname;
		        var filename = fullpath.replace(/^.*[\\\/]/, '');
		        //alert(filename);
		        var currentLink = $('a[href="' + filename + '"]');
		        currentLink.closest('.linav').addClass("active open");
		        //ADDING CLASS TO LI BASED ON URL

		        Main.init();
		        Index.init();

		    });

		</script>




		<?php


if($uri_parts[0] == '/create_debit_voucher.php'){
    ?>
		<script>
		    $(".nav_view li").click(function() {
		        $(".nav_view li").removeClass('active');
		        $(this).addClass('active');
		        var id = $(this).find("a").attr("id");

		        $("#viewarea").find('.viewsec').css("display", "none");

		        var view = "#" + id + "VIEW";

		        $(view).css("display", "block");
		    });

		    $("#corporate_selection").change(function() {

		        var corporate_selection = $("#corporate_selection").find(":selected").val();

		        /*alert(corporate_selection);*/

		        $.ajax({
		            url: "../ajax/ajax_debit_voucher.php",
		            method: "POST",
		            data: {
		                corporate_selection: corporate_selection
		            },
		            dataType: "JSON",
		            success: function(data) {
		                /*console.log(data);*/
		                $("#client_name").val(data.principal_name);
		                $("#client_id").val(data.id);
		                $("#rate").val(data.currency_rate);
		                $("#based").val(data.currency);
		                $("#corporate_form_view").css("display", "block");
		            }
		        });
		    });




		    $("#corporate_credit_date").datepicker({
		        dateFormat: "yy-mm-dd"
		    });

		    $("#personal_credit_date").datepicker({
		        dateFormat: "yy-mm-dd"
		    });

		    $("#pay_mode input").click(function() {
		        var val = $(this).attr("id");
		        if (val == "radio_check") {
		            $("#bank_name, #bank_account_no").removeAttr('readonly');
		            $("#bank_name, #bank_account_no").prop('required', true);
		        } else {
		            $("#bank_name, #bank_account_no").val('');
		            $("#bank_name, #bank_account_no").removeAttr('required');
		            $("#bank_name, #bank_account_no").prop('readonly', true);
		        }
		    });

		    $("#pay_mode_p input").click(function() {
		        var val = $(this).attr("id");
		        if (val == "radio_check") {
		            $("#bank_name_p, #bank_account_no_p").removeAttr('readonly');
		            $("#bank_name_p, #bank_account_no_p").prop('required', true);
		        } else {
		            $("#bank_name_p, #bank_account_no_p").val('');
		            $("#bank_name_p, #bank_account_no_p").removeAttr('required');
		            $("#bank_name_p, #bank_account_no_p").prop('readonly', true);
		        }
		    });


		    $("#corporate_form").on("submit", function(event) {
		        event.preventDefault();

		        var corporate_form = $("#corporate_form").serialize();

		        console.log(corporate_form);

		        $.ajax({
		            url: "../ajax/ajax_debit_voucher.php",
		            data: corporate_form,
		            method: "POST",
		            success: function(data) {
		                if (data == '1') {
		                    alert("Success!");
		                    $("#corporate_form")[0].reset();
		                } else {
		                    alert("Something Wrong!");
		                }

		            }
		        })

		    });


		    $("#porsonal_form").on("submit", function(event) {
		        event.preventDefault();

		        var porsonal_form = $("#porsonal_form").serialize();

		        console.log(porsonal_form);

		        $.ajax({
		            url: "../ajax/ajax_debit_voucher.php",
		            data: porsonal_form,
		            method: "POST",
		            success: function(data) {
		                if (data == '1') {
		                    alert("Success!");
		                    $("#porsonal_form")[0].reset();
		                } else {
		                    alert("Something Wrong!");
		                }
		            }
		        })

		    });

		</script>
		<?php
}


if($uri_parts[0] == '/create_credit_voucher.php'){
    ?>
		<script>
		    $(".nav_view li").click(function() {
		        $(".nav_view li").removeClass('active');
		        $(this).addClass('active');
		        var id = $(this).find("a").attr("id");

		        $("#viewarea").find('.viewsec').css("display", "none");

		        var view = "#" + id + "VIEW";

		        $(view).css("display", "block");
		    });

		    $("#corporate_selection").change(function() {

		        var corporate_selection = $("#corporate_selection").find(":selected").val();

		        /*alert(corporate_selection);*/

		        $.ajax({
		            url: "../ajax/ajax_credit_corporte_voucher.php",
		            method: "POST",
		            data: {
		                corporate_selection: corporate_selection
		            },
		            dataType: "JSON",
		            success: function(data) {
		                $("#client_name").val(data.company_name);
		                $("#client_id").val(data.id);
		                $("#corporate_form_view").css("display", "block");
		            }
		        });
		    });




		    $("#corporate_credit_date").datepicker({
		        dateFormat: "yy-mm-dd"
		    });

		    $("#personal_credit_date").datepicker({
		        dateFormat: "yy-mm-dd"
		    });

		    $("#pay_mode input").click(function() {
		        var val = $(this).attr("id");
		        if (val == "radio_check") {
		            $("#bank_name, #bank_account_no").removeAttr('readonly');
		            $("#bank_name, #bank_account_no").prop('required', true);
		        } else {
		            $("#bank_name, #bank_account_no").val('');
		            $("#bank_name, #bank_account_no").removeAttr('required');
		            $("#bank_name, #bank_account_no").prop('readonly', true);
		        }
		    });

		    $("#pay_mode_p input").click(function() {
		        var val = $(this).attr("id");
		        if (val == "radio_check") {
		            $("#bank_name_p, #bank_account_no_p").removeAttr('readonly');
		            $("#bank_name_p, #bank_account_no_p").prop('required', true);
		        } else {
		            $("#bank_name_p, #bank_account_no_p").val('');
		            $("#bank_name_p, #bank_account_no_p").removeAttr('required');
		            $("#bank_name_p, #bank_account_no_p").prop('readonly', true);
		        }
		    });


		    $("#corporate_form").on("submit", function(event) {
		        event.preventDefault();

		        var corporate_form = $("#corporate_form").serialize();

		        $.ajax({
		            url: "../ajax/ajax_credit_corporte_voucher.php",
		            data: corporate_form,
		            method: "POST",
		            success: function(data) {
		                if (data == '1') {
		                    alert("Success!");
		                    $("#corporate_form")[0].reset();
		                } else {
		                    alert("Something Wrong!");
		                }

		            }
		        })

		    });


		    $("#porsonal_form").on("submit", function(event) {
		        event.preventDefault();

		        var porsonal_form = $("#porsonal_form").serialize();

		        $.ajax({
		            url: "../ajax/ajax_credit_corporte_voucher.php",
		            data: porsonal_form,
		            method: "POST",
		            success: function(data) {
		                if (data == '1') {
		                    alert("Success!");
		                    $("#porsonal_form")[0].reset();
		                } else {
		                    alert("Something Wrong!");
		                }
		            }
		        })

		    });

		</script>
		<?php
}

if($uri_parts[0] == '/designation_list.php'){
    
?>
		<script>
		    $(document).ready(function() {
		        $('#designationTable').DataTable();
		    });

		    $('.editBtn').click(function() {
		        var ruleId = $(this).attr("id");
		        /*$('#ptext').text(employee_id);*/
		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                ruleId: ruleId
		            },
		            dataType: "json",
		            success: function(data) {
		                /*$('#name').val(data.name);  
		                $('#address').val(data.address);  
		                $('#gender').val(data.gender);  
		                $('#designation').val(data.designation);  
		                $('#age').val(data.age);  
		                $('#employee_id').val(data.id);  
		                $('#insert').val("Update");  
		                $('#add_data_Modal').modal('show');*/
		                $("#ruleIdUp").val(ruleId);
		                $("#designationTitle").val(data.ruleName);
		                $("#designationStatus").val(data.status);

		            }
		        });
		    });

		    $("#updateDesignationForm").on("submit", function(event) {
		        event.preventDefault();

		        /*var designTitle = $("#designationTitle").val();*/

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#updateDesignationForm').serialize(),
		            success: function(data) {
		                $('#updateDesignationForm')[0].reset();
		                $('#myModal').modal('hide');
		                location.reload();
		            }
		        });


		    });

		</script>
		<?php
}


if($uri_parts[0] == '/create_principals.php'){
    
?>
		<script>
		    $('.editBtn').click(function() {
		        var principalId = $(this).attr("id");
		        /*$('#ptext').text(employee_id);*/
		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                getPrincipalId: principalId
		            },
		            dataType: "json",
		            success: function(data) {

		                $("#upPrincipalId").val(data.id);
		                $("#upPrincipalName").val(data.principal_name);
		                $("#upPrincipalBased").val(data.based);
		                $("#upCurrency").val(data.currency);
		                $("#upFuelCost").val(data.fuel_cost);
		                $("#upAirlinesCost").val(data.airlines_cost);

		                console.log(data);
		            }
		        });

		    });

		    $("#upPrincipal").on("submit", function(event) {
		        event.preventDefault();

		        /*var designTitle = $("#designationTitle").val();*/

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#upPrincipal').serialize(),
		            success: function(data) {
		                $('#myModal').modal('hide');
		                location.reload();
		            }
		        });


		    });

		</script>
		<?php
}



if($uri_parts[0] == '/principal_account.php'){
    
    ?>

		<script>
		    $(document).ready(function() {});

		    $(".nav_view").css("display", "none");

		    $("#cour_company").change(function() {
		        var cour_company = $("#cour_company").find(":selected").val();

		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#makepaymentbody").css("display", "none");

		        if (cour_company != 0) {
		            $(".nav_view").css("display", "block");
		        }

		        $(".nav_view li").removeClass('active');
		    })

		    $(function() {
		        $("#formdate").datepicker();
		        $("#todate").datepicker();
		    });

		    $(".nav_view li").click(function() {
		        $(".nav_view li").removeClass('active');
		        $(this).addClass('active');
		    });

		    $("#overview").click(function() {
		        $("#overviewbody").css("display", "block");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#makepaymentbody").css("display", "none");
		    });

		    $("#transection").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "block");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#makepaymentbody").css("display", "none");


		        var principal_id = $("#cour_company").find(":selected").val();
		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_principal_account_transection.php",
		            method: "POST",
		            data: {
		                principal_id: principal_id
		            },
		            success: function(data) {
		                $("#principal_transection_table").html(data);
		                $(".loading-img").css("display", "none");
		            }
		        });
		    });

		    $("#payment").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "block");
		        $("#balancebody").css("display", "none");
		        $("#makepaymentbody").css("display", "none");


		        var principal_id = $("#cour_company").find(":selected").val();
		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_principal_account_payment.php",
		            method: "POST",
		            data: {
		                principal_id: principal_id
		            },
		            success: function(data) {
		                $("#principal_payment_table").html(data);
		                $(".loading-img").css("display", "none");
		            }
		        });


		    });

		    $("#balance").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "block");
		        $("#makepaymentbody").css("display", "none");

		        var principal_id = $("#cour_company").find(":selected").val();
		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_principal_account_balance.php",
		            method: "POST",
		            data: {
		                principal_id: principal_id
		            },
		            success: function(data) {
		                $("#principal_balance_table").html(data);
		                $(".loading-img").css("display", "none");
		                /*console.log(data);*/
		            }
		        });
		    });

		    /*$("#makepayment").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#makepaymentbody").css("display", "block");
		    });*/

		</script>

		<?php
}



if($uri_parts[0] == '/accounts_corporate.php'){
    
    ?>

		<script>
		    $(document).ready(function() {});

		    $(".nav_view").css("display", "none");

		    $("#cour_company").change(function() {
		        var cour_company = $("#cour_company").find(":selected").val();

		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#limitbody").css("display", "none");

		        if (cour_company != 0) {
		            $(".nav_view").css("display", "block");
		        }

		        $(".nav_view li").removeClass('active');
		    })

		    $(function() {
		        $("#formdate").datepicker();
		        $("#todate").datepicker();
		    });

		    $(".nav_view li").click(function() {
		        $(".nav_view li").removeClass('active');
		        $(this).addClass('active');
		    });

		    $("#overview").click(function() {
		        $("#overviewbody").css("display", "block");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#limitbody").css("display", "none");
		    });

		    $("#transection").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "block");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#limitbody").css("display", "none");


		        var principal_id = $("#cour_company").find(":selected").val();
		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_corporate_account_transection.php",
		            method: "POST",
		            data: {
		                principal_id: principal_id
		            },
		            success: function(data) {
		                $("#principal_transection_table").html(data);
		                $(".loading-img").css("display", "none");
		            }
		        });
		    });

		    $("#payment").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "block");
		        $("#balancebody").css("display", "none");
		        $("#limitbody").css("display", "none");


		        var principal_id = $("#cour_company").find(":selected").val();
		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_corporate_account_payment.php",
		            method: "POST",
		            data: {
		                principal_id: principal_id
		            },
		            success: function(data) {
		                $("#principal_payment_table").html(data);
		                $(".loading-img").css("display", "none");
		            }
		        });


		    });

		    $("#balance").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "block");
		        $("#limitbody").css("display", "none");

		        var principal_id = $("#cour_company").find(":selected").val();
		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_corporate_account_balanace.php",
		            method: "POST",
		            data: {
		                principal_id: principal_id
		            },
		            success: function(data) {
		                $("#principal_balance_table").html(data);
		                $(".loading-img").css("display", "none");
		                /*console.log(data);*/
		            }
		        });
		    });

		    $("#limit").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#limitbody").css("display", "block");

		        var principal_id = $("#cour_company").find(":selected").val();
		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_corporate_account_limit.php",
		            method: "POST",
		            data: {
		                principal_id: principal_id
		            },
		            success: function(data) {
		                $("#principal_limit_table").html(data);
		                $(".loading-img").css("display", "none");
		                /*console.log(data);*/
		            }
		        });


		    });

		    /*$("#makepayment").click(function() {
		        $("#overviewbody").css("display", "none");
		        $("#transectionbody").css("display", "none");
		        $("#paymentbody").css("display", "none");
		        $("#balancebody").css("display", "none");
		        $("#makepaymentbody").css("display", "block");
		    });*/

		</script>

		<?php
}
    
if($uri_parts[0] == '/stuff_list.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#userTable').DataTable({
		            "order": [
		                [0, "desc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}


if($uri_parts[0] == '/accounts_summery.php'){
    ?>
		<script>
		    $("#accmindate").datepicker({
		        dateFormat: "yy-mm-dd"
		    });

		    $("#accmaxdate").datepicker({
		        dateFormat: "yy-mm-dd"
		    });

		    $("#accform").on("submit", function(event) {
		        event.preventDefault();

		        var accform = $("#accform").serialize();

		        $.ajax({
		            url: "../ajax/ajax_account_summery.php",
		            method: 'POST',
		            data: accform,
		            success: function(data) {
		                $("#content").find("*").remove();
		                $("#content").append(data);
		            }
		        })
		    })

		</script>
		<?php
}

if($uri_parts[0] == '/role_play.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#userTable').DataTable({
		            "order": [
		                [0, "desc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}



if($uri_parts[0] == '/role_play_user.php'){
    ?>

		<script>
		    $('#role-play').on('submit', function(event) {
		        event.preventDefault();

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#role-play').serialize(),
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    alert(data)
		                }

		            }
		        });
		    });

		</script>

		<?php
}



if($uri_parts[0] == '/set_principal_zone.php'){
    ?>

		<script>
		    $("#p_z_c_tag").change(function() {
		        var ct = $("#p_z_c_tag").val();
		        var ct_n = $("#p_z_c_tag option:selected").text();
		        //<input type="text" name="country[]"><a href="#">DELETE</a>
		        //var country = $("<input type=\"text\" class=\"fieldname\" />");
		        var country = $("<div class=\"country\"><input type=\"hidden\" name=\"country[]\" value=\"" + ct + "\"><input type=\"text\" value=\"" + ct_n + "\" disabled><a onClick=\"removeBtn(event);\" id=\"remove_btn\">REMOVE</a><br></div>");

		        $("#p_z_c_tag option[value=" + ct + "]").hide();

		        $("#selected_country").append(country);

		    });


		    $("#principal_zone").on("submit", function(event) {
		        event.preventDefault();
		        var principal_zone = $("#principal_zone").serialize();
		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: principal_zone,
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    console.log(data);
		                }

		            }
		        });

		    });

		    function removeBtn(event) {
		        $(event.target).closest("div").remove();
		    }

		</script>

		<?php
}





if($uri_parts[0] == '/set_zone.php'){
    ?>

		<script>
		    $("#dml_country_tag").change(function() {
		        var ct = $("#dml_country_tag").val();
		        var ct_n = $("#dml_country_tag option:selected").text();
		        //<input type="text" name="country[]"><a href="#">DELETE</a>
		        //var country = $("<input type=\"text\" class=\"fieldname\" />");
		        var country = $("<div class=\"country\"><input type=\"hidden\" name=\"dml_country[]\" value=\"" + ct + "\"><input type=\"text\" value=\"" + ct_n + "\" disabled><a onClick=\"removeBtn(event);\" id=\"remove_btn\">REMOVE</a><br></div>");

		        $("#dml_country_tag option[value=" + ct + "]").hide();

		        $("#selected_country").append(country);

		    });


		    $("#dml_zone").on("submit", function(event) {
		        event.preventDefault();
		        var dml_zone = $("#dml_zone").serialize();
		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: dml_zone,
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    console.log(data);
		                }

		            }
		        });

		    });

		    function removeBtn(event) {
		        $(event.target).closest("div").remove();
		    }

		</script>

		<?php
}



if($uri_parts[0] == '/view_principal_zone.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $("#principalName").text('Not Selected');
		        $("#zoneCode").text('Not Selected');
		    });

		    $("#viewZone").click(function() {

		        $("#zoneBody").html('');

		        var principal = $("#principal").val();
		        var principalName = $("#principal option:selected").text();
		        var zone_code = $("#zone_code").val();
		        if (principal == '' || zone_code == '') {

		        } else {

		            $("#principalName").text(principalName);
		            $("#zoneCode").text(zone_code);

		            $.ajax({
		                url: "/lib/ajax.php",
		                method: "POST",
		                data: {
		                    principalId: principal,
		                    zone_code: zone_code
		                },
		                success: function(data) {
		                    if (data == '0') {
		                        alert("Zone Not Found!");
		                    } else {
		                        $("#zoneBody").append(data);
		                    }
		                }
		            });
		        }
		    });

		    function removeCountry(event) {
		        /*$(this).closest('td').hide();*/

		        var id = $(event.target).attr("id");



		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                removeCountry: id
		            },
		            success: function(data) {
		                if (data == '1') {
		                    $(event.target).closest('tr').remove();
		                } else {
		                    alert('COUNTRY NOT REMOVED!');
		                }
		            }
		        });
		    }

		</script>

		<?php
}

if($uri_parts[0] == '/add_country.php'){
    ?>


		<script>
		    $('.editBtn').click(function() {
		        var country_id = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            dataType: 'json',
		            data: {
		                getCountryInfo: country_id
		            },
		            success: function(data) {
		                $("#upCountryId").val(data.country_id);
		                $("#upCountryName").val(data.country_name);
		                $("#upCountryTag").val(data.country_tag);
		            }
		        });
		    });


		    $("#upCountry").on('submit', function(event) {
		        event.preventDefault();

		        var countryId = $("#upCountryId").val();
		        var countryName = $("#upCountryName").val();
		        var countryTag = $("#upCountryTag").val();

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                countryId: countryId,
		                countryName: countryName,
		                countryTag: countryTag
		            },
		            success: function(data) {
		                if (data == '1') {
		                    location.reload();
		                } else {
		                    alert('Country Not Updated!!!');
		                }
		            }
		        })
		    });

		</script>



		<?php
}

if($uri_parts[0] == '/new_principal_settings.php'){
    ?>

		<script>
		    $(".nav_view").css("display", "none");

		    $("#setzoneview").css("display", "none");
		    $("#viewzoneview").css("display", "none");
		    $("#setpriceview").css("display", "none");
		    $("#viewpriceview").css("display", "none");
		    $("#editprincipalview").css("display", "none");
		    $("#updatepriceview").css("display", "none");

		    var ct_array = [];

		    $("#principalid").change(function() {

		        var principalid = $("#principalid").find(":selected").val();

		        if (principalid == 0) {
		            $(".nav_view").css("display", "none");
		        } else {
		            $(".nav_view").css("display", "block");
		        }

		        $("#setzoneview").css("display", "none");
		        $("#viewzoneview").css("display", "none");
		        $("#setpriceview").css("display", "none");
		        $("#viewpriceview").css("display", "none");
		        $("#editprincipalview").css("display", "none");
		        $("#updatepriceview").css("display", "none");




		        ct_array = [];

		        $("#selected_country").find("div").remove();

		        var principalid = $("#principalid").find(":selected").val();
		        $("#userId").val(principalid);

		        $(".nav_view").find('.active').removeClass('active');
		    });

		    $(".nav_view li").click(function() {
		        $(".nav_view").find('.active').removeClass('active');
		        $(this).addClass("active");
		    });

		    $("#setzone").click(function() {

		        $("#setzoneview").css("display", "block");
		        $("#viewzoneview").css("display", "none");
		        $("#setpriceview").css("display", "none");
		        $("#viewpriceview").css("display", "none");
		        $("#editprincipalview").css("display", "none");
		        $("#updatepriceview").css("display", "none");

		        var principal_name = $("#principalid option:selected").text();
		        $("#setzoneviewprincipal").html(principal_name);

		    });



		    $("#zoneaddbtn").click(function() {

		        var ct = $("#p_z_c_tag").val();
		        var ct_n = $("#p_z_c_tag option:selected").text();

		        var ch = 0;

		        var zone_id = $("#zone_id").find(":selected").val();

		        var principalid = $("#principalid").find(":selected").val();



		        $.each(ct_array, function(index, ct_sing) {
		            if (ct_sing == ct)
		                ch = 1;
		        });



		        if (ch != 1) {

		            $.ajax({
		                url: '../lib/ajax.php',
		                method: "POST",
		                data: {
		                    check_tag_in_zone: ct,
		                    tag_principalid_zone: principalid,
		                    tag_zone_id: zone_id
		                },
		                success: function(data) {
		                    if (data != 1) {
		                        var country = $("<div class=\"country\"><input class=\"rmb_country\" type=\"hidden\" name=\"country[]\" value=\"" + ct + "\"><input type=\"text\" value=\"" + ct_n + "\" disabled><a onClick=\"removeBtn(event);\" id=\"remove_btn\">REMOVE</a><br></div>");

		                        $("#p_z_c_tag option[value=" + ct + "]").hide();

		                        $("#selected_country").append(country);

		                        ct_array.push(ct);

		                    } else {
		                        alert("Contry Already Exist!!!", "Message");
		                    }


		                }
		            });

		            //<input type="text" name="country[]"><a href="#">DELETE</a>
		            //var country = $("<input type=\"text\" class=\"fieldname\" />");


		        }



		    });


		    $("#principal_zone").on("submit", function(event) {
		        event.preventDefault();
		        var principal_zone = $("#principal_zone").serialize();
		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: principal_zone,
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    console.log(data);
		                }

		            }
		        });

		    });

		    function removeBtn(event) {
		        var r = confirm("Do you want to remove?");

		        var ct_tag = $(event.target).closest("div").find(".rmb_country").val();

		        var newArray = [];

		        if (r == true) {


		            $.each(ct_array, function(index, ct_single) {
		                if (ct_single != ct_tag) {
		                    newArray.push(ct_single);
		                }
		            });

		            ct_array = newArray;

		            $(event.target).closest("div").remove();
		        }

		    }

		    $("#viewzone").click(function() {
		        $("#setzoneview").css("display", "none");
		        $("#viewzoneview").css("display", "block");
		        $("#setpriceview").css("display", "none");
		        $("#viewpriceview").css("display", "none");
		        $("#editprincipalview").css("display", "none");
		        $("#updatepriceview").css("display", "none");

		        $("#zoneBody").html('');

		        var principal_name = $("#principalid option:selected").text();
		        $(".setzoneviewprincipal").html(principal_name);
		    });


		    $("#principalName").text('Not Selected');
		    $("#zoneCode").text('Not Selected');


		    $("#viewZone").click(function() {

		        $("#zoneBody").html('');

		        var principal = $("#principalid").find(":selected").val();
		        var principalName = $("#principalid").find(":selected").text();
		        var zone_code = $("#zone_code").val();
		        if (principal == '' || zone_code == '') {

		        } else {

		            $("#principalName").text(principalName);
		            $("#zoneCode").text(zone_code);

		            $.ajax({
		                url: "/lib/ajax.php",
		                method: "POST",
		                data: {
		                    principalId: principal,
		                    zone_code: zone_code
		                },
		                success: function(data) {
		                    if (data == '0') {
		                        alert("Zone Not Found!");
		                    } else {
		                        $("#zoneBody").append(data);
		                    }
		                }
		            });
		        }
		    });

		    function removeCountry(event) {
		        /*$(this).closest('td').hide();*/

		        var id = $(event.target).attr("id");


		        var r = confirm("Do you want to remove?");

		        if (r == true) {
		            $.ajax({
		                url: "/lib/ajax.php",
		                method: "POST",
		                data: {
		                    removeCountry: id
		                },
		                success: function(data) {
		                    if (data == '1') {
		                        $(event.target).closest('tr').remove();
		                    } else {
		                        alert('COUNTRY NOT REMOVED!');
		                    }
		                }
		            });
		        }


		    }

		    $("#setprice").click(function() {
		        $("#setzoneview").css("display", "none");
		        $("#viewzoneview").css("display", "none");
		        $("#setpriceview").css("display", "block");
		        $("#viewpriceview").css("display", "none");
		        $("#editprincipalview").css("display", "none");
		        $("#updatepriceview").css("display", "none");

		        var principal_name = $("#principalid option:selected").text();
		        var principal_id = $("#principalid option:selected").val();
		        $(".setzoneviewprincipal").html(principal_name);
		        $("#setzoneprincipalid").val(principal_id);
		    });


		    $("#zone_code_price").change(function() {
		        var zone_code = $("#zone_code_price").find(":selected").val();
		        var principal = $("#principalid").find(":selected").val();
		        if (zone_code != 0) {
		            $.ajax({
		                url: "/lib/ajax.php",
		                method: "POST",
		                data: {
		                    check_zone_for_price: zone_code,
		                    tag_principalid_zone: principal
		                },
		                success: function(data) {
		                    if (data != 0) {
		                        alert(data);
		                        $("#submit_zone_price").attr("disabled", true);
		                    } else {
		                        $("#submit_zone_price").attr("disabled", false);
		                    }
		                }
		            });
		        }
		    });


		    $("#setpriceform").on("submit", function(event) {
		        event.preventDefault();

		        var setpriceform = $("#setpriceform").serialize();

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: setpriceform,
		            success: function(data) {
		                if (data == 2) {
		                    alert("Operation Successful!");
		                    location.reload();
		                } else {
		                    alert("Error!!!  Data Not Submited!");
		                }
		            }
		        })
		    });

		    $("#viewprice").click(function() {

		        $("#viewpriceview-loading").css("display", "block");


		        $("#setzoneview").css("display", "none");
		        $("#viewzoneview").css("display", "none");
		        $("#setpriceview").css("display", "none");
		        $("#viewpriceview").css("display", "block");
		        $("#editprincipalview").css("display", "none");
		        $("#updatepriceview").css("display", "none");

		        var principalid = $("#principalid").find(":selected").val();

		        $("#showpricetable").html('');

		        $.ajax({
		            url: "principal_price_table.php",
		            method: "POST",
		            data: {
		                principalid: principalid
		            },
		            success: function(data) {
		                $("#viewpriceview-loading").css("display", "none");
		                $("#showpricetable").append(data);
		            }
		        })


		    });

		    $("#editprincipal").click(function() {


		        $("#setzoneview").css("display", "none");
		        $("#viewzoneview").css("display", "none");
		        $("#setpriceview").css("display", "none");
		        $("#viewpriceview").css("display", "none");
		        $("#editprincipalview").css("display", "block");
		        $("#updatepriceview").css("display", "none");

		        var principal_name = $("#principalid").find(":selected").text();
		        var principalId = $("#principalid").find(":selected").val();

		        $(".setzoneviewprincipal").html(principal_name);

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                getPrincipalId: principalId
		            },
		            dataType: "json",
		            success: function(data) {

		                $("#upPrincipalId").val(data.id);
		                $("#upPrincipalName").val(data.principal_name);
		                $("#upPrincipalBased").val(data.based);
		                $("#upCurrency").val(data.currency);
		                $("#upFuelCost").val(data.fuel_cost);
		                $("#upAirlinesCost").val(data.airlines_cost);

		                console.log(data);
		            }
		        });

		    });

		    $("#upPrincipal").on("submit", function(event) {
		        event.preventDefault();

		        /*var designTitle = $("#designationTitle").val();*/

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#upPrincipal').serialize(),
		            success: function(data) {
		                if (data == 1) {
		                    alert("Operation Successfully!");
		                } else {
		                    alert("ERROR@@@!!!");
		                }
		            }
		        });


		    });

		    $("#updateprice").click(function() {

		        $("#setzoneview").css("display", "none");
		        $("#viewzoneview").css("display", "none");
		        $("#setpriceview").css("display", "none");
		        $("#viewpriceview").css("display", "none");
		        $("#editprincipalview").css("display", "none");
		        $("#updatepriceview").css("display", "block");

		        $("#updatepricesection").find("#updatetable").remove();

		        var principal_name = $("#principalid").find(":selected").text();
		        var principalId = $("#principalid").find(":selected").val();

		        $(".setzoneviewprincipal").html(principal_name);

		        $("#upzoneprincipalid").val(principalId);

		    });


		    $("#zone_code_update").change(function() {
		        var principalId = $("#principalid").find(":selected").val();
		        var zone_code = $("#zone_code_update").find(":selected").val();

		        $(".loading-img").css("display", "block");

		        $("#updatepricesection").find("#updatetable").remove();

		        $.ajax({
		            url: "principal_price_table.php",
		            method: "POST",
		            data: {
		                update_zone_price: zone_code,
		                prinicipal_Id: principalId
		            },
		            success: function(data) {
		                if (data == 'null') {
		                    alert("Please Insert Zone Price First!");
		                    $(".loading-img").css("display", "none");
		                } else {
		                    $(".loading-img").css("display", "none");
		                    $("#updatepricesection").append(data);
		                }
		            }
		        });
		    });


		    $("#updatepriceform").on("submit", function(event) {
		        event.preventDefault();
		        var updatepriceform = $("#updatepriceform").serialize();

		        var principalId = $("#principalid").find(":selected").val();
		        var zone_code = $("#zone_code_update").find(":selected").val();

		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "principal_price_table.php",
		            method: "POST",
		            data: updatepriceform,
		            success: function(data) {
		                if (data == 2) {
		                    $("#updatepricesection").find("#updatetable").remove();
		                    $.ajax({
		                        url: "principal_price_table.php",
		                        method: "POST",
		                        data: {
		                            update_zone_price: zone_code,
		                            prinicipal_Id: principalId
		                        },
		                        success: function(data) {
		                            if (data == 'null') {
		                                alert("Please Insert Zone Price First!");
		                                $(".loading-img").css("display", "none");
		                            } else {
		                                $(".loading-img").css("display", "none");
		                                $("#updatepricesection").append(data);
		                            }
		                        }
		                    });
		                } else {
		                    alert('ERRROR@@!! UPDATE NOT WORKING!!!');
		                }

		            }
		        });
		    });

		</script>

		<?php
}

if($uri_parts[0] == '/set_principal_price.php'){
    ?>

		<script>
		    $("#principal_price").on("submit", function(event) {
		        event.preventDefault();
		        var principal_price = $("#principal_price").serialize();

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: principal_price,
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    alert('Error: ' + data);
		                }
		            }
		        });

		    });

		    $('#zone_id').change(function() {
		        var zone_id = $('#zone_id').val();
		        var principal_price_id = $("#principal_price_id").val();
		        $("#type").children("option").remove();
		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                zone_id_check: zone_id,
		                principal_price_id_check: principal_price_id
		            },
		            success: function(data) {

		                /* <option value="P">Parcel</option>
		                 <option value="D">Documnet</option>*/
		                if (data == 1) {
		                    $("#type").append('<option value="P">Parcel</option>');
		                } else if (data == 2) {
		                    $("#type").append('<option value="D">Documnet</option>');
		                } else {
		                    $("#type").append('<option value="">--</option><option value="P">Parcel</option><option value="D">Documnet</option>');
		                }
		            }
		        });
		    });

		    $('#country').change(function() {
		        var country = $('#country').val();
		        var principal_price_id = $("#principal_price_id").val();
		        $("#type").children("option").remove();

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                country_check: country,
		                principal_price_id_check: principal_price_id
		            },
		            success: function(data) {


		                if (data == 1) {
		                    $("#type").append('<option value="P">Parcel</option>');
		                } else if (data == 2) {
		                    $("#type").append('<option value="D">Documnet</option>');
		                } else {
		                    $("#type").append('<option value="">--</option><option value="P">Parcel</option><option value="D">Documnet</option>');
		                }

		                console.log(data);
		            }
		        });

		    });

		</script>

		<?php
}



if($uri_parts[0] == '/set_corporate_client_price.php'){
    ?>

		<script>
		    $("#corporate_client_price").on("submit", function(event) {
		        event.preventDefault();
		        var corporate_client_price = $("#corporate_client_price").serialize();

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: corporate_client_price,
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    alert('Error: ' + data);
		                }
		            }
		        });

		    });

		    $('#client_zone_id').change(function() {
		        var client_zone_id = $('#client_zone_id').val();
		        var client_price_id = $("#client_price_id").val();
		        $("#client_good_type").children("option").remove();
		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                client_zone_id_check: client_zone_id,
		                client_price_id_check: client_price_id
		            },
		            success: function(data) {

		                /* <option value="P">Parcel</option>
		                 <option value="D">Documnet</option>*/

		                if (data == 1) {
		                    $("#client_good_type").append('<option value="P">Parcel</option>');
		                } else if (data == 2) {
		                    $("#client_good_type").append('<option value="D">Documnet</option>');
		                } else {
		                    $("#client_good_type").append('<option value="">--</option><option value="P">Parcel</option><option value="D">Documnet</option>');
		                }
		            }
		        });
		    });

		    $('#country').change(function() {
		        var country = $('#country').val();
		        var principal_price_id = $("#principal_price_id").val();
		        $("#type").children("option").remove();

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                country_check: country,
		                principal_price_id_check: principal_price_id
		            },
		            success: function(data) {


		                if (data == 1) {
		                    $("#type").append('<option value="P">Parcel</option>');
		                } else if (data == 2) {
		                    $("#type").append('<option value="D">Documnet</option>');
		                } else {
		                    $("#type").append('<option value="">--</option><option value="P">Parcel</option><option value="D">Documnet</option>');
		                }

		                console.log(data);
		            }
		        });

		    });

		</script>

		<?php
}


if($uri_parts[0] == '/set_corporate_client_special_price.php'){
    ?>


		<script>
		    $(document).ready(function() {
		        $("#startdatepicker").datepicker();
		        $("#enddatepicker").datepicker();
		    });

		    $("#corporate_client_price").on("submit", function(event) {
		        event.preventDefault();
		        var corporate_client_price = $("#corporate_client_price").serialize();

		        $.ajax({
		            url: "/lib/ajax_corporate_special.php",
		            method: "POST",
		            data: corporate_client_price,
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    alert('Error: ' + data);
		                }
		            }
		        });

		    });

		    $('#client_zone_id').change(function() {
		        var client_zone_id = $('#client_zone_id').val();
		        var client_price_id = $("#client_price_id").val();
		        $("#client_good_type").children("option").remove();
		        $.ajax({
		            url: "/lib/ajax_corporate_special.php",
		            method: "POST",
		            data: {
		                client_zone_id_check: client_zone_id,
		                client_price_id_check: client_price_id
		            },
		            success: function(data) {

		                /* <option value="P">Parcel</option>
		                 <option value="D">Documnet</option>*/

		                if (data == 1) {
		                    $("#client_good_type").append('<option value="P">Parcel</option>');
		                } else if (data == 2) {
		                    $("#client_good_type").append('<option value="D">Documnet</option>');
		                } else {
		                    $("#client_good_type").append('<option value="">--</option><option value="P">Parcel</option><option value="D">Documnet</option>');
		                }
		            }
		        });
		    });

		</script>

		<?php
}



if($uri_parts[0] == '/view_principal_price.php'){
    ?>

		<script>
		    $("#view_principal_price_id").change(function() {
		        var view_principal_price_id = $("#view_principal_price_id").find(":selected").val();


		        $("#zone_country").children("option").remove();
		        $("#zone_code").children("option").remove();
		        $("#good_type").children("option").remove();

		        $("#zone_country").append('<option value="">--</option>');
		        $("#zone_code").append('<option value="">--</option>');
		        $("#good_type").append('<option value="">--</option>');

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                view_principal_price_id: view_principal_price_id
		            },
		            success: function(data) {
		                $("#zone_country").children("option").remove();
		                $("#zone_country").append('<option value="">--</option>');
		                $("#zone_country").append(data);
		            }
		        });

		    });

		    $("#zone_country").change(function() {
		        var zone_principal_price_id = $("#view_principal_price_id").find(":selected").val();
		        var zone_country = $("#zone_country").find(":selected").val();
		        var good_type = $("#good_type").find(":selected").val();


		        $("#zoneBody").children().remove();
		        $("#zone_code").children("option").remove();
		        $("#good_type").children("option").remove();

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                zone_principal_price_id: zone_principal_price_id,
		                zone_country: zone_country
		            },
		            success: function(data) {
		                $("#zoneBody").append(data);
		            }
		        });

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                check_principal_price_id: zone_principal_price_id,
		                check_zone_country: zone_country
		            },
		            success: function(data) {
		                $("#zone_code").append('<option value="">--</option>');
		                $("#zone_code").append(data);
		            }
		        });

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                principal_price_id_type: zone_principal_price_id,
		                zone_country_type: zone_country,
		                check_good_type: good_type
		            },
		            success: function(data) {
		                $("#good_type").append('<option value="">--</option>');
		                $("#good_type").append(data);
		            }
		        });

		    });

		    $("#zone_code").change(function() {
		        getPrice();
		    });

		    $("#good_type").change(function() {
		        getPrice();
		    });


		    function getPrice() {
		        var zone_code = $("#zone_code").find(":selected").val();
		        var good_type = $("#good_type").find(":selected").val();
		        var filter_principal_id = $("#view_principal_price_id").find(":selected").val();
		        var filter_zone_country = $("#zone_country").find(":selected").val();

		        $("#zoneBody").children("tr").remove();


		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                filter_zone_code: zone_code,
		                filter_good_type: good_type,
		                filter_principal_id: filter_principal_id,
		                filter_zone_country: filter_zone_country
		            },
		            success: function(data) {
		                $("#zoneBody").append(data);
		                console.log(data);
		            }
		        });
		    }

		</script>

		<?php
}



if($uri_parts[0] == '/view_corporate_client_price.php'){
    ?>

		<script>
		    $("#client_zone").change(function() {

		        $("#client_price_table").children().remove();

		        var client_email = $("#client_email").val()
		        var client_zone = $("#client_zone").find(":selected").val();

		        $("#client_zone_weight").children("option").remove();
		        $("#client_good_type").children("option").remove();

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                client_email: client_email,
		                client_zone_view: client_zone
		            },
		            success: function(data) {
		                $("#view_client_price").append(data);
		            }
		        });

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                client_email_w: client_email,
		                client_zone_w: client_zone
		            },
		            success: function(data) {
		                $("#client_zone_weight").append('<option value="">--</option>');
		                $("#client_zone_weight").append(data);
		            }
		        });

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                client_email_t: client_email,
		                client_zone_t: client_zone
		            },
		            success: function(data) {
		                $("#client_good_type").append('<option value="">--</option>');
		                $("#client_good_type").append(data);
		            }
		        });

		    });


		    $("#client_zone_weight").change(function() {
		        getPrice();
		    });

		    $("#client_good_type").change(function() {
		        getPrice();
		    });

		    function getPrice() {

		        $("#client_price_table").children().remove();

		        var client_email = $("#client_email").val()
		        var client_zone = $("#client_zone").find(":selected").val();

		        var client_zone_weight = $("#client_zone_weight").find(":selected").val();
		        var client_good_type = $("#client_good_type").find(":selected").val();


		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                client_email_filter: client_email,
		                client_zone_filter: client_zone,
		                client_zone_weight: client_zone_weight,
		                client_good_type: client_good_type
		            },
		            success: function(data) {
		                $("#client_price_table").append(data);
		            }
		        });



		    }

		</script>

		<?php
}



if($uri_parts[0] == '/client_cash_deposit.php'){
    ?>

		<script>
		    $("#client_cash_deposit").on('submit', function(event) {
		        event.preventDefault();
		        var client_cash_deposit = $("#client_cash_deposit").serialize();
		        $("#alert").children().remove();
		        $(".loading").css("display", "block");
		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: client_cash_deposit,
		            success: function(data) {
		                $("#alert").append(data);
		                $(".loading").css("display", "none");
		            }
		        });
		    });

		</script>

		<?php
}



if($uri_parts[0] == '/client_limit_update.php'){
    ?>

		<script>
		    $("#client_limit_update_id").change(function() {
		        var client_id = $("#client_limit_update_id").find(":selected").val();
		        $("#alert").children().remove();
		        $(".loading").css("display", "block");
		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                client_limit_update_id_check: client_id
		            },
		            success: function(data) {

		                $(".loading").css("display", "none");

		                if (data == 'NOT') {
		                    $("#alert").append('<div class="alert alert-danger"><strong>Warning!</strong><br> Client Company Not Found!</div>');
		                } else {
		                    $("#currentcredit").val(data);
		                }
		            }
		        });
		    });

		    $("#client_limit_update").on('submit', function(event) {
		        event.preventDefault();
		        var client_limit_update = $("#client_limit_update").serialize();
		        $("#alert").children().remove();
		        $(".loading").css("display", "block");

		        $.ajax({
		            url: "/lib/ajax_principal_price.php",
		            method: "POST",
		            data: client_limit_update,
		            success: function(data) {
		                $(".loading").css("display", "none");

		                if (data == 1) {
		                    alert('Limit Update Successfully!');
		                    location.reload();
		                } else {

		                    $("#alert").append(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}

if($uri_parts[0] == '/agent_limit_update.php'){
    ?>

		<script>
		    $("#agent_limit_update_id").change(function() {
		        var agent_id = $("#agent_limit_update_id").find(":selected").val();
		        $("#alert").children().remove();
		        $(".loading").css("display", "block");
		        $.ajax({
		            url: "../ajax/ajax_agent_limit_update.php",
		            method: "POST",
		            data: {
		                agent_limit_update_id_check: agent_id
		            },
		            success: function(data) {

		                $(".loading").css("display", "none");

		                if (data == 'NOT') {
		                    $("#alert").append('<div class="alert alert-danger"><strong>Warning!</strong><br> Agent Not Found!</div>');
		                } else {
		                    $("#currentcredit").val(data);
		                }
		            }
		        });
		    });

		    $("#agent_limit_update").on('submit', function(event) {
		        event.preventDefault();
		        var agent_limit_update = $("#agent_limit_update").serialize();
		        $("#alert").children().remove();
		        $(".loading").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_agent_limit_update.php",
		            method: "POST",
		            data: agent_limit_update,
		            success: function(data) {
		                $(".loading").css("display", "none");

		                if (data == 1) {
		                    alert('Limit Update Successfully!');
		                    location.reload();
		                } else {

		                    $("#alert").append(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}



if($uri_parts[0] == '/set_general_price.php'){
    ?>
		<script>
		    $("#general_zone").change(function() {
		        var zone = $("#general_zone").find(":selected").val();

		        $.ajax({
		            url: "getCorpoClient.php",
		            method: "POST",
		            data: {
		                generalZoneCheck: zone
		            },
		            success: function(data) {
		                if (data == 1) {
		                    alert("ZONE ALREADY EXIST!!!");
		                    $("#submit_zone_price").attr("disabled", true);
		                } else {
		                    $("#submit_zone_price").attr("disabled", false);
		                }
		            }
		        });

		    });

		    $("#general_price").on("submit", function(e) {
		        e.preventDefault();
		        var general_price = $("#general_price").serialize();

		        $.ajax({
		            url: "getCorpoClient.php",
		            method: "POST",
		            data: general_price,
		            success: function(data) {
		                if (data == 2) {
		                    alert("Success!!!");
		                } else {
		                    alert(data);
		                }
		            }
		        });
		    });

		</script>
		<?php
}
if($uri_parts[0] == '/update_consignment.php'){
    ?>

		<script>
		    $("#dest_country").change(function() {
		        getPrice();
		    });

		    $("#goods_type").change(function() {
		        getPrice();
		    });

		    $("#goods_weight").change(function() {
		        getPrice();
		    });

		    function getPrice() {
		        var type = $("#s_type").val();

		        var goods_type = $("#goods_type").val();
		        var goods_weight = $("#goods_weight").val();
		        var countryTag = $("#dest_country").val();


		        if ((goods_type != "") && (goods_weight != "") && (countryTag != "")) {



		            if (type == 'corporate') {

		                var client_id = $("#client_Id").val();

		                $.ajax({
		                    url: "getCorpoClient.php",
		                    method: "POST",
		                    data: {
		                        ct: countryTag,
		                        client: client_id,
		                        goods_weight_c: goods_weight,
		                        goods_type_c: goods_type
		                    },
		                    success: function(data) {

		                        if (data == "PNF") {
		                            alert("Price Not Found!");
		                            $("#shipping_charge").val("");
		                        } else if (data == "CNF") {
		                            alert("Country Not Found!");
		                            $("#shipping_charge").val("");
		                        } else {
		                            $("#shipping_charge").val(data);
		                        }
		                    }
		                });

		            } else {

		                $.ajax({
		                    url: "getCorpoClient.php",
		                    method: "POST",
		                    data: {
		                        ct_p: countryTag,
		                        goods_weight_p: goods_weight,
		                        goods_type_p: goods_type
		                    },
		                    success: function(data) {

		                        if (data == "PNF") {
		                            alert("Price Not Found!");
		                            $("#shipping_charge").val("");
		                        } else if (data == "CNF") {
		                            alert("Country Not Found!");
		                            $("#shipping_charge").val("");
		                        } else {
		                            $("#shipping_charge").val(data);
		                        }

		                        /*if (data == 0) {
		                            alert("Result Not Found!");
		                        } else {
		                            $("#shipping_charge").val(data);
		                        }*/
		                    }
		                });


		            }

		        }
		    }

		    $("#update_cons_booking").on("submit", function(e) {



		        var dest_country = $("#dest_country").val();
		        var goods_weight = $("#goods_weight").val();
		        var shipping_charge = $("#shipping_charge").val();


		        if ((dest_country == "") || (goods_weight == "") || (shipping_charge == "")) {
		            e.preventDefault();
		            alert("Required Field Missing!!!");
		        }

		    });

		</script>

		<?php
}

if($uri_parts[0] == '/update_general_price.php'){
    ?>

		<script>
		    $("#general_zone").change(function() {

		        $("#updatePrice").html("");

		        var zone = $("#general_zone").find(":selected").val();



		        $.ajax({
		            url: "../ajax/ajax_principal_price.php",
		            method: "POST",
		            data: {
		                update_price: zone
		            },
		            success: function(data) {
		                $("#updatePrice").html(data);
		            }
		        })
		    })

		    function updatePrice(event) {
		        event.preventDefault();

		        var values = $(event.target).serialize();

		        $.ajax({
		            url: "../ajax/ajax_principal_price.php",
		            method: "POST",
		            data: values,
		            success: function(data) {
		                if (data == "3") {
		                    alert("Success!!");
		                } else {
		                    alert("Something is Wrong!!!");
		                }
		            }
		        })

		    }

		</script>

		<?php
}

if($uri_parts[0] == '/view_zone.php'){
    ?>
		<script>
		    $("#viewZone").click(function() {
		        var zone = $("#zone_code").find(":selected").val();
		        $("#zoneBody").find("tr").remove();
		        if (zone != "") {
		            $.ajax({
		                url: "../ajax/ajax_dml_zone.php",
		                method: "POST",
		                data: {
		                    dml_zone_view: zone
		                },
		                success: function(data) {
		                    if (data == "0") {
		                        alert("Zone Not Found!");
		                    } else {
		                        $("#zoneBody").append(data);
		                    }
		                }
		            });
		        }
		    });

		    function removeCountry(event) {
		        var id = $(event.target).attr("id");
		        $.ajax({
		            url: "../ajax/ajax_dml_zone.php",
		            method: "POST",
		            data: {
		                dml_zone_cn_remove: id
		            },
		            success: function(data) {
		                if (data == "1") {
		                    $(event.target).closest('tr').remove();
		                } else {
		                    alert("Something Wrong!");
		                }
		            }
		        });
		    }

		</script>
		<?php
}

if($uri_parts[0] == '/consignment_assign.php'){
    
    ?>

		<script>
		    $(".assign").click(function() {
		        var id = $(this).attr("id");

		        $("#remote_poss").html('');

		        $("#principal_list").find("tr").remove();

		        $.ajax({
		            url: "../ajax/ajax_consignment.php",
		            method: "POST",
		            data: {
		                get_con_details: id
		            },
		            dataType: "JSON",
		            success: function(data) {
		                /*console.log(data);*/
		                $("#trackid").text(data.tracking_id);
		                $("#city").text(data.r_city);
		                $("#zip").text(data.r_zip);
		                $("#country_tag").val(data.r_country);
		                if (data.g_type == 'P') {
		                    $("#type").text("PARCEL");
		                } else {
		                    $("#type").text("DOCUMENT");
		                }
		                $("#weight").text(data.g_weight + ' kg');
		                $("#shipcharge").text(data.g_shipment_charge + ' USD');

		                $.ajax({
		                    url: "../ajax/ajax_consignment.php",
		                    method: "POST",
		                    data: {
		                        get_country_name: data.r_country
		                    },
		                    success: function(countryname) {
		                        $("#destcountry").text(countryname);
		                    }
		                });
		            }
		        });

		        $.ajax({
		            url: "../ajax/ajax_consignment.php",
		            method: "POST",
		            data: {
		                get_principal_list: id

		            },
		            success: function(data) {
		                $("#principal_list").append(data);
		            }
		        });


		    });

		    function getRemotePoss(id, pid) {

		        $("#remote_poss").html('');

		        $(".loading-img").css("display", "block");

		        $.ajax({
		            url: "../ajax/ajax_remotearea.php",
		            method: "POST",
		            data: {
		                match_city_id: id,
		                pid: pid
		            },
		            success: function(data) {
		                $("#remote_poss").html(data);
		                $(".loading-img").css("display", "none");
		            }
		        });

		        var trackid = $("#trackid").text();

		        var tag = $("#country_tag").val();

		        $("#assing-btn").attr('onclick', 'assignFunction(' + trackid + ',' + pid + ',"' + tag + '")');

		    }


		    function assignFunction(trackid, pid, tag) {
		        $(".loading-img").css("display", "block");


		        $.ajax({
		            url: "../ajax/ajax_assign_consignment.php",
		            method: "POST",
		            data: {
		                trackid: trackid,
		                pid: pid,
		                tag: tag
		            },
		            success: function(data) {
		                $(".loading-img").css("display", "none");
		                if (data == '1') {
		                    alert("Operation Success!!!");
		                    $("#myModal").modal('toggle');
		                    location.reload();
		                } else {
		                    alert(data);
		                    $("#myModal").modal('toggle');
		                }

		            }
		        })
		    }

		</script>

		<?php
    
}
if($uri_parts[0] == '/create_csv.php'){
    ?>
		<script>
		    $(function() {
		        $("#minformdate").datepicker();
		        $("#mintodate").datepicker();
		    });

		    $(".nav_view").css("display", "none");

		    $("#principalid").change(function() {
		        $("#manlist").html('');
		        $(".nav_view").css("display", "block");
		        var pid = $("#principalid").find(":selected").val();
		        $("#principal_id").val(pid);
		    });


		    $("#csvdate").on("submit", function(event) {
		        event.preventDefault();
		        $("#manlist").html('');
		        $(".loading-img").css("display", "block");
		        var csvdate = $("#csvdate").serialize();
		        $.ajax({
		            url: "../ajax/ajax_csv.php",
		            method: "POST",
		            data: csvdate,
		            success: function(data) {
		                if (data != '0') {
		                    $("#manlist").html(data);
		                } else {
		                    alert("Data Not Found!");
		                }
		                $(".loading-img").css("display", "none");
		            }
		        })
		    })

		</script>
		<?php
}

if($uri_parts[0] == '/prinicpal_menifest.php'){
    ?>
		<script>
		    var array = [];

		    $(function() {
		        $("#minformdate").datepicker();
		        $("#mintodate").datepicker();
		    });


		    $("#add").click(function() {
		        var principalid = $("#principalid").find(":selected").val();
		        var principalName = $("#principalid").find(":selected").text();



		        var ch = 0;

		        $.each(array, function(key, val) {
		            if (val == principalid) {
		                ch = 1;
		            }
		        });

		        if (ch != 1) {
		            $("#principals").append('<div><input type="text" value="' + principalName + '" readonly><button class="btn-warning" onclick="remove(event)">X</button><input class="val" type="hidden" name="principals[]" value="' + principalid + '"></div>');
		            array.push(principalid);
		        }



		    });

		    function remove(event) {
		        var id = $(event.target).closest("div").find(".val").val();
		        $(event.target).closest("div").remove();

		        var tem = [];

		        $.each(array, function(key, val) {
		            if (val != id)
		                tem.push(val);
		        });

		        array = [];


		        $.each(tem, function(key, val) {
		            array.push(val);
		        });

		    }

		    $("#csvdate").on('submit', function(e) {
		        e.preventDefault();
		        var manifest_form = $("#csvdate").serialize();

		        var values = $("input[name='principals[]']").map(function() {
		            return $(this).val();
		        }).get();

		        var minformdate = $("#minformdate").val();
		        var mintodate = $("#mintodate").val();

		        $("#hid").find("*").remove();

		        $("#manlist table tbody").find('tr').remove();
		        $(".loading-img").css('display', 'block');
		        $.ajax({
		            url: "../ajax/ajax_manifest.php",
		            method: 'POST',
		            data: manifest_form,
		            success: function(data) {

		                $(".loading-img").css('display', 'none');
		                if (data != '') {
		                    $("#manlist table tbody").append(data);

		                    $.each(values, function(key, val) {
		                        $("#hid").append('<input id="principals_prn" name="principals_prn[]" value="' + val + '" type="hidden">');
		                    });


		                    $("#hid").append('<input id="minformdate_prn" name="minformdate_prn" value="' + minformdate + '" type="hidden">');
		                    $("#hid").append('<input id="mintodate_prn" name="mintodate_prn" value="' + mintodate + '" type="hidden">');

		                    $("#hid").append('<button type="submit" class="btn btn-warning pull-right">Create Manifest</button>');
		                }
		            }
		        });

		    });

		</script>
		<?php
}

if($uri_parts[0] == '/prinicpal_menifest.php'){
    ?>
		<script>
		    var array = [];

		    $(function() {
		        $("#minformdate").datepicker();
		        $("#mintodate").datepicker();
		    });


		    $("#add").click(function() {
		        var principalid = $("#principalid").find(":selected").val();
		        var principalName = $("#principalid").find(":selected").text();



		        var ch = 0;

		        $.each(array, function(key, val) {
		            if (val == principalid) {
		                ch = 1;
		            }
		        });

		        if (ch != 1) {
		            $("#principals").append('<div><input type="text" value="' + principalName + '" readonly><button class="btn-warning" onclick="remove(event)">X</button><input class="val" type="hidden" name="principals[]" value="' + principalid + '"></div>');
		            array.push(principalid);
		        }



		    });

		    function remove(event) {
		        var id = $(event.target).closest("div").find(".val").val();
		        $(event.target).closest("div").remove();

		        var tem = [];

		        $.each(array, function(key, val) {
		            if (val != id)
		                tem.push(val);
		        });

		        array = [];


		        $.each(tem, function(key, val) {
		            array.push(val);
		        });

		        console.log(array);
		    }

		</script>
		<?php
}


if($uri_parts[0] == '/remote_area.php'){
    ?>

		<script>
		    $("#cour_company").change(function() {
		        $(".nav_view").css("display", "block");
		        $(".nav_view").find("li").removeClass("active");
		        $("#remote_body").find(".remote_view").css("display", "none");

		    });

		    $(".nav_view li").click(function() {
		        $(".nav_view").find("li").removeClass("active");
		        $(this).addClass("active");
		    });

		    $("#setremotearea").click(function() {
		        $("#remote_body").find(".remote_view").css("display", "none");
		        $("#set_remote_body").css("display", "block");
		        $("#remote-list").find('tr').remove();
		    });

		    $("#viewremotearea").click(function() {
		        $("#remote_body").find(".remote_view").css("display", "none");
		        $("#view_remote_body").css("display", "block");

		        $("#remote_price_list").find('tr').remove();

		        var cour_company = $("#cour_company").find(":selected").val();

		        $.ajax({
		            url: "../ajax/ajax_remotearea.php",
		            method: "POST",
		            data: {
		                get_remote_price: cour_company
		            },
		            success: function(data) {
		                $("#remote_price_list").append(data);
		            }
		        })
		    });

		    $("#editremotearea").click(function() {
		        $("#remote_body").find(".remote_view").css("display", "none");
		        $("#edit_remote_body").css("display", "block");

		        var cour_company = $("#cour_company").find(":selected").val();

		        $.ajax({
		            url: "../ajax/ajax_remotearea.php",
		            method: "POST",
		            data: {
		                getextracost: cour_company
		            },
		            success: function(data) {
		                $("#extracost").val(data);
		            }
		        })

		    });


		    $("#add_remote_area").click(function() {

		        var remote_country = $("#remote_country").find(":selected").val();
		        var remote_zip_code = $("#remote_zip_code").val();
		        var remote_city = $("#remote_city").val();

		        var cour_company = $("#cour_company").find(":selected").val();



		        if ((remote_country != "") && (remote_zip_code != "") && (remote_city != "")) {

		            $.ajax({
		                url: "../ajax/ajax_remotearea.php",
		                method: "POST",
		                data: {
		                    add_remote_country: remote_country,
		                    add_remote_zip_code: remote_zip_code,
		                    add_remote_city: remote_city,
		                    add_cour_company: cour_company
		                },
		                success: function(data) {
		                    if (data == 0) {
		                        alert("Remote Area Already Exist!");
		                    } else if (data == 1) {
		                        alert("Something is Wrong!!!");
		                    } else {
		                        $("#remote-list").append(data);
		                        $("#remote_submit").prop("disabled", false);
		                    }
		                }
		            })

		        }


		    });


		    $("#remote_submit").click(function() {
		        alert("Submited!!!");
		        location.reload();
		    });


		    function removeBtn(event) {

		        var id = $(event.target).attr("id");

		        $.ajax({
		            url: "../ajax/ajax_remotearea.php",
		            method: "POST",
		            data: {
		                delete: id
		            },
		            success: function(data) {
		                if (data == "1") {
		                    $(event.target).closest(".remote_add").remove();
		                } else {
		                    alert("Somthing Is Wrong!!!");
		                }
		            }
		        });
		    }

		    $("#extracostbtn").click(function() {

		        var cour_company = $("#cour_company").find(":selected").val();

		        var extracost = $("#extracost").val();

		        if ((extracost != "") && (extracost != 0)) {

		            $.ajax({
		                url: "../ajax/ajax_remotearea.php",
		                method: "POST",
		                data: {
		                    extracost: extracost,
		                    principal: cour_company
		                },
		                success: function(data) {
		                    if (data == "1") {
		                        alert("Success!!!");
		                    } else {
		                        alert("Something Wrong!");
		                    }
		                }
		            });
		        }

		    })

		</script>

		<?php
}

if($uri_parts[0] == '/consignment_list.php'){
    ?>

		<script>
		    $(".rts").click(function() {
		        var id = $(this).attr("id");

		        var r = confirm("Are You Sure?")

		        if (r == true) {
		            $.ajax({
		                url: "ajax/ajax_consignment.php",
		                method: "POST",
		                data: {
		                    returnToShiper: id
		                },
		                success: function(data) {
		                    if (data == 1) {
		                        $("#" + id).closest("tr").find(".rclrm").css("background-color", "#636e72");
		                        $("#" + id).closest("tr").find(".rclr").css("background-color", "#dfe6e9");
		                        $("#" + id).closest("tr").find(".rbtn div").remove();
		                        $("#" + id).closest("tr").find(".rbtn").append("<p>Return To Shipper</p>");
		                    } else {
		                        alert(data);
		                    }
		                }
		            });
		        }


		    })

		</script>

		<?php
}


if($uri_parts[0] == '/agent_list.php'){
    ?>

		<script>
		    $(".agent_edit_btn").click(function() {
		        var id = $(this).attr('id');
		        id = id.replace('assign-', '');

		        $.ajax({
		            url: "../ajax/ajax_agent_list.php",
		            method: "POST",
		            data: {
		                agent_id: id
		            },
		            success: function(data) {
		                $("#principal_list").find("*").remove();
		                $("#principal_list").append(data);
		                $("#agent_id").val(id);
		                $("#myModal").show();
		            }
		        });


		    });

		    function update_status(event) {
		        var status = $(event.target).prop('checked');
		        var principal = $(event.target).attr("id");
		        var agent_id = $("#agent_id").val();
		        principal = principal.replace('pid_', '');

		        $.ajax({
		            url: "../ajax/ajax_agent_list.php",
		            method: "POST",
		            data: {
		                agent_up: agent_id,
		                principal_id: principal,
		                status: status
		            },
		            success: function(data) {
		                console.log(data);
		            }
		        })
		    }


		    $(".status_btn").click(function() {
		        var status_id = $(this).attr("id");
		        status_id = status_id.replace('status_', '');


		        var status_id_s = $(this).attr("id");



		        $.ajax({
		            url: '../ajax/ajax_agent_list.php',
		            method: 'POST',
		            data: {
		                agent_status_id: status_id
		            },
		            success: function(data) {
		                var hasClass = $("#" + status_id_s).hasClass('btn-green');
		                console.log(hasClass);

		                if (data == 1) {
		                    if (hasClass == true) {
		                        $("#" + status_id_s).removeClass('btn-green');
		                        $("#" + status_id_s).addClass('btn-red');
		                    } else {
		                        $("#" + status_id_s).removeClass('btn-red');
		                        $("#" + status_id_s).addClass('btn-green');
		                    }
		                } else {
		                    if (hasClass == true) {
		                        $("#" + status_id_s).removeClass('btn-green');
		                        $("#" + status_id_s).addClass('btn-red');
		                    } else {
		                        $("#" + status_id_s).removeClass('btn-red');
		                        $("#" + status_id_s).addClass('btn-green');
		                    }
		                }
		            }
		        })
		    })

		</script>
		<?php
}


if($uri_parts[0] == '/agent_prices.php'){
    ?>
		<script>
		    $('#agent_zone_price').DataTable()

		    $("#agent_select").change(function() {
		        var agent_id = $(this).find(":selected").val();
		        if (agent_id != "") {
		            $(".nav_view").css("display", "block");

		            $.ajax({
		                url: "../ajax/ajax_agent_prices.php",
		                method: "POST",
		                data: {
		                    get_agent_mail: agent_id
		                },
		                success: function(data) {
		                    $("#agent_email").val(data);
		                }
		            })

		        } else {
		            $(".nav_view").css("display", "none");
		            $("#agent_email").val("");
		        }

		        $(".viewpanel").css("display", "none");
		        $(".nav_view li").removeClass("active");
		    });

		    $(".nav_view li").click(function() {
		        $(".nav_view li").removeClass("active");
		        $(this).addClass("active");
		    });


		    $("#setprice").click(function() {
		        $(".viewpanel").css("display", "none");
		        $("#view_setprice").css("display", "block");

		        var agent_mail = $("#agent_email").val();
		        $("#zone").find('*').remove();
		        $("#zone").append('<option value="">--</option>');
		        $("#zone").selectpicker('refresh');

		        $.ajax({
		            url: "../ajax/ajax_agent_prices.php",
		            method: "POST",
		            data: {
		                agent_setprice_mail: agent_mail
		            },
		            success: function(data) {
		                $("#principal").find("*").remove();
		                $("#principal").append(data);
		                $("#principal").selectpicker('refresh');
		                $("#submit_zone_price").prop("disabled", true);
		            }
		        })

		    });


		    $("#viewprice").click(function() {
		        $(".viewpanel").css("display", "none");
		        $("#view_viewprice").css("display", "block");



		        var agent_mail = $("#agent_email").val();

		        $.ajax({
		            url: "../ajax/ajax_agent_prices.php",
		            method: "POST",
		            data: {
		                get_view_price_principal: agent_mail
		            },
		            success: function(data) {
		                $("#view_principal").find("*").remove();
		                $("#view_principal").append(data);
		                $("#view_principal").selectpicker('refresh');
		                //		                console.log(data);
		            }
		        })

		    });


		    $("#updateprice").click(function() {
		        $(".viewpanel").css("display", "none");
		        $("#view_updateprice").css("display", "block");

		        var agent_mail = $("#agent_email").val();

		        $("#load_update_price").find("*").remove();

		        $.ajax({
		            url: "../ajax/ajax_agent_prices.php",
		            method: "POST",
		            data: {
		                get_view_price_principal: agent_mail
		            },
		            success: function(data) {
		                $("#upzoneprincipal").find("*").remove();
		                $("#upzoneprincipal").append(data);
		                $("#upzoneprincipal").selectpicker('refresh');
		                //		                console.log(data);
		            }
		        })
		    });


		    $("#upzoneprincipal").change(function() {

		        var agent_mail = $("#agent_email").val();
		        var principal_id = $("#upzoneprincipal").find(":selected").val();

		        //                console.log(agent_mail+' '+principal_id);

		        if (principal_id != "") {
		            $.ajax({
		                url: "../ajax/ajax_agent_prices.php",
		                method: "POST",
		                data: {
		                    up_agent_mail: agent_mail,
		                    up_agent_principal: principal_id
		                },
		                success: function(data) {
		                    $("#upzone").find("*").remove();
		                    $("#upzone").append(data);
		                    $("#upzone").selectpicker('refresh');
		                }
		            })
		        }

		    });



		    $("#upzone").change(function() {
		        var zone_id = $(this).find(":selected").val();
		        var agent_mail = $("#agent_email").val();
		        var principal_id = $("#upzoneprincipal").find(":selected").val();

		        if (zone_id != '') {
		            $.ajax({
		                url: '../ajax/ajax_agent_prices.php',
		                method: 'POST',
		                data: {
		                    update_zone: zone_id,
		                    up_zone_mail: agent_mail,
		                    up_zone_principal_id: principal_id
		                },
		                success: function(result) {
		                    $("#load_update_price").find("*").remove();
		                    $("#load_update_price").append(result);
		                }
		            })
		        }
		    });


		    $("#updateagent").click(function() {
		        $(".viewpanel").css("display", "none");
		        $("#view_updateagent").css("display", "block");
		    });

		    $("#principal").change(function() {
		        var principal = $(this).find(":selected").val();
		        var agent_email = $("#agent_email").val();


		        if (principal != '') {
		            $.ajax({
		                url: "../ajax/ajax_agent_prices.php",
		                method: "POST",
		                data: {
		                    get_zone_principal: principal,
		                    get_zone_agent_mail: agent_email
		                },
		                success: function(result) {
		                    $("#zone").find('*').remove();
		                    $("#zone").append('<option value="">--</option>');
		                    $("#zone").append(result);
		                    $("#zone").selectpicker('refresh');
		                }
		            })
		        } else {
		            $("#zone").find('*').remove();
		            $("#zone").append('<option value="">--</option>');
		            $("#zone").selectpicker('refresh');
		        }
		    });

		    $("#zone").change(function() {
		        var zone = $("#zone").find(":selected").val();



		        var agent_id = $("#agent_select").find(":selected").val();
		        var principal_id = $("#principal").find(":selected").val();


		        if (zone != '') {
		            $.ajax({
		                url: "../ajax/ajax_agent_prices.php",
		                method: "POST",
		                data: {
		                    zone_no: zone,
		                    agent_id: agent_id,
		                    principal_id: principal_id
		                },
		                success: function(data) {
		                    if (data == 0) {
		                        $("#submit_zone_price").prop("disabled", false);
		                    } else {
		                        alert("Zone Price Already Submitted!");
		                        $("#submit_zone_price").prop("disabled", true);
		                    }
		                }
		            })
		        } else {
		            $("#submit_zone_price").prop("disabled", true);
		        }



		    });

		    $("#agent_zone_set_form").on("submit", function(event) {
		        event.preventDefault();

		        var agent_price = $(this).serialize();

		        $.ajax({
		            url: "../ajax/ajax_agent_prices.php",
		            method: "POST",
		            data: agent_price,
		            success: function(data) {
		                if (data == "DP PP") {
		                    location.reload();
		                } else {
		                    alert("DATA NOT SUBMITED!");
		                }
		            }
		        })

		    })

		    $("#viewprice").click(function() {
		        $("#load_price").find("*").remove();
		    });

		    $("#view_principal").change(function() {
		        var agent_id = $("#agent_select").find(":selected").val();
		        var principal_id = $(this).find(":selected").val();
		        $.ajax({
		            url: "../ajax/ajax_agent_prices.php",
		            method: "POST",
		            data: {
		                agent_zone_price: agent_id,
		                view_price_principal: principal_id
		            },
		            success: function(data) {
		                $("#load_price").find("*").remove();
		                $("#load_price").append(data);
		            }
		        })
		    })

		    $(".view_btn").click(function() {
		        $(".view_btn").removeClass('active');
		        $(this).addClass('active');
		    });

		    /*$("#updateprice").click(function() {
		        var agent_mail = $("#agent_email").val();
		        $.ajax({
		            url: "../ajax/ajax_agent_prices.php",
		            method: "POST",
		            data: {
		                up_agent_principal_list: agent_mail
		            },
		            success: function(data) {

		            }
		        })
		    });*/

		    function update_agent_submit(event) {
		        event.preventDefault();
		        var agent_mail = $("#agent_email").val();

		        var form_data = $(event.target).serialize() + "&update_agent_mail=" + agent_mail;

		        $.ajax({
		            url: "../ajax/ajax_agent_prices.php",
		            method: "POST",
		            data: form_data,
		            success: function(data) {
		                if (data == "OK") {
		                    alert("PRICE UPDATED!");
		                    location.reload();
		                } else if (data == "ERROR") {
		                    alert("PROBLEM IN UPDATE");
		                } else {
		                    alert("PROBLEM IN DATABASE");
		                }
		            }
		        })
		    }

		</script>

		<?php
}


if($uri_parts[0] == '/view_zone_by_country.php'){
    ?>
		<script>
		    $("#viewZone").click(function() {
		        var country_tag = $("#country").find(":selected").val();
		        $("#zoneBody").find('tr').remove();
		        if (country_tag != "") {
		            $.ajax({
		                url: "../ajax/ajax_find_zone.php",
		                method: "POST",
		                data: {
		                    country_tag: country_tag
		                },
		                success: function(data) {
		                    $("#zoneBody").append(data);
		                }
		            })
		        }
		    });

		</script>
		<?php
}
if($uri_parts[0] == '/create_currency.php'){
    ?>

		<script>
		    $("#currencyForm").on('submit', function(event) {
		        event.preventDefault();
		        var currency = $("#currencyForm").serialize();

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: currency,
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    alert('Data not inserted!');
		                }
		            }
		        });
		    });

		    $(".editBtn").click(function() {
		        var currencyId = $(this).attr("id");
		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            dataType: 'json',
		            data: {
		                currencyId: currencyId
		            },
		            success: function(data) {
		                $("#upCurrencyId").val(data.id);
		                $("#upCurrencyName").val(data.currency_name);
		                $("#upCurrencyRate").val(data.currency_rate);
		            }
		        });
		    });

		    $("#updateCurrencyRate").on('submit', function(event) {
		        event.preventDefault();

		        var updateCurrencyRate = $("#updateCurrencyRate").serialize();



		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: updateCurrencyRate,
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    alert('Data Not Updated!');
		                }
		            }
		        });
		    });

		</script>

		<?php
}


if($_SERVER['REQUEST_URI']== '/create_stuff.php'){
    ?>

		<script>
		    $("#staff_form").on("submit", function(event) {
		        event.preventDefault();

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#staff_form').serialize(),
		            success: function(data) {
		                if (data == 'donedone') {
		                    /*location.reload();*/
		                    console.log('Inserted');
		                } else {
		                    /*location.reload();*/
		                    console.log('Error: ' + data);
		                }
		            }
		        });

		    });

		</script>

		<?php
}

if($_SERVER['REQUEST_URI']== '/create_weight.php'){
    ?>

		<script>
		    $("#staff_form").on("submit", function(event) {
		        event.preventDefault();

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#staff_form').serialize(),
		            success: function(data) {
		                if (data == 'donedone') {
		                    /*location.reload();*/
		                    console.log('Inserted');
		                } else {
		                    /*location.reload();*/
		                    console.log('Error: ' + data);
		                }
		            }
		        });

		    });

		</script>

		<?php
}


if($_SERVER['REQUEST_URI']== '/consignment_booking.php'){
    ?>

		<script>
		    $("#sender_personal").click(function() {
		        $("#corporate").css("display", "none");
		        $("#personal").css("display", "block");
		    });

		    $("#sender_corporate").click(function() {
		        $("#corporate").css("display", "block");
		        $("#personal").css("display", "none");
		    });


		    $("#corpo_clients").change(function() {
		        event.preventDefault();

		        var clients = $("#corpo_clients").find(":selected").val();
		        //		$("#loader2").show();
		        //getCorpClientPrice(clients,income_or_outgo,sender_name,dest_country,goods_type,goods_weight);

		        $("#shipping_charge").val('');

		        $.ajax({
		            url: "getCorpoClient.php",
		            method: "POST",
		            data: {
		                clientId: clients
		            },
		            success: function(data) {
		                $("#loader2").hide();

		                var obj_data = JSON.parse(data);

		                $("#sender_name").val(obj_data['client'].name);
		                $("#sender_id").val(obj_data['client'].id);
		                $("#sender_company").val(obj_data['client'].company_name);
		                $("#client_mail").val(obj_data['client'].email);
		                $("#sender_contact").val(obj_data['client'].contact);
		                $("#sender_addr").val(obj_data['client'].address);
		                $("#assign_to_stuff").val(obj_data['client'].client_address);


		                $("#shipping_charge").val('');

		            }
		        });

		    });

		    $('#dest_country').change(function() {
		        getPrice();
		    });

		    $('#goods_weight').change(function() {
		        getPrice();
		    });

		    $('#goods_type').change(function() {
		        getPrice();
		    });

		    $('#goods_weight_p').change(function() {
		        getPrice_p();
		    });

		    $('#goods_type_p').change(function() {
		        getPrice_p();
		    });

		    $('#dest_country_p').change(function() {
		        getPrice_p();
		    });

		    var getPrice_p = function() {
		        var goods_weight_p = $('#goods_weight_p').find(":selected").val();
		        var goods_type_p = $('#goods_type_p').find(":selected").val();
		        var countryTag_p = $('#dest_country_p').find(":selected").val();

		        if ((goods_type_p != "") && (goods_weight_p != "") && (countryTag_p != "")) {
		            $.ajax({
		                url: "getCorpoClient.php",
		                method: "POST",
		                data: {
		                    ct_p: countryTag_p,
		                    goods_weight_p: goods_weight_p,
		                    goods_type_p: goods_type_p
		                },
		                success: function(data) {

		                    if (data == "PNF") {
		                        alert("Price Not Found!");
		                    } else if (data == "CNF") {
		                        alert("Country Not Found!");
		                    } else {
		                        $("#shipping_charge_p").val(data);
		                    }

		                    /*if (data == 0) {
		                        alert("Result Not Found!");
		                    } else {
		                        $("#shipping_charge").val(data);
		                    }*/
		                }
		            });
		        }
		    }

		    var getPrice = function() {
		        var goods_weight_c = $('#goods_weight').find(":selected").val();
		        var goods_type_c = $('#goods_type').find(":selected").val();
		        var countryTag_c = $('#dest_country').find(":selected").val();
		        var client_id_c = $("#corpo_clients").find(":selected").val();

		        if ((goods_type_c != "") && (goods_weight_c != "") && (countryTag_c != "") && (client_id_c != null)) {
		            $.ajax({
		                url: "getCorpoClient.php",
		                method: "POST",
		                data: {
		                    ct: countryTag_c,
		                    client: client_id_c,
		                    goods_weight_c: goods_weight_c,
		                    goods_type_c: goods_type_c
		                },
		                success: function(data) {

		                    if (data == "PNF") {
		                        alert("Price Not Found!");
		                    } else if (data == "CNF") {
		                        alert("Country Not Found!");
		                    } else {
		                        $("#shipping_charge").val(data);
		                    }
		                }
		            });
		        }
		    }

		    $('#trackID').click(function() {
		        var trackId_c = $('#trackID').val();
		        if (trackId_c == "") {
		            $.ajax({
		                url: "getCorpoClient.php",
		                method: "POST",
		                data: {
		                    trackId_c
		                },
		                success: function(data) {

		                    $('#trackID').val(data);
		                }
		            });
		        }
		    });

		    $('#trackID_p').click(function() {
		        var trackId_c = $('#trackID_p').val();
		        if (trackId_c == "") {
		            $.ajax({
		                url: "getCorpoClient.php",
		                method: "POST",
		                data: {
		                    trackId_c
		                },
		                success: function(data) {

		                    $('#trackID_p').val(data);
		                }
		            });
		        }
		    });

		    $('#form_cons_booking').on('submit', function(event) {
		        event.preventDefault();


		        var personal_con = $("#sender_personal").prop("checked");
		        var corporate_con = $("#sender_corporate").prop("checked");

		        var condition = 0;


		        var goods_title_p = $("#goods_title_p").val();
		        var recipient_city_p = $("#recipient_city_p").val();

		        var dest_country_p = $("#dest_country_p").find(":selected").val();
		        var goods_type_p = $("#goods_type_p").find(":selected").val();
		        var goods_weight_p = $("#goods_weight_p").find(":selected").val();

		        var shipping_charge_p = $("#shipping_charge_p").val();
		        var shimpent_pieces_p = $("#shimpent_pieces_p").val();
		        var shimpent_declared_value_p = $("#shimpent_declared_value_p").val();
		        var trackID_p = $("#trackID_p").val();
		        var custom_trackId_p = $("#custom_trackId_p").val();




		        var goods_title_c = $("#goods_title").val();
		        var recipient_city_c = $("#recipient_city").val();

		        var dest_country_c = $("#dest_country").find(":selected").val();
		        var goods_type_c = $("#goods_type").find(":selected").val();
		        var goods_weight_c = $("#goods_weight").find(":selected").val();

		        var shipping_charge_c = $("#shipping_charge").val();
		        var shimpent_pieces_c = $("#shimpent_pieces").val();
		        var shimpent_declared_value_c = $("#shimpent_declared_value").val();
		        var trackID_c = $("#trackID").val();
		        var custom_trackId_c = $("#custom_trackId").val();



		        if (personal_con == true) {



		            if (goods_title_p == '') {
		                alert("Goods Title Required!");
		                condition = 0;
		            } else if (recipient_city_p == '') {
		                alert("Recipient City Required!");
		                condition = 0;
		            } else if (dest_country_p == '') {
		                alert("Destination Country Required!");
		                condition = 0;
		            } else if (goods_type_p == '') {
		                alert("Goods Type Required!");
		                condition = 0;
		            } else if (goods_weight_p == '') {
		                alert("Goods Weight Required!");
		                condition = 0;
		            } else if (shipping_charge_p == '') {
		                alert("Shipping Charge Not Found!");
		                condition = 0;
		            } else if (shimpent_pieces_p == '') {
		                alert("Shipment Pieces Required!");
		                condition = 0;
		            } else if (shimpent_declared_value_p == '') {
		                alert("Shipment Declared Value Required!");
		                condition = 0;
		            } else if (trackID_p == '') {
		                alert("Tracking ID Required!");
		                condition = 0;
		            } else if (custom_trackId_p == '') {
		                alert("AWB No. Required!");
		                condition = 0;
		            } else {
		                condition = 1;
		            }


		        } else if (corporate_con == true) {


		            if (goods_title_c == '') {
		                alert("Goods Title Required!");
		                condition = 0;
		            } else if (recipient_city_c == '') {
		                alert("Recipient City Required!");
		                condition = 0;
		            } else if (dest_country_c == '') {
		                alert("Destination Country Required!");
		                condition = 0;
		            } else if (goods_type_c == '') {
		                alert("Goods Type Required!");
		                condition = 0;
		            } else if (goods_weight_c == '') {
		                alert("Goods Weight Required!");
		                condition = 0;
		            } else if (shipping_charge_c == '') {
		                alert("Shipping Charge Not Found!");
		                condition = 0;
		            } else if (shimpent_pieces_c == '') {
		                alert("Shipment Pieces Required!");
		                condition = 0;
		            } else if (shimpent_declared_value_c == '') {
		                alert("Shipment Declared Value Required!");
		                condition = 0;
		            } else if (trackID_c == '') {
		                alert("Tracking ID Required!");
		                condition = 0;
		            } else if (custom_trackId_c == '') {
		                alert("AWB No. Required!");
		                condition = 0;
		            } else {
		                condition = 1;
		            }

		        }



		        if (condition != 0) {

		            var formValue = $('#form_cons_booking').serialize();

		            //                    var trak = $("#trackID").val();
		            //                    var ctrak = $("#custom_trackId").val();
		            //                    
		            /*console.log(formValue);*/

		            $.ajax({
		                url: "getCorpoClient.php",
		                method: "POST",
		                data: formValue,
		                success: function(data) {
		                    if (data == 1) {
		                        $('#goods_title').val('');
		                        $('#goods_type').val('');
		                        $('#shipping_charge').val('');
		                        $('#shimpent_pieces').val('');
		                        $('#shimpent_declared_value').val('');
		                        $('#custom_trackId').val('');
		                        $('#trackID').val('');
		                        alert("Booking Submited!");
		                    } else {
		                        alert('Data Already Submited!');
		                        console.log(data);
		                    }
		                }
		            });

		        }






		    });

		</script>

		<?php
}

if($uri_parts[0] == '/new_consignment_booking.php'){
    ?>
		<script>
		    $(".nav_view li").click(function() {
		        $(".nav_view li").removeClass('active');
		        $(this).addClass("active");
		    });



		    $("#personal").click(function() {
		        $("#personal_body").css("display", "block");

		        $("#corporate_body").css("display", "none");
		        $("#agent_body").css("display", "none");
		    });

		    $("#corporate").click(function() {
		        $("#personal_body").css("display", "none");

		        $("#corporate_body").css("display", "block");
		        $("#agent_body").css("display", "none");

		        document.getElementById("corporate_booking_form").reset();

		        $("#corporate_clients").val("");
		        $("#corporate_clients").selectpicker('refresh');


		    });

		    $("#agent").click(function() {
		        $("#personal_body").css("display", "none");

		        $("#corporate_body").css("display", "none");
		        $("#agent_body").css("display", "block");
                
                document.getElementById("agent_consignment_form").reset();
                
                $("#agent_principal").find('option').remove();
                $(".selectpicker").selectpicker('refresh');
                
		    });

		    $("#corporate_clients").change(function() {
		        var corporate_id = $(this).find(":selected").val();

		        if (corporate_id == "") {
		            $(".corporate_sender_name").val("");
		            $(".corporate_sender_mail").val("");
		            $(".corporate_sender_contact").val("");
		            $(".corporate_sender_addr").val("");
		        } else {
		            $.ajax({
		                url: "../ajax/consignment/ajax_corporate_form.php",
		                method: "POST",
		                data: {
		                    corporate_id: corporate_id
		                },
		                dataType: 'JSON',
		                success: function(data) {

		                    $(".corporate_sender_name").val(data.name);
		                    $(".corporate_sender_company").val(data.company_name);
		                    $(".corporate_sender_mail").val(data.email);
		                    $(".corporate_sender_contact").val(data.contact);
		                    $(".corporate_sender_addr").val(data.address);
		                    $(".corporate_assign_to").val(data.assign_to);
                            
//                            $("#corporate_shipping_charge").val("");
		                }
		            })
		        }


		    });
            
            function get_corporate_price(){
                var sender_mail = $("#corporate_sender_mail").val();
                var dest_country = $("#corporate_dest_country").find(":selected").val();
                var goods_type = $("#corporate_goods_type").find(":selected").val();
                var goods_weight = $("#corporate_goods_weight").find(":selected").val();
                
                if((sender_mail != "") && (dest_country != "") && (goods_type != "") && (goods_weight != "")){
                    $.ajax({
		                url: "../ajax/consignment/ajax_corporate_form.php",
		                method: "POST",
                        data: {
                            get_sender_mail: sender_mail,
                            get_dest_country: dest_country,
                            get_goods_type: goods_type,
                            get_goods_weight: goods_weight
                        },
                        success: function(data){
                            if(data == 'NOTHING'){
                                var r = confirm("No Price Found! Do you want to input Price Manually?");
                                if(r === true){
                                    $("#corporate_shipping_charge").prop("readonly", false);
                                    $("#corporate_shipping_charge").prop("required", true);
                                }
                            }else{
                                $("#corporate_shipping_charge").prop("readonly", true);
                                $("#corporate_shipping_charge").val(data);
                                $.ajax({
                                    url: "../ajax/consignment/ajax_corporate_form.php",
                                    method: "POST",
                                    data:{
                                        usd: data,
                                    },
                                    success: function(res){
                                        $("#corporate_bdt").text(res);
                                    }
                                    
                                });
                            }
                        }
                    });
                }
                
                
                
            }
            
            function corporate_convert_to_usd(){
                
                var usd = $("#corporate_shipping_charge").val();
                $.ajax({
                    url: "../ajax/consignment/ajax_corporate_form.php",
                    method: "POST",
                    data:{
                        usd: usd,
                    },
                    success: function(res){
                        $("#corporate_bdt").text(res);
                    }

                });
            }
            
            $("#corporate_booking_form").submit(function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                
                var track_id = $(".corporate_tracking_id").val();
                var shipping_charge = $("#corporate_shipping_charge").val();
                
                if((track_id != "") && (shipping_charge != "")){
                    $.ajax({
                        url: "../ajax/consignment/ajax_corporate_form.php",
                        method: "POST",
                        data: form_data,
                        success: function(data){
                            if(data == "1"){
                                alert("Consignment Booked!");
                                document.getElementById("corporate_booking_form").reset();
                                $("#corporate_clients").selectpicker('refresh');
                                $("#corporate_dest_country").selectpicker('refresh');
                                $("#corporate_goods_weight").selectpicker('refresh');
                                $("#corporate_bdt").text("");
                            }else{
                                alert("Somthing wrongs!!!!!!!!!!!!!!");
                            }
                        }
                    });
                }else{
                    alert("Please Add Required Values!");
                }
                
                
            });

		    function get_tracking_id(event) {
		        if ($(event.target).val() != "")
		            return 0;

		        $.ajax({
		            url: "../ajax/consignment/ajax_tracking_id.php",
		            method: "POST",
		            data: "",
		            success: function(data) {
		                $(event.target).val(data);
		            }
		        });
		    }


		    function get_personal_price() {
		        var personal_dest_country = $("#personal_dest_country").find(":selected").val();
		        var personal_goods_type = $("#personal_goods_type").find(":selected").val();
		        var personal_goods_weight = $("#personal_goods_weight").find(":selected").val();

		        if ((personal_dest_country != "") && (personal_goods_type != "") && (personal_goods_weight != "")) {
		            $.ajax({
                        url: "../ajax/consignment/ajax_personal_form.php",
                        method: "POST",
                        data: {
                            get_personal_dest_country: personal_dest_country,
                            get_personal_goods_type: personal_goods_type,
                            get_personal_goods_weight: personal_goods_weight
                        },
                        success: function(data){
                            if(data == 'NOTHING'){
                                var r = confirm("No Price Found! Do you want to input Price Manually?")
                                if(r === true){
                                    $("#personal_shipping_charge").prop('readonly', false);
                                }
                            }else{
                                $("#personal_shipping_charge").prop('readonly', true);
                                $("#personal_shipping_charge").val(data);
                                $.ajax({
                                    url: "../ajax/consignment/ajax_personal_form.php",
                                    method: "POST",
                                    data: { usd: data },
                                    success: function(res){
                                        $("#personal_bdt").text(res);
                                    }
                                });
                            }
                        }
                    });
		        } else {
		            $("#personal_shipping_charge").val("");
		        }

		    }
            
            function personal_convert_to_bdt(){
                var usd = $("#personal_shipping_charge").val();
                $.ajax({
                    url: "../ajax/consignment/ajax_personal_form.php",
                    method: "POST",
                    data: { usd: usd },
                    success: function(res){
                        $("#personal_bdt").text(res);
                    }
                });
                
            }



		    $("#personal_consignment_form").submit(function(event) {
		        event.preventDefault();
		        var form_data = $(this).serialize();
		        var personal_tracking_id = $("#personal_tracking_id").val();
		        var personal_shipping_charge = $("#personal_shipping_charge").val();

		        if ((personal_tracking_id != "") && (personal_shipping_charge != "")) {
		            $.ajax({
                        url: "../ajax/consignment/ajax_personal_form.php",
                        method: "POST",
                        data: form_data,
                        success: function(data){
                            if(data == '1'){
                                alert('Consigned Booking Successfully!');
                                
                                document.getElementById('personal_consignment_form').reset();
                                $("#personal_dest_country").selectpicker("refresh");
                                $("#personal_goods_weight").selectpicker("refresh");
                                $("#assigned_user").selectpicker("refresh");
                                $("#personal_bdt").text("");
                            }else{
                                alert("Consignment Already Submitted!");
                            }
                        }
                    });
		        } else {
		            alert("Please Check All Required Field Are Filled Up!");
		        }
		    });
            
            $("#agent_company").change(function(){
                var agent_company = $("#agent_company").find(":selected").val();
                
                $.ajax({
                    url: "../ajax/consignment/ajax_agent_form.php",
                    method: "POST",
                    data: { get_agent_info: agent_company },
                    dataType: 'JSON',
                    success: function(data){
                        $(".agent_sender_name").val(data.name);
                        $("#agent_company_name").val(data.company_name);
                        $(".agent_sender_mail").val(data.email);
                        $(".agent_sender_contact").val(data.contact);
                        $(".agent_sender_addr").val(data.address);
                        $(".agent_assign_to").val(data.assign_to);
//                        console.log(data);
                    }
                });
                
                $.ajax({
                    url: "../ajax/consignment/ajax_agent_form.php",
                    method: "POST",
                    data: { get_agent_principals: agent_company },
                    success: function(data){
                        $("#agent_principal").find('option').remove();
                        $("#agent_principal").append(data);
                        $("#agent_principal").selectpicker('refresh');
                    }
                });
            });
            
            
            function get_agent_price(){
                var agent_dest_country = $("#agent_dest_country").find(":selected").val();
                var agent_goods_type = $("#agent_goods_type").find(":selected").val();
                var agent_goods_weight = $("#agent_goods_weight").find(":selected").val();
                var agent_principal = $("#agent_principal").find(":selected").val();
                var agent_sender_mail = $(".agent_sender_mail").val();
                if((agent_dest_country != "") && (agent_goods_type != "") && (agent_goods_weight != "") && (agent_principal != "") && (agent_sender_mail != "")){
                    
                    $.ajax({
                        url: "../ajax/consignment/ajax_agent_form.php",
                        method: "POST",
                        data: { 
                            agent_dest_country: agent_dest_country,
                            agent_goods_type: agent_goods_type,
                            agent_goods_weight: agent_goods_weight,
                            agent_principal: agent_principal,
                            agent_sender_mail: agent_sender_mail
                        },
                        success: function(data){
                            if(data == 'NOTHING'){
                                
                                $("#agent_shipping_charge").val("");
                                var con = confirm("No Price Found! Do you want to input Price Manually?");
                                if(con == true){
                                    $("#agent_shipping_charge").prop('readonly', false);
                                    agent_convert_to_bdt()
                                }
                            }else{
                                $("#agent_shipping_charge").prop('readonly', true);
                                $("#agent_shipping_charge").val(data);
                                agent_convert_to_bdt()
                            }
                        }
                    });
                    
                }
            }
            
            function agent_convert_to_bdt(){
                var usd = $("#agent_shipping_charge").val();
                $("#agent_bdt").text("");
                if(usd != ""){
                    $.ajax({
                        url: "../ajax/consignment/ajax_agent_form.php",
                        method: "POST",
                        data: {
                            usd: usd
                        },
                        success: function(data){
                            $("#agent_bdt").text(data);
                        }
                    });
                }
            }
            
            $("#agent_consignment_form").submit(function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                var agent_company = $("#agent_company").val();
                var agent_dest_country = $("#agent_dest_country").val();
                var agent_goods_type = $("#agent_goods_type").val();
                var agent_goods_weight = $("#agent_goods_weight").val();
                var agent_principal = $("#agent_principal").val();
                var agent_shipping_charge = $("#agent_shipping_charge").val();
                var agent_tracking_id = $(".agent_tracking_id").val();
                
                if((agent_shipping_charge != "") && (agent_tracking_id != "")){
                    $.ajax({
                        url: "../ajax/consignment/ajax_agent_form.php",
                        data: form_data,
                        method: "POST",
                        success: function(data){
                            if(data == '1'){
                                alert("Consigned Booking Successfully!");
                                document.getElementById("agent_consignment_form").reset();
                                $('.selectpicker').selectpicker('refresh');
                            }else{
                                alert("SOMETHING WRONG!!!!");
                            }
                        }
                    });
                }else{
                    alert("Please Fillup all required fields!!!");
                }
                
                
            })

		</script>
		<?php
}

?>

		<style type="text/css">
		    .panel-heading {
		        background: #ffc800 !important;

		    }

		    ul.main-navigation-menu>li.active>a {
		        background: orange !important;
		    }

		    ul.main-navigation-menu>li.active>a .selected:before {
		        color: orange !important;
		    }

		</style>
		</body>

		</html>
