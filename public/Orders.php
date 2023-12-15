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
    <?php include('../partials/header.php'); ?>

    <div class="container mt-5">
        <?php
        if ($_SESSION["UserID"] !== NULL) {
            $userID = $_SESSION["UserID"];
            $ordermodel = new OrderModel($userID);
            $orderController = new OrderController($ordermodel);

            $orders = $orderController->getOrdersByUserID($userID);
            if (!empty($orders)) {
                foreach ($orders as $order) {
        ?>
                    <div class="card">
                        <table class="table table-bordered">
                            <tr>
                                <td class="card-header" colspan="2">
                                    <div class="header-content d-flex flex-column align-items-center">
                                        <h5 class="card-title mb-2">Order ID: <?php echo $order['OrderID']; ?></h5>
                                        <p class="text-muted mb-2">Total Amount: $<?php echo number_format($order['TotalAmount'], 2); ?></p>
                                        <p class="text-muted">Status: <?php echo ucfirst(strtolower($order['Status'])); ?></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="card-body" colspan="2">
                                    <!-- Display order details in a table -->
                                    <?php
                                    $orderDetails = $order['OrderDetails'];
                                    if (!empty($orderDetails)) {
                                    ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($orderDetails as $orderDetail) {
                                                    $productModel = new Product($orderDetail['ProductID']);
                                                    $ProductPictures = explode(',', $productModel->getProductPicture());
                                                    $imageSrc = !empty($ProductPictures[0]) ? "../uploads/" . $ProductPictures[0] : "../uploads/default.jpg";
                                                ?>
                                                    <tr>
                                                        <td><img src="<?php echo $imageSrc; ?>" alt="Product Image" width="100"></td>
                                                        <td><?php echo $productModel->getProductName(); ?></td>
                                                        <td><?php echo $orderDetail['Quantity']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo "<p class='text-center'>No order details found.</p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
        <?php
                }
            } else {
                echo "<p class='text-center'>No orders found for the user.</p>";
            }
        } else {
            echo "<p class='text-center'>User is not logged in.</p>";
        }
        ?>
    </div>

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
<style>
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .card-header {
            background-color: #bebe44;
            color: #fff;
            border-radius: 5px 5px 0 0;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-title {
            margin-bottom: 10px;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .text-muted {
            margin-bottom: 5px;
            font-size: 1.2rem;
            color: #eee;
        }

        
        .card-body {
            padding: 20px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>