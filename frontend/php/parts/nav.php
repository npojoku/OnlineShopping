<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <!-- header title -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href='productList.php'>
              <?php echo $title; ?>
            </a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

              <!-- Products toggle menu - don't display if not logged in-->
              <li class="dropdown" id="products-menu" <?php if (! isLoggedIn()){?>style="display:none"<?php } ?>>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Products
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">

                    <!-- view products available to all logged-in users -->
                    <li>
                      <a href="productList.php">
                        View Products
                      </a>
                    </li>

                    <!-- manage products available to all retailers -->
                    <li <?php if (! isRetailer()){?>style="display:none"<?php } ?>>
                      <a href="manageProducts.php">
                        Manage Products
                      </a>
                    </li>

                  </ul>
                </li>

                <!-- Orders toggle menu - don't display if not logged in-->
                <li class="dropdown" id="orders-menu" <?php if (! isLoggedIn()){?>style="display:none"<?php } ?>>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Orders
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">

                    <!-- view orders available to all logged-in users -->
                    <li>
                      <a href="orderList.php">
                        View Orders
                      </a>
                    </li>

                    <!-- orders Received available to all retailers -->
                    <li <?php if (! isRetailer()){?>style="display:none"<?php } ?>>
                      <a href="orderReceived.php">
                        Manage Orders
                      </a>
                    </li>

                  </ul>
                </li>

                <!-- link to user profile - don't display if not logged in -->
                <li <?php if (! isLoggedIn()){?>style="display:none"<?php } ?>>
                    <a href="profile.php" id="profile-menu">
                      Profile
                    </a>
                </li>

                <!-- user sign out - don't display if not logged in -->
                <li <?php if (! isLoggedIn()){?>style="display:none"<?php } ?>>
                    <!-- login backend will automatically sign out if it does not get a log in request -->
                    <a href="login.php" id="signout-menu">
                      Sign Out
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
