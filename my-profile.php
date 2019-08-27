<?php

include('includes/extra-page-header.php'); 

$has_msg = "";

if(isset($_POST['newname'])){
    $newname = $_POST['newname'];
    $adminId = Session::get('adminId');
    $password = $_POST['password'];
    $password = md5($password);
    
    $sql = "SELECT password FROM user WHERE userId='$adminId'";
    $result = $db->link->query($sql);
    
    $row = $result->fetch_array();
    
    if($row[0] == $password){
        $up = "UPDATE user SET name='$newname' WHERE userId='$adminId'";
        $upr = $db->link->query($up);
        if($upr){
            Session::set("adminUser", $newname);
            header("location: ".$_SERVER['PHP_SELF']."?success");
        }else{
            header("location: ".$_SERVER['PHP_SELF']."?error");
        }
    }else{
        header("location: ".$_SERVER['PHP_SELF']."?error=password");
    }
    
}

if(isset($_GET['error'])){
    $error = $_GET['error'];
    if($error == 'password'){
        $has_msg = "has-error";
    }
}

if(isset($_POST['c_password'])){
    $old_pass = $_POST['c_password'];
    $old_pass = md5($old_pass);
    $new_pass = $_POST['n_password'];
    $re_pass = $_POST['r_password'];
    $adminId = Session::get('adminId');
    
    $sql = "SELECT password FROM user WHERE userId='$adminId'";
    $result = $db->link->query($sql);
    $row = $result->fetch_array();
    
    if($row[0] == $old_pass){
        if($new_pass == $re_pass){
            $new_pass = md5($new_pass);
            $update = "UPDATE user SET password='$new_pass' WHERE userId='$adminId'";
            $up_result = $db->link->query($update);
            if($up_result){
                header("location: ".$_SERVER['PHP_SELF']."?pass_success");
            }else{
                header("location: ".$_SERVER['PHP_SELF']."?pass_error=password");
            }
        }else{
            header("location: ".$_SERVER['PHP_SELF']."?pass_error=password");
        }
    }else{
        header("location: ".$_SERVER['PHP_SELF']."?pass_error=password");
    }
}

?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">

    <?php include('includes/sidebar-menu.php'); ?>

    <div class="main-content">

        <div class="container"><br><br>


            <div class="row">
                <div class="col-md-6">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" role="form" id="staff_form" method="POST">

                        <?php
                                        if(isset($_GET['success'])){
                                            ?>
                        <div class="alert alert-success alert-dismissible">
                            <strong>Success!</strong> Your Name is Update!
                        </div>
                        <?php
                                        }else if(isset($_GET['error'])){
                                             ?>
                        <div class="alert alert-danger alert-dismissible">
                            <strong>Error!</strong> Something Error!
                        </div>
                        <?php
                                        }
                                    ?>

                        <div class="panel panel-default">
                            <div class="panel-heading bdOrange">
                                Name Update Form
                            </div>


                            <div class="panel-body">



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userid" class="control-label">
                                                Current Name
                                            </label>
                                            <input type="text" required class="form-control" name="staffRegId" id="userid" value="<?php echo Session::get('adminUser'); ?>" disabled>
                                            <input type="hidden" name="adminUser" value="<?php echo Session::get('adminId') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                New Name <span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" name="newname" id="newname" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group <?php echo $has_msg; ?>">
                                            <label for="userRegName" class="control-label">
                                                Current Password <span class="symbol required"></span>
                                            </label>
                                            <input type="password" class="form-control" name="password" id="password" value="" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                </div><br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group connected-group">
                                            <input class="btn btn-lg btn-warning btn-block" type="submit" name="submit" value="submit">
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </form>
                </div>
                <div class="col-md-6">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" role="form" id="staff_form" method="POST">

                        <?php
                                        if(isset($_GET['pass_success'])){
                                            ?>
                        <div class="alert alert-success alert-dismissible">
                            <strong>Success!</strong> Your Password is Updated!
                        </div>
                        <?php
                                        }else if(isset($_GET['pass_error'])){
                                             ?>
                        <div class="alert alert-danger alert-dismissible">
                            <strong>Error!</strong> Something Error!
                        </div>
                        <?php
                                        }
                                    ?>

                        <div class="panel panel-default">
                            <div class="panel-heading bdOrange">
                                Password Update Form
                            </div>


                            <div class="panel-body">



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                Current Password <span class="symbol required"></span>
                                            </label>
                                            <input type="password" class="form-control" name="c_password" id="c_password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                New Password <span class="symbol required"></span>
                                            </label>
                                            <input type="password" class="form-control" name="n_password" id="n_password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userRegName" class="control-label">
                                                Re-Password <span class="symbol required"></span>
                                            </label>
                                            <input type="password" class="form-control" name="r_password" id="r_password" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                </div><br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group connected-group">
                                            <input class="btn btn-lg btn-warning btn-block" type="submit" name="submit" value="submit">
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



<?php 
include('includes/footer.php');
?>
