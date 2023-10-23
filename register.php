<?php
function isStrongPassword($password) {
    // Password requirements: at least 8 characters, one uppercase letter, one lowercase letter, one number, and one special character
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/';
    return preg_match($pattern, $password);
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$FnameErr = $LnameErr = $EmailErr = $passwordErr = $confirmErr = ""; 
$emailTaken = false;


include_once "UserClass.php";


if(isset($_POST['Submit'])){ //check if form was submitted

	// Validate the first name field
    if (empty($_POST["FName"])) {
        $FnameErr = "First Name is required";
    } else {
        $name = test_input($_POST["FName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $FnameErr = "Only letters and white space allowed";
        }
    }

	// Validate the last name field
    if (empty($_POST["LName"])) {
        $LnameErr = "last Name is required";
    } else {
        $name = test_input($_POST["LName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $LnameErr = "Only letters and white space allowed";
        }
    }

    // Validate the email field
    if (empty($_POST["Email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["Email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid Email format";
        }
    }
    $email = test_input($_POST["Email"]);
    $sql = "SELECT * FROM users WHERE Email = '$email'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0) {
        $emailErr = "Email is already taken. please, login";
        $emailTaken = true;
    }

    // Validate the password field
  // Validate the password field
    if (empty($_POST["Password"])) {
    $passwordErr = "Password is required";
    } elseif (!isStrongPassword($_POST["Password"])) {
    $passwordErr = "Password must be at least 8 characters long and contain one uppercase letter, one lowercase letter, one number, and one special character";
    }

    // Validate the confirm password field
    if (empty($_POST["conPass"])) {
        $confirmErr = "Confirm is required";
    } else {
        $confirm = test_input($_POST["conPass"]);

        if ($_POST["Password"] !== $_POST["conPass"]) {
            $confirmErr = "Passwords don't match";
        }
    }


	if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmErr) && empty($birthErr)&& 
    !$emailTaken) {
		$FN=htmlspecialchars($_POST['FName']);
		$LN=htmlspecialchars($_POST['LName']);
		$EM=htmlspecialchars($_POST['Email']);
		$PW=htmlspecialchars($_POST['Password']);
		$conpw = htmlspecialchars($_POST['conPass']);

		if($PW === $conpw){
			$hashedPW = password_hash($PW, PASSWORD_DEFAULT , ["cost" => 12] );

			if(User::InsertinDB_Static($FN,$LN,$EM,$hashedPW)){
				header("Location:index.php");
			}
		}else{
			echo "Confirm password isn't identical with Password ,Try Again <br>" ;
		}
	
	
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
										<span class="error"> <?php echo $FnameErr;?></span>
									</div>
									<div class="form-group login-page">
										<label for="exampleInputName2">Last Name <span>*</span></label>
										<input type="text" name="LName" class="form-control" id="exampleInputName2" required >
										<span class="error"> <?php echo $LnameErr;?></span>
									</div>					
									<div class="form-group login-page">
										<label for="exampleInputEmail1">Email <span>*</span></label>
										<input type="email" name="Email" class="form-control" id="exampleInputEmail1" required >
										<span class="error"> <?php echo $emailErr;?></span>
									</div>								
									<div class="form-group login-page">
										<label for="exampleInputPassword1">Password <span>*</span></label>
										<input type="Password" name="Password" class="form-control" id="exampleInputPassword1" required >
										<span class="error"> <?php echo $passwordErr;?></span>
									</div>							
									<div class="form-group login-page">
										<label for="exampleInputPassword2">Confirm Password <span>*</span></label>
										<input type="Password" name="conPass" class="form-control" id="exampleInputPassword2" required >
										<span class="error"> <?php echo $confirmErr;?></span>
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

