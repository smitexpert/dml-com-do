<?php 
include("../lib/Session.php");
include("../lib/Database.php");



Session::checkAgentSession();

$agent_email = Session::get('agent_email');
$agent_id = Session::get('agent_id');
$id = Session::get('client_table_id');
$agent_name = Session::get('agent_name');
$agent_company = Session::get('agent_company');
$contact = Session::get('contact');
$address = Session::get('address');
$db = new Database();

?>




<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->

<head>
    <title>DML EXPRESS</title>
    <!-- start: META -->
    <meta charset="utf-8" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/style.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/main-responsive.css">
    <link rel="stylesheet" href="../assets/plugins/iCheck/skins/all.css">
    <link rel="stylesheet" href="../assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
    <!-- 		<link rel="stylesheet" href="assets/plugins/select2/select2.css"> -->
    <link rel="stylesheet" href="../assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/theme_light.css" type="text/css" id="skin_color">
    <link rel="stylesheet" href="../assets/css/print.css" type="text/css" media="print" />

    <link rel="stylesheet" href="../assets/css/jquery.datepicker.css">

    <link rel="stylesheet" href="../assets/css/bootstrap-select.css" />
    <link rel="stylesheet" href="../assets/plugins/gritter/css/jquery.gritter.css">
    <link href="../assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <link href="../assets/date/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/date/jquery-ui.theme.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="shortcut icon" href="favicon.ico" />

    <style>
        #style_selector {
            display: none;
        }

        .main-container {
            margin-top: 32px !important;
        }

                
        .loading {
            position: absolute;
            top: 0;
            z-index: 9999;
            /* left: 50%; */
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0, 0.6);
            display: none;
        }
        
        .loading img {
           left: 45%;
            top: 30%;
            position: relative;
        } 

        #selected_country a {
            margin: 0 10px;
            background-color: orange;
            padding: 5px;
            color: #fff;
        }

        #selected_country input {
            margin: 2px 0;
        }

        .page {
            padding: 4px 8px;
            background: salmon;
            margin-left: 4px;
            color: white;
            border-radius: 0px 6px;
        }

        .offer {
            background: #5bc0de;
            padding: 2px;
            color: #f3f3f3;
            padding: 2px 6px;
        }

        .country_form input {
            padding: 16px 10px !important;
            font-size: 14px;
        }

        .nav_view {
            margin-top: 5px;
            float: right;
        }
        .nav_view .nav>li>a {
    position: relative;
    display: block;
    padding: 10px 15px;
    background-color: #fcd16c;
    color: #fff;
}
.nav_view .nav-pills>li.active>a, .nav_view .nav-pills>li.active>a:hover, .nav_view .nav-pills>li.active>a:focus {
    color: #fff;
    background-color: orange;
}
.panel-heading {
    background: #ffc800 !important;
}
.loading-img {
            position: absolute;
            width: 100%;
            height: 100vh;
            top: 15%;
            text-align: center;
            z-index: 999;
            display: none;
} 
        

    </style>
</head>



<!-- end: HEAD -->
<!-- start: BODY -->

<body>

    <!-- start: HEADER -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <!-- start: TOP NAVIGATION CONTAINER -->
        <div class="container">
            <div class="navbar-header">
                <!-- start: RESPONSIVE MENU TOGGLER -->
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="clip-list-2"></span>
                </button>
                <!-- end: RESPONSIVE MENU TOGGLER -->
                <!-- start: LOGO -->
                <a class="navbar-brand" href="../client/index.php">
                    DML EXPRESS
                </a>
                <!-- end: LOGO -->
            </div>
            <div class="navbar-tools">
                <!-- start: TOP NAVIGATION MENU -->
                <ul class="nav navbar-right">
                    <!-- start: TO-DO DROPDOWN -->
                    
                    <!-- end: TO-DO DROPDOWN-->
                    <!-- start: NOTIFICATION DROPDOWN -->
                    
                    
                    <li class="dropdown current-user">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                            <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                            <span class="username">
                                <?php echo Session::get("agent_name"); ?>
                            </span>
                            <i class="clip-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li>
                                <a href="logout.php">
                                    <i class="clip-exit"></i>
                                    &nbsp;Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: USER DROPDOWN -->
                    <!-- start: PAGE SIDEBAR TOGGLE -->
                    <li>
                        <a class="sb-toggle" href="#"><i class="fa fa-outdent"></i></a>
                    </li>
                    <!-- end: PAGE SIDEBAR TOGGLE -->
                </ul>
                <!-- end: TOP NAVIGATION MENU -->
            </div>
        </div>
        <!-- end: TOP NAVIGATION CONTAINER -->
    </div>
    <!-- end: HEADER -->
    <div class="loading-img">
            <img src="../img/loading.gif" alt="">
        </div>

    <div class="main-container">

        
   <br>
    <?php 

    if(Session::get('type') == "agent"){
        include("agent_sidebar.php"); 
    }else{

    }
    
    
    
    ?>
    