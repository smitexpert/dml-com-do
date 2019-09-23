<?php 
$main_path = realpath(dirname(__FILE__));
include $main_path.'/../lib/Session.php';
Session::checkSession();
include $main_path.'/../lib/Database.php';
include $main_path.'/../helper/Format.php';

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}


//to include automatically all class from classes folder
spl_autoload_register(function($class){
	require_once __DIR__.'/../classes/'.$class.'.php';
});


$db = new Database();
$format = new Formatting();
$Consignment = new Consignment();
$Countryset = new Countryset();
$priceset = new Priceset();
$Corpoclients = new Corporateclients();
$Courcompanyset = new Courcompanyset();
$Stuffset = new Stuffset();
$Branchset = new Branchset();
$Designationset = new Designationset();
$Accounts = new Accounts();
/*$SelectDb = new SelectDb();*/

$userId = Session::get('adminId');

$userStatusQuery = "SELECT status FROM user WHERE userId = '$userId'";

$userStatusResult = $db->select($userStatusQuery);

while($userStatusRow = $userStatusResult->fetch_assoc()){
    $userStatus = $userStatusRow['status'];
}

if($userStatus == 0){
    header('location: logout.php');
}


if(Session::get('role') != 1){
    
    
    $getUrl = explode('?', $_SERVER['REQUEST_URI'], 2);

    $usrMenuId = Session::get('adminId');

    $countMenu = "SELECT COUNT(id) FROM menu_$usrMenuId";

    $tmr = $db->link->query($countMenu);

    $row_menu = $tmr->fetch_row();

    $menuSession = Session::get('menus');

    $isUrlActive = false;

    for($i=0; $i<$row_menu[0]; $i++){
        $menuUrl = '/'.$menuSession[$i];
        if( $menuUrl == $getUrl[0] ){
            $isUrlActive = true;
        }
    }

    if($getUrl[0] != '/dashboard.php'){
        if($isUrlActive != true){
            header("location: dashboard.php");
        }
    }
}

?>




<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->

