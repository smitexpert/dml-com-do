<?php ob_start(); ?>

<?php 
include('includes/extra-page-header.php');



if(Session::get('role') != 1){
    
    $getUrl = '/role_play.php';

    $usrMenuId = Session::get('adminId');

    $countMenu = "SELECT COUNT(id) FROM menu_$usrMenuId";

    $tmr = $db->link->query($countMenu);

    $row_menu = $tmr->fetch_row();

    $menuSession = Session::get('menus');

    $isUrlActive = false;

    for($i=0; $i<$row_menu[0]; $i++){
        $menuUrl = '/'.$menuSession[$i];
        if( $menuUrl == $getUrl ){
            $isUrlActive = true;
        }
    }

    if($getUrl != '/dashboard.php'){
        if($isUrlActive != true){
            header("location: dashboard.php");
        }
    }
}


$inMenu = new Database();

$getRes = '';

if(isset($_GET['user'])){
    $userId = mysqli_real_escape_string($db->link, $_GET['user']);
    $sql = ("SELECT * FROM user WHERE userId=$userId");
    $result = $db->select($sql);
    
    
    if($result != false){
        
       
        
        /*if($resultSA === TRUE){
            $newSA = "HAVE";
        }else{
            $newSA = "NOT";
        }*/
        
        
        
        while($row = $result->fetch_assoc()){
            $userName = $row['name'];
        }
    }else{
        header("location: role_play.php");
    }
    
}else{
    header("location: role_play.php");
}



?>

		<!-- start: MAIN CONTAINER -->
<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>

<?php
    


?>

			<!-- start: PAGE -->
			<div class="main-content">
				<!-- start: PANEL CONFIGURATION MODAL FORM -->
				<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title">Panel Configuration</h4>
							</div>
							<div class="modal-body">
								Here will be a configuration form
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Close
								</button>
								<button type="button" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">



<!-- start: STYLE SELECTOR BOX -->
							
<!-- end: STYLE SELECTOR BOX -->



							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="clip-home-3"></i>
									<a href="#">
										Home
									</a>
								</li>
								<li class="active">
									Role Play
								</li>
								<!--<li class="search-box">
									<form class="sidebar-search">
										<div class="form-group">
											<input type="text" placeholder="Start Searching...">
											<button class="submit">
												<i class="clip-search-3"></i>
											</button>
										</div>
									</form>
								</li>-->
							</ol>
							<div class="page-header">
								<h1>Role Play <small>Give Permissions To User: <strong><?php echo $userName; ?></strong></small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<form action="" method="post" id="role-play">
						    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                 <?php 
                    if($db->CuntMenu('dashboard') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Dashboard Menus<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body">
                        <?php
                        $dashboardMenu = $db->Menus('dashboard');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="<?php echo $dashboardRow['menuName'] ?>" checked disabled><?php echo $dashboardRow['menuName']; ?></label>
                            <?php 
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('creation-area') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Creation Area<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('creation-area');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]"  <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('consignment-area') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Consignment Area<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('consignment-area');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('manifest-area') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Manifest Area<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('manifest-area');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('corporate-clients-area') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Corporate Clients Area<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('corporate-clients-area');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('agent-area') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Agent Area<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('agent-area');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('rote-settings') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Rote Settings<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('rote-settings');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('country-settings') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">Country Settings<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('country-settings');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('general-price-settings') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">General Price Settings<div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div></div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('general-price-settings');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('principal-price-settings') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                           Principal Price Settings
                           <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div>
                           </div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('principal-price-settings');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('staff-settings') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                              Staff Settings
                              <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div>
                          </div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('staff-settings');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('branch-area') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                              Branch Area
                              <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div>
                          </div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('branch-area');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('designation-area') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                              Designation Area
                              <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div>
                          </div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('designation-area');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('sales-marketing') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                              Sales &amp; Marketing
                              <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div>
                          </div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('sales-marketing');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('accounts') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                              Accounts Area
                              <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a></div>
                          </div>
                          <div class="panel-body" style="display: block;">
                        <?php
                        $dashboardMenu = $db->Menus('accounts');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                 <?php 
                    if($db->CuntMenu('settings') > 0){
                        
                        ?>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                              Settings Area
                              <div class="panel-tools"><a class="btn btn-xs btn-link panel-collapse expand" href="#"></a></div>
                          </div>
                          <div class="panel-body" style="display: none;">
                        <?php
                        $dashboardMenu = $db->Menus('settings');
                        
                        while($dashboardRow = $dashboardMenu->fetch_assoc()){
                            ?>
                            <label class="checkbox-inline"><input type="checkbox" value="<?php echo $dashboardRow['id']; ?>" name="menu-area[]" <?php echo $db->MenuUser($dashboardRow['menuUrl'], $_GET['user']); ?> ><?php echo $dashboardRow['menuName']; ?></label>
                            <?php
                        }
                        
                        ?>
                        
                           </div>
                        </div>
                        <?php
                    }
                    
                    ?>
                 
                    
                  
                  
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <input type="submit" class="btn btn-block">
            </div>
        </div>
        <br>
        
</div>
						</form>
						
					</div>
					
					
					
					
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
