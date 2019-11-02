<?php

include("header.php");

?>

<div class="main-content">
    <div class="container"><br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="nav_view">
                    <div class="nav nav-pills">
                        <li class="active"><a href="#" id="profile">UPDATE PROFILE</a></li>
                        <li><a href="#" id="password">UPDATE PASSWORD</a></li>
                    </div>
                </div>
            </div>
        </div>
        <BR>
        <div class="view-item" id="view_profile" style="display:block">
            <div class="row" style="display:flex; justify-content:center; align-items:center">
                <div class="col-md-10" style="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            UPDATE PROFILE
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form" id="fcorpo_orm" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="errorHandler alert alert-danger no-display">
                                            <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                        </div>
                                        <div class="successHandler alert alert-success no-display">
                                            <i class="fa fa-ok"></i> Your form validation is successful!
                                        </div>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="col-md-12">
                                            <?php
                                            if (isset($insertCorpoClient)) { ?>
                                                <div class="alert alert-info fade in">
                                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                    <strong>
                                                        <?php echo $insertCorpoClient; ?>
                                                    </strong>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Agent id</label>
                                            <input type="text" class="form-control" name="agent_id" value="<?php echo $agent_id; ?>" readonly>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Agent Name<span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="agent_name" name="agent_name" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Company Name<span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="client_company" name="client_company" required>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Email Address <span class="symbol required"></span>
                                            </label>
                                            <input class="form-control" type="email" required id="client_mail" name="client_mail">
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Contact <span class="symbol required"></span>
                                            </label>
                                            <input type="text" required class="form-control" name="client_contact" id="client_contact">
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">
                                                Address <span class="symbol required"></span>
                                            </label>
                                            <input type="textarea" required class="form-control" id="client_addr" name="client_addr">
                                        </div>

                                        

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label">
                                                Bank Name
                                            </label>
                                            <input type="textarea" class="form-control" id="bank_name" name="bank_name">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Account Name
                                            </label>
                                            <input type="textarea" class="form-control" id="account_name" name="account_name">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Account Number
                                            </label>
                                            <input type="textarea" class="form-control" id="acc_num" name="acc_num">
                                        </div>

                                        <div class="form-group connected-group">
                                            <label class="control-label">Sales & Marketing<span class="symbol required"></span>
                                            </label>
                                            <select name="corpoAssignTo" id="corpoAssignTo" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                <option value="">--</option>
                                                <?php
                                                $query2 = "SELECT * FROM user WHERE status=1 AND rule != 1";
                                                $selectstuff = $db->link->query($query2);
                                                if ($selectstuff) {
                                                    while ($getstuff = $selectstuff->fetch_assoc()) { ?>
                                                        <option value="<?php echo $getstuff['userId']; ?>"><?php echo $getstuff['name']; ?></option>
                                                <?php }
                                                } else { } ?>

                                            </select>
                                        </div><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="btn btn-md btn-warning btn-block" type="submit" name="submit" value="submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="view-item" id="view_password" style="display:none">
            <div class="row" style="display:flex; justify-content:center; align-items:center">
                <div class="col-md-10" style="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            UPDATE PASSWORD
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <form action="#" id="update_password">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="old_pass">OLD PASSWORD</label><span class="symbol required"></span>
                                            <input class="form-control" type="password" name="old_pass" id="old_pass" required>
                                            <input class="form-control" type="hidden" name="agent_email" id="agent_email" value="<?php echo $agent_email; ?>">
                                            <input class="form-control" type="hidden" name="agent_id" id="agent_id" value="<?php echo $id; ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="new_pass">NEW PASSWORD</label><span class="symbol required"></span>
                                            <input class="form-control" type="password" name="new_pass" id="new_pass" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="new_pass">CONFIRM PASSWORD</label><span class="symbol required"></span>
                                            <input class="form-control" type="password" name="confirm_pass" id="confirm_pass" minlength="6" required>
                                        </div>
                                    </div>

                                    <div class="col-md-9">

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <br>
                                            <div class="gap" style="width: 100%; float: left; margin-top: 3px;"></div>
                                            <button class="btn btn-warning btn-block btn-sm" id="upPass">UPDATE PASSWORD</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="view-item" id="view_password" style="display:none">
            <div class="row" style="display:flex; justify-content:center; align-items:center">
                <div class="col-md-10" style="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            UPDATE PASSWORD
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <form action="#" id="update_password">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="old_pass">OLD PASSWORD</label><span class="symbol required"></span>
                                            <input class="form-control" type="password" name="old_pass" id="old_pass" required>
                                            <input class="form-control" type="hidden" name="agent_email" id="agent_email" value="<?php echo $agent_email; ?>">
                                            <input class="form-control" type="hidden" name="agent_id" id="agent_id" value="<?php echo $id; ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="new_pass">NEW PASSWORD</label><span class="symbol required"></span>
                                            <input class="form-control" type="password" name="new_pass" id="new_pass" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="new_pass">CONFIRM PASSWORD</label><span class="symbol required"></span>
                                            <input class="form-control" type="password" name="confirm_pass" id="confirm_pass" minlength="6" required>
                                        </div>
                                    </div>

                                    <div class="col-md-9">

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <br>
                                            <div class="gap" style="width: 100%; float: left; margin-top: 3px;"></div>
                                            <button class="btn btn-warning btn-block btn-sm" id="upPass">UPDATE PASSWORD</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include("footer.php");

?>