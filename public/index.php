<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--<link rel="icon" href="img/favicon.png" />
         Place favicon.ico in the root directory -->
		<!-- google-font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="../css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="../css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="../css/meanmenu.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="../css/nivo-slider.css">		
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
		
    </head>
    <body>
        <?php include('../partials/header.php'); ?>
		<!-- mainmenu-area-end -->
		<!-- slider-area-start -->
		
		<!-- slider-area-end -->
		<!-- service-area-start -->
		
		<!-- service-area-end -->
		<div class="new-product-area hot-deal-area dotted-5 new-product-4 pt-80">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-12 col-md-12">
						<div class="section-title section-title-4">
							<h2>New Products</h2>
						</div>	
						<div class="row">
							<div class="new-product-home-4-active">
							<?php

								$query = "SELECT * FROM product";
								$result = mysqli_query($con, $query);

								

								if ($result) {
									while ($product = mysqli_fetch_assoc($result)) {
										
										$ProductPictures = explode(',', $product['ProductPicture']);
										if (!empty($ProductPictures[0])) {
											$imageSrc = "../uploads/" . $ProductPictures[0];
										} else {
											$imageSrc = "../uploads/default.jpg";
										} ?>
										<div class="col-lg-12">
											<div class="single-new-product">
												<div class="product-img">
												<a href="product-details.php?details_id=<?=$product['id'];?>">
                                                    <img src="<?= $imageSrc ?>" class="first_img" alt="" />
                                                   </a>
												</div>
												<div class="product-content text-center">
													<a href="product-details.html"><h3><?=$product['ProductName']?></h3></a>
													<div class="product-price-star">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="price">
														<h4>EGP<?=$product['Price']?></h4> 
														
													</div>
												</div>
												<div class="product-icon-wrapper">
													<div class="product-icon">
														<ul>
															<li><a href="#"><span class="lnr lnr-sync"></span></a></li>
															<li><a href="index.php?wishlist_id=<?= $product['id']; ?>"><span class="lnr lnr-heart"></span></a></li>
															<li><a href="index.php?cart_id=<?= $product['id']; ?>"><span class="lnr lnr-cart"></span></a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									<?php 
										}
									}
									?>

				
							</div>
						</div>	
						<div class="row">
							<div class="col-lg-12">
								<div class="single-static-banner">
									<div class="single-static-img">
										<a href="shop.php"><img src="img/banner/ads-middle-grand.jpg" alt="" /></a>
										<div class="single-static-text single-static-text-4">
											<h3></h3>
											<span></span>
										</div>								
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	
			</div>
		</div>
		<!--new-product-area-start -->
		<div class="new-product-area hot-deal-area dotted-5 new-product-4 ptb-50">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title section-title-4 section_4">
							<h2>featured products</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="new-product-home-2-active">
						<?php

								$query = "SELECT * FROM product";
								$result = mysqli_query($con, $query);

								

								if ($result) {
									while ($product = mysqli_fetch_assoc($result)) {
										
										$ProductPictures = explode(',', $product['ProductPicture']);
										if (!empty($ProductPictures[0])) {
											$imageSrc = "../uploads/" . $ProductPictures[0];
										} else {
											$imageSrc = "../uploads/default.jpg";
										} ?>
										<div class="col-lg-12">
											<div class="single-new-product">
												<div class="product-img">
												<a href="product-details.php?details_id=<?=$product['id'];?>">
                                                    <img src="<?= $imageSrc ?>" class="first_img" alt="" />
                                                   </a>
												</div>
												<div class="product-content text-center">
													<a href="product-details.html"><h3><?=$product['ProductName']?></h3></a>
													<div class="product-price-star">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="price">
														<h4>EGP<?=$product['Price']?></h4> 
														
													</div>
												</div>
												<div class="product-icon-wrapper">
													<div class="product-icon">
														<ul>
															<li><a href="#"><span class="lnr lnr-sync"></span></a></li>
															<li><a href="index.php?wishlist_id=<?= $product['id']; ?>"><span class="lnr lnr-heart"></span></a></li>
															<li><a href="index.php?cart_id=<?= $product['id']; ?>"><span class="lnr lnr-cart"></span></a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									<?php 
										}
									}
									?>
	
					</div>
				</div>	
			</div>
		</div>
		<!-- new-product-area-end -->
		<!-- static-slider-area-start -->
		<div class="static-slider-area dotted-style new-product-4 pb-80 hidden-xs">
			<div class="static-slider-active">
				<div class="static-single-slider">
					<div class="static-slider-img">
						<img src="img/banner/ads-middle-grand.jpg" alt="" />
					</div>
					
				</div>	
				<div class="static-single-slider">
					<div class="static-slider-img">
						<img src="img/banner/ads-middle-grand.jpg" alt="" />
					</div>
					
				</div>	
				<div class="static-single-slider">
					<div class="static-slider-img">
						<img src="img/banner/ads-middle-grand.jpg" alt="" />
					</div>
			
				</div>			
			</div>
		</div>
		<!-- static-slider-area-end -->
		<!-- feature-preduct-area-start -->
		<div class="feature-preduct-area home-page-2 feature-product-4 dotted-5 new-product-4 hot-deal-area  pb-50">
			<div class="container">
				<div class="row">
					<div class="section-title hot-deal-title sale-4 section-title-4">
						<h2>sale products</h2>
					</div>				
					<div class="col-lg-9 col-md-9">
						<div class="feature-home-2-active feature-home-4-active">
						<?php

