<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM  principals_name order by id desc";
    $selectcourcom = $Courcompanyset->selectcourComp($query);
?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group connected-group">
                                <label class="control-label" style="font-size: 16px">Select Principal<span class="symbol required"></span>
                                </label>
                                <select name="principalid" required id="principalid" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                    <option value="">--</option>
                                    <?php 
																$select_principal = "SELECT * FROM principals_name ORDER BY dated";
   																 $query =  $db->link->query($select_principal);	
															if ($query) { while ($row=$query->fetch_assoc()) { ?>
                                    <option id="principal_name" class="<?php echo $row['stuff_name']; ?>" value="<?php echo $row['id']; ?>"><?php echo  $row['principal_name']; ?></option>
                                    <!-- <option data-subtext="<?php //echo $getclientname['client_name']; ?>" class="cl" value="<?php //echo $getclientname['client_id']; ?>"><?php //echo $getclientname['client_name']; ?></option> -->
                                    <?php } }else{} ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-9">
                            <br>
                            <div class="nav_view" style="display: none;">
                                <form action="" id="csvdate">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formdate">FROM</label>
                                                <!--<input type="text" class="form-control hasDatepicker" id="formdate" name="formdate" required>-->
                                                <input type="hidden" id="principal_id" name="principal_id">
                                                <input id="minformdate" name="minformdate" type="text" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="todate">TO</label>
                                                <!--<input type="text" class="form-control hasDatepicker" id="todate" name="todate" required>-->
                                                <input id="mintodate" name="mintodate" type="text" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <div class="gap" style="width: 100%; float: left; margin-top: 5px;"></div>
                                            <button class="btn btn-warning btn-sm btn-block">VIEW</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end: FORM VALIDATION 1 PANEL -->
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="loading-img">
                                <img src="img/loading.gif" alt="">
                            </div>
                            <div id="manlist">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
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
    jQuery(document).ready(function($) {
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
