<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Shop</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="../../img/favicon.png" />
	<script src="../../js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
	<?php include('../../partials/header.php'); ?>
	<!-- page-title-wrapper-end -->
	<!-- bedroom-all-product-area-start -->
	<div class="bedroom-all-product-area ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="bedroom-sideber">
						<div class="bedroom-title text-uppercase">
							<h4>Shopping Options</h4>
						</div>
					</div>
					<!-- price-slider-area-start -->
					<div class="price-slider-area">
						<h3 class="bedroom-side-title">price</h3>
						<div id="slider-range"></div>
						<p>
							<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
						</p>
					</div>
					<!-- price-slider-area-end -->
					<!-- Category-start -->
					<div class="category-area-start">
						<div class="caregory">
							<h3 class="bedroom-side-title">category</h3>
							<ul>
								<li>
									<div class="checkbox">
										<label>
											<input type="checkbox">Pendants <span>(14)</span>
										</label>
									</div>
								</li>
								<li>
									<div class="checkbox">
										<label>
											<input type="checkbox"> Necklaces <span>(14)</span>
										</label>
									</div>
								</li>
								<li>
									<div class="checkbox">
										<label>
											<input type="checkbox"> Bracelets <span>(14)</span>
										</label>
									</div>
								</li>

							</ul>
						</div>
					</div>
					<!-- Category-end -->
					<!-- .sideber-color-start -->
					<div class="sideber-color mt-40">
						<h3 class="bedroom-side-title">Color</h3>
						<ul>
							<li>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Purple <span>(14)</span>
									</label>
								</div>
							</li>
							<li>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Blue <span>(14)</span>
									</label>
								</div>
							</li>
							<li>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Yellow <span>(14)</span>
									</label>
								</div>
							</li>
							<li>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Red <span>(14)</span>
									</label>
								</div>
							</li>


							<!-- <li><a href="#">Nightstands <span>(5)</span></a></li>
									<li><a href="#">Headboards <span>(67)</span></a></li> -->
						</ul>
					</div>
					<!-- .sideber-color-end -->


				</div>
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<!-- category-products-area-start -->
					<div class="caregory-products-area">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<ul class="tab_menu">
									<li class="active"><a href="#viewed" data-toggle="tab"><i class="fa fa-th"></i></a>
									</li>
									<!--<li><a href="#random " data-toggle="tab"><i class="fa fa-list"></i></a></li>-->
								</ul>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<div class="product-option">
									<div class="porduct-option-left floatleft">
										<span> Items 1-16 of 17</span>
									</div>
									<div class="product-option-right floatright">
										<div class="sort-by">
											<label>Sort By:</label>
											<select class="cust-select">
												<option selected="selected">Position</option>
												<option>name</option>
												<option>price</option>
											</select>
											<a href="#"><i class="fa fa-arrow-up"></i></a>
										</div>
										<div class="sort-by">
											<label>Show:</label>
											<select class="cust-select cust-select-2">
												<option selected="selected">21</option>
												<option>22</option>
												<option>23</option>
												<option>24</option>
												<option>25</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="viewed">
								<div class="row">
									<div class="row">
										<?php

										if (!empty($products)) {
											foreach ($products as $product) {
												$ProductPictures = explode(',', $product['ProductPicture']);
												if (!empty($ProductPictures[0])) {
													$imageSrc = "../../uploads/" . $ProductPictures[0];
												} else {
													$imageSrc = "../../uploads/default.jpg";
												}
												?>
												<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
													<div class="single-new-product mt-40 category-new-product">
														<div class="product-img">
															<a href="product-details.php?details_id=<?= $product['id']; ?>">
																<img src="<?php echo $imageSrc; ?>" class="first_img" alt="" />
															</a>
															<div class="new-product-action">
																<a href="shop.php?cart_id=<?= $product['id']; ?>"><span
																		class="lnr lnr-cart cart_pad"></span>Add to Cart</a>
																<a href="shop.php?wishlist_id=<?= $product['id']; ?>"><span
																		class="lnr lnr-heart"></span></a>
															</div>
														</div>
														<div class="product-content text-center">
															<a href="product-details.html">
																<h3>
																	<?php echo $product['ProductName']; ?>
																</h3>
															</a>
															<div class="product-price-star">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="price">
																<h4>$
																	<?= $product['Price'] ?>
																</h4>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
										} else {
											echo '<div style="text-align: center; margin-top: 125px;">No products found.</div>';
										}
										?>
									</div>

								</div>
							</div>
						</div>
						<div class="bedroom-pagination">
							<!-- ... Your existing code ... -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include('../../partials/footer.php'); ?>
	<!-- .copyright-area-end -->

</body>

</html>