$query = "SELECT * FROM product";
$result = mysqli_query($con, $query);



if ($result) {
	while ($product = mysqli_fetch_assoc($result)) {
		
		$ProductPictures = explode(',', $product['ProductPicture']);
		if (!empty($ProductPictures[0])) {
			$imageSrc = "../uploads/" . $ProductPictures[0];
		} else {
			$imageSrc = "../uploads/default.jpg";
		} ?>
		<div class="col-lg-12">
			<div class="single-new-product">
				<div class="product-img">
				<a href="product-details.php?details_id=<?=$product['id'];?>">
					<img src="<?= $imageSrc ?>" class="first_img" alt="" />
				   </a>
				</div>
				<div class="product-content text-center">
					<a href="product-details.html"><h3><?=$product['ProductName']?></h3></a>
					<div class="product-price-star">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
					</div>
					<div class="price">
						<h4>EGP<?=$product['Price']?></h4> 
						
					</div>
				</div>
				<div class="product-icon-wrapper">
					<div class="product-icon">
						<ul>
							<li><a href="#"><span class="lnr lnr-sync"></span></a></li>
							<li><a href="index.php?wishlist_id=<?= $product['id']; ?>"><span class="lnr lnr-heart"></span></a></li>
							<li><a href="index.php?cart_id=<?= $product['id']; ?>"><span class="lnr lnr-cart"></span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php 
		}
	}
	?>

												
												
						</div>

							
					<div class="">
						<div class="single-static-banner">
							<div class="single-static-img">
								<a href="shop.php"><img src="img/banner/ads-middle-grand.jpg" alt="" /></a>
								<div class="single-static-text single-static-text-4">
									<h3></h3>
									<span></span>
								</div>								
							</div>
						</div>
					</div>	


					</div>
					
				</div>
			</div>
		</div>
		<?php include('../partials/footer.php'); ?>
		<!-- contact-area-end -->		
		
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
		<!-- wow js -->
        <script src="../js/wow.min.js"></script>
		<!-- scrolly js -->
        <script src="../js/jquery.scrolly.js"></script>		
		<!-- magnific-popup js -->
        <script src="../js/jquery.magnific-popup.min.js"></script>	
		<!--  countdown js -->
        <script src="../js/jquery.countdown.min.js"></script>	
		<!-- nivo.slider js -->
        <script src="../js/jquery.nivo.slider.js"></script>			
		<!-- plugins js -->
        <script src="../js/plugins.js"></script>
		<!-- main js -->
        <script src="../js/main.js"></script>
    </body>
</html>