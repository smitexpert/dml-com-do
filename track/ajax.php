<?php
require_once 'Database.php';

$db = new Database;


include('track_url.php');
include('dhl_track.php');
include('fed_track.php');
include('airborne_track.php');
include('ocs_track.php');

if(isset($_GET['awn'])){
    $awn = $_GET['awn'];
    
    $sql = "SELECT * FROM test_track WHERE dml_awn='$awn'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        $row = $query->fetch_assoc();
        $org_awn = $row['org_awn'];
        $principal = $row['principal'];
        
        $prin_array = getTrackUrl($row['principal'], $row['org_awn']);
        $dated = $row['dated'];
        
        
        $booking_date = $row['booking_date'];
        $date_time = date("Y-m-d H:i:s", strtotime($booking_date));
        
        $show_date = [
            'DATE' => $booking_date,
            'TIME' => date('H:i A', strtotime($dated)),
        ];
            
            ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-title">
                <h2>Consignment Details</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th style="width: 150px;">Consignment No.</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $row['dml_awn']; ?></td>
                        <th style="width: 150px;">Shipper Name</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $row['shipper_name']; ?></td>
                        <th style="width: 150px;">Consignee Name</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $row['consignee_name']; ?></td>
                    </tr>
                    <tr>
                        <th style="width: 130px;">Ref No.</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $row['org_awn']; ?></td>
                        <th style="width: 150px;">Origin</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $row['origin']; ?></td>
                        <th style="width: 150px;">Destination</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $row['destination']; ?></td>
                    </tr>
                    <tr>
                        <th style="width: 130px;">Services</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $prin_array['name']; ?></td>
                        <th style="width: 130px;">Ship Content</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $row['ship_content']; ?></td>
                        <th style="width: 130px;">Pcs</th>
                        <td style="width: 5px;">:</td>
                        <td><?php echo $row['pcs']; ?></td>
                    </tr>
                    <tr>
                        <th style="width: 130px;">Booking Date</th>
                        <td style="width: 5px;">:</td>
                        <td><?php $booking_date=$row['booking_date']; echo date('d M Y', strtotime($booking_date)); ?></td>
                        <th></th>
                        <td></td>
                        <td></td>
                        <th></th>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
      if($row['org_awn'] != "")  {
    
            
          
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="status_txt">
                    Shipment Connected With <?php echo $prin_array['name']; ?> with Ref # <span class="ref_num"><?php echo $row['org_awn']; ?></span> <a target="_blank" href="<?php echo $prin_array['url']; ?>">view at <?php echo $prin_array['name']; ?> website <i class="glyphicon glyphicon-new-window"></i></a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
       
      }else{
          ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="status_txt">
                    Shipment Waiting For Connecting With <?php echo $prin_array['name']; ?>.
                </p>
            </div>
        </div>
    </div>
</div>

<?php
      } 
?>

<!--<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-title">
                <h2>Shipper Info:</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 25%;">Shipper Name</th>
                                    <th style="width: 3px;">:</th>
                                    <td><?php echo $row['shipper_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Origin</th>
                                    <th>:</th>
                                    <td><?php echo $row['origin']; ?></td>
                                </tr>
                                <tr>
                                    <th>Ship Content</th>
                                    <th>:</th>
                                    <td><?php echo $row['ship_content']; ?></td>
                                </tr>
                                <tr>
                                    <th>Pcs</th>
                                    <th>:</th>
                                    <td><?php echo $row['pcs']; ?></td>
                                </tr>
                                <tr>
                                    <th>Booking Date</th>
                                    <th>:</th>
                                    <td><?php $booking_date=$row['booking_date']; echo date('d M Y', strtotime($booking_date)); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-title">
                <h2>Consignee Info:</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 28%;">Consignee Name</th>
                                    <th style="width: 5px;">:</th>
                                    <td><?php echo $row['consignee_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Destination</th>
                                    <th>:</th>
                                    <td><?php echo $row['destination']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-title">
                <h2>Tracking Progress:</h2>
            </div>
            <div class="card-body">


                <?php
        if(($principal == "DHL") && ($org_awn != "")){  
            
            dhl_tracking($org_awn);
            
        }elseif($principal == "FEDEX"){
            fedex_tracking($awn, $org_awn, $show_date);
        }elseif($principal == "AIRBORNE"){
            airborne_tracking($org_awn);
        }elseif($principal == "OCS"){
            ocs_tracking($org_awn);
        }else{
            ?>
                <table class="table tbl_five">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Activities</th>
                    </tr>
                    <tr>
                        <td><?php echo date('d M Y', strtotime($show_date['DATE'])) ?></td>
                        <td><?php echo date('H:i: A', strtotime($show_date['TIME'])) ?></td>
                        <td>DHAKA-BGD</td>
                        <td>Shipment picked up</td>
                    </tr>
                </table>
                <?php
            }
            ?>

            </div>
        </div>
    </div>
</div>


<?php
        
    }else{
        ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="status_txt">
                    Not Found!, Please check your AWB No.
                </p>
                <p style="text-align: center">
                    DML Help Line: <a href="tel: +880258052255">+88 (02) 5805-2255</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
    }
    
}



?>
