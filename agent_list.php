<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM  agent_clients order by id desc";
    $result = $db->link->query($query);
    
?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->


            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            AGENT CLIENT SETTINGS
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-full-width" id="couriertbl">

                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th class="center">Name of Agent</th>
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i=0; if ($result->num_rows > 0) {
                                                while($row=$result->fetch_assoc()) { $i++;
                                                    $status = $row['status'];
                                                                                    if($status == 1)
                                                                                        $sta = 'btn-green';
                                                                                    else
                                                                                        $sta = 'btn-red';
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td><?php echo $row['company_name']; ?></td>
                                        
                                        <td class="center">
                                            <div class="">
                                                <button id="assign-<?php echo $row['id']; ?>" class="btn btn-xs btn-warning agent_edit_btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i></button>
                                                
                                                <button id="status_<?php echo $row['id']; ?>" class="btn btn-xs <?php echo $sta; ?> status_btn"><i class="fa fa-circle "></i></button>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php } }else{ echo "Data not found";} ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>
        </div>
    </div>
    <!-- end: PAGE -->
    <div class="modal modal-dialog fade" id="myModal" role="dialog" tabindex="-1" aria-hidden="true">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Assign Principal</h4>
            </div>
            <div class="modal-body">
               <input type="hidden" id="agent_id" value="">
                <table class="table  table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Principals Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="principal_list">
                        <tr>
                            <td>1</td>
                            <td>Name</td>
                            <td class="text-center"><button class="btn btn-xs btn-green"><i class="fa fa-check"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>


</div>

<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        UIElements.init();


        // data table with pdf csv excel print copy
        table = $('#couriertbl').DataTable({

            // paging: false,
            // info: false,
            //  dom: 'Bfrtip',
            //       buttons: [
            //           'copy', 'csv', 'excel', 'pdf', 'print'
            //       ]
        });
    })

</script>
