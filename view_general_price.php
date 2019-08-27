<?php include('includes/header.php'); ?>

<style>
    th, td {
        text-align: center;
    }
</style>
<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>
    
   
   <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
        
        <div class="row">
            <div class="col-md-12">
                <div class="well">DML ZONE WISE PRICE VIEW</div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">GOODS TYPE</th>
                            <th>ZONE</th>
                            <?php
                                $slzone = "SELECT DISTINCT zone FROM dml_zone";
                                $zoneQuery = $db->link->query($slzone);
                                while($zoneRow = $zoneQuery->fetch_assoc()){
                                    ?>
                                    <th rowspan="2">ZONE <?php echo $zoneRow['zone']; ?></th>
                                    <?php
                                }
                            ?>
                        </tr>
                        <tr>
                            <th>WEIGHT</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        
                            $p_i = 1;
                            
                            for($i=0.50; $i<=3.00; $i+=0.50){
                                $p_i++;
                            }
                        
                            $c_p_sl = "SELECT * FROM tbl_weight";
                            $c_p_rl = $db->link->query($c_p_sl);
                            $d_i = $c_p_rl->num_rows;
                        
                        $i=0.25;
                        
                        while($i<=3.00){
                            
                            ?>
                            
                        <tr>
                            
                            <?php
                            
                            if($i==0.25){
                                ?>
                                <th rowspan="<?php echo $p_i; ?>">Document</th>
                                <?php
                            }
                            
                            ?>
                            <th><?php echo $i; ?></th>
                            <?php
                            
                            $slzone = "SELECT DISTINCT zone FROM dml_zone";
                            $zoneQuery = $db->link->query($slzone);
                            while($zoneRow = $zoneQuery->fetch_assoc()){
                                $p_zone = $zoneRow['zone'];
                                $slDprice = "SELECT price FROM general_price WHERE zone='$p_zone' AND weight='$i' AND goods_type='D'";
                                $rlDprice = $db->link->query($slDprice);
                                $rowDprice = $rlDprice->fetch_assoc();
                                ?>
                                <td><?php echo $rowDprice['price']; ?></td>
                                <?php
                            }
                            
                            ?>
                            
                        </tr>
                            
                            <?php
                            
                            
                            if($i==0.25){
                                $i=0.50;
                            }else{
                                $i+=0.50;
                            }
                        }
                        
                        $slWeight = "SELECT weight FROM tbl_weight WHERE status='1' ORDER BY weight ASC";
                        $rlWeight = $db->link->query($slWeight);
                        
                        $j=1;
                        
                        while($rowWight = $rlWeight->fetch_assoc()){
                                
                                $d_weight = $rowWight['weight'];
                             ?>
                             
                             <tr>
                                 <?php
                            
                            if($j==1){
                                ?>
                                <th rowspan="<?php echo $d_i; ?>" style="vertical-align: top">Parcel</th>
                                <?php
                            }
                                ?>
                                
                                <th><?php echo $rowWight['weight']; ?></th>
                                
                                <?php
                            
                                $slzone = "SELECT DISTINCT zone FROM dml_zone";
                                $zoneQuery = $db->link->query($slzone);
                                while($zoneRow = $zoneQuery->fetch_assoc()){
                                    $p_zone = $zoneRow['zone'];
                                    $slDprice = "SELECT price FROM general_price WHERE zone='$p_zone' AND weight='$d_weight' AND goods_type='P'";
                                    $rlDprice = $db->link->query($slDprice);
                                    $rowDprice = $rlDprice->fetch_assoc();
                                    ?>
                                    <td><?php echo $rowDprice['price']; ?></td>
                                    <?php
                                }

                                ?>
                                
                             </tr>
                             
                             <?php
                            
                            $j++;
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
       </div>
    </div>
   
  <?php 
include('includes/footer.php');
?>