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
                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Information&nbsp;&nbsp;
                    </h3>

                    <br>

                    <form class="form-horizontal" action = "../php/registerCard.php" method = "post">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Credit Card</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="CreditCard" placeholder="Credit Card #">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">Expiry Date</label>
                        <div class="col-sm-7">
                          <input type="month" class="form-control" name="CreditExpDate" placeholder="Expiry Date">
                        </div>
                      </div>
                      <br>
                      <button type="submit" class="btn btn-primary" name="registerCard" style="margin-left: 200px;">Submit</button>
                    </form>

                    <!-- skip card information -->
                    <div>
                      <a href="ProductList.php">
                        <i>Skip this for now.</i>
                      </a>
                    </div>

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
