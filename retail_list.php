<?php
include('includes/header.php');
$sql = "SELECT * FROM retail_customer";

?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>

    <!-- start: PAGE -->
    <div class="main-content">
        <div class="container"><br><br>
            <!-- start: PAGE CONTENT -->
            <!-- CLIENT PRICE SEARCH PORTION STARTS -->
            <div class="row">
                <div class="col-md-8">
                    <h3>Retail Customer List</h3>
                </div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <button class="btn btn-warning" data-toggle='modal' data-target="#add_modal">Add New</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="retail_customer_list">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Mobile No.</th>
                                <th>Email.</th>
                                <th>Address</th>
                                <th>Destination</th>
                                <th>Types</th>
                                <th>weight</th>
                                <th>Cost</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $db->link->query($sql);
                            if($query->num_rows > 0){
                                $i=1;
                                while($row = $query->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <th><?php echo $i++; ?></th>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['company_name']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['destination']; ?></td>
                                        <td><?php echo $row['types']; ?></td>
                                        <td><?php echo $row['weight']; ?></td>
                                        <td><?php echo $row['cost']; ?></td>
                                        <td><a id="customer_<?php echo $row['id']; ?>" href="#" class="btn btn-sm btn-warning customer_view" data-toggle="modal" data-target="#view_modal">#</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add_modal" class="modal fade" role="dialog" style="">
  <div class="">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Retail Customer Information</h4>
      </div>
      <div class="modal-body" id="add_body">
          <form action="" id="retail_customer_add_form">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" id="name" class="form-control" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="company_name">Company Name</label>
                          <input type="text" name="company_name" id="company_name" class="form-control">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="mobile">Mobile</label>
                          <input type="text" name="mobile" id="mobile" class="form-control" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" name="email" id="email" class="form-control">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <label for="address">Address</label>
                      <input type="text" id="address" name="address" class="form-control">
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="types">Types</label>
                          <select name="types" id="types" class="form-control">
                              <option value="">--</option>
                              <option value="DOX">Document</option>
                              <option value="SPX">Parcel</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="weight">Weight</label>
                          <input type="text" name="weight" id="weight" class="form-control">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="destination">Destination</label>
                          <select name="destination" id="destination" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                              <option value="">--</option>
                              <?php
                              $sql = "SELECT * FROM tbl_country";
                              $query = $db->link->query($sql);
                              if($query->num_rows > 0){
                                  while($row = $query->fetch_assoc()){
                                      ?>
                                      <option value="<?php echo $row['country_tag']; ?>"><?php echo $row['country_name']; ?></option>
                                      <?php
                                  }
                              }
                              ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="cost">Price/Cost</label>
                          <input type="text" name="cost" id="cost" class="form-control">
                      </div>
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <button class="btn btn-sm btn-warning btn-block">Submit</button>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="view_modal" class="modal fade" role="dialog" style="">
  <div class="">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Information of Retail Customer</h4>
      </div>
      <div class="modal-body" id="view_body">
         <form action="" id="retail_customer_update">
             <div class="row">
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="name">Name</label>
                         <input type="text" name="name" id="name" class="form-control">
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="company_name">Company Name</label>
                         <input type="text" name="company_name" id="company_name" class="form-control">
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="mobile_no">Mobile No.</label>
                         <input type="text" name="mobile_no" id="mobile_no" class="form-control">
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="email">Email</label>
                         <input type="text" name="email" id="email" class="form-control">
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12">
                     <div class="form-group">
                         <label for="address">Address</label>
                         <input type="text" name="address" id="address" class="form-control">
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12">
                     <button class="btn btn-sm btn-warning btn-block">UPDATE</button>
                 </div>
             </div>
         </form>
         <br>
         <form action="" id="convert_to">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="convert">Retail Migrate To</label>
                        <select name="convert" id="convert" class="form-control">
                            <option value="corporate">corporate</option>
                            <option value="agent">Agent</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-warning btn-block">MIGRATE</button>
                </div>
            </div>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php include('includes/footer.php'); ?>
<script src="scripts/retail_list.js"></script>