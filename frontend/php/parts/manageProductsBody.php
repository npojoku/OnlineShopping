<!-- populate fields with user information -->
<?php
$retailedList = getRetailerProductList();
$qualityList = getQualityList();

?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-9">

            <div class="thumbnail" style="width:1200px;">
                <div class="caption-full" style="
                        padding-left: 50px;
                        padding-right: 50px;
                        padding-top: 25px;
                        padding-bottom: 25px;">
                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manage Shop Products
                    </h3>
                    <a href="createSells.php">Create a new product</a>

                    <br>

                   <form class="form-horizontal" action="manageProducts.php" method="post">

                      <div class="form-group" style="display:block">
                              <table class="table table-bordered table-hover" id="tableAddRow">
                                  <thead>
                                      <tr>
                                          <th><label class="control-label">Product</label></th>
                                          <th><label class="control-label">Type</label></th>
                                          <th><label class="control-label">Quality</label></th>
                                          <th><label class="control-label">Quantity</label></th>
                                          <th><label class="control-label">Price $</label></th>
                                          <th style="width:10px">
                                      </tr>
                                    </thead>
                                    <tbody>

                      <!-- populate dynamic list of cards -->
                      <?php
                      if ($retailedList->num_rows > 0){

                        while ( $retailed = mysqli_fetch_array($retailedList, MYSQLI_ASSOC) ) {
                          $ProductName = $retailed['ProductName'];
                          $ProductId = $retailed['ProductId'];
                          $Type = $retailed['Type'];
                          $Quantity = $retailed['Quantity'];
                          $Price = $retailed['Price'];

                            echo "<tr>";

                              // display product name
                              echo "<td>";
                                echo "<input type='text' name='ProductName[]' value='$ProductName' readonly>";
                              echo "</td>";

                              // display type
                              echo "<td>";
                              if($Type == 1){
                                echo "<input type='text' value='New' readonly>";
                              } else {
                                echo "<input type='text' value='Used' readonly>";
                              }
                              echo "</td>";

                              // display quality
                              echo "<td>";

                              // some fields may have a null quality entry
                              if(sellsHasQuality($ProductId, $Type)){
                                $QualityName = getQualityName($ProductId, $Type);
                                echo "<input type='text' name='QualityName[]' value='$QualityName' readonly>";
                              } else {
                                echo "<input type='text' name='QualityName[]' value=N/A readonly>";
                              }

                              echo "</td>";

                              // display quantity (can edit)
                              echo "<td>";
                                echo "<input type='text' name='Quantity[]' value='$Quantity' placeholder='Quantity'>";
                              echo "</td>";

                              // display price
                              echo "<td>";
                                echo "<input type='text' name='Price[]' value='$Price' placeholder='Price'>";
                              echo "</td>";

                              // delete button
                              echo "<td>";
                              echo "<input type='text' style='display:none' class='form-control' name='Type[]' value='$Type'>";
                              echo "<input type='text' style='display:none' class='form-control' name='ProductId[]' value='$ProductId'>";
                              echo "<input type='button' class='btn form-control' onclick='removeSoldProduct(this)' value='-'></input></td>";

                            echo '</tr>';
                        }
                      }
                       ?>
                     </tbody>
                        </table>
                      </div>

                      <br>
                      <button type="submit" class="btn btn-primary" name="updateProducts" style="margin-left: 200px;">Save Changes</button>

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
