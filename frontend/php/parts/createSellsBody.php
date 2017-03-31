<!-- populate fields with user information -->
<?php
$productList = getProductList();
$qualityList = getQualityList();

?>

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

                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Shop Product</h3>

                    <br>

                    <!-- create product link -->
                    <div>
                      <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Can't find a product? Add it to our site. <a href="createProduct.php">Create Product</a></h5>
                    </div>

                    <br>

                   <form class="form-horizontal" action = "createSells.php" method = "post">

                     <!-- product drop down -->
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Product</label>
                        <div class="col-sm-9">
                          <?php
                          // create product drop down list
                          echo "<select name='ProductId' style='width:300px'>";

                          foreach ($productList as $productField){
                              $productId = $productField['ProductId'];
                              $productName = $productField['ProductName'];
                              $productDescription = $productField['ProductDescription'];
                              $entry = "'$productName' - '$productDescription'";

                              echo "<option value='$productId'>$entry</option>";
                          }

                          echo "</select>";

                           ?>
                        </div>
                      </div>

                      <!-- used checkbox -->
                      <div class="checkbox" style="margin-left: 140px;">
                        <label>
                          <input type="checkbox" name = "isUsed" onclick="showUsedQuality('usedQuality')"> Used Product
                        </label>
                      </div>

                      <br>

                    <!-- hidden quality drop down -->
                    <div class="form-group usedQuality" style="display:none">
                        <label class="col-sm-3 control-label">Quality</label>
                        <div class="col-sm-9">
                            <?php
                              echo "<select>";

                              foreach ($qualityList as $qualityField){
                                  $qualityId = $qualityField['QualityId'];
                                  $qualityName = $qualityField['Name'];

                                  echo "<option value='$qualityId'>$qualityName</option>";
                              }

                              echo '</select>';

                                ?>
                        </div>
                      </div>

                      <!-- product quantity -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Quantity</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" name="Quantity" placeholder="Quantity">
                        </div>
                      </div>

                      <!-- product price -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Price $</label>
                        <div class="col-sm-9">
                          <input type='number' min='0.01' step='0.01' class='form-control' name="Price" placeholder="Price">
                        </div>
                      </div>

                      <br>
                      <button type="submit" class="btn btn-primary" name="createSells" style="margin-left: 200px;">Add Product</button>
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
