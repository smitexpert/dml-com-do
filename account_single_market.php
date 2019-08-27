<?php 
include('includes/header.php'); 

if (isset($_REQUEST['booked_by']) && isset($_REQUEST['stuff_name'])) {
    if (empty($_REQUEST['booked_by'] ) && empty($_REQUEST['stuff_name'])) {
        header('Location:accounts_stuff_market.php');
    }else{
       $stuff_name = $_REQUEST['stuff_name'];
        $booked_by = $_REQUEST['booked_by'];
        $query = "SELECT sender_name,dest_country,income_or_outgo,goods_type,goods_quantity,goods_weight,CorpoClientPrice,total_charge,menifested,track_id,booking_date,booked_by,assigned_to,consignment_status FROM tbl_consignment WHERE booked_by=$booked_by";
        $get_marketer_date = $Accounts->selectAccount($query);

    }

}else{
     header('Location:accounts_stuff_market.php');
}

//$query = "SELECT c.sender_id,c.sender_name,sum(DISTINCT c.goods_quantity) AS clnttotlagoods,sum(DISTINCT c.goods_weight) AS clnttotalweight,sum(DISTINCT c.total_charge) AS clienttotalamount,c.menifested, p.cour_comp_id,p.cour_comp_name FROM tbl_consignment as c ,tbl_courier_companies AS p WHERE c.menifested !='' AND c.menifested = p.cour_comp_id GROUP BY menifesteD";
//$selectprinciinfo = $Accounts->selectAccount($query);

?>




        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
<?php include('includes/sidebar-menu.php'); ?>
            <!-- start: PAGE -->
            <div class="main-content">
                <!-- end: SPANEL CONFIGURATION MODAL FORM -->
                <div class="container"><br><br><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-external-link-square"></i>
                                    CONSIGNMENT HISTORY OF CORPORRATE CLIENT 
                                </div>


                                <div class="panel-body table-responsive">

                                    <br> 
                                    <div style="width: 60%;margin: 0 auto;text-align:center;">
                                       <span>ACCOUNT SUMMERY OF  : </span> 
                                       <span style="font-size: 22px;color: green;text-transform: uppercase;">

                                        <?php
                                         echo $stuff_name;  
                                         ?>
                                            
                                        </span>
                                       
                                    </div>
                                    <br>

<?php 
// $query2 = "SELECT menifested,sender_name,assigned_to,sum(total_charge) as client_total_charge,menifested FROM tbl_consignment WHERE menifested=$booked_by AND sender_type=2";
// $corpoclient_info = $Accounts->selectAccount($query2);
// $getcorpoclient_info=$corpoclient_info->fetch_assoc();
// $booked_by;
// $sender_type=2;
// $sender_name = $getcorpoclient_info['sender_name'];
// $total_cons_charg=$getcorpoclient_info['client_total_charge'];

//insert collection
if (isset($_POST['submit'])) {
$insertcorocollection = $Accounts->coropoCollectioninsert($formdata=array($_POST,$stuff_name,$booked_by));
}

?>




<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <?php 
        if (isset($insertcorocollection)) { 
           header('Location:account_single_principal.php?booked_by='.$booked_by.'&&msg=Entry Successfull'); 
    } 

    if (isset($_REQUEST['msg'])) { ?>
            <div class="alert alert-info fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $_REQUEST['msg']; ?></strong>
            </div>
    <?php } ?>
</div>
<div class="col-md-2"></div>
</div>


<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width" cellspacing="0">
          <tr>
            <th></th>
            <th></th> 
          </tr>
          <tr>
            <td>TOTAL AMOUNT : </td>
            <td>
        <?php 
            $query2 = "SELECT sum(total_charge) as principal_total_charge,menifested FROM tbl_consignment WHERE menifested=$booked_by";
            $principal_info = $Accounts->selectAccount($query2);
            $get_princi_ifo=$principal_info->fetch_assoc();
            echo $get_princi_ifo['principal_total_charge'];
        ?>
                 
             </td> 
          </tr>       
           <tr>

<?php 
// GET DATA FROM CORPO ACCOUNT TABLE
$query3 = "SELECT principal_id,principal_name,sum(ammount_collection) as principal_total_caollection,max(date) as lastcollection FROM tbl_account_principal WHERE principal_id=$booked_by";
$princi_acc_history = $Accounts->selectAccount($query3);
$get_princi_acc_history=$princi_acc_history->fetch_assoc();
 ?>


            <td>   
                <span>Total Collection : </span>  <br>   
                
            </td>             

            <td>   
              <?php echo $totalcollection = $get_princi_acc_history['principal_total_caollection']; ?> 
            </td> 
          </tr>
          <tr>
            <td>Now Payable</td>
            <td><?php if (isset($get_princi_ifo) && isset($totalcollection)) {
                echo $get_princi_ifo - $totalcollection; 
            }else{
                 echo $get_princi_ifo['principal_total_charge'];
            } ?></td> 
          </tr> 
          <tr>
            <td>  
                <form method="POST" action="account_single_principal.php?booked_by=<?php echo $booked_by; ?>">
                    <span><input type="text" name="collection" placeholder="collected amount entry"></span>
                    <input type="submit" name="submit" value="submit">
                </form>
            </td>
          </tr> 

        <tr>
            <td>

