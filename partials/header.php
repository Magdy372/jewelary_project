<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
	<?php
session_start();
include_once("UserClass.php");
include_once("shoppingcardclass.php");
include_once("productclass.php");
include_once("wishlishClass.php");
// Check if a user is logged in
if (!empty($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];
    $UserObject = new User($userID);
    echo "<p>Welcome " . $UserObject->FName . "</p";

    if (isset($_GET['wishlist_id'])) {
        
        $productID = $_GET['wishlist_id'];
        $wishObject1 = WishlistItem::addToWishlist($userID, $productID);

        if ($wishObject1 !== NULL) {
            echo "Added to wishlist Successfully :)";
        }
    } elseif (isset($_GET['cart_id'])) {
        $productID = $_GET['cart_id'];
        $cartObject1 = ShoppingCart::addToCart($userID, $productID);

        if ($cartObject1 !== NULL) {
            echo "Added to cart Successfully :)";
            echo "$cartObject1";
        }
    }
} else {
    // Guests cannot access wishlist or add anything to it
    if (isset($_GET['wishlist_id']) || isset($_GET['cart_id'])) {
        header("Location: customer-login.php");
        exit;
    }
}

if (isset($_GET['product_id']) || isset($_GET['cart_id'])) {
    if (isset($_GET['product_id'])) {
        $productID = $_GET['product_id'];
    } else {
        $productID = $_GET['cart_id'];
    }
    
    // Assuming Product::getProductID is a method to get product details
    $productObject1 = Product::getProductID($con, $productID);
}


