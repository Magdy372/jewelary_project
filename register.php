<?php
  include_once "includes/dbh.inc.php" ;


	//grap data from user if form was submitted 
	if($_SERVER["REQUEST_METHOD"]=="POST"){ //check if form was submitted
		$Fname=htmlspecialchars($_POST["FName"]);
		$Lname=htmlspecialchars($_POST["LName"]);
		$Email=htmlspecialchars($_POST["Email"]);
		$Password=htmlspecialchars($_POST["Pass"]);

		//insert it to database 
		//if(htmlspecialchars($_POST["Pass"]) === htmlspecialchars($_POST["conPass"])){
			$sql="insert into users(Fname,LName,Email,Pass) 
			values('$Fname','$Lname','$Email','$Password')";
			$result=mysqli_query($conn,$sql);
	
			//redirect the user back to index.php 
			if ($result) {
				header("Location: index.html");
				exit(); // Important: Terminate the script after the header() call
			} else {
				// Handle the error in a different way (e.g., redirect to an error page)
				header("Location: error.html");
				exit();
			}
		//}else{
		//	echo '<script>document.getElementsByClassName("con_pass")[0].textContent = "Passwords do not match";</script>';
		//}
	}
		
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Customer Account</title>
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
         <link rel="stylesheet" href="css/bootstrap-social.css">
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
		<header>
			<div class="header-top-area ptb-10 hidden-xs header-top-area-4">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-5">
							<div class="header-top-right header-top-left-4">
								<p>FREE SHIPPING ON ORDERS OVER Rs499</p>
							</div>
						</div>					
						<div class="col-lg-9 col-md-8 col-sm-7 header-top-right-4">
							<!--<div class="dropdown header-left-menu">
								  <button class="btn btn-default header-left-menu dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<img src="img/eng/1.jpg" alt="" /> English 1 <i class="fa fa-angle-down"></i>
								  </button>
								  <ul class="dropdown-menu">
									  <li><a href="#"><img src="img/eng/2.jpg" alt="" /> English 1</a></li>
									  <li><a href="#"><img src="img/eng/3.jpg" alt="" /> English 2</a></li>
									  <li><a href="#"><img src="img/eng/1.jpg" alt="" /> English 3</a></li>
								  </ul>
							</div>-->
							<!--<div class="dropdown header-left-menu">
								<button class="btn btn-default header-left-menu dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								GBP  <i class="fa fa-angle-down"></i>
								</button>
								 <ul class="dropdown-menu">
									<li><a href="#"> EUR - Euro</a></li>
									<li><a href="#"> USD - US Dollar</a></li>
								</ul>
							</div>-->
							<div class="header-top-left">
								<ul>
                                <li class="click_menu"><a href="#">My Account <i class="fa fa-angle-down"></i></a>
										<ul class="click_menu_show">
											<li><a href="customer-login.html">Compare Products</a></li>
											<li><a href="customer-login.html">My Account</a></li>
											<li><a href="wishlist.html">My Wish List</a></li>
											<li><a href="customer-login.html">Sign In</a></li>
										</ul>
									</li>
									<li><a href="customer-account.html">Create an Account</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-bottom-area home-page-2 ptb-10">
				<div class="container">
					<div class="row">

						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="menu-search-box scnd-fix">
								<form action="#">
									<input type="text" placeholder="Search here..."/>
									<button><span class="lnr lnr-magnifier"></span></button>
								</form>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="logo logo2">
								<a href="index.html"><img src="img/logo-4.jpg" alt="" /></a>
							</div>					
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">
							<div class="header-bottom-right-4-inner">
								<a href="#"><span class="lnr lnr-heart"></span></a>
							</div>					
							<div class="header-bottom-right header-bottom-right-4">
								<div class="shop-cart shop-cart-4">									
									<a href="#"><span class="lnr lnr-cart"></span></a>
								</div>
								<div class="shop-cart-hover shop-cart-hover-4 fix">
									<ul>
										<li>
											<div class="cart-img">
												<a href="#"><img src="img/cart/1.jpg" alt="" /></a>
											</div>
											<div class="cart-content">
												<h4><a href="#">1 x Faded...</a></h4>
												<span><a href="#">S, Orange</a></span>
												<span class="cart-price">Rs 16.84</span>
											</div>
											<div class="cart-del">
												<i class="fa fa-times-circle"></i>
											</div>											
										</li>
										<li>
											<div class="cart-img">
												<a href="#"><img src="img/cart/1.jpg" alt="" /></a>
											</div>
											<div class="cart-content">
												<h4><a href="#">1 x Faded...</a></h4>
												<span><a href="#">S, Orange</a></span>
												<span class="cart-price">Rs 16.84</span>
											</div>
											<div class="cart-del">
												<i class="fa fa-times-circle"></i>
											</div>											
										</li>
										<li class="total-price"><span> Total Rs 48.04 </span></li>
										<li class="checkout-bg">
											<a href="checkout.html">checkout <i class="fa fa-angle-right"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- header-end -->
		<!-- mainmenu-area-start -->
		<div class="mainmenu-area home-page-2 mainmenu-area-4" id="main_h">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="mainmenu hidden-xs">
							<nav>
								<ul>
									<li class="active"><a href="index.html">Seating</a>
										<ul>
											<li><a href="">EXECUTIVE CUSHIONED CHAIRS</a></li>
											<li><a href="">EXECUTIVE MESH CHAIRS</a></li>
											<li><a href="">WORKSTATION CHAIRS</a></li>
											<li><a href="">VISITOR CHAIR</a></li>
                                            <li><a href="">STOOL</a></li>
											<li><a href="">RECLINER CHIARS</a></li>
											<li><a href="">AUDITORIUM CHAIRS</a></li>
											<li><a href="">ACCESSORIES</a></li>
										</ul>
									</li>
									<li><a href="shop.html">Table</a>
										<div class="megamenu">
											<span>
												<a href="#" class="megatitle">EXCUTIVE MODULAR  TABLES</a>
												<a href="#">EXECUTIVE TRADITIONAL TABLES</a>
												<a href="#">COMPUTER TABLES</a>
												<a href="#">STEEL TABLES</a>
												<a href="#">ACCESSORIES</a>
												
											</span>
											<!--<span>
												<a href="#" class="megatitle">Nightstands</a>
												<a href="#">Brown Finish</a>
												<a href="#">Distressed</a>
												<a href="#">Cherry Finish</a>
												<a href="#">Weathered</a>
												<a href="#">Laundry</a>
											</span>
											<span>
												<a href="#" class="megatitle">Headboards</a>
												<a href="#">Upholstered</a>
												<a href="#">Tufted</a>
												<a href="#">Storage</a>
												<a href="#">padded</a>
												<a href="#">Outdoor</a>
											</span>-->
										</div>
									</li>
									<li><a href="shop.html">Workstation Furnitures</a>
										<div class="megamenu megamenu2 living-megamenu">
											<span>
												<a href="#" class="megatitle">Living Chairs</a>
												<a href="#">mattress</a>
												<a href="#">bunk bed</a>
												<a href="#">Weathered</a>
												<a href="#">sideboard</a>
												<a href="#">Dresses</a>
											</span>
											<span>
												<a href="#" class="megatitle">Bootees Bags</a>
												<a href="#">Brown Finish</a>
												<a href="#">Distressed</a>
												<a href="#">Tufted</a>
												<a href="#">Cherry Finish</a>
												<a href="#">Weathered</a>											
											</span>
											<span>
												<a href="#" class="megatitle">Headboards</a>
												<a href="#">Upholstered</a>
												<a href="#">Tufted</a>
												<a href="#">Storage</a>
												<a href="#">Sweaters</a>
												<a href="#">padded</a>											
											</span>
											<span>
												<a href="#" class="megatitle">Headboards</a>
												<a href="#">Upholstered</a>
												<a href="#">Tufted</a>
												<a href="#">Storage</a>
												<a href="#">Wedges</a>
												<a href="#">padded</a>											
											</span>
										</div>									
									</li>
									<li><a href="shop.html">Dining Room</a>
										<div class="megamenu dining-megamenu">
											<span>
												<a href="#" class="megatitle">Dining tables</a>
												<a href="#">Crochet</a>
												<a href="#">Sleeveless</a>
												<a href="#">Stripes</a>
												<a href="#">Sweaters</a>
											</span>
											<span>
												<a href="#" class="megatitle">Dining chairs</a>
												<a href="#">Dining chairs</a>
												<a href="#">Ankle</a>
												<a href="#">Cherry Finish</a>
												<a href="#">Weathered</a>
											</span>
											<span>
												<a href="#" class="megatitle">Dining sets</a>
												<a href="#">Upholstered</a>
												<a href="#">Tufted</a>
												<a href="#">Footwear</a>
												<a href="#">Wedges</a>
											</span>
										</div>									
									</li>
									<li><a href="#">All pages</a>
										<ul>
											<li><a href="wishlist.html">my wishlist</a></li>
											<li><a href="cart.html">cart page</a></li>
											<li><a href="checkout.html">checkout</a></li>
											<li><a href="product-details.html">product-details</a></li>
											<li><a href="user_accountpage.html">User account</a></li>
											<li><a href="customer-login.html">login</a></li>
                                            <li><a href="register.php">Register</a></li>
											<li><a href="shop.html">shop </a></li>
											<li><a href="contact.html">contact us</a></li>
											<li><a href="sitemap.html">Site map</a></li>
										</ul>									
									</li>
									<li><a href="contact.html">contact</a></li>
									
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mobile-menu-area hidden-sm hidden-md hidden-lg">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mobile-menu">
							<nav id="mobile-menu">
								<ul>
									<li class="active"><a href="index.html">Home</a>
										<ul>
											<li><a href="index.html">home version 1</a></li>
											<li><a href="index-2.html">home version 2</a></li>
											<li><a href="index-3.html">home version 3</a></li>
											<li><a href="index-4.html">home version 4</a></li>
										</ul>
									</li>
									<li><a href="shop.html">Bedroom</a>
										<ul>
											<li><a href="#">Beds</a>
												<ul>
													<li><a href="#">Platform Beds</a></li>
													<li><a href="#">Storage Beds</a></li>
													<li><a href="#">Regular Beds</a></li>
													<li><a href="#">Sleigh Beds</a></li>
													<li><a href="#">modern beds</a></li>
												</ul>
											</li>
											<li><a href="#">Nightstands</a>
												<ul>
													<li><a href="#">Brown Finish</a></li>
													<li><a href="#">Distressed</a></li>
													<li><a href="#">Cherry Finish</a></li>
													<li><a href="#">Weathered</a></li>
													<li><a href="#">Laundry</a></li>
												</ul>
											</li>
											<li><a href="#">Headboards</a>
												<ul>
													<li><a href="#">Upholstered</a></li>
													<li><a href="#">Tufted</a></li>
													<li><a href="#">Platform Beds</a></li>
													<li><a href="#">Platform Beds</a></li>
													<li><a href="#">Platform Beds</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="shop.html">Living Room	</a>
										<ul>
											<li><a href="#">Beds</a>
												<ul>
													<li><a href="#">Platform Beds</a></li>
													<li><a href="#">Storage Beds</a></li>
													<li><a href="#">Regular Beds</a></li>
													<li><a href="#">Sleigh Beds</a></li>
													<li><a href="#">modern beds</a></li>
												</ul>
											</li>
											<li><a href="#">Nightstands</a>
												<ul>
													<li><a href="#">Brown Finish</a></li>
													<li><a href="#">Distressed</a></li>
													<li><a href="#">Cherry Finish</a></li>
													<li><a href="#">Weathered</a></li>
													<li><a href="#">Laundry</a></li>
												</ul>
											</li>
											<li><a href="#">Headboards</a>
												<ul>
													<li><a href="#">Upholstered</a></li>
													<li><a href="#">Tufted</a></li>
													<li><a href="#">Platform Beds</a></li>
													<li><a href="#">Platform Beds</a></li>
													<li><a href="#">Platform Beds</a></li>
												</ul>
											</li>
											<li><a href="#">Headboards</a>
												<ul>
													<li><a href="#">Upholstered</a></li>
													<li><a href="#">Tufted</a></li>
													<li><a href="#">Platform Beds</a></li>
													<li><a href="#">Platform Beds</a></li>
													<li><a href="#">Platform Beds</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="shop.html">Dining Room</a>
										<ul>
											<li><a href="#">Dining tables</a>
												<ul>
													<li><a href="#">Crochet</a></li>
													<li><a href="#">Sleeveless</a></li>
													<li><a href="#">Regular Beds</a></li>
													<li><a href="#">Stripes</a></li>
													<li><a href="#">Sweaters</a></li>
												</ul>
											</li>
											<li><a href="#">Dining chairs</a>
												<ul>
													<li><a href="#">Ankle</a></li>
													<li><a href="#">Distressed</a></li>
													<li><a href="#">Cherry Finish</a></li>
													<li><a href="#">Weathered</a></li>
													<li><a href="#">Laundry</a></li>
												</ul>
											</li>
											<li><a href="#">Headboards</a>
												<ul>
													<li><a href="#">Upholstered</a></li>
													<li><a href="#">Tufted</a></li>
													<li><a href="#">Phery Finiss</a></li>
													<li><a href="#">Platform Beds</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="shop.html">pages</a>
										<ul>
											<li><a href="wishlist.html">my wishlist</a></li>
											<li><a href="cart.html">cart page</a></li>
											<li><a href="checkout.html">checkout</a></li>
											<li><a href="product-details.html">product-details</a></li>
											<li><a href="user_accountpage.html">User account</a></li>
											<li><a href="customer-login.html">login</a></li>
                                            <li><a href="register.html">Register</a></li>
											<li><a href="shop.html">shop </a></li>
											<li><a href="contact.html">contact us</a></li>
										</ul>									
									</li>
									<li><a href="contact.html">contact</a></li>
									<li><a href="blog.html">blog</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- mainmenu-area-end -->
		<!-- page-title-wrapper-start -->
		<div class="page-title-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="page-title">
							<h3>Create New Customer Account</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- page-title-wrapper-end -->
		<!-- contuct-form-area-start -->
			<div class="login-area ptb-80">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
							<div class="login-title">
								<h3>Create New User Account</h3>
							</div>
							<div class="login-form">
								<form method="post">
									<div class="form-group login-page">
										<label for="exampleInputName1">First Name <span>*</span></label>
										<input type="text" name="FName" class="form-control" id="exampleInputName1" required >
									</div>
									<div class="form-group login-page">
										<label for="exampleInputName2">Last Name <span>*</span></label>
										<input type="text" name="LName" class="form-control" id="exampleInputName2" required >
									</div>					
									<div class="form-group login-page">
										<label for="exampleInputEmail1">Email <span>*</span></label>
										<input type="email" name="Email" class="form-control" id="exampleInputEmail1" required >
									</div>								
									<div class="form-group login-page">
										<label for="exampleInputPassword1">Password <span>*</span></label>
										<input type="Password" name="Pass" class="form-control" id="exampleInputPassword1" required >
									</div>							
									<div class="form-group login-page">
										<label for="exampleInputPassword2">Confirm Password <span>*</span></label>
										<input type="Password" name="conPass" class="form-control" id="exampleInputPassword2" required >
										<h4 class="con_pass">l</h4>
									</div>
									<button type="submit"  class="btn btn-default login-btn">Create an Account</button>
								</form>						
							</div>
							<a href="#" class="back">back</a>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                        
                        <div class="login-title">
								<h3>Sign in with Social Media Account</h3>
							</div>
                        
                        <a class="btn btn-block btn-social btn-facebook">
            <span class="fa fa-facebook"></span> Sign in with Facebook
          </a>
          
          <a class="btn btn-block btn-social btn-google">
            <span class="fa fa-google"></span> Sign in with Google
          </a>
                        </div>
					</div>
				</div>
			</div>

			

		<!-- contuct-form-area-end -->
		<!-- contact-area-start -->
		<div class="contact-area ptb-40">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mar_b-30">
						<div class="contuct-info text-center">
							<h4>Sign up for news & offers!</h4>
							<p>You may safely unsubscribe at any time</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-8 col-sm-12 col-lg-offset-1 col-xs-12">
						<div class="search-box">
							<form action="#">
								<input type="email" placeholder="Enter your email address"/>
								<button><span class="lnr lnr-envelope"></span></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- contact-area-end -->
		<!-- footer-area-start -->
		<div class="footer-area footer-area-4 ptb-80">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 mar_b-30">
						<div class="footer-wrapper">
							<div class="footer-logo">
								<a href="#"><img src="img/logo-4.png" alt="" /></a>
							</div>
							<p>We are a team of designers and developers that create high quality Magento, Prestashop, Opencart themes and provide premium and  support to our products.</p>
							<ul>
								<li>
									<span>Address : </span> Delhi india
								</li>
								<li>
									<span>Phone: </span> 123445689
								</li>
								<li>
									<span>Email:</span> <a href="#">admin@dsfbvbbdvgz.company</a>
								</li>
							</ul>
							<ul class="footer-social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-youtube"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-flickr"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 hidden-sm col-xs-12 mar_b-30">
						<div class="footer-wrapper">
							<div class="footer-title">
								<a href="#"><h3>useful links</h3></a>
							</div>
							<div class="footer-wrapper">
								<ul class="usefull-link">
									<li><a href="#">Contact us</a></li>
									<li><a href="sitemap.html">Site map</a></li>
									<li><a href="#">About us</a></li>
									<li><a href="#">Specials</a></li>
									<li><a href="#">My Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Custom service</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-3 hidden-md hidden-sm col-xs-12 mar_b-30">
						<div class="footer-wrapper">
							<div class="footer-title">
								<a href="#"><h3>useful links</h3></a>
							</div>
							<div class="footer-wrapper">
								<ul class="usefull-link">
									<li><a href="#">Contact us</a></li>
									<li><a href="sitemap.html">Site map</a></li>
									<li><a href="#">About us</a></li>
									<li><a href="#">Specials</a></li>
									<li><a href="#">My Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Custom service</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="footer-wrapper">
							<div class="footer-title">
								<a href="#"><h3>useful links</h3></a>
							</div>
							<div class="footer-wrapper">
								<ul class="usefull-link">
									<li><a href="#">Contact us</a></li>
									<li><a href="sitemap.html">Site map</a></li>
									<li><a href="#">About us</a></li>
									<li><a href="#">Specials</a></li>
									<li><a href="#">My Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Custom service</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- footer-area-end -->
		<!-- .copyright-area-start -->
		<div class="copyright-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mar_b-30">
						<div class="copyright text-left">
							<p>2016 @ All Rights Reserved - <a href="#"></a></p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="copyright-img text-right">
							<a href="#"><img src="img/payment.png" alt="" /></a>
						</div>
					</div>
				</div>
			</div>
		</div>
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

