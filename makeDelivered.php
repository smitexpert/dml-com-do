<?php 
	include('includes/header.php'); 
	
	if (isset($_REQUEST['consid'])) {

		$consid = $_REQUEST['consid'];
		$runupdateq = $Consignment->makedelivered($consid);
	}else{
		header('Location:consignment_list.php');
	}
	

?>
