<script type="text/javascript">
jQuery(document).ready(function($) {
//table for pricncipal price srch of search_principal_price.php
//$('#principricetable').DataTable();


    $('#princishowbyweightable').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
column.data().unique().sort().each( function ( d, j ) {
    if(column.search() === '^'+d+'$'){
        select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
    } else {
        select.append( '<option value="'+d+'">'+d+'</option>' )
    }
} );
            } );
        }
    } );


});
</script>




<?php

ob_start();
require __DIR__."/classes/Courcompanyset.php";
$Courcompanyset = new Courcompanyset();



######## srch_principrice_by_weight page serach ##############

if ($_POST['action'] == 'showdaintablebyweight') { ?>


<table class="table table-striped table-bordered table-hover table-full-width" id="princishowbyweightable">
	<thead>
		<tr>
<?php 
$srcquery	 = "SELECT p.*,c.cour_comp_name FROM `tbl_principal_price` as p,tbl_courier_companies as c GROUP BY unit LIMIT 20";
$runsrcquery = $Courcompanyset->selectcourComp($srcquery);
				if ($runsrcquery != ""){ 
					$i=1;
					while($getsrcdata = $runsrcquery->fetch_assoc()){?>

			<th class="center">#</th>
			<th><?php echo $units = $getsrcdata['unit']; ?></th>
<?php 
$srcquery2	 = "SELECT p.*,c.cour_comp_name FROM `tbl_principal_price` as p,tbl_courier_companies as c WHERE unit=$units LIMIT 20";
$runsrcquery2 = $Courcompanyset->selectcourComp($srcquery2);
while($getsrcdata2 = $runsrcquery2->fetch_assoc()){
 ?>
<tr>
	

<?php
echo "<td>". $getsrcdata['cour_comp_name']."</td>";
echo "<td> ". $getsrcdata['route_code']."</td>";
echo "<td>". $getsrcdata['price']."</td>";
echo "</tr>";

}


 } }?>
		</tr>
	</thead>
	<tbody>

<?php
			// $routequery = "SELECT route_code,cntry_id FROM `tbl_cour_comp_route`";
			// $runroutequery = $Courcompanyset->selectcourComp($routequery);
			// if ($runroutequery == ""){ echo "route and county not found for this contry"; }else{
			// $getroute = $runroutequery->fetch_assoc();
			// //echo "route found from route table : <br>" .
			// $route = $getroute['route_code'];
			//echo "cntry from route table : <br>" .
			//$rescountry = $getroute['cntry_id'];
			//SEARCH ROUTE OR COUNTRY WHICH IS  AVAILABLE IN PRINCIPAL PRICE TABLE

				if ($runsrcquery != ""){ 
					$i=1;
					while($getsrcdata = $runsrcquery->fetch_assoc()){?> 
<div class="showpriceweight">
<ul class="topul">
<li class="unit">
	<span> UNIT : <?php echo $getsrcdata['unit']; ?><span>
</li>
</ul>

<ul class="bottomul">
	<li>COMPANY : <?php echo $getsrcdata['cour_comp_name']; ?></li>
	<li>ROUTE : <?php echo $getsrcdata['route_code']; ?></li>
	<li>PRICE : <?php echo $getsrcdata['price']; ?></li>
</ul>
</div>	
 



				<tr>
					<td><?php echo $i++; ?></td>
					 <td><?php // echo $getsrcdata['']; ?></td>
					<td><?php //echo $getsrcdata['']; ?></td>
					<!-- <td><?php //echo $getsrcdata['country_id']; ?></td> -->
					<td><?php echo $getsrcdata['income_or_outgo']; ?></td>
					<td><?php echo $getsrcdata['goods_type']; ?></td>
					<td></td>
					<td></td>
					<td class="center">
					<div class="visible-md visible-lg hidden-sm hidden-xs">
						<a href="#" editdata="<?php echo $getsrcdata['id']; ?>" class="btn btn-xs btn-teal tooltips editactionbtn" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
						<a href="#" class="btn btn-xs btn-bricky tooltips delactionbtn"  deldata = "<?php echo $getsrcdata['id']; ?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
					</div>
					</td>
				</tr>
					<!-- $output = array("price" => $getsrcdata['price'],"unit" => $getsrcdata['unit']);
					ob_clean();
					echo json_encode($output); -->
					<?php }
				}else{
					//$srcquery2	 = "SELECT p.*,c.cour_comp_name FROM `tbl_principal_price` as p,tbl_courier_companies as c LIMIT 5";
					$srcquery2 = "select * FROM tbl_principal_price where unit=(select weight from tbl_principal_price where unit='3.00') limt 4";
					$runsrcquery = $Courcompanyset->selectcourComp($srcquery2);	
					$i=1;
					while($getsrcdata = $runsrcquery->fetch_assoc()){?> 
				<tr>
					<td><?php echo $i++; ?></td>
					 <td><?php echo $getsrcdata['cour_comp_name']; ?></td>
					<td><?php echo $getsrcdata['route_code']; ?></td>
					<!-- <td><?php //echo $getsrcdata['country_id']; ?></td> -->
					<td><?php echo $getsrcdata['income_or_outgo']; ?></td>
					<td><?php echo $getsrcdata['goods_type']; ?></td>
					<td><?php echo $getsrcdata['unit']; ?></td>
					<ul><li><?php  ?></li></ul>
					<td><?php echo $getsrcdata['price']; ?></td>
					<td class="center">
					<div class="visible-md visible-lg hidden-sm hidden-xs">
						<a href="#" editdata="<?php echo $getsrcdata['id']; ?>" class="btn btn-xs btn-teal tooltips editactionbtn" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
						<a href="#" class="btn btn-xs btn-bricky tooltips delactionbtn" deldata = "<?php echo $getsrcdata['id']; ?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
					</div>
					</td>
				</tr>
					<!-- $output = array("price" => $getsrcdata['price'],"unit" => $getsrcdata['unit']);
					ob_clean();
					echo json_encode($output); -->
					<?php }
					}
			
		
}?> 								
	</tbody>
	        <tfoot>
            <tr>
			<th></th>
			<th width="19%"></th>
			<th width="11%"></th>
			<th></th>
			<th width="14.4%"> </th>
			<th></th>
			<th></th>
			<th></th>
            </tr>
        </tfoot>
</table>
<?php 									
exit();


######## srch_principrice_by_weight page serach ends ##############