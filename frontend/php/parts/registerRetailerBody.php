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
                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shop Information
                    </h3>
                    <br>
                   <form class="form-horizontal" action = "../php/registerRetailer.php" method = "post">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Shop Name</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="ShopName" placeholder="Shop Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Deposit Account</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="DepositAccount" placeholder="Deposit Account">
                        </div>
                      </div>
                      </div>
                      <br>
                      <button type="submit" class="btn btn-primary" name="registerRetailer" style="margin-left: 200px;">Submit</button>
                      <br>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
