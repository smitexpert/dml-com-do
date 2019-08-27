<?php include('includes/header.php'); 
error_reporting(E_ALL);
/*if (isset($_POST['submit'])) {
$createStuffs = $Stuffset->insertStuff($_POST);
}*/

$getUserId = new Database();

$db = new Database();

// Designation Query Start

$designationQuery = "SELECT * FROM user_rule WHERE status=1";
    
$ruleResult = $db->select($designationQuery);

$query = "SELECT id FROM user ORDER BY id DESC LIMIT 1";

$result = $getUserId->select($query);

while($row = $result->fetch_assoc()){
    $lastId = $row['id']+1;
}

$yearMonth = date('y').date('m');

if($lastId <= 9){
    $lastId = '0'.$lastId;
}


// Designation Query End


/*
$dashboardMenuQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='dashboard'";
$dashboardMenuCount = $db->count($dashboardMenuQuery);


$creationMenuQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='creation-area'";
$creationMenuCount = $db->count($creationMenuQuery);

*/



?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>

            <form action="#" role="form" id="staff_form" method="POST">
                <div class="row">
                   <div class="col-md-1"></div>
                    <div class="col-md-10">

                        <div class="panel panel-default">
                            <div class="panel-heading bdOrange">
                                CREATE STUFF LIST
                            </div>


                            <div class="panel-body">
                                <?php if (isset($msg)) {
	echo $msg;
} ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userid" class="control-label">
                                                User ID <span class="symbol required"></span>
                                            </label>
                                            <input type="text" required class="form-control" name="staffRegId" id="userid" value="<?php echo $yearMonth.$lastId; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                Name <span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" name="userRegName" id="userRegName" value="" required>
                                        </div>
                                    </div>

                                </div>



                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="usermail" class="control-label">
                                                Email <span class="symbol required"></span>
                                            </label>
                                            <input type="email" class="form-control" name="usermail" id="usermail" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address" class="control-label">
                                                Address <span class="symbol required"></span>
                                            </label>
                                            <input type="text" name="address" id="address" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Contact One <span class="symbol required"></span>
                                            </label>
                                            <input type="number" required class="form-control" name="contactOne" id="stuffcontact1" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Contact Two <span class="symbol"></span>
                                            </label>
                                            <input type="number" class="form-control" name="contactTwo" id="stuffcontact2" value="">
                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group connected-group">
                                            <label class="control-label">Create Password <span class="symbol required"></span>
                                            </label>
                                            <input type="Password" name="stuffPassword" id="userPassword" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Rule <span class="symbol required"></span>
                                            </label>
                                            <select name="stuffRole" id="stuffRole" class="form-control" required>
                                                <option value="">Select Rule</option>
                                                <?php
             while($ruleRow = $ruleResult->fetch_assoc()){
                 
                 if($ruleRow['ruleId'] != 1)
                 {
                 ?>

                                                <option value="<?php echo $ruleRow['ruleId']; ?>"><?php echo $ruleRow['ruleName']; ?></option>
                                                <?php
                     }
             }
            ?>


                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Status <span class="symbol required"></span>
                                            </label>
                                            <select name="userStatus" id="stuffStatus" class="form-control" required>
                                                <option value="1">Publish</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                </div><br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group connected-group">
                                            <input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="submit">
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </form>



            <?php 

	$query = "SELECT * FROM  tbl_stuff WHERE stuff_status=1";
    $selectcourcom = $Courcompanyset->selectcourComp($query);

?>



            
        </div>
    </div>

</div>



<?php 
include('includes/footer.php');
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {

        // data table with pdf csv excel print copy
        table = $('#stufftbl').DataTable({

            // paging: false,
            // info: false,
            //  dom: 'Bfrtip',
            //       buttons: [
            //           'copy', 'csv', 'excel', 'pdf', 'print'
            //       ]
        });


    })

</script>
