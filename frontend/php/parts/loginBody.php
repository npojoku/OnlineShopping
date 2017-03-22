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
                   <form action = "../../backend/login/logIn.php" method = "post">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name = "Email" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name = "Password" placeholder="Password">
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Remember me
                        </label>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
