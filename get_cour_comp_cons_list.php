<?php
require __DIR__."/classes/Corporateclients.php";
require __DIR__."/classes/Accounts.php";
$Corpoclients = new Corporateclients();
$Accounts = new Accounts();
//$insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);
// getcourcompcons
// cour_company_id
// nameof_cour_comp
// if (isset($_POST['corp_client']) AND isset($_POST['nameofclient'])) {
$cour_company_id = $_POST['cour_company_id'];
$nameof_cour_comp = $_POST['nameof_cour_comp'];
// }else{
    //  header('Location:accounts_corporate.php');
// }
if (isset($_POST['dateFrom']) && isset($_POST['dateTo'])) {
    $dateFrom=$_POST['dateFrom'];
    $dateTo=$_POST['dateTo'];
$srchquery = "SELECT sender_name,dest_country,income_or_outgo,goods_type,goods_quantity,goods_weight,delivery_charge,total_charge,track_id,booking_date,booked_by,assigned_to,menifested,consignment_status FROM tbl_consignment WHERE menifested=$cour_company_id AND booking_date >= '$dateFrom' AND booking_date  < '$dateTo'";
}else{
$srchquery = "SELECT sender_name,dest_country,income_or_outgo,goods_type,goods_quantity,goods_weight,delivery_charge,total_charge,track_id,booking_date,booked_by,assigned_to,menifested,consignment_status FROM tbl_consignment WHERE menifested=$cour_company_id";
}
    $i=0;
    $runsrchquery =  $Corpoclients->selectCorpoClient($srchquery);
if ($runsrchquery) { ?>
<div style="text-align:right;float: right;margin-top: -45px;" >
    <a href="princi_charges_given.php?principal_id=<?php echo $cour_company_id; ?>&namecourcomp=<?php echo $nameof_cour_comp; ?>" class="btn btn-green btn-sm text-right">
        See all the collections <i class="fa fa-arrow-circle-right"></i>
    </a>
    <a href="#courcompchargegiving" data-toggle="modal" class="btn btn-blue btn-sm text-right">
        Principal charge giving form <i class="fa fa-arrow-circle-right"></i>
    </a>
</div>
<div class="row">
    <div class="col-md-12">
        <hr>
        <!-- SUMMERY AREA  START-->
        <?php
        $query = "SELECT (SELECT COUNT(*) FROM tbl_consignment WHERE menifested=$cour_company_id) as total_consignment,(SELECT SUM(total_charge) FROM tbl_consignment WHERE menifested=$cour_company_id) as total_charges,(SELECT count(consignment_status) FROM tbl_consignment WHERE consignment_status=2 AND menifested=$cour_company_id) as deliv,(SELECT SUM(total_charge) FROM tbl_consignment WHERE menifested=$cour_company_id)-(SELECT SUM(menifested)  FROM tbl_consignment WHERE menifested=$cour_company_id) as totalsbalance";
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
        <table class="table table-hover cell-border" id="showprincidata">
            <!-- DATE RANGE SEARCH -->
            <div class="col-md-6 pull-right" style="padding-right: 0;">
                <div class="input-group input-daterange pull-right">
                    <form method="POST" id="daterangeform">
                        <div class="input-group-addon">From</div>
                        <input id="fromdate" type="date" name="fromdate" value="YYYY-MM-DD"/>
                        <div class="input-group-addon">to</div>
                        <input id="todate" type="date" name="todate" value="YYYY-MM-DD"/>
                        <a href="#" id="courcompdatewisesrchbtn" class="btn btn-danger"> Search</a>'
                    </form>
                </div><br><br><br>
            </div>
            <!-- DATE RANGE SEARCH END -->
            <thead>
                <tr>
                    <th>Srl</th>
                    <th>Track Id</th>
                    <th>Destination</th>
                    <th>Income or Outgo</th>
                    <th>Goods Type</th>
                    <th>Weight</th>
                    <th>Deliv Charge</th>
                    <th>Total Consignment Charge</th>
                    <th>Book Date</th>
                    <th>Booked By</th>
                    <th>Cons Status</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                $i=0;
                $total_deliv_charge = 0;
                if ($runsrchquery) { while ($getcorpoclient_cons_list=$runsrchquery->fetch_assoc()) { $i++; ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['track_id']; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['dest_country']; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['income_or_outgo']; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['goods_type']; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['goods_weight']; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['delivery_charge']; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['total_charge']; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['booking_date']; ?></td>
                    
                    <td><?php echo $getcorpoclient_cons_list['booked_by']; ?></td>
                    <td><?php echo $getcorpoclient_cons_list['consignment_status']; ?></td>
                </tr>
                <?php
                $total_deliv_charge += $getcorpoclient_cons_list['delivery_charge'];
                } ?>
                <tr>
                    <td>==</td><td></td><td></td><td></td><td></td><td></td><td>Total:<?php echo $total_deliv_charge; ?></td><td></td><td></td><td></td><td></td>
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

jQuery(document).ready(function( $ ) {
UIElements.init();
$('#courcompdatewisesrchbtn').on("click",function() {
    dateSearch();
});

function dateSearch(){
    var dateFrom = $("#fromdate").val();
    var dateTo = $("#todate").val();
    $.ajax({
    url: "get_cour_comp_cons_list.php",
    method: "POST",
    data:{action:'dateSearch',dateFrom:dateFrom,dateTo:dateTo,cour_company_id:'<?php echo $cour_company_id;?>',nameof_cour_comp:'<?php echo $nameof_cour_comp; ?>'},
    success: function(data) {
    $("#showclientprice").html(data);

    // getClientprices();
    // $("#clientpricesetmodal").modal("close");
    }
    })

}
// data table with pdf csv excel print copy
table = $('#showprincidata').DataTable({
paging: false,
info: false,
dom: 'Bfrtip',
buttons: [
'copy', 'csv', 'excel', 'pdf', 'print'
]
});




    // $('#showprincidata').DataTable( {
    // "scrollX": true,
    //     initComplete: function () {
    //         this.api().columns().every( function () {
    //             var column = this;
    //             var select = $('<select><option value=""></option></select>')
    //                 .appendTo( $(column.footer()).empty() )
    //                 .on( 'change', function () {
    //                     var val = $.fn.dataTable.util.escapeRegex(
    //                         $(this).val()
    //                     );
 
    //                     column
    //                         .search( val ? '^'+val+'$' : '', true, false )
    //                         .draw();
    //                 } );
 
    //             column.data().unique().sort().each( function ( d, j ) {
    //                 if(column.search() === '^'+d+'$'){
    //                     select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
    //                 } else {
    //                     select.append( '<option value="'+d+'">'+d+'</option>' )
    //                 }
    //             } );
    //         } );

    //     }

    // } );




});
</script>