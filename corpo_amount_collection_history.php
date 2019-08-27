<?php 

require __DIR__."/classes/Corporateclients.php";
require __DIR__."/classes/Accounts.php";
$Corpoclients = new Corporateclients();
$Accounts = new Accounts();
//$insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);

// if (isset($_POST['corp_client']) AND isset($_POST['nameofclient'])) {
$clientId = $_POST['corp_client'];
$nameofclient = $_POST['nameofclient'];
// }else{
//         header('Location:accounts_corporate.php');
// }



if (isset($_POST['dateFrom']) && isset($_POST['dateTo'])) {

	 $dateFrom=$_POST['dateFrom'];
	 $dateTo=$_POST['dateTo'];

 $srchquery = "SELECT * FROM tbl_account_corporate WHERE client_id=$clientId AND cash_given_date >= '$dateFrom' AND cash_given_date  < '$dateTo'";
}else{

 $srchquery = "SELECT * FROM tbl_account_corporate WHERE client_id=$clientId";

}

 	$i=0;
	$runsrchquery =  $Corpoclients->selectCorpoClient($srchquery);
	if ($runsrchquery) { ?>



								    	<div class="row">
												<div class="col-md-12">


                                                <h3>Amount Collection History of : <?php //echo $nameofclient; ?></h3>


<!-- SUMMERY AREA  START-->

<?php 
$query = "SELECT (SELECT COUNT(*) FROM tbl_consignment WHERE sender_id=$clientId) as total_consignment,(SELECT SUM(total_charge) FROM tbl_consignment WHERE sender_id=$clientId) as total_charges,(SELECT count(consignment_status) FROM tbl_consignment WHERE consignment_status=2 AND sender_id=$clientId) as deliv,(SELECT SUM(total_charge) FROM tbl_consignment WHERE sender_id=$clientId)-(SELECT SUM(menifested)  FROM tbl_consignment WHERE sender_id=$clientId) as totalsbalance";
    $selectaccount = $Accounts->selectAccount($query);
    $res = $selectaccount->fetch_assoc();
 ?>
<br><br><br>



						<table class="table table-hover" id="showclienttbl" style="overflow: scroll;">

                                <div class="row">
                                    <div class="col-md-6" style="padding-left: 0;">
                                        <a href="#responsive" data-toggle="modal" class="btn btn-blue btn-sm text-right">
                                        Amount Collection entry form <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>



                                    <!-- DATE RANGE SEARCH -->
                                      <div class="col-md-6" style="padding-right: 0;">
                                        <div class="input-group input-daterange pull-right">
                                            <form method="POST" id="daterangeform">
                                            <div class="input-group-addon">From</div>
                                            <input id="dateFrom" type="date" name="dateFrom" value="YYYY-MM-DD"/>
                                          <div class="input-group-addon">to</div>
                                          <input id="dateTo" type="date" name="dateTo" value="YYYY-MM-DD"/>
                                          <a href="#" id="daterangfrmbtn" class="btn btn-danger"> Search</a>'


                                          </form>
                                        </div><br><br><br>
                                      </div>
                                </div>

							<!-- DATE RANGE SEARCH END -->
                                <thead>
                                    <tr>
                                        <th>Srl</th>
                                        <th>client_name</th>
                                        <th>amount_collected_by</th>
                                        <th>bank_name</th>
                                        <th>amount_collection</th>
                                        <th>account_number</th>
                                        <th>check_number</th>
                                        <th>cash_given_date</th>
                                        <th>cash_giver</th>
                                        <th>cash_reciever</th>
                                        <th>entry_date</th>
                                    </tr>
                                </thead>

                                <tbody>

													
                        <?php 
                        $i=0; 
                        $total_amount = 0;
                        if ($runsrchquery) { while ($getcorpoclient_cons_list=$runsrchquery->fetch_assoc()) { $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['client_name']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['amount_collected_by']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['bank_name']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['amount_collection']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['account_number']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['check_number']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['cash_given_date']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['cash_giver']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['cash_reciever']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['entry_date']; ?></td>
                                    </tr>    
                        <?php 
                        $total_amount += $getcorpoclient_cons_list['amount_collection'];
                        } ?>
                        <tr>
                        <td>==</td><td></td><td></td><td></td><td></td><td>TOTAL =</td><td><?php echo "<h4>".$total_amount."</h4>"; ?></td><td></td><td></td><td></td><td></td>
                        </tr>

                        <?php }else{echo "Data not found";} ?>
                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                </tfoot>
                            </table>
                            </div>
                            <div class="col-md-1"></div>
                            </div>
    						</div>
    						

    									<?php }else{ ?>
    									
    										<div class="row">
												<div class="col-md-12 text-center"><br>
													<span>No History Found</span><br><br>
														<!-- <div style="width: 400px" class="center-block"> -->	
														<!-- id="pulsate-regular" -->	
														<!-- <a href="#responsive" data-toggle="modal" class="btn btn-blue btn-sm center-block">
															SET PRICE FOR THIS CLIENT <i class="fa fa-arrow-circle-right"></i>
														</a>
														</div> -->
													</div>
												</div>
    									<?php } ?>



<style type="text/css">
	.mini-stats li{color:green;}
</style>
<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
UIElements.init();



$('#daterangfrmbtn').on("click",function() {
	dateSearch();
}); 

function dateSearch(){
	var dateFrom = $("#dateFrom").val();
	var dateTo = $("#dateTo").val();
            $.ajax({
            url: "getCorpoClientPriceset.php",
            method: "POST",
       		data:{action:'dateSearch',dateFrom:dateFrom,dateTo:dateTo,corp_client:<?php echo $clientId;?>},  
            success: function(data) {
            $("#showclientprice").html(data);
                // getClientprices();
                // $("#clientpricesetmodal").modal("close");
            }
        })
	
}

// data table with pdf csv excel print copy
table = $('#showclienttbl').DataTable({
  paging: false,
  info: false,
   dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
});

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
            data: {action:'corpoCollectionInsert',corp_clientid:<?php echo $clientId; ?>,nameofclient:<?php echo $nameofclient; ?>,collection_type:collection_type,bank_name:bank_name,account_number:account_number,check_number:check_number,cash_giver:cash_giver,cash_reciever:cash_reciever,collected_amount:collected_amount,collection_date:collection_date},
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

});
</script>
