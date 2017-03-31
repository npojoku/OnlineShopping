<DOCTYPE html>

<?php require '../../backend/core.inc.php'; ?>
<?php include '../../backend/product/getProductList.php' ?>
<?php include '../../backend/retailer/updateRetailerProductList.php' ?>
<?php include '../../backend/product/getQualityList.php' ?>
<?php include '../../backend/retailer/addSells.php' ?>

<html>
<!-- header -->
<?php include('parts/head.php'); ?>

<body>
<!-- navigation bar -->
<?php include('parts/nav.php'); ?>

<!-- body -->
<?php include('parts/createSellsBody.php'); ?>

<!-- footer -->
<?php include('parts/footer.php'); ?>

</body>
</html>
