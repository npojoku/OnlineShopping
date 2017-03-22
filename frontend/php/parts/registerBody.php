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
                    <h3>Register
                    </h3>
                    <br>
                    <div class="dropdown">
                        <label class="col-sm-2 control-label" style="width: 110px;">Register as</label>
                          <button class="btn btn-default dropdown-toggle" type="button" id="ddl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            -- Select --
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#">Customer</a></li>
                            <li><a href="#">Retailer</a></li>
                          </ul>
                        </div>
                    <br>
                   <form class="form-horizontal" action = "../../backend/register/personRegister.php" method = "post">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="Email" class="form-control" name="Email" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="Password" placeholder="Password">
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="inputFirstName" class="col-sm-2 control-label" style=" padding-left: 0px; padding-right: 0px;">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="FirstName" placeholder="First Name">
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="inputLastName" class="col-sm-2 control-label" style=" padding-left: 0px; padding-right: 0px;">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="LastName" placeholder="Last Name">
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Phone" placeholder="Phone">
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Address" placeholder="Address">
                        </div>
                      </div>
                      <br>
                      <button type="submit" class="btn btn-primary" style="margin-left: 200px;">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
