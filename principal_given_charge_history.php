<?php 
include('includes/header.php'); 

    // if (isset($_POST['submit'])) {
    //    $insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);
    // }


if (isset($_REQUEST['principal_id'])) {

    $principal_id = $_REQUEST['principal_id'];
    //$namecourcomp = $_REQUEST['namecourcomp'];
}

?>
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10" id="clientpricesetmodal">
                                            <div id="responsive" class="modal fade " tabindex="-1" data-width="760" style="display: none;">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            &times;
                                                        </button>
                                                        <h4 class="modal-title">Amount Collection Form : <span style="color: orange;font-weight: bold" id="clnamemdelhead"></span></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="panel-body">


                                                                    <form method="POST" id="cashcollectionForm">
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
                                                                                    <label class="control-label">Amount Collect By<span class="symbol required"></span>
                                                                                    </label>
                                                                                    <select id="collected_by" name="collected_by" required  class="form-control">
                                                                                    <option value="handcash">Hand Cash</option>
                                                                                    <option value="bankcheck">Bank Check</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="row" id="cash_input">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group connected-group">
                                                                                    <label class="control-label">Cash Giver<span class="symbol required"></span>
                                                                                    </label>
                                                                                <input type="text" name="cash_giver" id="cash_giver">
                                                                                </div>  
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group connected-group">
                                                                                    <label class="control-label">Cash Reciever<span class="symbol required"></span>
                                                                                    </label>
                                                                                <input type="text" name="cash_reciever" id="cash_reciever">
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-md-4">
                                                                                <div class="form-group connected-group">
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="row" id="bank_inputs">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group connected-group">
                                                                                    <label class="control-label">Bank Name<span class="symbol required"></span>
                                                                                    </label>
                                                                                <input type="text" name="bank_name" id="bank_name">
                                                                                </div>  
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group connected-group">
                                                                                    <label class="control-label">Account Number<span class="symbol required"></span>
                                                                                    </label>
                                                                                <input type="text" name="account_number" id="account_number">
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-md-4">
                                                                                <div class="form-group connected-group">
                                                                                    <label class="control-label">Check Number<span class="symbol required"></span>
                                                                                    </label>
                                                                                <input type="text" name="check_number" id="check_number">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                        

                                                                        <div class="row">
                                                                            <div class="col-md-4">  
                                                                                <div class="form-group connected-group">
                                                                                    <label class="control-label">Collected Amount<span class="symbol required">*</span>
                                                                                    </label>
                                                                                    <input id="collected_amount" type="text" name="collected_amount" required >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">  
                                                                                <div class="form-group connected-group">
                                                                                    <label class="control-label">Collection Date<span class="symbol required">*</span>
                                                                                    </label>
                                                                                    <input type="date" name="collection_date" id="collection_date" required >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            </div>
                                                                        </div>



                                                                        <br>
                                                                        <div class="row">
                                                                            <div class="col-md-4"></div>
                                                                            <div class="col-md-4">
                                                                                <!-- <a id="ccpricemodalbtn" class="btn btn-lg btn-green btn-block"> submites </a> -->
                                                                                <input type="submit" name="submit"  class="btn btn-lg btn-green btn-block">
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



            <!-- start: PAGE -->
            <div class="main-content">
                <div class="container"><br><br><br><br>
                    <!-- start: PAGE CONTENT -->

<!-- CLIENT PRICE SEARCH PORTION STARTS -->
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    Search Setted Corporate Client Price
                                </div>
                                <div class="panel-body">

                                    <div id="showclientprice"></div>

                                </div>
                            </div>
                        </div>

                    </div><br><br>



<!-- SHOW ALL THE GENERAL PRICE  -->
                    <!-- <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">LIST OF GENERAL PRICES :
                                    <i class="fa fa-external-link-square"></i>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                            <div class="genpricehead"> <h4>GENERAL PRICE LIST</h4> </div>

<?php 
//$selectgenpr = "SELECT * FROM tbl_route_price WHERE status=1 ORDER BY route_code ASC,unit ASC";
//$execgenpr =  $Corpoclients->selectCorpoClient($selectgenpr);
?>
                                            <table class="table table-hover" id="showgenpricetbl">
                                                <thead>
                                                    <tr>
                                                        <th>Zone</th>
                                                        <th>IN or OUT</th>
                                                        <th>Goods Type</th>
                                                        <th>Unit</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php //if ($execgenpr) {while ($findgenpr=$execgenpr->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td class="yellow"><?php // echo $findgenpr['route_code']; ?></td>
                                                        <td><?php //echo $findgenpr['income_or_outgo']; ?></td>
                                                        <td><?php //echo $findgenpr['goods_type']; ?></td>
                                                        <td><?php //echo $findgenpr['unit']; ?>1</td>
                                                        <td><?php //echo $findgenpr['price']; ?>1</td>
                                                    </tr>
                                                <?php // } }else{ echo "Data not found";} ?>


                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1"></div>
                    </div> -->
