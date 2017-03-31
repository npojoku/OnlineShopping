<!-- populate fields with user information -->
<?php
$profile = getCustomer();
$retailer = getRetailer();
$cardList = getCardList();

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
                   <form class="form-horizontal" action="profile.php" method="post">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                          <input type="Email" class="form-control" name="Email" placeholder="Email" value="<?php echo $profile['Email']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="Password" placeholder="Password" value="<?php echo $profile['Password']; ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="inputFirstName" class="col-sm-3 control-label" style=" padding-left: 0px; padding-right: 0px;">First Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="FirstName" placeholder="First Name" value="<?php echo $profile['FirstName']; ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="inputLastName" class="col-sm-3 control-label" style=" padding-left: 0px; padding-right: 0px;">Last Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="LastName" placeholder="Last Name" value="<?php echo $profile['LastName']; ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="Phone" placeholder="Phone" value="<?php echo $profile['Phone']; ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="Address" placeholder="Address" value="<?php echo $profile['Address']; ?>">
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

                      <div class="form-group" style="display:block">
                              <table class="table table-bordered table-hover" id="tableAddRow">
                                  <thead>
                                      <tr>
                                          <th><label class="control-label">Credit Card #</label></th>
                                          <th><label class="control-label">Credit Expiration Date</label></th>
                                          <th style="width:10px">
                                            <span class="glyphicon glyphicon-plus btn" onclick="addTableRow(this)"></span></th>
                                      </tr>
                                    </thead>
                                    <tbody>

                      <!-- populate dynamic list of cards -->
                      <?php
                      $count = 0;
                      if ($cardList->num_rows > 0){

                        while ( $card = mysqli_fetch_array($cardList, MYSQLI_ASSOC) ) {
                          $cardId = $card['CardId'];
                          $cardName = $card['CreditCard'];
                          $cardDate = date("Y-m", strtotime($card['CreditExpDate']));

                            echo "<tr>";
                              echo "<td><input type='text' class='form-control' name='CreditCard[]' placeholder='Credit Card' value='$cardName'></td>";
                              echo "<td><input type='month' class='form-control' name='CreditExpDate[]' value='$cardDate'></td>";
                              echo "<td><input type='text' style='display:none' class='form-control' name='CardId[]' value='$cardId'><input type='button' class='btn form-control' onclick='removeCard(this)' value='-'></input></td>";
                            echo '</tr>';
                            $count = $count + 1;
                        }
                      }
                       ?>
                     </tbody>
                        </table>
                      </div>

                      <br>
                      <button type="submit" class="btn btn-primary" name="updatePerson" style="margin-left: 200px;">Update Profile</button>

                    </form>

                    <!-- populate error results from form submission -->
                    <?php foreach($errors as $err){
                      echo "$err";
                    }
                    ?>


                </div>
            </div>
        </div>

    </div>

</div>
