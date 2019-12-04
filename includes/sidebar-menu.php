<?php

    $currentPage = explode('?', $_SERVER['REQUEST_URI'], 2);

    $currentPage = $currentPage[0];

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

						<!-- <li class="active open"> -->
						<?php
                       /* while($row = $selectMenu->fetch_assoc()){
                            ?>
                            
                            <li class="<?php if($currentPage == '/'.$row['menuUrl']){ echo 'active open'; } ?>">
							<a href="<?php echo $row['menuUrl'] ?>"><i class="clip-home-3"></i>
								<span class="title"><?php echo $row['menuName']; ?></span><span class="selected"></span>
							</a>
						</li>
                           
                            <?php
                                
                                
                        }*/
                        
if(Session::get('role') == 1){
            ?>

            <li class="<?php if($currentPage == '/addadmin.php'){ echo 'active open'; } ?>">
                <a href="addadmin.php"><i class="clip-link"></i>
                    <span class="title">Add Admin User</span><span class="selected"></span>
                </a>
            </li>

            <li class="<?php if($currentPage == '/addmenu.php'){ echo 'active open'; } ?>">
                <a href="addmenu.php"><i class="clip-link"></i>
                    <span class="title">Add Menu</span><span class="selected"></span>
                </a>
            </li>
<?php

    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='tracking'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-pencil"></i>
    <span class="title">TRACKING AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}



$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='consignment-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-pencil"></i>
    <span class="title">CONSIGNMENT AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='manifest-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-screen"></i>
    <span class="title">MANIFEST AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='corporate-clients-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-grid-6"></i>
    <span class="title">CORPORATE AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='agent-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-user-2"></i>
    <span class="title">AGENT AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='general-price-settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-user-2"></i>
    <span class="title">GENERAL SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='principal-price-settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-location"></i>
    <span class="title">PRINCIPAL SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='sales-marketing'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-grid-6"></i>
    <span class="title">SALES &amp; MARKETING</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='accounts'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-bars"></i>
    <span class="title">ACCOUNTS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-bars"></i>
    <span class="title">SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='creation-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-bars"></i>
    <span class="title">CREATION AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='country-settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-grid-6"></i>
    <span class="title">COUNTRY SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='staff-settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-grid-6"></i>
    <span class="title">STAFF SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='designation-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-cog-2"></i>
    <span class="title">DESIGNATION AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='branch-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-cog-2"></i>
    <span class="title">BRANCH AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php
}
?>


    </ul>
</li>
<?php
}else{
    ?>
    <li class="<?php if($currentPage == '/dashboard.php'){ echo 'active open'; } ?>">
        <a href="dashboard.php"><i class="clip-link"></i>
            <span class="title">DASHBOARD</span><span class="selected"></span>
        </a>
    </li>
    <?php
    
  
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='tracking'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-pencil"></i>
    <span class="title">TRACKING AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
        
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='consignment-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-pencil"></i>
    <span class="title">CONSIGNMENT AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='manifest-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-screen"></i>
    <span class="title">MANIFEST AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='corporate-clients-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-grid-6"></i>
    <span class="title">CORPORATE AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='agent-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-user-2"></i>
    <span class="title">AGENT AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='general-price-settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-user-2"></i>
    <span class="title">GENERAL SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='principal-price-settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-location"></i>
    <span class="title">PRINCIPAL SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='sales-marketing'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-grid-6"></i>
    <span class="title">SALES &amp; MARKETING</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='accounts'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-bars"></i>
    <span class="title">ACCOUNTS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-bars"></i>
    <span class="title">SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='creation-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-bars"></i>
    <span class="title">CREATION AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='country-settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-grid-6"></i>
    <span class="title">COUNTRY SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='staff-settings'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-grid-6"></i>
    <span class="title">STAFF SETTINGS</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='designation-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-cog-2"></i>
    <span class="title">DESIGNATION AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
$superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='branch-area'";

$creationAreaCount = $menu->count($superCreationAreaQuery);

if($creationAreaCount[0] > 0) {

$creationAreaMenu = $menu->select($superCreationAreaQuery);


?>
<li class="linav">
    <a href="javascript:void(0)"><i class="clip-cog-2"></i>
    <span class="title">BRANCH AREA</span><i class="icon-arrow"></i>
    <span class="selected"></span>
    </a>
    <ul  class="sub-menu">
        <?php

        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
            ?>


            <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                </a>
            </li>	

            <?php
            }


        ?>


    </ul>
</li>
<?php

}
    
    
}

?>

					</ul>
					</nav>
					<br>
					<br>
					<br>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>