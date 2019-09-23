<?php
require '../lib/Session.php';
require "../lib/Database.php";

Session::checkSession();

$db = new Database();
$ndb = new Database();


if(isset($_POST['dml_zone_view'])){
    $zone = $_POST['dml_zone_view'];
    
//    $sql = "SELECT * FROM dml_zone WHERE zone='$zone'";
    $sql = "SELECT tbl_country.country_name, dml_zone.* FROM dml_zone INNER JOIN tbl_country ON tbl_country.country_tag = dml_zone.country_tag WHERE dml_zone.zone = '$zone' ORDER BY tbl_country.country_name ASC";
    $query = $db->link->query($sql);
    $id = 1;
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $row['country_name']; ?></td>
                <td><?php echo $row['country_tag']; ?></td>
                <td><button class="btn btn-sm btn-block btn-warning" id="<?php echo $row['id']; ?>" onclick="removeCountry(event)">REMOVE</button></td>
            </tr>
            <?php
            $id++;
        }
    }else{
        echo '0';
    }
}


if(isset($_POST['dml_zone_cn_remove'])){
    $id = $_POST['dml_zone_cn_remove'];
    
    $sql = "DELETE FROM dml_zone WHERE id='$id'";
    $query = $db->link->query($sql);
    
    if($query){
        echo '1';
    }else{
        echo '0';
    }
}

?>