<!-- SHOW ALL THE GENERAL PRICE ENDS -->


                </div>
            </div>

        </div>



<?php include('includes/footer.php'); ?>



<script type="text/javascript">


jQuery( document ).ready(function( $ ) {
UIElements.init();

$(function() {
// DYNAMIC FIELD CHANGE CODE end
    function bankfunc(){
            $('#bank_inputs').show(); 
            $("#bank_name").prop('required',true);
            $("#account_number").prop('required',true);
            $("#check_number").prop('required',true);
            $("#cash_giver").prop('required',false);
            $("#cash_reciever").prop('required',false);
            $('#cash_input').hide(); 
    }   
    function handcashfunc(){
            $('#bank_inputs').hide(); 
            $('#cash_input').show(); 
            $("#cash_giver").prop('required',true);
            $("#cash_reciever").prop('required',true);
            $("#bank_name").prop('required',false);
            $("#account_number").prop('required',false);
            $("#check_number").prop('required',false);
    }
    handcashfunc();
    $('#collected_by').change(function(){
        if($('#collected_by').val() == 'bankcheck') {
            bankfunc();
        } else {
            handcashfunc();
        }
    });
});

// DYNAMIC FIELD CHANGE CODE END



// INSERT CASH COLLECTION 
    $('#cashcollectionForm').on('submit', function (e) {
        e.preventDefault();
          //var collectionformdata = $('#cashcollectionForm').serialize()
        var corp_clientid = $("#CorpoClient").val();
        var nameofclient= $('#CorpoClient option:selected').html();
        var collection_type = $('#collected_by').val();
        var bank_name  =$('#bank_name').val();
        var account_number  =$('#account_number').val();
        var check_number  =$('#check_number').val();
        var cash_giver  =$('#cash_giver').val();
        var cash_reciever  =$('#cash_reciever').val();
        var collected_amount = $('#collected_amount').val();
        var collection_date = $('#collection_date').val();





          $.ajax({
            type: 'post',
            url: 'CorppaccountCollection.php',
            data: {action:'corpoCollectionInsert',corp_clientid:corp_clientid,nameofclient:nameofclient,collection_type:collection_type,bank_name:bank_name,account_number:account_number,check_number:check_number,cash_giver:cash_giver,cash_reciever:cash_reciever,collected_amount:collected_amount,collection_date:collection_date},
            success: function (data) {
              alert(data);

                $("#bank_name").val('') ;
                $("#account_number").val('') ;
                $("#check_number" ).val('');
                $("#cash_giver ").val('');
                $("#cash_reciever").val('') ;
                $("#collected_amount").val('') ;
                $("#collection_date").val('') ;

            }
          });

        });

// INSERT CASH COLLECTION 








principalgivenchargehistory();
    // $("#CorpoClient").change(function(){
    //     event.preventDefault();
    //     getClientprices();
    // });
    function getPrincipalgievechargehistory(){
        // var corp_client = $("#CorpoClient").val();
        // var nameofclient= $('#CorpoClient option:selected').html();
        // $("#corp_client").val(corp_client);
        // $("#corp_client").html(nameofclient);
        // $("#clnamemdelhead").html(nameofclient);

        //alert(corp_client);exit();
           $.ajax({  
            url:"corpo_amount_collection_history.php",  
            method:"POST",  
            data:{action:'getgenpr',corp_client:<?php echo $principal_id; ?>},  
                //dataType: "JSON",
                success:function(data){  
                    $("#showclientprice").html(data);
                }  
            });  
    }






//CUSTOMER PRICE INSERT  MDOAL CODE STARTS

    $('#ccpricemodalbtn').on("click",function() {
        insertclientprice();
    }); 

    function insertclientprice(){
        var corpo_client_id = $("#corp_client").val();
        var route_code = $("#route_code").val();
        var income_or_outgo = $("#income_or_outgo").val();
        var goods_type = $("#goods_type").val();
        var unit = $("#unit").val();
        var price = $("#price").val();

                $.ajax({
                url: "actions.php",
                method: "POST",
                data:{action:'insertclientprice',corpo_client_id:corpo_client_id,route_code:route_code,income_or_outgo:income_or_outgo,goods_type:goods_type,unit:unit,price:price},  
                success: function(data) {
                    alert(data);
                    getClientprices();
                    $("#clientpricesetmodal").modal("close");
                }
            })
        
    }

//CUSTOMER PRICE INSERT  MDOAL CODE ENDS


});



</script>
<style type="text/css">
.genpricehead,#showclienttbl thead{
background: #fbd200;
}

</style>
