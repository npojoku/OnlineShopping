<DOCTYPE html>

<!-- user session must be logged in to view this page -->
<?php include '../../backend/session.php'; ?>

<!-- additional backend libraries -->
<?php include '../../backend/order/markAsFinished.php' ?>

<html>
<!-- header -->
<?php include('parts/head.php'); ?>

<body>
<!-- navigation bar -->
<?php include('parts/nav.php'); ?>

<!-- body -->
<?php include('parts/orderReceivedBody.php'); ?>

<!-- footer -->
<?php include('parts/footer.php'); ?>

</body>
</html>
