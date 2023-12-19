<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Wishlist</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="../../img/favicon.png" />
	<!-- Place favicon.ico in the root directory -->

	<!-- modernizr css -->
	<script src="../../js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

	<!-- header-start -->
	<?php include('../../partials/header.php'); ?>
	<?php

	require_once(__ROOT__ . "model/Wishlist.php");
	require_once(__ROOT__ . "controller/WishlistController.php");

	if ($_SESSION["UserID"] !== NULL) {



		$Wishlistmodel = new WishlistItem($_SESSION["UserID"]);
		$Wishlistcontroller = new WishlistController($Wishlistmodel);
		// to adding product to wishlist 
	
		// to delete product from Wishlist
		if (isset($_GET['delete_id'])) {
			$deleteProductID = $_GET['delete_id'];
			$userID = $_SESSION["UserID"];

			$wishObject1 = $Wishlistcontroller->Delete($userID, $deleteProductID);
			if ($wishObject1) {
				echo "Deleted Successfully :)";
			}
			// Implement the code to delete the item with $deleteProductID from the wishlist.
			// You can use your WishlistItem class to delete the item.
	

		}




		//to display user wishlist 
	
		$wishObject = $Wishlistcontroller->Display($_SESSION["UserID"]);

		?>




		<!-- mainmenu-area-end -->
		<!-- page-title-wrapper-start -->
		<div class="page-title-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="page-title">
							<h3>wishlist</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- page-title-wrapper-end -->
		<!-- wishlist-area start -->
		<div class="wishlist-area pt-80 pb-30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="wishlist-content">
							<form action="#">
								<div class="wishlist-title">
									<h2>My wishlist</h2>
								</div>
								<div class="wishlist-table table-responsive">
									<table>
										<thead>
											<tr>
												<th class="product-remove"><span class="nobr">Remove</span></th>
												<th class="product-thumbnail">Image</th>
												<th class="product-name"><span class="nobr">Product Name</span></th>
												<th class="product-price"><span class="nobr"> Unit Price </span></th>
												<th class="product-stock-stauts"><span class="nobr"> Stock Status </span>
												</th>
												<th class="product-add-to-cart"><span class="nobr">add-to-cart </span></th>
											</tr>
										</thead>
										<tbody>

											<?php
											if (!is_null($wishObject) && !empty($wishObject)) {
												// Assuming $wishObject and $wisharr have the same length
												$count = count($wishObject);

												for ($i = 0; $i < $count; $i++) {
													$element = $wishObject[$i];

													// Assuming $element and $value are arrays
													$ProductPictures = explode(',', $element['ProductPicture']);
													if (!empty($ProductPictures[0])) {
														$imageSrc = "../../uploads/" . $ProductPictures[0];
													} else {
														$imageSrc = "../../uploads/default.jpg";
													}
													?>
													<tr>
														<td class="product-remove"><a
																href="wishlist.php?delete_id=<?= $element['ProductID'] ?>">x</a>
														</td>
														<td class="product-thumbnail"><a href="#"><img src="<?= $imageSrc ?>"
																	alt="" /></a></td>
														<td class="product-name"><a href="#">
																<?= $element['ProductName'] ?>
															</a></td>
														<td class="product-price"><span class="amount">$
																<?= $element['ProductPrice'] ?>
															</span></td>
														<td class="product-stock-status"><span class="wishlist-in-stock">In
																Stock</span></td>
														<td class="product-add-to-cart"><a
																href="wishlist.php?cart_id=<?= $element['ProductID'] ?>">Add to
																Cart</a></td>
													</tr>
													<?php
												}
											} else {
												// Handle the case where there are no items in the wishlist
												echo "Your wishlist is empty.";
											}
											?>


										</tbody>
										<tfoot>
											<tr>
												<td colspan="6">
													<div class="wishlist-share">
														<h4 class="wishlist-share-title">Share on:</h4>
														<ul>
															<li><a class="facebook" href="#"></a></li>
															<li><a class="twitter" href="#"></a></li>
															<li><a class="pinterest" href="#"></a></li>
															<li><a class="googleplus" href="#"></a></li>
															<li><a class="email" href="#"></a></li>
														</ul>
													</div>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else {
		header("Location:index.php");
	}
	?>
	<!-- wishlist-area end -->
	<!-- contact-area-start -->
	<?php include('../../partials/footer.php'); ?>
	<!-- .copyright-area-end -->


</body>

</html>