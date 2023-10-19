<?php
   //start session
   session_start();
   //include database connection file
   include_once "includes/dbh.inc.php";
   //grab data from user and see if it exists in database
   if($_SERVER["REQUEST_METHOD"]=="POST"){

    $Email=$_POST["Email"];
	$Password=$_POST["Pass"];
   
    
   //select data from database where email and password matches

    $sql = "select * from users where Email ='$Email' and Pass='$Password';";
    $result = mysqli_query($conn,$sql);


   //if true then use session variables to use it as long as session is started
    if($row = mysqli_fetch_array($result)){
      $_SESSION['id'] = $row[0];
      $_SESSION['fname'] = $row["Fname"];
      $_SESSION['lastname'] = $row["LName"];
      $_SESSION['email'] = $row["Email"];
      $_SESSION['pass'] = $row["Pass"];

      header("location:index.php");
	  exit;

    }
    else{
      echo " invalid username or password " . "<br>";
    }
	
   }

 
 ?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Customer-Login</title>
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
		<!-- mainmenu-area-start -->
		<?php include('partials/header.php'); ?>
		<!-- header-end -->
		<!-- mainmenu-area-end -->
		


		<!-- page-title-wrapper-start -->
		<div class="page-title-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="page-title">
							<h3>Customer Login</h3>
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
						<div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="login-title">
								<h3>Registered Customers</h3>
								<span>If you have an account, sign in with your email address.</span>
							</div>
							<div class="login-form">
								<form method="post">									
									<div class="form-group login-page">
										<label for="exampleInputEmail1">Email <span>*</span></label>
										<input type="text" name="Email" class="form-control" id="exampleInputEmail1">
									</div>								
									<div class="form-group login-page">
										<label for="exampleInputPassword1">Password <span>*</span></label>
										<input type="Password" name= "Pass" class="form-control" id="exampleInputPassword1">
									</div>	
									<button type="submit" class="btn btn-default login-btn">Sign In</button>
								</form>						
							</div>
							<a href="#" class="back">Forgot Your Password?</a>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="login-title">
								<h3>New Customers</h3>
								<span>Creating an account has many benefits: check out faster, keep more than one address, track orders and more.</span>
							</div>
								<form action="#">
									<button type="submit" class="btn btn-default login-btn">Create an Account</button>
								</form>
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
