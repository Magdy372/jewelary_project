<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Wishlist</title>
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
        
		<!-- header-start -->
		<?php include('partials/header.php'); ?>
		<?php
			if($_SESSION["UserID"]!==NULL){
				include_once ("wishlishClass.php");
				
				
				// to adding product to wishlist 

				// to delete product from Wishlist
				if (isset($_GET['delete_id'])) {
					$deleteProductID = $_GET['delete_id'];
					$userID = $_SESSION["UserID"];
					
					$wishObject1=ShoppingCart::deleteFromWishlist($userID,$deleteProductID);
					if ($wishObject1!==NULL)
					{	
						echo "Deleted Successfully :)";
					}
					// Implement the code to delete the item with $deleteProductID from the wishlist.
					// You can use your WishlistItem class to delete the item.


				}


            }

				//to display user wishlist 
				$wishObject=ShoppingCart::dispalyWish($_SESSION["UserID"]);

			?>

            