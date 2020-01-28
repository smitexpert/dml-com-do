<?php

require "../../lib/Database.php";

$db = new Database;
$dbn = new Database;

if(isset($_POST['dml_awn'])){
    $dml_awn = $_POST['dml_awn'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $activities = $_POST['activities'];
    
    $sql = "INSERT INTO test_track_update (dml_awn, date, time, location, activities) VALUES ('$dml_awn', '$date', '$time', '$location', '$activities')";

    $query = $db->link->query($sql);

    if($query){
        echo '1';
    }else{
        echo $db->link->error;
    }
}

if(isset($_POST['get_update_table'])){
    $id = $_POST['get_update_table'];

    $sql = "SELECT * FROM test_track_update WHERE dml_awn='$id' ORDER BY id DESC";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
                <tr>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['activities']; ?></td>
                    <td><button class="btn btn-danger">DEL</button></td>
                </tr>
            <?php
        }
    }
}

?>