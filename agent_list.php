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
                <div class="col-md-3">
                    <div class="form-group connected-group">
                        <label class="control-label" style="font-size: 16px">Select Agent<span class="symbol required"></span>
                        </label>
                        <select name="agent_select" required id="agent_select" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <option value="">--</option>
                            <?php
                                $selectclientname = "SELECT * FROM agent_clients WHERE status='1'";
                                    $findclientname =  $db->link->query($selectclientname);
                                if ($findclientname->num_rows > 0) { while ($getclientname=$findclientname->fetch_assoc()) { ?>
                            <option id="cour_comp_name" value="<?php echo $getclientname['id']; ?>"><?php echo $getclientname['company_name']; ?></option>
                            <!-- <option data-subtext="<?php //echo $getclientname['cour_comp_name']; ?>" class="cl" value="<?php //echo $getclientname['client_id']; ?>"><?php //echo $getclientname['cour_comp_name']; ?></option> -->
                            <?php } }else{} ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <br>
            

            <div id="view_section" style="display: none">
                <div class="row">

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i>
                                ASSIGN AGENT SERVICES
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-md-4">
                        
                                    <label for="new_service">Add New Service</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" placeholder="Add New Service" name="new_service" id="new_service">
                                            <span class="input-group-btn">
                                                <button id="new_add_button" class="btn btn-warning" type="button">ADD</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Select Service</label>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <select name="available_service" id="available_service" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button id="assign_service_btn" class="btn btn-warning">ADD</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>All Services For Agent: <span class="agent_name"></span></h5>
                                        <ul class="list-group">
                                            <li class="list-group-item"><input type="checkbox" class="" id="1"> <label for="1">Service Name</label></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
            </div>

        </div>
    </div>
    <!-- end: PAGE -->
</div>

<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>


<script type="text/javascript">
    $("#agent_select").change(function(){
        var agent_id = $(this).find(":selected").val();
        if(agent_id != ""){
            $("#view_section").css("display", "block")
        }else{
            $("#view_section").css("display", "none")
        }
        load_service();
        assigned_service();
    })

    $("#new_add_button").click(function(){
        var new_service = $("#new_service").val();
        if(new_service == ""){
            alert("New Service Name is Empty!!!");
        }else{
            $.ajax({
                url: "ajax/ajax_agent_service.php",
                method: "POST",
                data:{
                    create_new_service: new_service
                },
                success: function(data){
                    console.log(data);
                    if(data == '1'){
                        alert("Service Successfully Added!");
                        $("#new_service").val("");
                        load_service()
                        assigned_service()
                    }else{
                        alert("Service Already Exist in Service List")
                    }
                }
            })
        }
    })

    $("#assign_service_btn").click(function(){
        var selected = $("#available_service").find(":selected").val();
        var agent_id = $("#agent_select").find(":selected").val();
        if(selected != ""){
            $.ajax({
                url: "ajax/ajax_agent_service.php",
                method: "POST",
                data:{
                    assign_new_service: selected,
                    agent_id: agent_id
                },
                success: function(data){
                    if(data == '1'){
                        alert("Successfully Added!!!");
                    }else{
                        console.log(data);
                        alert("Something is Wrong!");
                    }
                    load_service()
                    assigned_service()
                }
            })
        }
    })

    function load_service(){
        var agent_id = $("#agent_select").find(":selected").val()
        // console.log(agent_id);
        $("#available_service").find("*").remove();
        $.ajax({
            url: "ajax/ajax_agent_service.php",
            method: "POST",
            data: { 
                agent_available_service: agent_id
             },
             success: function(data){
                 $("#available_service").append(data);
                 $("#available_service").selectpicker("refresh");
             }
        })
    }

    function assigned_service(){
        var agent_id = $("#agent_select").find(":selected").val();
        $(".list-group").find("*").remove();
        $.ajax({
            url: "ajax/ajax_agent_service.php",
            method: "POST",
            data: { 
                agent_assigned_service: agent_id
             },
             success: function(data){
                $(".list-group").append(data)
             }
        })
    }

    function update_service(service, agent){
        $.ajax({
            url: "ajax/ajax_agent_service.php",
            method: "POST",
            data: { 
                agent_update_service: service,
                agent_id: agent
             },
             success: function(data){
                if(data == '1'){
                    alert("Operation Success!");
                }else{
                    alert("Something Wrong!!!");
                }
             }
        })
    }


</script>