<!-- Mirrored from www.cliptheme.com/preview/admin/clip-one/ by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 12 Apr 2015 06:25:32 GMT -->

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
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/main-responsive.css">
    <link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
    <!-- 		<link rel="stylesheet" href="assets/plugins/select2/select2.css"> -->
    <link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/theme_light.css" type="text/css" id="skin_color">
    <link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print" />

    <link rel="stylesheet" href="assets/css/jquery.datepicker.css">

    <link rel="stylesheet" href="assets/css/bootstrap-select.css" />
    <link rel="stylesheet" href="assets/plugins/gritter/css/jquery.gritter.css">
    <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="assets/date/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/date/jquery-ui.theme.min.css">




    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> -->

    <!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- 		<link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css"> -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="shortcut icon" href="favicon.ico" />

    <style>
        
        .modal-lg {
            width: 750px;
            margin-left: -375px;
        }
        
        #prn {
                width: 100%;
                float: left;
                margin-bottom: 10px;
                /*display: none;*/
            }

        .box {
            background-color: #ecf0f1;
            height: 130px;
            width: 100%;
            display: table;
        }

        .box-green {
            background-color: #2ed573;
        }

        .box-orange {
            background-color: #FFA400;
        }

        .box-blue {
            background-color: #1F4788;
        }

        .box-purple {
            background-color: #BF55EC;
        }

        .box-red {
            background-color: #F62459;
        }

        #selected_country a {
            margin: 0 10px;
            background-color: orange;
            padding: 5px;
            color: #fff;
        }

        .box .box-footer {
            text-align: center;
            position: absolute;
            width: 240px;
            left: 50%;
            margin-left: -120px;
            bottom: 0;
            padding: 10px 0;
            color: #e0e0e0;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
        }

        .box .box-content {
            display: table-cell;
            justify-content: center;
            vertical-align: middle;
            text-align: center;
        }

        .box .box-content h1 {
            margin: -30px 0;
            padding: 0;
            color: #dff9fb;
            font-weight: bold;
            font-size: 46px;
        }

        #viewpriceview-loading {
            width: 100%;
            height: 100%;
            text-align: center;
        }

        #viewpriceview-loading img {
            text-align: center;
            margin: 0 auto;
        }
        
        .loading-img {
            position: absolute;
            width: 100%;
            height: 100vh;
            top: 15%;
            text-align: center;
            display: none;
        }
        
        .loading-img img {
            margin-top: 8%;
            width: 120px;
            height: auto;
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


        .nav_view .nav-pills>li.active>a,
        .nav_view .nav-pills>li.active>a:hover,
        .nav_view .nav-pills>li.active>a:focus {
            color: #fff;
            background-color: orange;
        }

        #style_selector {
            display: none;
        }

        .main-container {
            margin-top: 32px !important;
        }

        #ui-datepicker-div {
            z-index: 999 !important;
        }

        /*input, button, select, textarea {     border: 1px solid orange !important;
            background: hsla(194, 66%, 61%, 0.02) !important;
            color: black !important;}*/

        .loading {
            position: absolute;
            top: 0;
            z-index: 9999;
            /* left: 50%; */
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
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
        
        .zone_class  {
            color: aqua;
            background-color: green !important;
        }
        
        .weight_class  {
            color: aqua;
            background-color: red !important;
        }

    </style>
</head>


<script>
    $(function() {
        $("#datepicker").datepicker();
    });

</script>

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
                <a class="navbar-brand" href="dashboard.php">
                    DML EXPRESS
                </a>
                <!-- end: LOGO -->
            </div>
            <div class="navbar-tools">
                <!-- start: TOP NAVIGATION MENU -->
                <ul class="nav navbar-right">
                    <!-- start: TO-DO DROPDOWN -->
                    <!--<li class="dropdown">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                            <i class="clip-list-5"></i>
                            <span class="badge"> 12</span>
                        </a>
                        <ul class="dropdown-menu todo">
                            <li>
                                <span class="dropdown-menu-title"> You have 12 pending tasks</span>
                            </li>
                            <li>
                                <div class="drop-down-wrapper">
                                    <ul>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
                                                <span class="label label-danger" style="opacity: 1;"> today</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
                                                <span class="label label-danger" style="opacity: 1;"> today</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> Hire developers</span>
                                                <span class="label label-warning"> tommorow</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc">Staff Meeting</span>
                                                <span class="label label-warning"> tommorow</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> New frontend layout</span>
                                                <span class="label label-success"> this week</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> Hire developers</span>
                                                <span class="label label-success"> this week</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> New frontend layout</span>
                                                <span class="label label-info"> this month</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> Hire developers</span>
                                                <span class="label label-info"> this month</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
                                                <span class="label label-danger" style="opacity: 1;"> today</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
                                                <span class="label label-danger" style="opacity: 1;"> today</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="todo-actions" href="javascript:void(0)">
                                                <i class="fa fa-square-o"></i>
                                                <span class="desc"> Hire developers</span>
                                                <span class="label label-warning"> tommorow</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="view-all">
                                <a href="javascript:void(0)">
                                    See all tasks <i class="fa fa-arrow-circle-o-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                    <!-- end: TO-DO DROPDOWN-->
                    <!-- start: NOTIFICATION DROPDOWN -->
                    <!--<li class="dropdown">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                            <i class="clip-notification-2"></i>
                            <span class="badge"> 11</span>
                        </a>
                        <ul class="dropdown-menu notifications">
                            <li>
                                <span class="dropdown-menu-title"> You have 11 notifications</span>
                            </li>
                            <li>
                                <div class="drop-down-wrapper">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                <span class="message"> New user registration</span>
                                                <span class="time"> 1 min</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                <span class="message"> New comment</span>
                                                <span class="time"> 7 min</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                <span class="message"> New comment</span>
                                                <span class="time"> 8 min</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                <span class="message"> New comment</span>
                                                <span class="time"> 16 min</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                <span class="message"> New user registration</span>
                                                <span class="time"> 36 min</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-warning"><i class="fa fa-shopping-cart"></i></span>
                                                <span class="message"> 2 items sold</span>
                                                <span class="time"> 1 hour</span>
                                            </a>
                                        </li>
                                        <li class="warning">
                                            <a href="javascript:void(0)">
                                                <span class="label label-danger"><i class="fa fa-user"></i></span>
                                                <span class="message"> User deleted account</span>
                                                <span class="time"> 2 hour</span>
                                            </a>
                                        </li>
                                        <li class="warning">
                                            <a href="javascript:void(0)">
                                                <span class="label label-danger"><i class="fa fa-shopping-cart"></i></span>
                                                <span class="message"> Transaction was canceled</span>
                                                <span class="time"> 6 hour</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                <span class="message"> New comment</span>
                                                <span class="time"> yesterday</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                <span class="message"> New user registration</span>
                                                <span class="time"> yesterday</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                <span class="message"> New user registration</span>
                                                <span class="time"> yesterday</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                <span class="message"> New comment</span>
                                                <span class="time"> yesterday</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                <span class="message"> New comment</span>
                                                <span class="time"> yesterday</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="view-all">
                                <a href="javascript:void(0)">
                                    See all notifications <i class="fa fa-arrow-circle-o-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                    <!-- end: NOTIFICATION DROPDOWN -->
                    <!-- start: MESSAGE DROPDOWN -->
                    <!--<li class="dropdown">
							<a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#">
								<i class="clip-bubble-3"></i>
								<span class="badge"> 9</span>
							</a>
							<ul class="dropdown-menu posts">
								<li>
									<span class="dropdown-menu-title"> You have 9 messages</span>
								</li>
								<li>
									<div class="drop-down-wrapper">
										<ul>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="assets/images/avatar-2.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Nicole Bell</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time"> Just Now</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="assets/images/avatar-1.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Peter Clark</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time">2 mins</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="assets/images/avatar-3.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Steven Thompson</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time">8 hrs</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="assets/images/avatar-1.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Peter Clark</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time">9 hrs</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="assets/images/avatar-5.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Kenneth Ross</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time">14 hrs</span>
														</div>
													</div>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="view-all">
									<a href="pages_messages.html">
										See all messages <i class="fa fa-arrow-circle-o-right"></i>
									</a>
								</li>
							</ul>
						</li>-->
                    <!-- end: MESSAGE DROPDOWN -->
                    <!-- start: USER DROPDOWN -->
                    <li class="dropdown current-user">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                            <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                            <span class="username">
                                <?php if (isset($_SESSION['adminUser'])) {
										echo $_SESSION['adminUser'];
									}else{
										header('Location:index.php');
									}
									?>
                            </span>
                            <i class="clip-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="my-profile.php">
                                    <i class="clip-user-2"></i>
                                    &nbsp;My Profile
                                </a>
                            </li>
                            <!--<li>
                                <a href="pages_calendar.html">
                                    <i class="clip-calendar"></i>
                                    &nbsp;My Calendar
                                </a>

                            </li>
                            <li>
                                <a href="pages_messages.html">
                                    <i class="clip-bubble-4"></i>
                                    &nbsp;My Messages (3)
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="utility_lock_screen.html"><i class="clip-locked"></i>
                                    &nbsp;Lock Screen </a>
                            </li>-->
                            <li>
                                <a href="logout.php">
                                    <i class="clip-exit"></i>
                                    &nbsp;Log Out
                                </a>
                            </li>
                        </ul>
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
