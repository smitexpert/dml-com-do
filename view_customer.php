<?php include('includes/header.php'); 
	
if (isset($_POST['submit'])) {
    
    $client_name = $_POST['client_name'];
    $client_company = $_POST['client_company'];
    $client_mail = $_POST['client_mail'];
    $client_contact = $_POST['client_contact'];
    $client_addr = $_POST['client_addr'];
    $corpoAssignTo = $_POST['corpoAssignTo'];
    $created_by = Session::get('adminId');
    
    $insert = "INSERT INTO corporate_company (name, company_name, email, contact, address, assign_to, created_by) VALUES ('$client_name', '$client_company', '$client_mail', '$client_contact', '$client_addr', '$corpoAssignTo', '$created_by')";
    $query = $db->link->query($insert);
    
    if($query){
        header("location: ".$_SERVER['PHP_SELF']."?success=true");
    }else{
        header("location: ".$_SERVER['PHP_SELF']."?success=false");
    }
    
}




?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            
            <div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									CORPORATE COMPANY LIST
								</div>

								<div class="panel-body">
								
									<table class="table table-striped table-bordered table-hover table-full-width" id="weighttbl">
										
										<thead>
											<tr>
												<th class="center">#</th>
												<th>COMPANY NAME</th>
												<th>CONTACT</th>
												<th>ASSIGN TO</th>
												<th></th>
											</tr>
										</thead>
										
										<tbody>

									   <?php 
                                            $sql = "SELECT * FROM corporate_company";
                                            $rlt = $db->link->query($sql);
                                            
                                            $i=1;
                                            
                                            while($row = $rlt->fetch_assoc()){
                                        ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $row['company_name']; ?></td>
												<td><?php echo $row['contact']; ?></td>
												<td><?php echo $db->getUserName($row['assign_to']); ?></td>
												<td></td>
											</tr>
										 <?php 
                                            $i++;
                                            }
                                            
                                        ?> 

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
							<!-- end: FORM VALIDATION 1 PANEL -->
					</div>
            
        </div>
        <!-- end: PAGE -->


    </div>
    <!-- end: MAIN CONTAINER -->


    <?php 
include('includes/footer.php');
?>

