<?php

define('__ROOT__', "../");
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

        <link rel="icon" href="../../img/favicon.png" />
        <!-- Place favicon.ico in the root directory -->
		<!-- modernizr css -->
        <script src="../../js/vendor/modernizr-2.8.3.min.js"></script>
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
		
		<?php include('../../partials/header.php'); ?>

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
										<label for="exampleInputName1">First Name <span style="color: red;">*<?php echo $controller-> getFnameErr();?></span></label>
										<input type="text" name="FName" class="form-control" id="exampleInputName1" required >
										
									</div>
									<div class="form-group login-page">
										<label for="exampleInputName2">Last Name <span style="color: red;">*<?php echo $controller-> getLnameErr();;?></span></label>
										<input type="text" name="LName" class="form-control" id="exampleInputName2" required >
										
									</div>					
									<div class="form-group login-page">
										<label for="exampleInputEmail1">Email <span style="color: red;" >*<?php echo $controller-> getEmailErr();?></span></label>
										<input type="email" name="Email" class="form-control" id="exampleInputEmail1" required >
										
									</div>								
									<div class="form-group login-page">
										<label for="exampleInputPassword1">Password <span style="color: red;">* <?php echo $controller-> getpasswordErr();?></span></label>
										<input type="Password" name="Password" class="form-control" id="exampleInputPassword1" required >
										
									</div>							
									<div class="form-group login-page">
										<label for="exampleInputPassword2">Confirm Password <span style="color: red;">*  <?php echo $controller-> getconfirmErr();?></span></label>
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
		
		 <?php include('../../partials/footer.php'); ?>
		
		<!-- contact-area-end -->
		<!-- footer-area-end -->
		<!-- .copyright-area-end -->
		



		
    </body>
</html>

