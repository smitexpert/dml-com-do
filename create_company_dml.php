<?php include('includes/header.php'); 


$sql = "SELECT id FROM corporate_company ORDER BY id DESC LIMIT 1";
$query = $db->link->query($sql);
if($query->num_rows > 0){
    $row = $query->fetch_assoc();
    $last_id = $row['id'];
    $last_id++;
}else{
    $last_id = 1;
}


$agent_id = "SM".sprintf("%06d", $last_id);
	
if (isset($_POST['submit'])) {
    
    $client_name = $_POST['client_name'];
    $client_company = $_POST['client_company'];
    $client_mail = $_POST['client_mail'];
    $client_contact = $_POST['client_contact'];
    $client_addr = $_POST['client_addr'];
    $corpoAssignTo = $_POST['corpoAssignTo'];
    $created_by = Session::get('adminId');
    
    $insert = "INSERT INTO corporate_company (company_id, name, company_name, email, contact, address, assign_to, created_by) VALUES ('$agent_id', '$client_name', '$client_company', '$client_mail', '$client_contact', '$client_addr', '$corpoAssignTo', '$created_by')";
    $query = $db->link->query($insert);
    
    if($query){
        header("location: ".$_SERVER['PHP_SELF']."?success=true&company=".$client_company);
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
                            CREATE CORPORATE COMPANY
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form" id="fcorpo_orm" method="POST">
                                <div class="row">
                                <div class="col-md-12">
                                        
                                    <?php 
                                        if(isset($_GET['success'])){
                                            if($_GET['success'] == 'true'){
                                                ?>
                                    <div class="successHandler alert alert-success">
                                        <i class="fa fa-ok"></i> The Company <b><?php echo $_GET['company']; ?></b>  Successfully Created!!!
                                    </div>
                                                <?php
                                            }else{
                                                ?>
                                                <div class="errorHandler alert alert-danger">
                                                    <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>

                                    <div class="row-fluid">
                                        <div class="col-md-12">
                                            <?php 
													if (isset($insertCorpoClient)) { ?>
                                            <div class="alert alert-info fade in">
                                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                <strong>
                                                    <?php echo $insertCorpoClient; ?>
                                                </strong>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Company ID <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" id="company_id" name="company_id" value="<?php echo $agent_id; ?>" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Company Name<span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" id="client_company" name="client_company" required>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Chairman / Managing Director<span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" id="client_name" name="client_name">
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Email Address <span class="symbol required"></span>
                                                    </label>
                                                    <input class="form-control" type="email" required id="client_mail" name="client_mail">
                                                </div>


                                                

                                            </div>
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Contact <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" name="client_contact" id="client_contact">
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Address <span class="symbol required"></span>
                                                    </label>
                                                    <input type="textarea" required class="form-control" id="client_addr" name="client_addr">
                                                </div>

                                                <div class="form-group connected-group">
                                                    <label class="control-label">Assign to :<span class="symbol required"></span>
                                                    </label>
                                                    <select name="corpoAssignTo" id="corpoAssignTo" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                        <option value="">--</option>
                                                        <?php 
            $query2 = "SELECT * FROM user WHERE status=1 AND rule != 1";
            $selectstuff = $db->link->query($query2);
            if ($selectstuff) { while ($getstuff=$selectstuff->fetch_assoc()) { ?>
                                                        <option value="<?php echo $getstuff['userId']; ?>"><?php echo $getstuff['name']; ?></option>
                                                        <?php } }else{} ?>

                                                    </select>
                                                </div><br>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="submit">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
                <div class="col-md-1"></div>
            </div>
            
            
            
        </div>
        <!-- end: PAGE -->


    </div>
    <!-- end: MAIN CONTAINER -->


    <?php 
include('includes/footer.php');
?>
