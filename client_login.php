<?php

include('client/login.php');

$msg = '';

if(isset($_POST['agent'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(agent_login($email, $password) == '0'){
        $msg = "Login Information Incorrect!";
    }
}

if(isset($_POST['corporate'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $msg = "Corporate Email: ".$email;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Login - DML</title>
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .login {
            margin-top: 120px;
        }
        .client_btn_group {
            width: 100%;
            text-align: center;
        }
        .client_btn {
            width: 50%;
            float: left;
            display: block;
            background-color: #fff;
            color: #e67e22;
            padding: 10px 0;
            border: 0;
            border: 1px solid #e67e22;
        }
        .client_btn:hover {
            text-decoration: none;
            background-color: #f39c12;
            color: #fff;
        }
        .client_btn:first-child {
            border-top-left-radius: 9px;
            border-bottom-left-radius: 9px;
        }
        .client_btn:last-child {
            border-top-right-radius: 9px;
            border-bottom-right-radius: 9px;
            border-left: none;
        }
        
        
        .active {
            background-color: #d35400;
            color: #fff;
        }
        
        
    </style>
</head>

<body>

    <div class="container">
        <div class="login">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                   <div class="row">
                       <div class="col-md-12">
                           <?php
                           if($msg != ""){
                               ?>
                               <div class="alert alert-danger alert-dismissible">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  <strong>Error!</strong> <?php echo $msg; ?>
                                </div>
                               <?php
                           }
                           ?>
                       </div>
                   </div>
                    <div class="panel panel-default">
                       <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            CLIENT LOGIN PANEL
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="client_btn_group">
                                       <button id="corporate_btn" class="client_btn active">Corporate</button>
                                       <button id="agent_btn" class="client_btn">Agent</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div id="corporate_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Corporate Login Form</h4>
                                    </div>
                                </div>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="fomr-group">
                                                <label for="">Email</label>
                                                <input name="email" type="email" class="form-control" required>
                                                <input type="hidden" name="corporate" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="fomr-group">
                                                <label for="">Password</label>
                                                <input name="password" type="password" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-warning btn-block">LOGIN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="agent_form" style="display:none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Agent Login Form</h4>
                                    </div>
                                </div>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="fomr-group">
                                                <label for="">Email</label>
                                                <input name="email" type="email" class="form-control" required>
                                                <input type="hidden" name="agent" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="fomr-group">
                                                <label for="">Password</label>
                                                <input name="password" type="password" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-warning btn-block">LOGIN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
    
</body>
   
   
    <script src="assets/jQuery/jquery-3.3.1.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>
    <script>
        
        $(".client_btn").click(function(){
            $(".client_btn").removeClass('active');
            $(this).addClass('active');
        });
        
        $("#corporate_btn").click(function(){
            $("#agent_form").css('display', 'none');
            $("#corporate_form").css('display', 'block');
        });
        
        $("#agent_btn").click(function(){
            $("#agent_form").css('display', 'block');
            $("#corporate_form").css('display', 'none');
        });
    </script>
</html>