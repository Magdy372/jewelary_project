<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Wishlist</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="../img/favicon.png" />
    <!-- Place favicon.ico in the root directory -->
    <!-- google-font -->

    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- jquery-ui.min css -->
    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    <!-- nivo-slider css -->
    <link rel="stylesheet" href="../css/nivo-slider.css">
    <!-- magnific-popup css -->
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="../css/meanmenu.min.css">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <!-- linearicons css -->
    <link rel="stylesheet" href="../css/linearicons-icon-font.min.css">
    <!-- font-awesome css -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="../css/responsive.css" />
    <!-- modernizr css -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    
</head>

<body>
    <?php include('../partials/header.php'); 
    if ($_SESSION["UserID"] !== NULL) {

    echo"Your order has been Placed";
    }
    
    
    ?>

    
    <?php include('../partials/footer.php'); ?>

    <!-- .copyright-area-end -->

    <!-- all js here -->
    <!-- jquery latest version -->
    <script src="../js/vendor/jquery-1.12.0.min.js"></script>
    <!-- bootstrap js -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- owl.carousel js -->
    <script src="../js/owl.carousel.min.js"></script>
    <!-- meanmenu js -->
    <script src="../js/jquery.meanmenu.js"></script>
    <!-- jquery-ui js -->
    <script src="../js/jquery-ui.min.js"></script>
    <!-- nivo.slider js -->
    <script src="../js/jquery.nivo.slider.js"></script>
    <!-- magnific-popup js -->
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <!-- wow js -->
    <script src="../js/wow.min.js"></script>
    <!-- scrolly js -->
    <script src="../js/jquery.scrolly.js"></script>
    <!-- plugins js -->
    <script src="../js/plugins.js"></script>
    <!-- main js -->
    <script src="../js/main.js"></script>
</body>

</html>
