Use
<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Cart</title>
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
	<link rel="stylesheet" href="../style.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="../css/responsive.css" />
	<!-- modernizr css -->
	<script src="../js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

	<!-- header-start -->
	<?php include('../partials/header.php'); ?>
	<?php
	if ($_SESSION["UserID"] !== NULL) {
		

		// to adding product to wishlist 

		// to delete product from Wishlist
		if (isset($_GET['delete_id'])) {
			$deleteProductID = $_GET['delete_id'];
			$userID = $_SESSION["UserID"];

			$ShoppingObj = ShoppingCart::deleteFromCart($userID, $deleteProductID);
			if ($ShoppingObj !== NULL) {
				echo "Deleted Successfully :)";
			}
			if (isset($_GET['delete_id'])) {
				$deleteProductID = $_GET['delete_id'];
				$userID = $_SESSION["UserID"];

				$ShoppingObj = ShoppingCart::deleteFromCart($userID, $deleteProductID);
				if ($ShoppingObj !== NULL) {
					echo "Deleted Successfully :)";
				}
				// Implement the code to delete the item with $deleteProductID from the wishlist.
				// You can use your WishlistItem class to delete the item.


			}
			// if (isset($_GET['cart_id'])) {
			// 	$productID = $_GET['cart_id'];
			// 	$userID = $_SESSION["UserID"];
			// 	$cartObject1 = ShoppingCart::addToCart($userID, $productID);

			// 	if ($cartObject1 !== NULL) {
			// 	} else {
			// 		echo "Error adding to cart";
			// 	}
			// }

			//to display user wishlist 
			//$cartObject = ShoppingCart::displayCart($_SESSION["UserID"]);
		}
		if (isset($_GET['clear_id'])) {

			$userID = $_SESSION["UserID"];
			
			$ShoppingObj = $Cartcontroller->Clear($userID);
			 if ($ShoppingObj) {
			 	//echo "Your ShoppingCart is empty.";
			 	//exit();
			
			 } else {
				echo "Failed to clear the cart.";
			}
		}
	}

	?>


	<div class="page-title-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="page-title">

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- page-title-wrapper-end -->
	<!-- entry-header-area start -->
	<div class="entry-header-area pt-40">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="entry-header">
						<h1 class="entry-title">Cart</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- entry-header-area end -->
	<!-- cart-main-area start -->
	<div class="cart-main-area ptb-40">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<form action="#">
						<div class="table-content table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product-thumbnail">Image</th>
										<th class="product-name">Product</th>
										<th class="product-price">Price</th>
										<th class="product-quantity">Quantity</th>
										<th class="product-subtotal">Total</th>
										<th class="product-remove">Remove</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sum = 0;

									if (!is_null($cartObject) && !empty($cartObject)) {
										foreach ($cartObject as $element) {
											// Check if $element is an array or an object
											if (is_array($element)) {
												$ProductPicture = explode(',', $element['ProductPicture']);
												$ProductID = $element['ProductID'];
												$ProductName = $element['ProductName'];
												$ProductPrice = $element['ProductPrice'];
												$Quantity = $element['Quantity'];
												$Subtotal = $element['Subtotal'];
											} else {
												// Assuming $element is an object
												$ProductPicture = explode(',', $element->ProductPicture);
												$ProductName = $element->ProductName;
												$ProductPrice = $element->ProductPrice;
												$Quantity = $element->Quantity;
												$Subtotal = $element->Subtotal;
												$ProductID = $element->ProductID;
											}

											// session 3ashn product details
											$productDetails = array(
												'ProductName' => $ProductName,
												'ProductPrice' => $ProductPrice,
												'Quantity' => $Quantity,
												'Subtotal' => $Subtotal
											);

											$cartDetails[] = $productDetails;

											$sum += $Subtotal;

											if (!empty($ProductPicture[0])) {

												$imageSrc = "../uploads/" . $ProductPicture[0];
											} else {
												$imageSrc = "uploads/default.jpg";
											}
									?>
											<tr>
												<td class="product-thumbnail"><a href="#"><img src="<?= $imageSrc ?>" alt="" /></a></td>
												<td class="product-name"><a href="#"><?= $ProductName ?></a></td>
												<td class="product-price">
													<span class="amount">$<?= $ProductPrice ?></span>
												</td>
												<td class="product-quantity">

													<span class="amount"><?= $Quantity ?></span>
												</td>

												<td class="totalproduct">
													<span class="totalproduct">$<?= $Subtotal ?></span>
												</td>
												<td class="product-remove"><a href="cart.php?delete_id=<?= $ProductID ?>">x</a></td>
											</tr><?php
												}
											} else {
												// Handle the case where there are no items in the wishlist
												echo "Your ShoppingCart is empty.";
											}

											// add the sum fel session variable l cartDetails
											$cartDetails['sum'] = $sum;

											
											$_SESSION['cartDetails'] = $cartDetails;
													?>

								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
								<div class="buttons-cart">

									<a href="cart.php?clear_id=<?= $userID ?>">Clear Cart</a>
									<a href="shop.php">Continue Shopping</a>
								</div>
								<div class="coupon">
									<h3>Coupon</h3>
									<p>Enter your coupon code if you have one.</p>
									<input type="text" placeholder="Coupon code" />
									<input type="submit" value="Apply Coupon" />
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
								<div class="cart_totals">


									<!-- Add a container for the total price -->
									<strong>Total Price: <span id="totalPrice" class="amount"> $<?= $sum ?></span></strong>

									</td>
									</tr>
									</tbody>
									</table>
									<div class="wc-proceed-to-checkout">
										<a href="checkout.php">Proceed to Checkout</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- cart-main-area end -->
	<!-- contact-area-start -->
	<?php include('../partials/footer.php'); ?>
	<!-- footer-area-end -->

</body>

</html>


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