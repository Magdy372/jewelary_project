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
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="css/jquery-ui.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="css/nivo-slider.css">
		<!-- magnific-popup css -->
        <link rel="stylesheet" href="css/magnific-popup.css">		
		<!-- meanmenu css -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!--linearicons css -->
        <link rel="stylesheet" href="css/linearicons-icon-font.min.css">
		<!-- font-awesome css -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css" />
		<!-- modernizr css -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
		<!-- header-start -->
		<?php include('partials/header.php'); ?>
		<!-- mainmenu-area-end -->
		<!-- page-title-wrapper-start -->
		<div class="page-title-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="page-title">
							<h3>Checkout</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
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
		<div class="coupon-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="coupon-accordion">
							<!-- ACCORDION START -->
							<h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
							<div id="checkout-login" class="coupon-content">
								<div class="coupon-info">
									<!--<p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>-->
									<form action="#">
										<p class="form-row-first">
											<label>Email <span class="required">*</span></label>
											<input type="text" />
										</p>
										<p class="form-row-last">
											<label>Password  <span class="required">*</span></label>
											<input type="text" />
										</p>
										<p class="form-row">					
											<input type="submit" value="Login" />
											<label>
												<input type="checkbox" />
												 Remember me 
											</label>
										</p>
										<p class="lost-password">
											<a href="#">Lost your password?</a>
										</p>
									</form>
								</div>
							</div>
							<!-- ACCORDION END -->	
							<!-- ACCORDION START -->
							<h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
							<div id="checkout_coupon" class="coupon-checkout-content">
								<div class="coupon-info">
									<form action="#">
										<p class="checkout-coupon">
											<input type="text" placeholder="Coupon code" />
											<input type="submit" value="Apply Coupon" />
										</p>
									</form>
								</div>
							</div>
							<!-- ACCORDION END -->						
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- coupon-area end -->		
		<!-- checkout-area start -->
		<div class="checkout-area pb-50">
			<div class="container">
				<div class="row">
					<form action="#">
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
									<!--<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Company Name</label>
											<input type="text" placeholder="" />
										</div>
									</div>-->
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Address <span class="required">*</span></label>
											<input type="text" placeholder="Street address" />
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">									
											<input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Town / City <span class="required">*</span></label>
											<input type="text" placeholder="Town / City" />
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
											<label>Phone  <span class="required">*</span></label>										
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
											<label>Account password  <span class="required">*</span></label>
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
												<th class="product-name">Product</th>
												<th class="product-total">Total</th>
											</tr>							
										</thead>
										<tbody>
											<tr class="cart_item">
												<td class="product-name">
													Vestibulum suscipit <strong class="product-quantity"> x 1</strong>
												</td>
												<td class="product-total">
													<span class="amount">Rs165.00</span>
												</td>
											</tr>
											<tr class="cart_item">
												<td class="product-name">
													Vestibulum dictum magna	<strong class="product-quantity"> x 1</strong>
												</td>
												<td class="product-total">
													<span class="amount">Rs50.00</span>
												</td>
											</tr>
										</tbody>
										<tfoot>
											<tr class="cart-subtotal">
												<th>Cart Subtotal</th>
												<td><span class="amount">Rs215.00</span></td>
											</tr>
                                            
                                            <tr class="cart-subtotal">
												<th>GST IN</th>
												<td><span class="amount">28%</span></td>
											</tr>
                                            
											<tr class="shipping">
												<th>Shipping</th>
												<td>
													<ul>
														<li>
															<input type="radio" />
															<label>
																Flat Rate: <span class="amount">Rs7.00</span>
															</label>
														</li>
														<li>
															<input type="radio" />
															<label>Free Shipping:</label>
														</li>
														<li></li>
													</ul>
												</td>
											</tr>
											<tr class="order-total">
												<th>Order Total</th>
												<td><strong><span class="amount">Rs215.00</span></strong>
												</td>
											</tr>								
										</tfoot>
									</table>
								</div>
								<div class="payment-method">
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingOne">
												<h4 class="panel-title">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" 	aria-controls="collapseOne">
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
		<?php include('partials/footer.php'); ?>
		<!-- .copyright-area-end -->
		
		<!-- all js here -->
		<!-- jquery latest version -->
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
		<!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
		<!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
		<!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- jquery-ui js -->
        <script src="js/jquery-ui.min.js"></script>
		<!-- nivo.slider js -->
        <script src="js/jquery.nivo.slider.js"></script>		
		<!-- magnific-popup js -->
        <script src="js/jquery.magnific-popup.min.js"></script>		
		<!-- wow js -->
        <script src="js/wow.min.js"></script>
		<!-- scrolly js -->
        <script src="js/jquery.scrolly.js"></script>		
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
		<!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
