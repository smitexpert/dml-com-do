
<?php 

require __DIR__."/classes/Courcompanyset.php";
$Courcompanyset = new Courcompanyset();
//$insertCoropprice =  $Corpoclients->insertCorpoPrice($_POST);


// if ($_POST['action']=='getprincidata') {
// 	if (isset($_POST['cour_comp'])) {
// 	$cour_comp=$_POST['cour_comp'];


//SEARCH PRICE BY UNIT AND COUNTRY

if ($_POST['action'] == 'getprincipalComparison') {

$route_code2 = $_POST['route_code2'];
$income_or_outgo2 = $_POST['income_or_outgo2'];
$goods_type2 = $_POST['goods_type2'];
$unit2 = $_POST['unit2'];

?>

						<div class="col-md-12">
							<table class="table table-striped table-bordered table-hover table-full-width" id="showcomptbl">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Company Name</th>
												<th>Zone</th>
												<th>Country</th>
												<th>Where</th>
												<th>Goods Type</th>
												<th>Unit</th>
												<th>Price</th>
												<th>status</th>
												
											</tr>
										</thead>
							<?php
								if(!empty($route_code2) && !empty($income_or_outgo2) && !empty($goods_type2) && !empty($unit2)){

								$query = "SELECT p.*,r.cour_comp_name FROM tbl_principal_price as p,tbl_courier_companies as r WHERE p.cour_company = r.cour_comp_id AND p.route_code=$route_code2 AND p.income_or_outgo='$income_or_outgo2' AND p.goods_type='$goods_type2' AND p.unit=$unit2 ORDER BY price ASC";
								if ($query) {
									$selectcourcomp = $Courcompanyset->selectcourComp($query);
									if ($selectcourcomp) {?> 
	
									   <?php $i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcourcomp['cour_comp_name']; ?></td>
												<td><?php echo $getcourcomp['route_code']; ?></td>
												<td><?php //echo $getcourcomp['country_name']; ?></td>
												<td><?php echo $getcourcomp['income_or_outgo']; ?></td>
												<td><?php echo $getcourcomp['goods_type']; ?></td>
												<td><?php echo $getcourcomp['unit']; ?></td>
												<td><?php echo $getcourcomp['price']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['status']; ?></td>
												
											</tr>
										 <?php } } else{ echo "no data found";} }else{ echo "something wrong"; } }elseif(empty($cour_comp)){echo " please select Courrier compmany";}elseif(empty($unit3)){echo "select unit";} elseif(empty($cntry3)){ echo "please select country"; }else{ echo "please select options to search"; } ?>
									</table>
							</div>

<?php } ?>

<style type="text/css">
.dataTables_filter label {
    top: 3px !important;
}
</style>

<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
UIElements.init();


// data table with pdf csv excel print copy
table = $('#showcomptbl').DataTable({

  paging: false,
  info: false,
   dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
});
})


</script>