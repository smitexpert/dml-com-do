<?php
require_once 'Database.php';

$db = new Database;

//SELECT ALL COUNTRY FROM tbl_country
$getCountryName = "SELECT *FROM tbl_country ORDER BY country_name";
$getName = $db->link->query($getCountryName);
$getNameUp = $db->link->query($getCountryName);

session_start();

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
}

if(isset($_SESSION['trk_login'])){
    $login = 1;
}else{
    $login = 0;
}

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(($username == 'admin') && ($password == 'dml_admin')){
        $_SESSION['trk_login'] = true;
        header("location: admin.php");
    }else{
        session_unset();
        session_destroy();
        header("location: admin.php?error");
    }
    
}

$er = 0;

if(isset($_GET['error'])){
    $er = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - DML Shipment Tracking</title>
    <link rel="stylesheet" href="jquery.dataTables.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin_style.css">
</head>

<body>

    <div class="container">

        <?php if($login == 0 ){ ?>
        <div class="login">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                    if($er == 1){
                        ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Username Password Incurrect!
                    </div>
                    <?php
                    }
                    ?>
                    <form action="admin.php" method="post" id="login_form">
                        <h2>Tracking Panel Login</h2>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-block btn-sm btn-warning">LOGIN</button>
                    </form>
                    <br>
                    <a href="index.php">Back to Track</a>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <?php }else{ ?>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="admin.php">DML Tracking</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="admin.php">Admin Panel</a></li>
                    <li><a href="admin.php?logout">Logout</a></li>
                    <li><a href="index.php">Visit Tracker</a></li>
                </ul>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <form class="" id="awn_form">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dml">DML AWB No.:</label>
                                <input type="text" class="form-control" id="dml" placeholder="Enter DML AWN" name="dml" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="org">LINK AWB No.:</label>
                                <input type="text" class="form-control" id="org" placeholder="Enter ORG AWN" name="org">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="principal">SELECT:</label>
                                <select class="form-control" name="principal" id="principal" required>
                                    <option value="">--</option>
                                    <option value="DHL">DHL</option>
                                    <option value="FEDEX">FEDEX</option>
                                    <option value="ARAMEX">ARAMEX</option>
                                    <option value="FIRSTFLIGHT">FIRST FLIGHT</option>
                                    <option value="NICEEXPRESS">NICE EXPRESS</option>
                                    <option value="DPEX">DPEX</option>
                                    <option value="DPD">DPD</option>
                                    <option value="SKYNET">SKYNET</option>
                                    <option value="OCS">OCS</option>
                                    <option value="BLUEDART">BLUE DART</option>
                                    <option value="TNT">TNT</option>
                                    <option value="SF">SF EXPRESS</option>
                                    <option value="AIRBORNE">ELITE AIR BORNE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shipper_name">SHIPPER NAME</label>
                                <input type="text" class="form-control" id="shipper_name" placeholder="SHIPPER NAME" name="shipper_name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="origin">Origin</label>
                                <input type="text" class="form-control" id="origin" placeholder="Origin" name="origin" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <!--<input type="text" class="form-control" id="destination" placeholder="Destination" name="destination" required>-->
                                <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="destination" id="destination" required>
                                    <option value="">--</option>
                                    <?php
                                    while($row = $getName->fetch_assoc()){
                                        // $name = $row['country_name'];
                                        ?>
                                    <option value="<?php echo $row['country_name'];?>"><?php echo $row['country_name'];?></option>
                                    <?php
                                    }
                                    ?>
                                    <!--<option value="ALB"></option>-->
                                    <!--<option value="DZ">Algeria</option>-->
                                    <!--<option value="DPEX">DPEX</option>-->
                                    <!--<option value="DPD">DPD</option>-->
                                    <!--<option value="SKYNET">SKYNET</option>-->
                                    <!--<option value="OCS">OCS</option>-->
                                    <!--<option value="BLUEDART">BLUE DART</option>-->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="consignee_name">Consignee Name</label>
                                <input type="text" class="form-control" id="consignee_name" placeholder="Consignee Name" name="consignee_name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pcs">Pcs</label>
                                <input type="number" min="1" class="form-control" id="pcs" placeholder="Pcs" name="pcs" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ship_content">Ship Content</label>
                                <select type="text" class="form-control" id="ship_content" placeholder="Ship Content" name="ship_content" required>
                                    <option value="">--</option>
                                    <option value="DOX">DOX</option>
                                    <option value="SPX">SPX</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="booking_date">Booking Date</label>
                                <input type="date" class="form-control" id="booking_date" placeholder="Booking Date" name="booking_date" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning btn-block">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>DML AWN</th>
                                    <th>ORG. AWN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    
                                    $sql = "SELECT * FROM test_track ORDER BY id DESC";
                                    $query = $db->link->query($sql);
                                    if($query->num_rows > 0){
                                        while($row = $query->fetch_assoc()){
                                            ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['dml_awn']; ?></td>
                                    <td onclick="editOrg(event)"><?php echo $row['org_awn']; ?></td>
                                    <td><button class="btn btn-sm btn-warning edit_btn" id="edit_btn_<?php echo $row['dml_awn']; ?>" onclick="edit_track(event)" data-toggle="modal" data-target="#myModal"><span class="fa fa-pencil-square-o"></span></button> <button id="dlt_dml_<?php echo $row['dml_awn']; ?>" class="btn btn-sm btn-danger dlt_cls" onclick="dlt_item(event)"><span class="glyphicon glyphicon-trash"></span></button> <a class="btn btn-sm btn-info" target="_blank" href="index.php?awn=<?php echo $row['dml_awn']; ?>"><i class="glyphicon glyphicon-new-window"></i></a></td>
                                </tr>
                                <?php
                                        }
                                    }

                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <?php } ?>

    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Tracking Info</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <form class="" id="update_awn_form">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dml">DML AWB No.:</label>
                                            <input type="hidden" name="up_id" id="up_id">
                                            <input type="text" class="form-control" id="up_dml" placeholder="Enter DML AWN" name="up_dml" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="org">LINK AWB No.:</label>
                                            <input type="text" class="form-control" id="up_org" placeholder="Enter ORG AWN" name="up_org">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="principal">SELECT:</label>
                                            <select class="form-control" name="up_principal" id="up_principal" required>
                                                <option value="">--</option>
                                                <option value="DHL">DHL</option>
                                                <option value="FEDEX">FEDEX</option>
                                                <option value="ARAMEX">ARAMEX</option>
                                                <option value="FIRSTFLIGHT">FIRST FLIGHT</option>
                                                <option value="NICEEXPRESS">NICE EXPRESS</option>
                                                <option value="DPEX">DPEX</option>
                                                <option value="DPD">DPD</option>
                                                <option value="SKYNET">SKYNET</option>
                                                <option value="OCS">OCS</option>
                                                <option value="BLUEDART">BLUE DART</option>
                                                <option value="TNT">TNT</option>
                                                <option value="SF">SF EXPRESS</option>
                                                <option value="AIRBORNE">ELITE AIR BORNE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="shipper_name">SHIPPER NAME</label>
                                            <input type="text" class="form-control" id="up_shipper_name" placeholder="SHIPPER NAME" name="up_shipper_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="origin">Origin</label>
                                            <input type="text" class="form-control" id="up_origin" placeholder="Origin" name="up_origin" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="destination">Destination</label>
                                            <!--<input type="text" class="form-control" id="destination" placeholder="Destination" name="destination" required>-->
                                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="up_destination" id="up_destination" required>
                                                <option value="">--</option>
                                                <?php
                                    while($row = $getNameUp->fetch_assoc()){
                                        // $name = $row['country_name'];
                                        ?>
                                                <option value="<?php echo $row['country_name'];?>"><?php echo $row['country_name'];?></option>
                                                <?php
                                    }
                                    ?>
                                                <!--<option value="ALB"></option>-->
                                                <!--<option value="DZ">Algeria</option>-->
                                                <!--<option value="DPEX">DPEX</option>-->
                                                <!--<option value="DPD">DPD</option>-->
                                                <!--<option value="SKYNET">SKYNET</option>-->
                                                <!--<option value="OCS">OCS</option>-->
                                                <!--<option value="BLUEDART">BLUE DART</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="consignee_name">Consignee Name</label>
                                            <input type="text" class="form-control" id="up_consignee_name" placeholder="Consignee Name" name="up_consignee_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pcs">Pcs</label>
                                            <input type="number" min="1" class="form-control" id="up_pcs" placeholder="Pcs" name="up_pcs" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ship_content">Ship Content</label>
                                            <select type="text" class="form-control" id="up_ship_content" placeholder="Ship Content" name="up_ship_content" required>
                                                <option value="">--</option>
                                                <option value="DOX">DOX</option>
                                                <option value="SPX">SPX</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="booking_date">Booking Date</label>
                                            <input type="date" class="form-control" id="up_booking_date" placeholder="Booking Date" name="up_booking_date" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning btn-block">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <script src="jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>
    <script>
        $("#destination").selectpicker();

        function edit_track(event) {
            var id = $(event.target).closest('td').find('.edit_btn').attr("id");
            id = id.replace('edit_btn_', '');

            document.getElementById("update_awn_form").reset();
            $("#up_destination").val("");
            $("#up_destination").selectpicker("refresh");

            $.ajax({
                url: "ajax_admin.php",
                method: "POST",
                data: {
                    update_id: id
                },
                dataType: "json",
                success: function(data) {
                    $("#up_id").val(data.id);
                    $("#up_dml").val(data.dml_awn);
                    $("#up_org").val(data.org_awn);
                    $("#up_principal").val(data.principal);
                    $("#up_shipper_name").val(data.shipper_name);
                    $("#up_origin").val(data.origin);
                    $("#up_destination").val(data.destination);
                    $("#up_consignee_name").val(data.consignee_name);
                    $("#up_pcs").val(data.pcs);
                    $("#up_ship_content").val(data.ship_content);
                    $("#up_booking_date").val(data.booking_date);

                    $("#up_destination").selectpicker("refresh");

                    //                    console.log(data);
                }
            });
        }

        function editOrg(event) {
            var org = $(event.target).text();
            $(event.target).find("*").remove();
            $(event.target).append('<input class="form-control" type="text" onkeyup="checkSubmit(event)" onfocusout="focusSub(event)" value=' + org + '>');
            $(event.target).find('input').focus();
        }

        function checkSubmit(event) {
            var prev = $(event.target).closest('td').text();


            var key = event.which || event.keyCode;
            if (key == 13) {


                var org = $(event.target).val();
                var con = confirm("Are You Sure?");



                if (con == true) {


                    $(event.target).removeAttr('onfocusout');

                    var id = $(event.target).closest("tr").find("button").attr('id');
                    id = id.replace("edit_btn_", "");
                    console.log(id);
                    $.ajax({
                        url: "ajax_admin.php",
                        method: "POST",
                        data: {
                            org_up: org,
                            org_up_id: id
                        },
                        success: function(data) {
                            $(event.target).closest('td').text(org);
                            $(event.target).remove();
                        }
                    })

                } else {
                    $(event.target).closest('td').find("input").hide();
                    $(event.target).closest('td').text(prev);
                }

            }
        }

        function focusSub(event) {
            var old = $(event.target).closest('td').text();
            var now = $(event.target).val();

            if (old != now) {
                var con = confirm("Are You Want To Save?");
                if (con == true) {
                    var id = $(event.target).closest("tr").find("button").attr('id');
                    id = id.replace("edit_btn_", "");
                    console.log(id);
                    $.ajax({
                        url: "ajax_admin.php",
                        method: "POST",
                        data: {
                            org_up: now,
                            org_up_id: id
                        },
                        success: function(data) {
                            $(event.target).closest('td').text(now);
                            $(event.target).remove();
                        }
                    })
                }
            } else {
                $(event.target).remove();
            }


        }

        function lastId() {
            var last = 0;
            $("#datatable > tbody > tr").each(function(key, val) {
                if (last < $(val).find('td').find('button').attr("id"))
                    last = $(val).find('td').find('button').attr("id");
            })

            return last;
        }

        $("#datatable").DataTable({
            "order": [
                [0, "desc"]
            ],

            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }]
        });

        $("#awn_form").on('submit', function(e) {
            e.preventDefault();
            var awn_form = $(this).serialize();
            var awm_ar = $(this).serializeArray();

            var dml = awm_ar[0].value;
            var org = awm_ar[1].value;

            var dataTable = $("#datatable").DataTable();

            var count = lastId() + 1;





            $.ajax({
                url: "ajax_admin.php",
                method: "POST",
                data: awn_form,
                success: function(data) {
                    if (data == '1') {
                        alert("Inserted!!!");
                        document.getElementById("awn_form").reset();
                        $("#destination").selectpicker("refresh");
                        dataTable.row.add([
                            count,
                            dml,
                            org,
                            '<button class="btn btn-sm btn-warning" id="edit_btn_' + dml + '" onclick="edit_track(event)" data-toggle="modal" data-target="#myModal"><span class="fa fa-pencil-square-o"></span></button> <button id="' + dml + '" class="btn btn-sm btn-danger dlt_cls"><span class="glyphicon glyphicon-trash" onclick="dlt_item(event)"></span></button> <a class="btn btn-sm btn-info" target="_blank" href="index.php?awn=' + dml + '"><i class="glyphicon glyphicon-new-window"></i></a>'
                        ]).draw(false);
                    } else {
                        alert("DML AWN already Exist!!!");
                        $("#destination").selectpicker("refresh");

                    }

                    //                    console.log(data);

                }
            });
        });

        $("#update_awn_form").submit(function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();

            $.ajax({
                url: "ajax_admin.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    if (data == "1") {
                        alert("Success!");
                        $("#myModal").modal('toggle')
                    } else {
                        alert("System Error!");
                    }
                }
            });
        });

        /*$(".dlt_cls").click(function(e){
            var id = $(this).closest('td').find('button').attr("id");
           
            var conf = confirm("Do you want to Delete?");
            if(conf == true){
                $.ajax({
                    url: "ajax_admin.php",
                    method: "POST",
                    data: { dlt_id: id },
                    success: function(data){
                        if(data == 1){
                            $(e.target).closest('tr').remove();
                        }else{
                            alert("Opps!!! Try again.");
                        }
                    }
                })
            }
        })*/

        function dlt_item(event) {
            var id = $(event.target).closest('td').find('.dlt_cls').attr("id");
            id = id.replace('dlt_dml_', '');

            var conf = confirm("Do you want to Delete?");
            if (conf == true) {
                $.ajax({
                    url: "ajax_admin.php",
                    method: "POST",
                    data: {
                        dlt_id: id
                    },
                    success: function(data) {
                        if (data == 1) {
                            $(event.target).closest('tr').remove();
                        } else {
                            alert("Opps!!! Try again.");
                        }
                    }
                })
            }
        }

    </script>
</body>

</html>
