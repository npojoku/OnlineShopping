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
                    <h3>New Store Product
                    </h3>
                    <br>
                   <form action = "createProduct.php" method = "post">
                      <div class="form-group">
                        <label >Product Name</label>
                        <input type="text" class="form-control" maxlength="50" name = "ProductName" placeholder="Product Name">
                      </div>
                      <div class="form-group">
                        <label >Description</label>
                        <input type="text" class="form-control" maxlength="100" name = "ProductDescription" placeholder="Product Description">
                      </div>
                      <button type="submit" name="addProduct" class="btn btn-primary">Create</button>
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
