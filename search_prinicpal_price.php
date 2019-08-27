<?php 
include('includes/header.php'); 


/*if (isset($_POST['submit'])) {
    $insertcourcompprice = $Courcompanyset->insertPrincipalPrice($_POST);
}

$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id AND p.country_id = c.country_id";
$selectcourcomp = $Courcompanyset->selectcourComp($query);*/


?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>


            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            <STRONG>PRINCIPAL PRICE SEARCH:</STRONG>
                        </div>
                        <div class="panel-body table-responsive">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group connected-group">
                                        <label class="control-label">Country<span class="symbol required"></span>
                                        </label>
                                        <select name="country" required id="country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                            <option value=""></option>
                                            <?php 
															$selectcountry = "SELECT * FROM tbl_country WHERE status=1 ORDER BY country_name ASC";
																$execcountry =  $Courcompanyset->selectcourComp($selectcountry);
														if ($execcountry) {while ($findcountry=$execcountry->fetch_assoc()) { ?>
                                            <option id="dd" value="<?php echo $findcountry['country_tag']; ?>"><?php echo $findcountry['country_name']; ?></option>
                                            <?php } }else{ } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Weight<span class="symbol required"></span>
                                        </label>
                                        <select name="weight" required id="weight" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                            <option value=""></option>
                                            <?php 
															$selectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
																$execweight =  $db->link->query($selectweight);
														if ($execweight) {while ($findweight=$execweight->fetch_assoc()) { ?>
                                            <option id="dd" value="<?php echo $findweight['weight']; ?>"><?php echo $findweight['weight']; ?></option>
                                            <?php } }else{ } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="gap" style="width: 100%; float: left; margin-top: 5px;"></div>
                                    <button id="get_price" class="btn btn-warning btn-md btn-block">VIEW</button>
                                </div>
                                <br>

                            </div><br><br><br>



                            <div class="tbl">
                                
                            </div>
                        </div>
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

</style>
<script type="text/javascript">
    jQuery(document).ready(function($) {

        $('body').on('click', '.delactionbtn', function() {
            deletedata();
        });

        $("#get_price").click(function() {
            var country = $("#country").val();
            var weight = $("#weight").val();
            
            $(".tbl").find(".all_price").remove();

            if (country != 0 && weight != 0) {

                $.ajax({
                    url: "ajax/ajax_search_principal_price.php",
                    method: "POST",
                    data: {
                        country: country,
                        weight: weight
                    },
                    success: function(data) {
                        $(".tbl").append(data)
                        console.log(data);
                    }

                });

            }


        });


    });

</script>
