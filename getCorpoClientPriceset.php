<?php 

require __DIR__."/classes/Corporateclients.php";
require __DIR__."/classes/Accounts.php";
$Corpoclients = new Corporateclients();
$Accounts = new Accounts();
//$insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);


// if (isset($_POST['corp_client']) AND isset($_POST['nameofclient'])) {
 $clientId = $_POST['corp_client'];
 //$nameofclient = $_POST['nameofclient'];
// }else{
// 	header('Location:accounts_corporate.php');
// }

if (isset($_POST['dateFrom']) && isset($_POST['dateTo'])) {

	 $dateFrom=$_POST['dateFrom'];
	 $dateTo=$_POST['dateTo'];

 $srchquery = "SELECT sender_name,dest_country,income_or_outgo,goods_type,goods_quantity,goods_weight,CorpoClientPrice,total_charge,track_id,booking_date,booked_by,assigned_to,menifested,consignment_status FROM tbl_consignment WHERE sender_id=$clientId AND sender_type=2 AND booking_date >= '$dateFrom' AND booking_date  < '$dateTo'";

}else{

 $srchquery = "SELECT sender_name,dest_country,income_or_outgo,goods_type,goods_quantity,goods_weight,CorpoClientPrice,total_charge,track_id,booking_date,booked_by,assigned_to,menifested,consignment_status FROM tbl_consignment WHERE sender_id=$clientId AND sender_type=2";

}

 	$i=0;
	$runsrchquery =  $Corpoclients->selectCorpoClient($srchquery);
	if ($runsrchquery) { ?>
	<div style="text-align:right;float: right;margin-top: -45px;" >	
   <!--  <a href="corpo_collection_history.php?corp_client=<?php //echo $clientId; ?>&nameofclient=<?php //echo $nameofclient; ?>" class="btn btn-green btn-sm text-right"> -->
	<a href="corpo_collection_history.php?corp_client=<?php echo $clientId; ?>" class="btn btn-green btn-sm text-right">
		See all the collections <i class="fa fa-arrow-circle-right"></i>
	</a>
	<a href="#responsive" data-toggle="modal" class="btn btn-blue btn-sm text-right">
		Amount Collection entry form <i class="fa fa-arrow-circle-right"></i>
	</a>
	</div>


								    	<div class="row">
												<div class="col-md-12">
<hr>



<!-- SUMMERY AREA  START-->

<?php 
$query = "SELECT (SELECT COUNT(*) FROM tbl_consignment WHERE sender_id=$clientId) as total_consignment,(SELECT SUM(total_charge) FROM tbl_consignment WHERE sender_id=$clientId) as total_charges,(SELECT count(consignment_status) FROM tbl_consignment WHERE consignment_status=2 AND sender_id=$clientId) as deliv,(SELECT SUM(total_charge) FROM tbl_consignment WHERE sender_id=$clientId)-(SELECT SUM(menifested)  FROM tbl_consignment WHERE sender_id=$clientId) as totalsbalance";
    $selectaccount = $Accounts->selectAccount($query);
    $res = $selectaccount->fetch_assoc();
 ?>

														<div class="row space12">
															<ul class="mini-stats col-sm-12">
																<li class="col-sm-3">
																	<div class="values">
																		<strong><?php echo $res['total_consignment']; ?></strong>
																		Total Consignment
																	</div>
																</li>
																<li class="col-sm-3">
																	<div class="values">
																		<strong><?php echo $res['total_charges']; ?></strong>
																		Total Charges
																	</div>
																</li>
																<li class="col-sm-3">
																	<div class="values">
																		<strong><?php echo $res['deliv']; ?></strong>
																		Total Delivered
																	</div>
																</li>		

																<li class="col-sm-3">
																	<div class="values">
																		<strong><?php echo $res['totalsbalance']; ?></strong>
																		Balance
																	</div>
																</li>
															</ul>
														</div>
									<!-- SUMMERY AREA  END-->
<hr>


												<table class="table table-hover" id="showstufftbl">

							<!-- DATE RANGE SEARCH -->
							  <div class="col-md-6 pull-right" style="padding-right: 0;">
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
							<!-- DATE RANGE SEARCH END -->
                                <thead>
                                    <tr>
                                        <th>Srl</th>
                                        <th>Sender Name</th>
                                        <th>Tracking Id</th>
                                        <th>Destination</th>
                                        <th>Income or Outgo</th>
                                        <th>Goods Type</th>
                                        <th>Weight</th>
                                        <th>Charge</th>
                                        <th>Booking Date</th>
                                        <th>Menifested</th>
                                        <th>Booked By</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

													
                        <?php 
                        $i=0; 
                        $total_price = 0;
                        if ($runsrchquery) { while ($getcorpoclient_cons_list=$runsrchquery->fetch_assoc()) { $i++; ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['sender_name']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['track_id']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['dest_country']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['income_or_outgo']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['goods_type']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['goods_weight']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['total_charge']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['booking_date']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['menifested']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['booked_by']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['consignment_status']; ?></td>
                                    </tr>    
                        <?php 
                        $total_price += $getcorpoclient_cons_list['total_charge'];
                        } ?>
                        <tr>
                        <td>==</td><td></td><td></td><td></td><td></td><td></td><td>TOTAL =</td><td><?php echo "<h4>".$total_price."</h4>"; ?></td><td></td><td></td><td></td><td></td>
                        </tr>

                        <?php }else{echo "Data not found";} ?>
                                </tbody>
                                <tfoot>
                                      <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    </tr>
                                </tfoot>
                            </table>
                            </div>
    						</div>
    						<div class="col-md-1"></div>
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
table = $('#showstufftbl').DataTable({

  paging: false,
  info: false,
   dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
});


});
</script>