if (isset($_GET['details_id'])) {
    $productID = $_GET['details_id'];
    $productData = Product::getProductID($con, $productID);

    if ($productData) {
        // Display product details here
        echo 'Product Name: ' . $productData['ProductName'] . '<br>';
        echo 'Description: ' . $productData['Description'] . '<br>';
        echo 'Price: ' . $productData['Price'] . '<br>';
        // Add more product details as needed
    } else {
        echo 'Product not found';
    }
} 
?>
		<header>
			<div class="header-top-area ptb-10 hidden-xs header-top-area-4">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-5">
							<div class="header-top-right header-top-left-4">
						
			
							</div>
						</div>					
						<div class="col-lg-9 col-md-8 col-sm-7 header-top-right-4">
    <div class="header-top-left">
        <ul>
            <?php if(!empty($_SESSION['UserID'])): ?>
                <li><a href="register.php">Create an Account</a></li>
                <li class="click_menu">
                    <a href="#">My Account <i class="fa fa-angle-down"></i></a>
                    <ul class="click_menu_show">
                        <?php 
                        for ($i = 0; $i < count($UserObject->UserType_obj->ArrayOfPages); $i++) {
                            echo "<li><a href=" . $UserObject->UserType_obj->ArrayOfPages[$i]->Linkaddress . ">" . $UserObject->UserType_obj->ArrayOfPages[$i]->FreindlyName . "</a></li>";
                        }
                        ?>
                    </ul>
                </li>
            <?php else: ?>
                <li><a href="customer-login.php">Compare Products</a></li>
                <li><a href="customer-login.php">Sign In</a></li>
                <li><a href="customer-login.php">My Account</a></li>
                <li><a href="register.php">Create an Account</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

					</div>
				</div>
			</div>
			<div class="header-bottom-area home-page-2 ptb-10">
				<div class="container">
					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="logo logo2">
								<a href="index.php"><img src="./img/logo-4.jpg" alt="" /></a>
							</div>					
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="menu-search-box scnd-fix">
								<form action="#">
									<input type="text" placeholder="Search here..."/>
									<button><span class="lnr lnr-magnifier"></span></button>
								</form>
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
												<a href="cart.php"><img src="./img/cart/1.jpg" alt="" /></a>
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
												<a href="#"><img src="./img/cart/1.jpg" alt="" /></a>
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
											<a href="checkout.php">checkout <i class="fa fa-angle-right"></i></a>
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
									<li><a href="shop.php">Little H</a>
										<div class="megamenu">
											<span>
												<a href="#" class="megatitle">Little H</a>
												<a href="#">Necklaces</a>
												<a href="#">Pendants</a>
												<a href="#">Rings</a>
												<a href="#">Bracelets</a>
												<a href="#">Earrings</a>
												<a href="#">Colored Stones</a>
												
											</span>
											<span>
												<a href="#" class="megatitle">Shop by Metal</a>
												<a href="#">18k Gold</a>
												<a href="#">21k Gold</a>
												<a href="#">24k Gold</a>
												<a href="#">Yellow Gold</a>
												<a href="#">Rose Gold</a>
											</span>
											
										</div>
									</li>
									<li><a href="shop.php">New in</a>
										<div class="megamenu">
											<span>
												<a href="#" class="megatitle">New in</a>
												<a href="#">Necklaces</a>
												<a href="#">Pendants</a>
												<a href="#">Rings</a>
												<a href="#">Anklets</a>
												<a href="#">Bracelets</a>
												<a href="#">Earrings</a>
												<a href="#">Colored Stones</a>
												
											</span>
											<span>
												<a href="#" class="megatitle">Shop by Metal</a>
												<a href="#">18k Gold</a>
												<a href="#">21k Gold</a>
												<a href="#">24k Gold</a>
												<a href="#">Yellow Gold</a>
												<a href="#">Rose Gold</a>
											</span>
											
										</div>
									</li>
									<li><a href="shop.php">Gold Jewellery</a>
										<div class="megamenu megamenu2 living-megamenu">
											<span>
												<a href="#" class="megatitle">Gold Jewellery</a>
												<a href="#">Necklaces</a>
												<a href="#">Pendants</a>
												<a href="#">Rings</a>
												<a href="#">Bracelets</a>
												<a href="#">Anklets</a>
												<a href="#">Earrings</a>
												<a href="#">Colored Stones</a>
											</span>
											<span>
												<a href="#" class="megatitle">Shop by Metal</a>
												<a href="#">18k Gold</a>
												<a href="#">21k Gold</a>
												<a href="#">24k Gold</a>
												<a href="#">Yellow Gold</a>
												<a href="#">Rose Gold</a>									
											</span>
											
										</div>									
									</li>
									<li><a href="shop.php">Gold Bars</a>
																		
									</li>
									<li><a href="shop.php">Gold Coins</a>
																		
									</li>
									
									<li><a href="shop.php">Sets</a>
																		
									</li>

									<li><a href="shop.php">Wedding Bands</a>
																		
									</li>

									<li><a href="#">All pages</a>
										<ul>
											<li><a href="wishlist.php">my wishlist</a></li>
											<li><a href="cart.php">cart page</a></li>
											<li><a href="checkout.php">checkout</a></li>
											<li><a href="product-details.php">product-details</a></li>
											<li><a href="user_accountpage.php">User account</a></li>
											<li><a href="customer-login.php">login</a></li>
                                            <li><a href='register.php'>Register</a></li>
											<li><a href="shop.php">shop </a></li>
											<li><a href="contact.php">contact us</a></li>
											<li><a href="sitemap.php">Site map</a></li>
										</ul>									
									</li>




									<li><a href="contact.php">contact</a></li>
									
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
									<li class="active"><a href="index.php">LITTLE H</a>
										<ul>
											<li><a href="#">Necklaces</a></li>
											<li><a href="#">Pendants</a></li>
											<li><a href="#">Rings</a></li>
											<li><a href="#">Bracelets</a></li>
											<li><a href="#">Earrings</a></li>
											<li><a href="#">Colored Stones</a></li>
										</ul>
									</li>
									<li><a href="shop.php">Bedroom</a>
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
									<li><a href="shop.php">Living Room	</a>
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
									<li><a href="shop.php">Dining Room</a>
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
									<li><a href="#">All pages</a>
										<ul>
											<li><a href="wishlist.php">my wishlist</a></li>
											<li><a href="cart.php">cart page</a></li>
											<li><a href="checkout.php">checkout</a></li>
											<li><a href="product-details.php">product-details</a></li>
											<li><a href="user_accountpage.php">User account</a></li>
											<li><a href="customer-login.php">login</a></li>
                                            <li><a href='register.php'>Register</a></li>
											<li><a href="shop.php">shop </a></li>
											<li><a href="contact.php">contact us</a></li>
											<li><a href="sitemap.php">Site map</a></li>
										</ul>									
									</li>
									<li><a href="contact.php">contact</a></li>
									<li><a href="blog.php">blog</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- mainmenu-area-end -->
		<!-- slider-area-start -->
		
	
		
    </body>
</html>
