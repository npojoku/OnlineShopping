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
                    <h3>Log In
                    </h3>
                    <br>
                   <form action = "login.php" method = "post">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name = "Email" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name = "Password" placeholder="Password">
                      </div>
                      <button type="submit" name="login" class="btn btn-primary">Submit</button>
                    </form>

                    <!-- new user register -->
                    <div>
                      <h5><i>New user?</i></h5>
                      <a href="register.php">
                        <i>Create new account</i>
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
