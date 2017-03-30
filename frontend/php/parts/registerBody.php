<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-9">

            <div class="thumbnail">
                <div class="caption-full" style="
                        padding-left: 130px;
                        padding-right: 140px;
                        padding-top: 25px;
                        padding-bottom: 25px;">
                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Register
                    </h3>
                    <br>
                   <form class="form-horizontal" action = "../php/register.php" method = "post">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="Email" value="<?php if(isset($_POST['register'])) {echo htmlspecialchars($_POST['Email']);}?>"  placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="Password" placeholder="Password">
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="inputFirstName" class="col-sm-3 control-label">First Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="FirstName" value="<?php if(isset($_POST['register'])) {echo htmlspecialchars($_POST['FirstName']);}?>" placeholder="First Name">
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="inputLastName" class="col-sm-3 control-label" style=" padding-left: 0px; padding-right: 0px;">Last Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="LastName" value="<?php if(isset($_POST['register'])) {echo htmlspecialchars($_POST['LastName']);}?>" placeholder="Last Name">
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="tel" class="form-control" name="Phone" value="<?php if(isset($_POST['register'])) {echo htmlspecialchars($_POST['Phone']);}?>" placeholder="Phone">
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="Address" value="<?php if(isset($_POST['register'])) {echo htmlspecialchars($_POST['Address']);}?>" placeholder="Address">
                        </div>
                      </div>
                      <div class="checkbox" style="margin-left: 140px;">
                        <label>
                          <input type="checkbox" name = "retailer"> Registered as Retailer
                        </label>
                      </div>
                      <br>
                      <button type="submit" class="btn btn-primary" name="register" style="margin-left: 200px;">Submit</button>
                    </form>

                    <?php foreach($errors as $err){
                       echo "$err";
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

</div>
