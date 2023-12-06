<?php

define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "controller/UserController.php");

$model = new Users();
//$model = new User();
$controller = new UserController($model);
//$view = new ViewUser($controller, $model);



if (isset($_POST['Submit'])){
    

	$Fname =  $_POST['FName'];
	$Lname =  $_POST['LName'];
	$password=$_POST['Password'];
	$Conpass=$_POST['conPass'];
	$email =  $_POST['Email'];


   $controller->insert($Fname, $Lname, $password,$Conpass, $email) ;
   
   
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
        <link rel="stylesheet" href="../css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="../css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="../css/jquery-ui.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="../css/nivo-slider.css">
		<!-- magnific-popup css -->
        <link rel="stylesheet" href="../css/magnific-popup.css">		
		<!-- meanmenu css -->
        <link rel="stylesheet" href="../css/meanmenu.min.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="../css/owl.carousel.css">
		<!--linearicons css -->
        <link rel="stylesheet" href="../css/linearicons-icon-font.min.css">
		<!-- font-awesome css -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
         <link rel="stylesheet" href="../css/bootstrap-social.css">
		<!-- style css -->
		<link rel="stylesheet" href="../style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="../css/responsive.css" />
		<!-- modernizr css -->
        <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
	<style>
	.error {color:#FF0000;}
	</style>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
		

		
		<!-- header-start -->
		<!-- mainmenu-area-start -->
		
		<?php// include('../partials/header.php'); ?>

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
										<label for="exampleInputName1">First Name <span>*<?php echo $controller-> getFnameErr();?></span></label>
										<input type="text" name="FName" class="form-control" id="exampleInputName1" required >
										
									</div>
									<div class="form-group login-page">
										<label for="exampleInputName2">Last Name <span>*<?php echo $controller-> getLnameErr();;?></span></label>
										<input type="text" name="LName" class="form-control" id="exampleInputName2" required >
										
									</div>					
									<div class="form-group login-page">
										<label for="exampleInputEmail1">Email <span>*<?php echo $controller-> getEmailErr();?></span></label>
										<input type="email" name="Email" class="form-control" id="exampleInputEmail1" required >
										
									</div>								
									<div class="form-group login-page">
										<label for="exampleInputPassword1">Password <span>* <?php echo $controller-> getpasswordErr();?></span></label>
										<input type="Password" name="Password" class="form-control" id="exampleInputPassword1" required >
										
									</div>							
									<div class="form-group login-page">
										<label for="exampleInputPassword2">Confirm Password <span>*  <?php echo $controller-> getconfirmErr();?></span></label>
										<input type="Password" name="conPass" class="form-control" id="exampleInputPassword2" required >
										
									</div>
									<button type="submit"  class="btn btn-default login-btn"  value="Done" name="Submit">Create an Account</button>
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
		
		 <?php //include('../partials/footer.php'); ?>
		
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

