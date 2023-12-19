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
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
		<!-- header-start -->
		<?php include('../../partials/header.php'); ?>
		<!-- mainmenu-area-end -->
		<!-- page-title-wrapper-start -->
		
		<!-- page-title-wrapper-end -->
		<!-- contuct-form-area-start -->
        <div class="login-area ptb-80">
            <div class="container">
                <div class="container">
                    <div  class="col-sm-12">
                        <h3>Edit Password</h3>
                        <hr/>
                        <div class="col-sm-9">
                            <div class="tab-pane" id="chnage_passwrd">
                                <form method="POST">
                                    <div class="form-group login-page">
                                        <label for="">Old Password<span>*</span></label>
                                        <input type="password" name="old_Password" class="form-control" id="">
                                    </div>
                                    <div class="form-group login-page">
                                        <label for="">New Password<span>*</span></label>
                                        <input type="password" name="Password" class="form-control" id="">
                                    </div>
                                                                    
                                    <div class="form-group login-page">
                                        <label for="">Confirm Password<span>*</span></label>
                                        <input type="password" name="con_Password" class="form-control" id="">
                                    </div>								
                                    
                                    <button type="submit"  name="changePasswordSubmit"  class="btn btn-default login-btn">Submit</button>
                                </form>	       
                                    <?php
                                        
                                        
                                        //session_start();
                                        if(isset($_POST["changePasswordSubmit"])){

                                            $Password=$_POST["Password"];
                                            $oldPass=$_POST["old_Password"];
                                            $conPass= $_POST["con_Password"];

                                            if($conPass===$Password){
                                            $controller->EditPW($oldPass,$Password,$_SESSION['UserID']);
                                            }else{
                                                echo "Confirm Password isn't match Password <br>" ;
                                            }

                                        }
                                    ?>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
            
		<!-- contuct-form-area-end -->
		<!-- contact-area-start -->
    	<?php include('../../partials/footer.php'); ?>
		<!-- .copyright-area-end -->
		
		
        
        
    </body>
</html>


