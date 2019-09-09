<?php

    $currentPage = $_SERVER['REQUEST_URI'];

    require_once __DIR__.'/../lib/Database.php';
    
    $user_menu = 'menu_'.Session::get('adminId');

    

    $menu = new Database();
    $query = "SELECT * FROM menu_sidebar";
    $selectMenu = $menu->select($query);

    /*while($row = $selectMenu->fetch_assoc()){
        echo $row['menuName'];
    }*/

?>
            <br>

			<div class="navbar-content">
				<!-- start: SIDEBAR -->
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<!-- end: MAIN MENU TOGGLER BUTTON -->
					<!-- start: MAIN NAVIGATION MENU -->
					
					<nav>
					<ul id="nav" class="main-navigation-menu">

						<li class="linav">
							<!--<a href="javascript:void(0)"><i class="clip-pencil"></i>
								<span class="title"> Creation Area</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul  class="sub-menu">
								<li class="acli">
									<a href="create_weight.php">
										<span class="title">Create Weight</span>
									</a>
								</li>
								<li>
									<a href="createRoute.php">
										<span class="title">Create Route</span>
									</a>
								</li>								
								<li>
									<a href="add_country.php">
										<span class="title">Create Country</span>
									</a>
								</li>	
								<li>
									<a href="createCourierCompany.php">
										<span class="title">Create Courier Company</span>
									</a>	
								</li>									

								<li>
									<a href="create_stuff.php">
										<span class="title">Create Stuff</span>
									</a>
								</li>								

								<li>
									<a href="createBranch.php">
										<span class="title">Create Branch</span>
									</a>
								</li>									

								<li>
									<a href="createDesignation.php">
										<span class="title">Create Designation</span>
									</a>
								</li>					

							</ul>
						</li>-->							


						<li class="linav">
							<a href="javascript:void(0)"><i class="clip-screen"></i>
								<span class="title"> Consignment Area</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a class="nav" href="client_consignment_booking.php">
										<span class="title">Consignment Booking</span>
									</a>
								</li>
								<li>
									<a href="client_consignment_list.php">
										<span class="title">Consignment List</span>
									</a>
								</li>								

								<li>
									<a href="client_consignment_history.php">
										<span class="title">Consignment History</span>
									</a>
								</li>	

							</ul>
						</li>						


						<li class="linav">
							<a href="javascript:void(0)"><i class="clip-grid-6"></i>
								<span class="title"> Price Settings</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a class="nav" href="client_view_price.php">
										<span class="title">View Genarel Price</span>
									</a>
								</li>
								<li>
									<a href="client_view_special_price.php">
										<span class="title">View Special Price</span>
									</a>
								</li>

							</ul>
						</li>					


						<li class="linav">
							<a href="client_accounts.php"><i class="clip-screen"></i>
								<span class="title">Accounts</span>
							</a>
				        </li>						


						<li class="linav">
							<a href="javascript:void(0)"><i class="clip-user-2"></i>
								<span class="title">Settings</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a class="nav" href="client_change_name.php">
										<span class="title">Change Name</span>
									</a>
								</li>
								<li>
									<a href="client_change_password.php">
										<span class="title">Change Password</span>
									</a>
								</li>

							</ul>
						</li>	

					</ul>
					</nav>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>