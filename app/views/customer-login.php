<?php

// include_once "UserClass.php";

// if($_SERVER["REQUEST_METHOD"]=="POST"){
	
// 	$Email=$_POST["Email"];
// 	$Password=$_POST["Password"];
	
// 	$UserObject=User::login($Email,$Password);
// 	if ($UserObject!==NULL)
// 	{	
// 		session_start();
// 		$_SESSION["UserID"]=$UserObject->ID;
		
// 		header("Location:index.php");
// 	}else{
// 		echo " Email or Password is incorrect <br>";
// 	}
// }



define('__ROOT__', "../");
require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "controller/UserController.php");

$model = new Users();
//$model = new User();
$controller = new UserController($model);
//$view = new ViewUser($controller, $model);

if (isset($_POST['Submit'])){
    

	$email =  $_POST['Email'];
	$password=$_POST['Password'];
	


   $controller->login($email,$password) ;
   
   
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

        <link rel="icon" href="../../img/favicon.png" />
        <!-- Place favicon.ico in the root directory -->
		<!-- google-font -->
		
		<!-- modernizr css -->
        <script src="../../js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->


		<!-- header-start -->
		<!-- mainmenu-area-start -->
		<?php include('../../partials/header.php'); ?>
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
										<input type="Password" name= "Password" class="form-control" id="exampleInputPassword1">
									</div>	
									<button type="submit" class="btn btn-default login-btn" value="Done" name="Submit">Sign In</button>
								</form>						
							</div>
							<a href="#" class="back">Forgot Your Password?</a>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="login-title">
								<h3>New Customers</h3>
								<span>Creating an account has many benefits: check out faster, keep more than one address, track orders and more.</span>
							</div>
								<form action="register.php">
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
		
		<?php  include('../../partials/footer.php'); ?>

		<!-- contact-area-end -->
		<!-- footer-area-end -->
		<!-- .copyright-area-end -->
		
		
		
    </body>
</html>
