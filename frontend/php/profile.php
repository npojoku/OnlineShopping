<DOCTYPE html>

<!-- user session must be logged in to view this page -->
<?php include '../../backend/session.php'; ?>

<!-- additional backend libraries -->
<?php include '../../backend/profile/getCustomer.php'; ?>
<?php include '../../backend/profile/getRetailer.php'; ?>
<?php include '../../backend/account/getCardList.php'; ?>
<?php include '../../backend/profile/updatePerson.php'; ?>

<html>
<!-- header -->
<?php include('parts/head.php'); ?>

<body>
<!-- navigation bar -->
<?php include('parts/nav.php'); ?>

<!-- body -->
<?php include('parts/profileBody.php'); ?>

<!-- footer -->
<?php include('parts/footer.php'); ?>

</body>
</html>
