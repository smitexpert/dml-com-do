<?php 
include('includes/header.php'); 

if (isset($_REQUEST['client_id'])) {
    if (empty($_REQUEST['client_id'] )) {
        header('Location:accounts_corporate.php');
    }else{
        $client_id = $_REQUEST['client_id'];
        $QUERY4 = "SELECT client_name,amount_collection,date FROM tbl_account_corporate WHERE client_id=$client_id AND client_type=2 ORDER BY id DESC";
        $corpotransactionhist = $Accounts->selectAccount($QUERY4);

    }

}

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
                                    TRANSACTION HISTORY OF CORPORRATE CLIENT 
                                </div>


                                <div class="panel-body table-responsive">


<!-- SERACH BY DATE BAR STARTS  -->
                                        <div class="row-fluid" id="datesearch">
                                            <!-- <input type="hidden" name="corpoclient_id" id="corpoclient_id" value="<?php //echo $corposenderid; ?>"> -->
                                            <div class="col-md-4"> <a href="account_single_principal.php?clientid=<?php echo $client_id ;?>">Back to Account page</a> </div>
                                            <div class="col-md-2">
                                                <span style="text-align: center;margin-top: 11px;float: left;color: #3ab766;">
                                                    SEARCH BY DATE
                                                </span>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <input name="min" id="min" type="text" data-select="datepicker" placeholder="From">
                                            <!--        <input type="text" class="form-control" placeholder="From" name="datefrom" id="datefrom" data-select="datepicker" >
                                                    <span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span> -->
                                                </div>
                                            </div>

                                                <div class="col-md-2">
                                                    <div class="input-group">
                                                        <input name="max" id="max" type="text" data-select="datepicker" placeholder="To">
                                                    <!-- <input type="text" class="form-control" placeholder="To" name="dateto" id="dateto" data-select="datepicker" >
                                                    <span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group text-left">
                                                    <a href="#" id="btnsrchbydate" class="btn-default btn">SEARCH</a></div>
                                                </div>
                                                
                                        </div><br><br><br>
                                        
<!-- SERACH BY DATE BAR ENDS  -->





<div class="tbl">

    </table><table width="100%" class="display" id="example" cellspacing="0">
        <thead>
            <tr>
                <th>Srl</th>
                <th>Client</th>
                <th>Collected Amount</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

<?php 
$i=0; 
$total_price = 0;
if ($corpotransactionhist) { while ($corpotranshistlist=$corpotransactionhist->fetch_assoc()) { $i++; ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $corpotranshistlist['client_name']; ?></td>
                <td><?php echo $corpotranshistlist['amount_collection']; ?></td>
                <td><?php echo $corpotranshistlist['date']; ?></td>
            </tr>    
<?php 
$total_price += $corpotranshistlist['amount_collection'];
} ?>
<tr>
<td>==</td><td style="text-align:right;">TOTAL =</td><td><?php echo "<h4>".$total_price."</h4>"; ?></td><td></td>
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
                var corpoclient_id = $('#corpoclient_id').val();
                if (corpoclient_id != '') {
                    var dateForm = $('#datefrom').val();
                    var dateTo = $('#dateto').val();

                    $.ajax({
                        url: 'ajaxdatedsrch.php',
                        type: 'POST',
                        data: {action: 'srchclientrecordbydata',corpoclient_id : corpoclient_id,dateForm : dateForm,dateTo : dateTo},
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
