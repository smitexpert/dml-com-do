<?php include('includes/header.php'); 
	$query = "SELECT * FROM corporate_clients WHERE status=1 ORDER BY created_date ASC";
    $selectCorpoClient = $Corpoclients->selectCorpoClient($query);
if (isset($_POST['submit'])) {
    $insertCorpoClient = $Corpoclients->insertCorpoclient($_POST);
    header('location: '.$_SERVER['PHP_SELF']);
}




?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            CREATE CORPORATE CLIENT
                        </div>
                        <div class="panel-body">
                            <form action="corporate_client_create.php" role="form" id="fcorpo_orm" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="errorHandler alert alert-danger no-display">
                                            <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                        </div>
                                        <div class="successHandler alert alert-success no-display">
                                            <i class="fa fa-ok"></i> Your form validation is successful!
                                        </div>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="col-md-12">
                                            <?php 
													if (isset($insertCorpoClient)) { ?>
                                            <div class="alert alert-info fade in">
                                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                <strong>
                                                    <?php echo $insertCorpoClient; ?>
                                                </strong>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Client Name<span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="client_name" name="client_name" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Company Name<span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="client_company" name="client_company" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Email Address <span class="symbol required"></span>
                                            </label>
                                            <input class="form-control" type="email" required id="client_mail" name="client_mail">
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Contact <span class="symbol required"></span>
                                            </label>
                                            <input type="text" required class="form-control" name="client_contact" id="client_contact">
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Address <span class="symbol required"></span>
                                            </label>
                                            <input type="textarea" required class="form-control" id="client_addr" name="client_addr">
                                        </div>

                                        <div class="form-group connected-group">
                                            <label class="control-label">Member Type<span class="symbol required"></span>
                                            </label>
                                            <select name="member_type" id="member_type" class="form-control" required>
                                                <option value="">--</option>
                                                <option value="1">Regular</option>
                                                <option value="2">Premium</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label">
                                                Bank Name
                                            </label>
                                            <input type="textarea" class="form-control" id="bank_name" name="bank_name">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Account Name
                                            </label>
                                            <input type="textarea" class="form-control" id="account_name" name="account_name">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Account Number
                                            </label>
                                            <input type="textarea" class="form-control" id="acc_num" name="acc_num">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Discount Offer
                                            </label>
                                            <input class="form-control tooltips" type="text" data-original-title="This amount will be minus from booking main amount" data-rel="tooltip" title="" data-placement="top" name="discount" id="discount">
                                        </div>



                                        <div class="form-group connected-group">
                                            <label class="control-label">Status<span class="symbol required"></span>
                                            </label>
                                            <select name="client_status" id="client_status" class="form-control" required>
                                                <option value="">--</option>
                                                <option value="1">Publish</option>
                                                <option value="2">Pending</option>
                                            </select>
                                        </div>



                                        <div class="form-group connected-group">
                                            <label class="control-label">Assign to :<span class="symbol required"></span>
                                            </label>
                                            <select name="corpoAssignTo" id="corpoAssignTo" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                <option value="">--</option>
                                                <?php 
	$query2 = "SELECT * FROM user WHERE status=1 AND rule != 1";
    $selectstuff = $db->link->query($query2);
	if ($selectstuff) { while ($getstuff=$selectstuff->fetch_assoc()) { ?>
                                                <option value="<?php echo $getstuff['userId']; ?>"><?php echo $getstuff['name']; ?></option>
                                                <?php } }else{} ?>

                                            </select>
                                        </div><br>





                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="submit">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <!-- end: PAGE -->


    </div>
    <!-- end: MAIN CONTAINER -->


    <?php 
include('includes/footer.php');
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            UIElements.init();
            $('#corpoClientTable3').DataTable({
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
        })

    </script>