<?php 
// GET DATA FROM CORPO ACCOUNT TABLE
$QUERY4 = "SELECT ammount_collection,date FROM tbl_account_principal WHERE principal_id=$booked_by  ORDER BY id DESC";
$lastdata = $Accounts->selectAccount($QUERY4);
if ($lastdata) {
   $get_princi_last_data=$lastdata->fetch_assoc();
   echo "Last Collected Amount :".$get_princi_last_data['ammount_collection']."<br>"; 
    echo "Last Collection Date :".$get_princi_last_data['date']."<br>";
}else{
    echo "Last Collected Amount : No Amount Collected yet"."<br>"; 
    echo "Last Collection Date : No Date found"."<br>"; 
}

 
?> 

            <a href="all_transaction_principal.php?client_id=<?php echo $booked_by ?>">See Transaction History</a>
            </td>
        </tr>

        </table>

    </div>
   <div class="col-md-2"></div>
</div><br>

<!-- <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">

    </div>
   <div class="col-md-2"></div>
</div><br> -->



<hr>









<!-- SERACH BY DATE BAR STARTS  -->


    <div class="row">
        <div class="col-md-10">
            <form method="POST" action="">
                <input type="hidden" name="corpoclientid" id="corpoclientid" value="<?php echo $booked_by; ?>">

                <div class="input-group">
                <h5>Search by Date</h5>
                <input name="min" id="min" type="text" data-select="datepicker" placeholder="From">
                <input name="max" id="max" type="text" data-select="datepicker" placeholder="To">
                <a href="#" id="btnsrchbydate" class="btn-primary btn btn-small" style="margin-left: 11px;">SEARCH</a>
                </div>   
            </form>  <br>
        </div>    
        <div class="col-md-2">
        </div>    
    </div>

                               
<!-- SERACH BY DATE BAR ENDS  -->


    <div class="row">
        <div class="col-md-12">
            

                    <div class="tbl">

                        <table width="100%" class="display" id="example" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Srl</th>
                                        <th>Tracking Id</th>
                                        <th>Destination</th>
                                        <th>Income or Outgo</th>
                                        <th>Goods Type</th>
                                        <th>Weight</th>
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
                        if ($get_marketer_date) { while ($getfinal_marketer_data=$get_marketer_date->fetch_assoc()) { $i++; ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $getfinal_marketer_data['track_id']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['dest_country']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['income_or_outgo']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['goods_type']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['goods_weight']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['total_charge']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['booking_date']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['menifested']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['booked_by']; ?></td>
                                        <td><?php echo $getfinal_marketer_data['consignment_status']; ?></td>
                                    </tr>    
                        <?php 
                        $total_price += $getfinal_marketer_data['total_charge'];
                        } ?>
                        <tr>
                        <td>==</td><td></td><td></td><td></td><td></td><td>TOTAL =</td><td><?php echo "<h4>".$total_price."</h4>"; ?></td><td></td><td></td><td></td><td></td>
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
    </div>







                            </div>


                            </div>
                            <!-- end: FORM VALIDATION 1 PANEL -->
                        </div>



                    <!-- end: PAGE CONTENT-->
                </div>
            </div>
            <!-- end: PAGE -->


        </div>
        <!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>

<script type="text/javascript">
$(document).ready(function(){
    $('#singleaccounttble').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 8)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        }
    } );

// SEARCH BY DATE STARTS ####################################################

        $('#btnsrchbydate').on('click', function(event) {
            event.preventDefault();
            srchcorpoclientrecord();
        });

        function srchcorpoclientrecord(){
                var corpoclientid = $('#corpoclientid').val();
                if (corpoclientid != '') {
                    var dateForm = $('#datefrom').val();
                    var dateTo = $('#dateto').val();

                    $.ajax({
                        url: 'ajaxdatedsrch.php',
                        type: 'POST',
                        data: {action: 'srchclientrecordbydata',corpoclientid : corpoclientid,dateForm : dateForm,dateTo : dateTo},
                    })
                    .done(function(data) {
                        $("#loader").hide();
                        $('#showdatesrchres').html(data);
                        $("#datesearch").show();
                    })
                    .fail(function() {

                    })
                    .always(function() {

                    });

                }else{alert('cant search');}

                }

        $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[4]);
            if (min == null && max == null) { return true; }
            if (min == null && startDate <= max) { return true;}
            if(max == null && startDate >= min) {return true;}
            if (startDate <= max && startDate >= min) { return true; }
            return false;
        }
        );
            $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true },{ dateFormat: 'yy-mm-dd' });
            $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true },{ dateFormat: 'yy-mm-dd' });
            var table = $('#example').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });





})


</script>
