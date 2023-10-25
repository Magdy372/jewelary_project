<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Shop</title>
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
		<?php include('partials/header.php'); ?>
		<!-- <?php //include('partials/footer.php'); ?> -->
		<!-- mainmenu-area-end -->
		<!-- page-title-wrapper-start -->
		<div class="page-title-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="page-title">
							<h3>Shop</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
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
									<li> <div class="checkbox">
										<label>
											<input type="checkbox">Pendants <span>(14)</span>
										</label>
									</div>
								    </li>
								    	<li> <div class="checkbox">
								    		<label>
								    			<input type="checkbox"> Necklaces <span>(14)</span>
								    		</label>
								    	</div>
								        </li>
								        	<li> <div class="checkbox">
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
									<li> <div class="checkbox">
										<label>
											<input type="checkbox"> Purple <span>(14)</span>
										</label>
									</div>
								    </li>
								    	<li> <div class="checkbox">
								    		<label>
								    			<input type="checkbox"> Blue <span>(14)</span>
								    		</label>
								    	</div>
								        </li>
								        	<li> <div class="checkbox">
								        		<label>
								        			<input type="checkbox"> Yellow <span>(14)</span>
								        		</label>
								        	</div>
								            </li>
								            	<li> <div class="checkbox">
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
										<li class="active"><a href="#viewed" data-toggle="tab"><i class="fa fa-th"></i></a></li>
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
            <?php
            $query = "SELECT * FROM Product";
            $result = mysqli_query($con, $query);

            if ($result) {
                while ($product = mysqli_fetch_assoc($result)) {
                    $ProductPictures = explode(',', $product['ProductPicture']);
                    if (!empty($ProductPictures[0])) {
                        $imageSrc = "uploads/" . $ProductPictures[0];
                    } else {
                        $imageSrc = "uploads/default.jpg";
                    }
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="single-new-product mt-40 category-new-product">
                    <div class="product-img">
                        <a href="shop.php?product_id=<?= $product['ProductID']; ?>">
                            <img src="<?php echo $imageSrc; ?>" class="first_img" alt=""  />
                        </a>
                        <div class="new-product-action">
                            <!-- Uncomment the following line if needed -->
                            <!-- <a href="#"><span class="lnr lnr-sync"></span></a> -->
                            <a href="shop.php?cart_id=<?= $product['ProductID']; ?>"><span class="lnr lnr-cart cart_pad"></span>Add to Cart</a>
                            <a href="shop.php?wishlist_id=<?= $product['ProductID']; ?>"><span class="lnr lnr-heart"></span></a>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <a href="product-details.html"><h3><?php echo  $product['ProductName']; ?></h3></a>
                        <div class="product-price-star">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <div class="price">
                            <h4>$<?=$product['Price']?></h4>
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

							<div class="bedroom-pagination">
								<nav aria-label="Page navigation">
									<ul class="pagination">
										<li><a href="#">Page</a></li>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li>
											<a href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											</a>
										</li>
									</ul>
								</nav>							
							</div>
						</div>
						<!-- pagination-area-end -->
					</div>
				</div>
			</div>
		</div>
		<!-- bedroom-all-product-area-end -->
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
