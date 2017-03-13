<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#ddl').on('change', function() {
              if ( this.value == '1')
              //.....................^.......
              {
                $("#retailer").show();
              }
              else
              {
                $("#retailer").hide();
              }
            });
        });
    </script>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Scythian</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Products
                        <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">View Products</a></li>
                        <li><a href="#">Manage Products</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Orders
                        <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">View Orders</a></li>
                        <li><a href="#">Manage Orders</a></li>
                      </ul>
                    </li>
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    <li>
                        <a href="#">Sign Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

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
                       <form class="form-horizontal">
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input type="Email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                            </div>
                          </div>
                        <div class="form-group">
                            <label for="inputFirstName" class="col-sm-2 control-label" style=" padding-left: 0px; padding-right: 0px;">First Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                            </div>
                          </div>
                        <div class="form-group">
                            <label for="inputLastName" class="col-sm-2 control-label" style=" padding-left: 0px; padding-right: 0px;">Last Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                            </div>
                          </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputPhone" placeholder="Phone">
                            </div>
                          </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputAddress" placeholder="Address">
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Scythian 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

</body>

</html>
