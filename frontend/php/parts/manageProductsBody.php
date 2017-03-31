<!-- populate fields with user information -->
<?php
$productList = getProductList();
$retailedList = getRetailerProductList();
$qualityList = getQualityList();

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
                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manage Shop Products
                    </h3>
                    <a href="createProduct.php">Create a new product</a>

                    <br>

                   <form class="form-horizontal" action="manageProducts.php" method="post">

                      <div class="form-group" style="display:block">
                              <table class="table table-bordered table-hover" id="tableAddRow">
                                  <thead>
                                      <tr>
                                          <th><label class="control-label">Product</label></th>
                                          <th><label class="control-label">Used</label></th>
                                          <th><label class="control-label">Quantity</label></th>
                                          <th><label class="control-label">Price $</label></th>
                                          <th style="width:10px">
                                            <span class="glyphicon glyphicon-plus btn" onclick="addTableRow(this)"></span></th>
                                      </tr>
                                    </thead>
                                    <tbody>

                      <!-- populate dynamic list of cards -->
                      <?php
                      if ($retailedList->num_rows > 0){

                        while ( $retailed = mysqli_fetch_array($retailedList, MYSQLI_ASSOC) ) {
                          $ProductId = $retailed['ProductId'];
                          $Type = $retailed['Type'];
                          $Quantity = $retailed['Quantity'];
                          $QualityId = $retailed['QualityId'];
                          $Price = $retailed['Price'];

                            echo "<tr>";

                              // drop down of product name and description
                              echo "<td>";
                                echo "<select style='width:100px'>";

                                foreach ($productList as $productField){
                                    $productId = $productField['ProductId'];
                                    $productName = $productField['ProductName'];
                                    $productDescription = $productField['ProductDescription'];
                                    $entry = "'$productName' - '$productDescription'";

                                    echo "<option value='$productId'>$entry</option>";
                                }

                                echo "</select>";
                              echo "</td>";

                              // drop down of quality (enable only if used)
                              echo "<td>";
                                echo "<div class='form-group'>";
                                if($Type){
                                  // new
                                  echo '<input type="checkbox" class="col-sm-1" name = "Type[]" onclick="toggleQuality(this)"></input>';
                                  echo "<select class='col-sm-7' disabled>";
                                } else {
                                  // used
                                  echo '<input type="checkbox" class="col-sm-1" name = "Type[]" onclick="toggleQuality(this)" checked></input>';
                                  echo "<select class='col-sm-7'>";
                                }

                                foreach ($qualityList as $qualityField){
                                    $qualityId = $qualityField['QualityId'];
                                    $qualityName = $qualityField['Name'];

                                    echo "<option value='$qualityId'>$qualityName</option>";
                                }

                                echo "<option value='-1'>New (No Quality)</option>";

                                echo '</select>';
                                echo "</div>";
                              echo '</td>';

                              // quantity
                              echo "<td><input type='number' class='form-control' name='Quantity[]' placeholder='' value='$Quantity'></td>";

                              // price
                              echo "<td><input type='number' min='0.01' step='0.01' class='form-control' name='Price[]' placeholder='' value='$Price'></td>";

                            echo '</tr>';
                        }
                      }
                       ?>
                     </tbody>
                        </table>
                      </div>

                      <br>
                      <button type="submit" class="btn btn-primary" name="manageProducts" style="margin-left: 200px;">Update Shop</button>

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
