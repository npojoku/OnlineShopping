<!-- populate fields with user information -->
<?php
$profile = getCustomer();
$retailer = getRetailer();

// decide visibility of retailer
if($retailer){
  $retailCheck = "display:none";
  $retailFields = "display:block";
} else {
  $retailCheck = "display:block";
  $retailFields = "display:none";
}
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-9">

            <div class="thumbnail">
                <div class="caption-full" style="
                        padding-left: 140px;
                        padding-right: 140px;
                        padding-top: 25px;
                        padding-bottom: 25px;">
                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account Settings
                    </h3>
                   <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                          <input type="Email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $profile['Email']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="inputPassword" placeholder="Password" value="<?php echo $profile['Password']; ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="inputFirstName" class="col-sm-3 control-label" style=" padding-left: 0px; padding-right: 0px;">First Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputFirstName" placeholder="First Name" value="<?php echo $profile['FirstName']; ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="inputLastName" class="col-sm-3 control-label" style=" padding-left: 0px; padding-right: 0px;">Last Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputLastName" placeholder="Last Name" value="<?php echo $profile['LastName']; ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputPhone" placeholder="Phone" value="<?php echo $profile['Phone']; ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputAddress" placeholder="Address" value="<?php echo $profile['Address']; ?>">
                        </div>
                      </div>

                      <div class="checkbox" style="margin-left: 140px; <?php echo $retailCheck; ?>">
                        <label>
                          <input type="checkbox" name = "registerAsRetailer" onclick="showRetailerRegister('retailerRegister')"> Register as Retailer
                        </label>
                      </div>

                      <div class="form-group retailerRegister" style="<?php echo $retailFields; ?>">
                        <label class="col-sm-3 control-label">Shop Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="ShopName" placeholder="Shop Name" value="<?php echo $retailer['ShopName']; ?>">
                        </div>
                      </div>

                      <div class="form-group retailerRegister" style="<?php echo $retailFields; ?>">
                        <label for="inputPassword" class="col-sm-3 control-label">Deposit Account</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="DepositAccount" placeholder="Deposit Account" value="<?php echo $retailer['DepositAccount']; ?>">
                        </div>
                      </div>

                      <br>
                      <button type="submit" class="btn btn-primary" name="register" style="margin-left: 200px;">Update Profile</button>

                    </form>

                <!--    <form class="form-horizontal">
                    	<div class="row">
                              <table class="table table-bordered table-hover" id="tableAddRow">
                                  <thead>
                                      <tr>
                                          <th>Credit Card #</th>
                                          <th>CreditExpDate</th>
                                          <th style="width:10px"><span class="glyphicon glyphicon-plus addBtn" id="addBtn_0"></span></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr id="tr_0">
                                          <td><input type="text" id="creditCard#" class="form-control"/></td>
                                          <td><input type="text" id="creditExpDate" class="form-control" /></td>
                                          <td><span class="glyphicon glyphicon-minus addBtnRemove" id="addBtnRemove_0"></span></td>
                                      </tr>
                                  </tbody>
                              </table>
                        </div>
                      </form>-->
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
