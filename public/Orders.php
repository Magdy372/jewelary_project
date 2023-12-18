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

    
    <!-- modernizr css -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    
</head>

<body>
<?php include('../partials/header.php'); ?>

<div class="container mt-5">
    <?php
    if (isset($_SESSION["UserID"])) {
        $userID = $_SESSION["UserID"];
        $orderModel = new OrderModel($userID);

        $orders = $orderModel->getOrdersByUserID($userID);

        if (!empty($orders)) {
            foreach ($orders as $order) {
                ?>
               <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Order ID: <?php echo $order['OrderID']; ?></h5>
                <span class="badge badge-info"><?php echo ucfirst(strtolower($order['Status'])); ?></span>
            </div>
            <p class="text-muted mb-0">Total Amount: $<?php echo number_format($order['TotalAmount'], 2); ?></p>
        </div>
        <div class="card-body">
            <?php
            $orderDetailsModel = new OrderDetails($order['OrderID']);
            
            $details = $orderDetailsModel->getAllOrderDetails();

            if (!empty($details)) {
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
                        foreach ($details as $detail) {
                            $productID = $detail['ProductID'];
                            $productModel = new Product($productID);
                            $productPictures = explode(',', $productModel->getProductPicture());
                            $imageSrc = !empty($productPictures[0]) ? "../uploads/" . $productPictures[0] : "../uploads/default.jpg";
                            ?>
                            <tr>
                                <td><img src="<?php echo $imageSrc; ?>" alt="Product Image" width="100"></td>
                                <td><?php echo $productModel->getProductName(); ?></td>
                                <td><?php echo $detail['Quantity']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<p class='text-center'>No order details found for Order ID: " . $order['OrderID'] . "</p>";
            }
                        ?>
                    </div>
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