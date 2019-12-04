<?php

require 'lib/Session.php';
require "lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>

   <script src="assets/jQuery/jquery-3.3.1.min.js"></script>
   <script src="assets/js/tableHTMLExport.js"></script>
</head>

<body>
<?php
    if(isset($_POST['principals_prn'])){
        $principals_prn = $_POST['principals_prn'];
        
        $minformdate_prn = $_POST['minformdate_prn'];
        $mintodate_prn = $_POST['mintodate_prn'];
        
        $minformdate_prn = date('Y-m-d', strtotime($minformdate_prn));
        $mintodate_prn = date('Y-m-d', strtotime($mintodate_prn));
        
        print_r($minformdate_prn);
    ?>
<button id="save">DOWNLOAD</button>
<table border="1" class="table2excel">
   <tr style="display: none;">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><h2>CUSTOM MANIFEST FOR TRANSHIPMENT</h2></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
       <td></td>
       <td></td>
   </tr>
   <tr style="display: none;">
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td style="text-align: center">MAWB :</td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td style="text-align: center">BAGS: </td>
       <td></td>
   </tr>
   <tr style="display: none;">
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td style="text-align: center">FLIGHT</td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td style="text-align: center">WEIGHT(KG): </td>
       <td id="gross"></td>
   </tr>
    <tr>
        <td>NO</td>
        <td>BAGS</td>
        <td>AWB NO.</td>
        <td>ORG.SHIPPER</td>
        <td>CONSIGNEE</td>
        <td>DEST</td>
        <td>NO. PHONE</td>
        <td>VALUE</td>
        <td>PCS</td>
        <td>GROSS WEIGHT</td>
        <td>DESCRIPTION</td>
        <td>REMARKS</td>
    </tr>
    
    <?php
        
        $t = 1;
        $w = 0;
        $p = 0;
        
        for($i=0; $i<count($principals_prn); $i++){
            $sql = "SELECT consignment_booking.* FROM consignment_booking INNER JOIN consignment_booked ON consignment_booked.tracking_id = consignment_booking.tracking_id WHERE consignment_booked.principal_id = '$principals_prn[$i]' AND consignment_booked.date BETWEEN '$minformdate_prn' AND '$mintodate_prn'";
            $result = $db->link->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $t; ?></td>
                        <td></td>
                        <td><?php echo $row['awb_no']; ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td><?php echo $row['r_name']; ?></td>
                        <td><?php echo $db->getCountryName($row['r_country']); ?></td>
                        <td><?php echo $row['r_phone']; ?></td>
                        <td style="text-align: right;"><?php 
                                    if($row['g_customs_value'] == 0)
                                        echo 'NCV';
                                    else
                                        echo '$'.$row['g_customs_value'];
                            ?></td>
                        <td><?php echo $row['g_pieces']; ?></td>
                        <td><?php echo $row['g_weight']; ?></td>
                        <td><?php echo $row['g_title']; ?></td>
                        <td><?php echo $db->getPrincipalName($principals_prn[$i]); ?></td>
                    </tr>
                    <?php
                    $w += $row['g_weight'];
                    $p += $row['g_pieces'];
                    $t++;
                }
            }
            
        }
        
    ?>
    <tr style="display: none;">
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td style="text-align: center"><?php echo $p; ?></td>
       <td style="text-align: center"><?php echo $w; ?></td>
       <td></td>
       <td></td>
   </tr>
</table>

<input id="hid" type="hidden" value="<?php echo ceil($w); ?>">

<?php
}
    ?>
    <script>
        $("#save").click(function() {
            
            var hid = $("#hid").val();
            
            $("#gross").text(hid);
            
            $(".table2excel").tableHTMLExport({
                type: 'csv',
                filename: 'sample.csv'
            });
        });

    </script>
</body>

</html>
