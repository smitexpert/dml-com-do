<?php
include('includes/header.php');
// require __DIR__."/classes/Corporateclients.php";
// require __DIR__."/classes/Accounts.php";
$Corpoclients = new Corporateclients();
$Accounts = new Accounts();

//$insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);
 if(isset($_REQUEST['principal_id']) && isset($_REQUEST['namecourcomp'])) {

$principal_id = $_REQUEST['principal_id'];
$namecourcomp = $_REQUEST['namecourcomp'];

 }else{
// header('Location:accounts_principal.php');
 }


if (isset($_POST['dataesrchsubmit'])) {
    $dateFrom=$_POST['dateFrom'];
    $dateTo=$_POST['dateTo'];
    $srchquery = "SELECT * FROM tbl_account_principal WHERE client_id=$principal_id";
// $srchquery = "SELECT * FROM tbl_account_principal WHERE client_id=$principal_id AND cash_given_date >= '$dateFrom' AND cash_given_date  < '$dateTo'";
}else{
$srchquery = "SELECT * FROM tbl_account_principal WHERE client_id=$principal_id";
}



$i=0;
$runsrchquery = $Corpoclients->selectCorpoClient($srchquery);
if ($runsrchquery) { ?>


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
                    <h4 class="modal-title">Charge Given Form : <span style="color: orange;font-weight: bold" id="clnamemdelhead"></span></h4>
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
                                        <label class="control-label">Amount Given By<span class="symbol required"></span>
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
                            <label class="control-label">Money Reciept No.<span class="symbol required"></span>
                        </label>
                        <input type="text" name="money_rec_no" id="money_rec_no">
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
            <label class="control-label">Given Amount<span class="symbol required">*</span>
        </label>
        <input id="collected_amount" type="text" name="collected_amount" required >
    </div>
</div>
<div class="col-md-4">
    <div class="form-group connected-group">
        <label class="control-label">Giving Date<span class="symbol required">*</span>
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

<!-- start: PAGE -->
<div class="main-content">
<div class="container"><br><br><br>
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-external-link-square"></i>
History of Given charge to Principals
</div>
<div class="panel-body">
<h4>Given Charge History of : <span style="color:green"> <?php echo $namecourcomp; ?></span></h4>
<!-- SUMMERY AREA  START-->
<?php
$query = "SELECT (SELECT COUNT(*) FROM tbl_consignment WHERE sender_id=$principal_id) as total_consignment,(SELECT SUM(total_charge) FROM tbl_consignment WHERE sender_id=$principal_id) as total_charges,(SELECT count(consignment_status) FROM tbl_consignment WHERE consignment_status=2 AND sender_id=$principal_id) as deliv,(SELECT SUM(total_charge) FROM tbl_consignment WHERE sender_id=$principal_id)-(SELECT SUM(menifested)  FROM tbl_consignment WHERE sender_id=$principal_id) as totalsbalance";
$selectaccount = $Accounts->selectAccount($query);
$res = $selectaccount->fetch_assoc();
?>
<br>
<div class="row">
<div class="col-md-12">
    <table class="table table-hover cell-border" id="showclienttbl" style="overflow: scroll;">
        <div class="row">
            <div class="col-md-6" style="">
                <a href="#responsive" data-toggle="modal" class="btn btn-blue btn-sm text-right">
                    Amount Collection entry form <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
            <!-- DATE RANGE SEARCH -->
            <div class="col-md-6" style="padding-right: 0;">
                <div class="input-group input-daterange pull-right">
                    <form method="POST" action="princi_charges_given.php?principal_id=<?php echo $principal_id; ?>&namecourcomp=<?php echo $namecourcomp; ?>" id="daterangeform">
                        <div class="input-group-addon">From</div>
                        <input id="dateFrom" type="date" name="dateFrom" value="YYYY-MM-DD"/>
                        <div class="input-group-addon">to</div>
                        <input id="dateTo" type="date" name="dateTo" value="YYYY-MM-DD"/>
                        <!-- <a href="#" id="daterangfrmbtn" class="btn btn-danger"> Search</a> -->
                        <input type="submit" name="dataesrchsubmit" class="btn btn-danger">
                    </form>
                </div><br><br><br>
            </div>
        </div>
        <!-- DATE RANGE SEARCH END -->
        <thead>
            <tr>
                <th>Srl</th>
                <th>Collected By</th>
                <th>Given Amount</th>
                <th>Bank</th>
                <th>Acc No.</th>
                <th>Check No.</th>
                <th>Cash Giver</th>
                <th>Cash Reciever</th>
                <th>Money Reciept No.</th>
                <th>Amont giving date</th>
                <th>Entry Date</th>
            </tr>
        </thead>
        <tbody class="table-striped">
            
            <?php
            $i=0;
            $total_amount = 0;
            if ($runsrchquery) { while ($getcorpoclient_cons_list=$runsrchquery->fetch_assoc()) { $i++; ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $getcorpoclient_cons_list['amount_collected_by']; ?></td>
                <td><?php echo $getcorpoclient_cons_list['amount_collection']; ?></td>
                <td><?php echo $getcorpoclient_cons_list['bank_name']; ?></td>
                <td><?php echo $getcorpoclient_cons_list['account_number']; ?></td>
                <td><?php echo $getcorpoclient_cons_list['check_number']; ?></td>
                <td><?php echo $getcorpoclient_cons_list['cash_giver']; ?></td>
                <td><?php echo $getcorpoclient_cons_list['cash_reciever']; ?></td>
                <td><?php echo $getcorpoclient_cons_list['money_rec_no']; ?></td>
                  <td><?php echo $getcorpoclient_cons_list['cash_given_date']; ?></td>
                <td><?php echo $getcorpoclient_cons_list['entry_date']; ?></td>
            </tr>
            <?php
            $total_amount += $getcorpoclient_cons_list['amount_collection'];
            } ?>
            <tr>
                <td>==</td><td>TOTAL =</td><td><?php echo "<h4>".$total_amount."</h4>"; ?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
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
</div>
</div>
<!-- <div class="col-md-1"></div> -->
</div>
</div>
</div>
</div>
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
</div>
<?php include('includes/footer.php'); ?>
<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
UIElements.init();

// data table with pdf csv excel print copy
table = $('#showclienttbl').DataTable({
  paging: false,
  info: false,
   dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
});
$(function() {
// DYNAMIC FIELD CHANGE CODE end
function bankfunc(){
$('#bank_inputs').show();
$("#bank_name").prop('required',true);
$("#account_number").prop('required',true);
$("#check_number").prop('required',true);
$("#cash_giver").prop('required',false);
$("#cash_reciever").prop('required',false);
$("#money_rec_no").prop('required',false);
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
$("#money_rec_no").prop('required',true);
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
var corp_clientid = <?php echo $principal_id; ?>;
var nameofclient= '<?php echo $namecourcomp; ?>';

var collection_type = $('#collected_by').val();
var bank_name  =$('#bank_name').val();
var account_number  =$('#account_number').val();
var check_number  =$('#check_number').val();
var cash_giver  =$('#cash_giver').val();
var cash_reciever  =$('#cash_reciever').val();
var collected_amount = $('#collected_amount').val();
var money_rec_no = $('#money_rec_no').val();
var collection_date = $('#collection_date').val();
$.ajax({
type: 'post',
url: 'Principalchargegiving.php',
data: {action:'Principalchargegiving',corp_clientid:corp_clientid,nameofclient:nameofclient,collection_type:collection_type,bank_name:bank_name,account_number:account_number,check_number:check_number,cash_giver:cash_giver,cash_reciever:cash_reciever,collected_amount:collected_amount,money_rec_no:money_rec_no,collection_date:collection_date},
success: function (data) {
alert(data);
location.reload();
$("#bank_name").val('') ;
$("#account_number").val('') ;
$("#check_number" ).val('');
$("#cash_giver ").val('');
$("#cash_reciever").val('') ;
$("#collected_amount").val('') ;
$("#money_rec_no").val('') ;
$("#collection_date").val('') ;
}
});
});
// INSERT CASH COLLECTION
$("#cour_company").change(function(){
event.preventDefault();
getClientprices();
});
function getClientprices(){
var cour_company_id = $("#cour_company").val();
var nameof_cour_comp= $('#cour_company option:selected').html();
$("#cour_company_id").val(cour_company_id);
$("#corp_client").html(nameof_cour_comp);
$("#corcompnamehead").html(nameof_cour_comp);

$.ajax({
url:"get_cour_comp_cons_list.php",
method:"POST",
data:{action:'getcourcompcons',cour_company_id:cour_company_id,nameof_cour_comp:nameof_cour_comp},
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



//DATE RANGE SEARCH
$('#courcompdatewisesrchbtn').on("click",function() {
    dateSearch();
});

function dateSearch(){
    var dateFrom = $("#dateFrom").val();
    var dateTo = $("#dateTo").val();
    $.ajax({
    url: "princi_charges_given.php",
    method: "POST",
    data:{action:'dateSearch',dateFrom:dateFrom,dateTo:dateTo,principal_id:'<?php echo $principal_id;?>',namecourcomp:'<?php echo $namecourcomp; ?>'},
    success: function(data) {
    $("#showclientprice").html(data);


    // getClientprices();
    // $("#clientpricesetmodal").modal("close");
    }
    })

}

});
</script>
<style type="text/css">
.genpricehead,#showclienttbl thead{
background: #fbd200;
}
</style>