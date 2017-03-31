<DOCTYPE html>

<?php require '../../backend/core.inc.php'; ?>
<?php include '../../backend/product/getProductList.php' ?>
<?php include '../../backend/retailer/getRetailerProductList.php' ?>
<?php include '../../backend/retailer/updateRetailerProductList.php' ?>
<?php include '../../backend/product/getQualityList.php' ?>

<html>
<!-- header -->
<?php include('parts/head.php'); ?>

<body>
<!-- navigation bar -->
<?php include('parts/nav.php'); ?>

<!-- body -->
<?php include('parts/manageProductsBody.php'); ?>

<!-- footer -->
<?php include('parts/footer.php'); ?>

</body>
</html>
