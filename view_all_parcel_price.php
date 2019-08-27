<?php 
include('includes/extra-page-header.php');


if(Session::get('role') != 1){
    
    $getUrl = '/corporate_client_price.php';

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


?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>


    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <a href="view_all_document_price.php" class="btn btn-warning btn-sm">View Document Price</a>
                    <a href="view_all_parcel_price.php" class="btn btn-warning btn-sm">View Parcel Price</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <table class="table table-bordered colored">
                       <caption style="text-align:left; font-weight: bold; font-size: 18px">View Parcel Price</caption>
                        <thead>
                            <tr>
                                <th>COUNTRY</th>
                                <th>PPRINCIPAL<span style="color: #FFF">_</span>NAME</th>
                                <?php
                                $sql_d = "SELECT weight FROM tbl_weight ORDER BY weight ASC";
                                $rlt_d = $db->link->query($sql_d);
                                while($row_d = $rlt_d->fetch_assoc()){
                                    echo '<th>'.$row_d['weight'].'</th>';
                                }
                            ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $sql = "SELECT * FROM tbl_country ORDER BY country_name ASC";
                        //$sql = "select *from tbl_coutry asc";
                        
                                        
                        $result = $db->link->query($sql);
                        
                        

                        while($row = $result->fetch_assoc()){
                            $country_tag = $row['country_tag'];
                            $country_name = $row['country_name'];
                            
                            $sl_principal = "SELECT * FROM principals_name";
                            $rl_principal = $db->link->query($sl_principal);
                            
                            $count_principal = $rl_principal->num_rows;
                            $i=1;
                            
                            
                            while($row_principal = $rl_principal->fetch_assoc()){
                                $principal_name = $row_principal['principal_name'];
                                $based = $row_principal['based'];
                                $p_id = $row_principal['id'];
                                echo '<tr>';
                                
                                
                                if($i==1){
                                    echo '<td rowspan="'.$count_principal.'">'.$country_name.'</td>';
                                }                                
                                echo '<td>'.$principal_name.'</td>';
                                
                                if($based == 1){
                                   
                                    $sl_zone = "SELECT zone FROM principal_zone WHERE principal_id='$p_id' AND country_tag='$country_tag'";
                                    $rl_zone = $db->link->query($sl_zone);
                                    $row_zone = $rl_zone->fetch_row();
                                    $zone = $row_zone[0];
                                
                                    $sql_d = "SELECT weight FROM tbl_weight ORDER BY weight ASC";
                                    $rlt_d = $db->link->query($sql_d);
                                
                                    while($weight_row = $rlt_d->fetch_assoc()){
                                        $weight = $weight_row['weight'];
                                        
                                        
                                        
                                        $sl_price = "SELECT price FROM principal_price WHERE zone='$zone' AND principal_id='$p_id' AND goods_type='P' AND weight='$weight'";
                                        $rl_price = $db->link->query($sl_price);
                                        $row_price = $rl_price->fetch_row();
                                        echo '<td>'.$row_price[0].'</td>';
                                    }
                                    
                                }else{
                                    
                                    $sql_d = "SELECT weight FROM tbl_weight ORDER BY weight ASC";
                                    $rlt_d = $db->link->query($sql_d);
                                
                                    while($weight_row = $rlt_d->fetch_assoc()){
                                        $weight = $weight_row['weight'];
                                        
                                        
                                        
                                        $sl_price = "SELECT price FROM principal_price WHERE country='$country_tag' AND principal_id='$p_id' AND goods_type='P' AND weight='$weight'";
                                        $rl_price = $db->link->query($sl_price);
                                        $row_price = $rl_price->fetch_row();
                                        echo '<td>'.$row_price[0].'</td>';
                                    }
                                    
                                }
                                
                                    
                                    
                                
                                    
                                    
                                    
                                
                                
                                echo '</tr>';
                                $i++;
                                
                            }
                                
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    
                    
                    
                    ?>


                    <!-- end: FORM VALIDATION 1 PANEL -->
                </div>
            </div><br>






        </div>
    </div>
    <!-- end: PAGE -->


</div>
<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>
