<!doctype html>
<html class="no-js" lang="en">

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
	<link rel="stylesheet" href="../style.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="../css/responsive.css" />
	<!-- modernizr css -->
	<script src="../js/vendor/modernizr-2.8.3.min.js"></script>

	<?php
	// Start the session

	// Check if the form is submitted
	if (isset($_POST['submit'])) {
		// Assuming you have established a database connection, replace the following placeholders with your actual database credentials

		// Create connection
		$conn = new mysqli("172.232.216.8", "root", "Omarsalah123o", "Jewelry_project");

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Get address data from the form
		$street = $_POST['street'];
		$city = $_POST['city'];
		$apartmentNumber = $_POST['apartmentNumber'];

		// Assuming you have a user ID stored in the session, replace 'your_user_id_key' with the actual key you use to store the user ID
		$userID = $_SESSION["UserID"];

		// Prepare and execute the SQL query
		$sql = "INSERT INTO address (street, city, apartmentnumber, UserID) VALUES ('$street', '$city', '$apartmentNumber', '$userID')";

		if ($conn->query($sql) === TRUE) {
			echo "Address inserted successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		// Close the database connection
		$conn->close();
	}
	?>



</head>

<body>




	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<!-- Add your site or application content here -->
	<!-- header-start -->
	<?php include('../partials/header.php'); ?>
	<!-- mainmenu-area-end -->
	<!-- page-title-wrapper-start -->

	<!-- page-title-wrapper-end -->
	<!-- entry-header-area start -->
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
	<!-- entry-header-area end -->
	<!-- coupon-area start -->

	<!-- coupon-area end -->
	<!-- checkout-area start -->
	<div class="checkout-area pb-50">
		<div class="container">
			<div class="row">
				<form action="checkout.php" id="checkoutForm" method="POST">
					<div class="col-lg-6 col-md-6">

						<div class="checkbox-form">

							<h3>Choose Address</h3>

							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-6 col-sm-6 col-xs-12 multiple_address">
									<label class="radio-inline">
										<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> E-199 kalka ji New Delhi infront of Sanatan Dharam Mandir New Delhi 110019
									</label>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 multiple_address">
									<label class="radio-inline">
										<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> E-199 kalka ji New Delhi infront of Sanatan Dharam Mandir New Delhi 110019
									</label>
								</div>


								<div class="col-md-6 col-sm-6 col-xs-12 multiple_address">
									<label class="radio-inline">
										<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> E-199 kalka ji New Delhi infront of Sanatan Dharam Mandir New Delhi 110019
									</label>
								</div>

							</div>
							<h3>Enter New Address</h3>
							<div class="row">
								<!-- Address-Coloum end -->

								<div class="col-md-12">
									<div class="country-select">
										<label>Country <span class="required">*</span></label>
										<select>
											<option value="volvo">bangladesh</option>
											<option value="saab">Algeria</option>
											<option value="mercedes">Afghanistan</option>
											<option value="audi">Ghana</option>
											<option value="audi2">Albania</option>
											<option value="audi3">Bahrain</option>
											<option value="audi4">Colombia</option>
											<option value="audi5">Dominican Republic</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>First Name <span class="required">*</span></label>
										<input type="text" placeholder="" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Last Name <span class="required">*</span></label>
										<input type="text" placeholder="" />
									</div>
								</div>

								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Address <span class="required">*</span></label>
										<input type="text" name="street" placeholder="Street address" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list">
										<input type="text" name="apartmentNumber" placeholder="Apartment, suite, unit etc. (optional)" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Town / City <span class="required">*</span></label>
										<input type="text" name="city" placeholder="Town / City" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>State / County <span class="required">*</span></label>
										<input type="text" placeholder="" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Postcode / Zip <span class="required">*</span></label>
										<input type="text" placeholder="Postcode / Zip" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Email Address <span class="required">*</span></label>
										<input type="email" placeholder="" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Phone <span class="required">*</span></label>
										<input type="text" placeholder="Postcode / Zip" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list create-acc">
										<input id="cbox" type="checkbox" />
										<label>Create an account?</label>
									</div>
									<div id="cbox_info" class="checkout-form-list create-account">
										<p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
										<label>Account password <span class="required">*</span></label>
										<input type="password" placeholder="password" />
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="your-order">
							<h3>Your order</h3>
							<div class="your-order-table table-responsive">
								<table>
									<thead>
										<tr>
											<th class="product-name">Product Name</th>
											<th class="product-total">Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										// Check if the session variable exists
										if (isset($_SESSION['cartDetails'])) {
											$cartDetails = $_SESSION['cartDetails'];

											// Loop through the stored product details
											foreach ($cartDetails as $product) {
												if (is_array($product)) {
													$productName = $product['ProductName'];
													$productPrice = $product['ProductPrice'];
													$quantity = $product['Quantity'];
													$subtotal = $product['Subtotal'];

													// Display each product in the table
										?>
													<tr class="cart_item">
														<td class="product-name">
															<strong class="product-quantity"> x <?= $quantity ?> </strong> <?= $productName ?>
														</td>
														<td class="product-total">
															<span class="amount">$<?= $subtotal ?></span>
														</td>
													</tr>
										<?php
												}
											}
										}
										?>
									</tbody>
									<tfoot>
										<tr class="cart-subtotal">
											<th>Cart Subtotal</th>
											<td><span class="amount">$<?= $sum ?></span></td>
										</tr>




										<tr class="order-total">
											<th>Order Total</th>
											<td><strong><span class="amount">$<?= $sum ?></span></strong></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>

					<div class="payment-method">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Direct Bank Transfer
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body payment-content">
										Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											Cheque Payment
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body payment-content">
										Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingThree">
									<h4 class="panel-title panel-img">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
											PayPal <img src="img/payment_c.png" alt="" />
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
									<div class="panel-body payment-content">
										Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.
									</div>
								</div>
							</div>
						</div>
						<div class="order-button-payment">
							<input type="submit" value="Place order" />
						</div>
					</div>
			</div>
		</div>
		</form>
	</div>
	</div>
	</div>
	<!-- checkout-area end -->
	<!-- contact-area-start -->
	<?php include('../partials/footer.php'); ?>
	<!-- .copyright-area-end -->

	<!-- <script>
		function validateForm() {
			var requiredFields = document.querySelectorAll('[required]');
			var isValid = true;

			requiredFields.forEach(function(field) {
				if (!validateField(field)) {
					isValid = false;
				}
			});

			return isValid;
		}

		function validateField(field) {
			var value = field.value.trim();
			var label = field.closest('.checkout-form-list').querySelector('label').textContent;

			if (value === '') {
				alert(label + ' is required.');
				return false;
			}

			// General email format validation
			if (field.type === 'email' && !isValidEmail(value)) {
				alert('Please enter a valid email address.');
				return false;
			}

			// General phone number format validation
			if (field.type === 'tel' && !isValidPhoneNumber(value)) {
				alert('Please enter a valid phone number.');
				return false;
			}

			// Specific validations for certain fields
			switch (field.id) {
				case 'postcode':
					if (!isValidZipCode(value)) {
						alert('Please enter a valid postcode/zip code.');
						return false;
					}
					break;
					// Add more specific cases as needed

				default:
					// Additional general validations for other fields
					if (field.classList.contains('validate-number') && !isNumeric(value)) {
						alert('Please enter a valid numeric value.');
						return false;
					}
					break;
			}

			// Add more rules as needed

			return true;
		}

		function isValidEmail(email) {
			// Basic email format validation
			var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			return emailRegex.test(email);
		}

		function isValidPhoneNumber(phoneNumber) {
			// Basic phone number format validation
			var phoneRegex = /^\d{10}$/;
			return phoneRegex.test(phoneNumber);
		}

		function isValidZipCode(zipCode) {
			// Basic zip code format validation
			var zipCodeRegex = /^\d{5}$/;
			return zipCodeRegex.test(zipCode);
		}

		function isNumeric(value) {
			// Check if the value is numeric
			return !isNaN(value);
		}
	</script> -->



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