<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Wishlist</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="../../img/favicon.png" />
    <!-- Place favicon.ico in the root directory -->
    <!-- google-font -->

    <!-- modernizr css -->
    <script src="../../js/vendor/modernizr-2.8.3.min.js"></script>
    
</head>

<body>
    <?php include('../../partials/header.php'); 
    if ($_SESSION["UserID"] !== NULL) {

    echo"Your order has been Placed";
    }
    
    
    ?>

    
    <?php include('../../partials/footer.php'); ?>

    <!-- .copyright-area-end -->

    
</body>

</html>
