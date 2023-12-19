<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Checkout</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="img/favicon.png" />
	<!-- Place favicon.ico in the root directory -->
	<!-- google-font -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
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
	<!--linearicons css -->
	<link rel="stylesheet" href="../css/linearicons-icon-font.min.css">
	<!-- font-awesome css -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- style css -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="../css/responsive.css" />
	<!-- modernizr css -->
	<script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    <?php
ob_start();

include('../partials/header.php');

if (isset($_GET['action']) && $_GET['action'] === 'proceedToCheckout') {
    $userID = $_SESSION['UserID'];
    $addressObject = new Address($userID);
    $addresses = $addressObject->loadAddressByUserID($userID);

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['placeOrder'])) {
    // Validate and sanitize input if necessary

    // Get user ID from the session
    $userID = $_SESSION['UserID'];
    $orderModel = new OrderModel();
    $orderController = new OrderController($orderModel);

    // Check if a radio button is selected
    if (isset($_POST['selectedAddressID'])) {
        $selectedAddressID = $_POST['selectedAddressID'];
        $totalAmount = $_SESSION['cartDetails']['sum'];
        $status = 'Pending';

        // Create the order and get the order ID
        $orderID = $orderController->createOrder($userID, $totalAmount, $status, $_SESSION['cartDetails'], $selectedAddressID);
        header('Location: OrderConfirmation.php?order_ID=' . $orderID);
        ob_end_flush();
    } else {
        // Handle the case where no address is selected
        echo "Please select an address before placing the order.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AddAddress'])) {
    $userID = $_SESSION['UserID'];
    $model = new Address($userID);
$controller = new UserController ($model);
    $newCountry = $_POST['newCountry'];
    $newStreet = $_POST['newStreet'];
    $newCity = $_POST['newCity'];
    $newApartmentNumber = $_POST['newApartmentNumber'];
    $newPostalCode = $_POST['newPostalCode'];
    $addres = $controller->createAddress($newCountry, $newStreet, $newCity, $newApartmentNumber, $newPostalCode, $userID);
    if ($addressAdded) {
        // Reload addresses after adding a new one
        $addresses = $model->loadAddressByUserID($userID);
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        echo "Failed to add address.";
    }
}
?>
</head>

<div class="entry-header-area ptb-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="entry-header">
                        <h1 class="entry-title">Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Area -->
    <div class="checkout-area pb-50">
        <div class="container">
            <div class="row">

                <!-- Enter New Address Form -->
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form">
                        <h3>Enter New Address</h3>
                        <form method="post" action="">
                            <div class="row">
                                <!-- Your form fields for new address here -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label for="newCountry">Country:</label>
                                        <input type="text" name="newCountry" id="newCountry" placeholder="Enter the country">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label for="newStreet">Street:</label>
                                        <input type="text" name="newStreet" id="newStreet" placeholder="Enter new street">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label for="newCity">City:</label>
                                        <input type="text" name="newCity" id="newCity" placeholder="Enter new city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label for="newApartmentNumber">Apartment Number:</label>
                                        <input type="text" name="newApartmentNumber" id="newApartmentNumber" placeholder="Enter new apartment number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label for="newPostalCode">Postal Code:</label>
                                        <input type="text" name="newPostalCode" id="newPostalCode" placeholder="Enter new postal code">
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" name="AddAddress" value="Submit" />
                                    </form>
                                </div>
                            </div>
                       
                    </div>
                </div>

                <!-- Your Order Table -->
                <div class="col-lg-6 col-md-6">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Product Name</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-total">Img</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Display products in the order table -->
                                    <?php
                                    if (isset($_SESSION['cartDetails'])) {
                                        $totalAmount = 0;
                                        $cartDetails = $_SESSION['cartDetails'];

                                        foreach ($cartDetails as $product) {
                                            if (is_array($product) && isset($product['ProductID'], $product['Quantity'], $product['Subtotal'])) {
                                                $ProductID = $product['ProductID'];
                                                
                                                $productName = $product['ProductName'];
                                                $ProductPicture = $product['ProductPicture'];
                                                $quantity = $product['Quantity'];
                                                $subtotal = $product['Subtotal'];
                                                $totalAmount += $product['Subtotal'];
                                                $imageSrc = !empty($ProductPicture[0]) ? "../uploads/" . $ProductPicture : "uploads/default.jpg";
                                                ?>
                                                
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <strong class="product-quantity"> x <?= $quantity ?> </strong> <?= $productName ?>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount">$<?= $subtotal ?></span>
                                                    </td>
                                                    <td class="product-name">
                                                        <strong class="product-quantity"><a href="#"><img src="<?= $imageSrc ?>" alt="" style="width: 100px; height: 100px;" /></a></strong>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">$<?= $totalAmount ?></span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Choose Address Form -->
                <div class="col-lg-12 col-md-12">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h3>Choose Address</h3>
                        <?php
                        
                        if (!empty($addresses)) {
                            foreach ($addresses as $address) {
                                if ($address !== null && $address->getAddressID() !== null) {
                                    echo "<label>";
                                    echo "<input type='radio' name='selectedAddressID' value='{$address->getAddressID()}'>";
                                    echo "{$address->getStreet()}, {$address->getCity()}, {$address->getCountry()}";
                                    echo "</label><br>";
                                } else {
                                    echo "Debug: Address is null or has null ID<br>";
                                }
                            }
                        } else {
                            echo "No addresses available.";
                        }
                        
                        
                        ?>
                        <div class="order-button-payment">
                            <input type="submit" name="placeOrder" value="Place order" />
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
	<!-- checkout-area end -->
	<!-- contact-area-start -->
	<?php include('../partials/footer.php'); ?>
	
<!-- .copyright-area-start -->

<!-- .copyright-area-end -->

<!-- all js here -->
<!-- jquery latest version -->
<script src="../js/vendor/jquery-1.12.0.min.js"></script>
<!-- bootstra../p js -->
<script src="../js/bootstrap.min.js"></script>
<!-- owl.caro../usel js -->
<script src="../js/owl.carousel.min.js"></script>
<!-- meanmenu../ js -->
<script src="../js/jquery.meanmenu.js"></script>
<!-- jquery-u../i js -->
<script src="../js/jquery-ui.min.js"></script>
<!-- nivo.sli../der js -->
<script src="../js/jquery.nivo.slider.js"></script>
<!-- magnific../-popup js -->
<script src="../js/jquery.magnific-popup.min.js"></script>
<!-- wow js -->
<script src="js/wow.min.js"></script>
<!-- scrolly ../js -->
<script src="../js/jquery.scrolly.js"></script>
<!-- plugins ../js -->
<script src="../js/plugins.js"></script>
<!-- main js ../-->
<script src="../js/main.js"></script>
</body>

</html>






