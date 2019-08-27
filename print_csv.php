       <!DOCTYPE html>
       <html lang="en">

       <head>
           <meta charset="UTF-8">
           <script src="assets/jQuery/jquery-3.3.1.min.js"></script>
           <script src="assets/js/tableHTMLExport.js"></script>
       </head>

       <body>
          <button id="save">DOWNLOAD</button>
           <?php
        require 'lib/Session.php';
        require "lib/Database.php";

        Session::checkSession();

        $db = new Database();
        /*$filename = time();*/
           
        if(isset($_POST['principal_id'])){
            $principal_id = $_POST['principal_id'];
            $fromdate = $_POST['fromdate'];
            $todate = $_POST['todate'];

            $filename = $db->getPrincipalName($principal_id).'_'.$fromdate.'_'.$todate.'.csv';

            $output = fopen('php://output', 'w');

            $is_print = 0;

            /*----------------------------------------------------------*/


            if($principal_id == 1){
                
                $csv = "DHL AWB NO, SHIPPER REFERENCE, SHIPPER COMPANY, SHIPPER ATTN NAME, SHIPPER COUNTRY, RECEIVER COMPANY, RECEIVER ATTN, RECEIVER ADD 1, RECEIVER ADD 2, RECEIVER ADD 3, RECEIVER CITY, RECEIVER POSTAL CODE, RECEIVER COUNTRY CODE, RECEIVER PHONE, RECEIVER MOBILE, SHIPMENT PIECES, SHIPMENT WEIGHT, LOCAL PRODUCT CODE, CONTENTS, ROUNDED WEIGHT, SHIPMENT DECLARED VALUE\n";
                
                ?>

           <table border="1" class="table2excel">
               <tr>
                   <td>DHL AWB NO</td>
                   <td>SHIPPER REFERENCE</td>
                   <td>SHIPPER COMPANY</td>
                   <td>SHIPPER ATTN NAME</td>
                   <td>SHIPPER COUNTRY</td>
                   <td>RECEIVER COMPANY</td>
                   <td>RECEIVER ATTN</td>
                   <td>RECEIVER ADD 1</td>
                   <td>RECEIVER ADD 2</td>
                   <td>RECEIVER ADD 3</td>
                   <td>RECEIVER CITY</td>
                   <td>RECEIVER POSTAL CODE</td>
                   <td>RECEIVER COUNTRY CODE</td>
                   <td>RECEIVER PHONE</td>
                   <td>RECEIVER MOBILE</td>
                   <td>SHIPMENT PIECES</td>
                   <td>SHIPMENT WEIGHT</td>
                   <td>LOCAL PRODUCT CODE</td>
                   <td>CONTENTS</td>
                   <td>ROUNDED WEIGHT</td>
                   <td>SHIPMENT DECLARED VALUE</td>
               </tr>
               <?php
                        $sql = "SELECT tracking_id FROM consignment_booked WHERE principal_id='$principal_id' AND assigned_date BETWEEN '$fromdate' AND '$todate' AND status='0'";
                        $query = $db->link->query($sql);
                        if($query->num_rows > 0){
                            $is_print = 1;
                            while($rowR = $query->fetch_assoc()){
                                $tr = $rowR['tracking_id'];

                                $conQl = "SELECT * FROM consignment_booking WHERE tracking_id='$tr'";
                                $conQry = $db->link->query($conQl);
                                while($row = $conQry->fetch_assoc()){
                                    $csv .= " ,".$row['tracking_id'].", ".$row['s_company'].", ".$row['s_name'].", ".$row['s_country'].", ".$row['r_company'].", ".$row['r_name'].",\" ".$row['r_address1']."\",\"  ".$row['r_address2']."\",\" ".$row['r_address3']."\", ".$row['r_city'].", ".$row['r_zip'].", ".$row['r_country'].", ".$row['r_phone'].", ".$row['r_mobile'].", ".$row['g_pieces'].", ".$row['g_weight'].", ".$row['g_type'].", ".$row['g_title'].", ".$row['g_weight'].", ".$row['g_customs_value']."\n";
                                    ?>
               <tr>
                   <td></td>
                   <td><?php echo $row['tracking_id']; ?></td>
                   <td><?php echo $row['s_company']; ?></td>
                   <td><?php echo $row['s_name']; ?></td>
                   <td><?php echo $row['s_country']; ?></td>
                   <td><?php echo $row['r_company']; ?></td>
                   <td><?php echo $row['r_name']; ?></td>
                   <td><?php echo $row['r_address1']; ?></td>
                   <td><?php echo $row['r_address2']; ?></td>
                   <td><?php echo $row['r_address3']; ?></td>
                   <td><?php echo $row['r_city']; ?></td>
                   <td><?php echo $row['r_zip']; ?></td>
                   <td><?php echo $row['r_country']; ?></td>
                   <td><?php echo $row['r_phone']; ?></td>
                   <td><?php echo $row['r_mobile']; ?></td>
                   <td><?php echo $row['g_weight']; ?></td>
                   <td><?php echo $row['g_type']; ?></td>
                   <td><?php echo $row['g_title']; ?></td>
                   <td><?php echo $row['g_weight']; ?></td>
                   <td><?php echo $row['g_customs_value']; ?></td>
               </tr>
               <?php
                                }
                                $csv_handler = fopen ("csv/".$filename,'w');
                                fwrite ($csv_handler, $csv);
                                fclose ($csv_handler);
                                
                            }
                        }
                    ?>
           </table>

           <?php
                
                
            }else if($principal_id == 2){
                
                $csv = "FEDEX AWB NO, SHIPMENT ACCOUNT NO, SHIPPER_COMPANY, SHIPPER_ATTN, SHIPPER_ADD1, SHIPPER_ADD2, SHIPPER_CITY,  SHIPPER_PHONE, SENDER_REFERENCE, RECEIVER_COMPANY, RECEIVER_ATTENTION, RECEIVER_ADDRESS_1, RECEIVER_ADDRESS_2, RECEIVER_CITY, RECEIVER_STATE, RECEIVER_ZIP, RECEIVER_COUNTRY, RECEIVER_PHONE, RECEIVER EMAIL, SHIPMENT_PIECES, TOTAL_WEIGHT, CUSTOM_VALUE, DESCRIPTION, COUNTRY OF MANUFACTURE, SERVICE TYPE, DOCUMENT TYPE\n";
                
                ?>

           <table border="1" class="table2excel">
               <tr>
                   <td>FEDEX AWB NO</td>
                   <td>SHIPMENT ACCOUNT NO</td>
                   <td>SHIPPER_COMPANY</td>
                   <td>SHIPPER_ATTN</td>
                   <td>SHIPPER_ADD1</td>
                   <td>SHIPPER_ADD2</td>
                   <td>SHIPPER_CITY</td>
                   <td>SHIPPER_PHONE</td>
                   <td>SENDER_REFERENCE</td>
                   <td>RECEIVER_COMPANY</td>
                   <td>RECEIVER_ATTENTION</td>
                   <td>RECEIVER_ADDRESS_1</td>
                   <td>RECEIVER_ADDRESS_2</td>
                   <td>RECEIVER_CITY</td>
                   <td>RECEIVER_STATE</td>
                   <td>RECEIVER_ZIP</td>
                   <td>RECEIVER_COUNTRY</td>
                   <td>RECEIVER_PHONE</td>
                   <td>RECEIVER EMAIL</td>
                   <td>SHIPMENT_PIECES</td>
                   <td>TOTAL_WEIGHT</td>
                   <td>CUSTOM_VALUE</td>
                   <td>DESCRIPTION</td>
                   <td>COUNTRY OF MANUFACTURE</td>
                   <td>SERVICE TYPE</td>
                   <td>DOCUMENT TYPE</td>
               </tr>
               <?php
                       $sql = "SELECT tracking_id FROM consignment_booked WHERE principal_id='$principal_id' AND assigned_date BETWEEN '$fromdate' AND '$todate' AND status='0'";
                $query = $db->link->query($sql);
                if($query->num_rows > 0){
                    $is_print = 1;
                    while($rowR = $query->fetch_assoc()){
                        $tr = $rowR['tracking_id'];

                        $conQl = "SELECT * FROM consignment_booking WHERE tracking_id='$tr'";
                        $conQry = $db->link->query($conQl);
                        while($row = $conQry->fetch_assoc()){
                            
                            
                            $csv .= ",,".$row['s_company'].",".$row['s_name'].",".$row['s_country'].",\" ".$row['s_address']."\", ,".$row['s_contact'].",".$row['tracking_id'].",".$row['r_company'].",".$row['r_name'].",\" ".$row['r_address1']."\",\" ".$row['r_address2']."\",".$row['r_city'].",".$row['r_country'].",".$row['r_zip'].",".$row['r_country'].",".$row['r_phone'].",".$row['r_email'].",".$row['g_pieces'].",".$row['g_weight'].",".$row['g_customs_value'].",".$row['g_title'].",\" CN\",\" IP\",".$row['g_type']."\n";
                    ?>
               <tr>
                   <td></td>
                   <td></td>
                   <td><?php echo $row['s_company']; ?></td>
                   <td><?php echo $row['s_name']; ?></td>
                   <td><?php echo $row['s_country']; ?></td>
                   <td><?php echo $row['s_address']; ?></td>
                   <td></td>
                   <td><?php echo $row['s_contact']; ?></td>
                   <td><?php echo $row['tracking_id']; ?></td>
                   <td><?php echo $row['r_company']; ?></td>
                   <td><?php echo $row['r_name']; ?></td>
                   <td><?php echo $row['r_address1']; ?></td>
                   <td><?php echo $row['r_address2']; ?></td>
                   <td><?php echo $row['r_city']; ?></td>
                   <td><?php echo $row['r_country']; ?></td>
                   <td><?php echo $row['r_zip']; ?></td>
                   <td><?php echo $row['r_country']; ?></td>
                   <td><?php echo $row['r_phone']; ?></td>
                   <td><?php echo $row['r_email']; ?></td>
                   <td><?php echo $row['g_pieces']; ?></td>
                   <td><?php echo $row['g_weight']; ?></td>
                   <td><?php echo $row['g_customs_value']; ?></td>
                   <td><?php echo $row['g_title']; ?></td>
                   <td>CN</td>
                   <td>IP</td>
                   <td><?php echo $row['g_type']; ?></td>
               </tr>
               <?php
                                }
                            }
                        }
                    ?>
           </table>

           <?php
                
                $csv_handler = fopen ("csv/".$filename,'w');
                fwrite ($csv_handler, $csv);
                fclose ($csv_handler);
                
            }else{
                header("location: index.php");
            }


            /* end all csv create code*/

            /* checque csv*/
            if($is_print == 1){

                $sql_up = "UPDATE consignment_booked SET status='1' WHERE principal_id='$principal_id' AND assigned_date BETWEEN '$fromdate' AND '$todate'  AND status='0'";
                $query_up = $db->link->query($sql_up);
            }

        }else{
            header("location: index.php");
        }

        ?>

           <script>
               $("#save").click(function(){
                   $(".table2excel").tableHTMLExport({
                       type: 'csv',
                       filename: 'sample.csv'
                   });
               });

           </script>
       </body>

       </html>
