<?php 

require __DIR__."/classes/Corporateclients.php";
require __DIR__."/classes/Accounts.php";
$Corpoclients = new Corporateclients();
$Accounts = new Accounts();

if (isset($_REQUEST['stuff_id'])) {
    $Stuffid = $_REQUEST['stuff_id'];
}else{
    header('Location:accounts_corporate.php');
 //$nameofclient = $_POST['nameofclient'];
}






if (isset($_POST['dateFrom']) && isset($_POST['dateTo'])) {

	$dateFrom=$_POST['dateFrom'];
	$dateTo=$_POST['dateTo'];

    $srchquery = "SELECT sender_type,sender_name,dest_country,income_or_outgo,goods_type,goods_quantity,goods_weight,CorpoClientPrice,delivery_charge,total_charge,track_id,booking_date,booked_by,assigned_to,menifested,consignment_status FROM tbl_consignment WHERE assigned_to =$Stuffid AND booking_date >= '$dateFrom' AND booking_date  < '$dateTo'";
}else{ 

    // $srchquery = "SELECT c.sender_id,c.sender_name,c.dest_country,c.income_or_outgo,c.goods_type,c.goods_quantity,c.goods_weight,c.CorpoClientPrice,c.total_charge,c.track_id,c.booking_date,c.booked_by,c.assigned_to,c.menifested,c.consignment_status,cc.client_id,cc.client_name FROM tbl_consignment as c,tbl_corporate_clients as cc WHERE c.sender_id = cc.client_id AND assigned_to =$Stuffid";
    $srchquery = "SELECT sender_type,sender_name,dest_country,income_or_outgo,goods_type,goods_quantity,goods_weight,CorpoClientPrice,delivery_charge,total_charge,track_id,booking_date,booked_by,assigned_to,menifested,consignment_status FROM tbl_consignment WHERE assigned_to =$Stuffid";

}

 	$i=0;
	$runsrchquery =  $Corpoclients->selectCorpoClient($srchquery);
	if ($runsrchquery) { ?>

	<div style="text-align:right;float: right;margin-top: -45px;" >	
	<a href="#" class="btn btn-green btn-sm text-right">
		See all the collections <i class="fa fa-arrow-circle-right"></i>
	</a>
    <a href="#responsive" data-toggle="modal" class="btn btn-blue btn-sm text-right">
        Amount Collection entry form <i class="fa fa-arrow-circle-right"></i>
    </a>	

    <a href="#stufftargetmodal" data-toggle="modal" class="btn btn-blue btn-sm text-right">
		Set Target <i class="fa fa-arrow-circle-right"></i>
	</a>
	</div>


<div class="row">
<div class="col-md-12">
<hr>



<!-- SUMMERY AREA  START-->

<?php 
$query = "SELECT (SELECT COUNT(*) FROM tbl_consignment WHERE assigned_to =$Stuffid) as total_consignment,(SELECT SUM(total_charge) FROM tbl_consignment WHERE assigned_to =$Stuffid) as total_charges,(SELECT count(consignment_status) FROM tbl_consignment WHERE consignment_status=2 AND assigned_to =$Stuffid) as deliv,(SELECT SUM(delivery_charge) FROM tbl_consignment WHERE assigned_to =$Stuffid) as total_deliv_charges,(SELECT SUM(total_charge) FROM tbl_consignment WHERE assigned_to =$Stuffid)-(SELECT SUM(delivery_charge)  FROM tbl_consignment WHERE assigned_to =$Stuffid) as totalsbalance";
    $selectaccount = $Accounts->selectAccount($query);
    $res = $selectaccount->fetch_assoc();
 ?>

														<div class="row space12">
															<ul class="mini-stats col-md-12">
																<li class="col-sm-2">
																	<div class="values">
																		<strong><?php echo $res['total_consignment']; ?></strong>
																		Total Consignment
																	</div>
																</li>
                                                                <li class="col-sm-2">
                                                                    <div class="values">
                                                                        <strong><?php echo $res['total_charges']; ?></strong>
                                                                        Total Charges
                                                                    </div>
                                                                </li>																
                                                                <li class="col-sm-2">
																	<div class="values">
																		<strong><?php echo $res['total_deliv_charges']; ?></strong>
																		Total Delivery Charges
																	</div>
																</li>
																<li class="col-sm-2">
																	<div class="values">
																		<strong><?php echo $res['deliv']; ?></strong>
																		Total Delivered
																	</div>
																</li>		

                                                                <li class="col-sm-2">
                                                                    <div class="values">
                                                                        <strong><?php echo $res['totalsbalance']; ?></strong>
                                                                        Total Profit
                                                                    </div>
                                                                </li>

                                                                <!-- TARGET SHOW -->
                                                                <?php 
                                                                $targetquery ="SELECT * FROM tbl_stuff_target  WHERE stuff_id=$Stuffid ORDER BY dated desc limit 1";   
                                                                    $selectStuffTarget = $Accounts->selectAccount($targetquery);
                                                                if ($selectStuffTarget) {
                                                                     $targetinfo = $selectStuffTarget->fetch_assoc();
                                                                ?>
                                                                <li class="col-sm-2">
                                                                    <div class="values">
                                                                        <span> Last Target : <span style="color: red"><?php echo $targetinfo['targeted_amount']; ?></span></span><br>
                                                                   
                                                                        <span>Date : <span style="color: red"><?php echo $targetinfo['date_to']; ?></span> to <span style="color: red"><?php echo $targetinfo['date_from']; ?></span></span><br>
                                                                        <a href="stuff_target_history.php?stuff_id=<?php echo $Stuffid; ?>">See target History ></a>
                                                                        
                                                                    </div>
                                                                </li>
                                                               <?php }else{ ?> 
                                                                <li class="col-sm-2">
                                                                    <div class="values">
                                                                        <span> Last Target : <strong></strong></span>
                                                                   
                                                                        <span>Date :</span>
                                                                        
                                                                    </div>
                                                                </li>  
                                                               <?php } ?>

															</ul>
														</div>
									<!-- SUMMERY AREA  END-->
<hr>


						<table class="table table-hover" id="showclienttbl">
							<!-- DATE RANGE SEARCH -->
							  <div class="col-md-6 pull-right" style="padding-right: 0;">
								<div class="input-group input-daterange pull-right">
									<form method="POST" id="daterangeform">
									<div class="input-group-addon">From</div>
									<input type="date" name="fromdate" value="YYYY-MM-DD"  class="fromdate" />
							      <div class="input-group-addon">to</div>
							      <input type="date" name="todate" value="YYYY-MM-DD" class="todate" />
							      <a href="#" id="daterangfrmbtn" class="btn btn-danger"> Search</a>'


							      </form>
							    </div><br><br><br>
							  </div>
							<!-- DATE RANGE SEARCH END -->
                                <thead>
                                    <tr>
                                        <th>Srl</th>
                                        <th>Sender Type</th>
                                        <th>Client Name</th>
                                        <th>Tracking Id</th>
                                        <th>Income or Outgo</th>
                                        <th>Goods Type</th>
                                        <th>Weight</th>
                                        <th>Delivery Charge</th>
                                        <th>Charge</th>
                                        <th>Booking Date</th>
                                        <th>Menifested</th>
                                        <th>Booked By</th>
                                        <th>Cons Status</th>
                                    </tr>
                                </thead>

                                <tbody>

													
                        <?php 
                        $i=0; 
                        $total_price = 0;
                        if ($runsrchquery) { while ($getcorpoclient_cons_list=$runsrchquery->fetch_assoc()) { $i++; ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php if ($getcorpoclient_cons_list['sender_type'] == 2) {
                                            echo "Corporate";
                                        }else{echo "General";} //echo $getcorpoclient_cons_list['client_name']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['sender_name']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['track_id']; ?></td>
                                     
                                        <td><?php echo $getcorpoclient_cons_list['income_or_outgo']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['goods_type']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['goods_weight']; ?></td>
                                        <td><?php echo $getcorpoclient_cons_list['delivery_charge']; ?></td>
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
                        <td>==</td><td></td><td></td><td></td><td></td><td></td><td></td><td>TOTAL =</td><td><?php echo "<h4>".$total_price."</h4>"; ?></td><td></td><td></td><td></td><td></td>
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
                                    <tr></tr>
                                    <tr></tr>
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
	dateragesrch();
}); 

function dateragesrch(){
	var dateFrom = $(".fromdate").val();
	var dateTo = $(".todate").val();
            $.ajax({
            url: "getcor_assignee_data.php",
            method: "POST",
       		data:{action:'dateSearch',dateFrom:dateFrom,dateTo:dateTo,stuff_id:<?php echo $_REQUEST['stuff_id'];?>},  
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



});
</script>
