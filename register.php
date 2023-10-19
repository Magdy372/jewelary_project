<?php
include_once "includes/dbh.inc.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fname = htmlspecialchars($_POST["FName"]);
    $Lname = htmlspecialchars($_POST["LName"]);
    $Email = htmlspecialchars($_POST["Email"]);
    $Password = htmlspecialchars($_POST["Pass"]);

    // Check if the database connection is valid
    if ($conn) {
        $sql = "INSERT INTO users (Fname, LName, Email, Pass) 
                VALUES ('$Fname', '$Lname', '$Email', '$Password')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Successful query execution - redirect the user
            header("Location: index.php");
            exit(); // Important: Terminate the script after the header() call
        } else {
            // Handle the error in a different way (e.g., log the error and display an error page)
            // You can log the error message and display a user-friendly error message.
            $error_message = "An error occurred while inserting the data: " . mysqli_error($conn);
            // Log the error to an error log or display it to the user.
            // For now, we'll just echo the error.
            echo $error_message;
        }
    } else {
        // Handle the case where the database connection is not valid
        // You can log the error or take appropriate action here.
        // For now, we'll display an error message.
        echo "Database connection is not valid.";
    }
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
		<!-- mainmenu-area-start -->
		
		<?php include('partials/header.php'); ?>

		<!-- header-end -->
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
		<!-- footer-area-start -->
		<!-- .copyright-area-start -->
		
		<?php include('partials/footer.php'); ?>
		
		<!-- contact-area-end -->
		<!-- footer-area-end -->
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

