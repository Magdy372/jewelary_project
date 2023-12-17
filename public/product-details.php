
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Product Details</title>
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
        <!-- meanmenu css -->
        <link rel="stylesheet" href="../css/meanmenu.min.css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" href="../css/owl.carousel.css">
        <!-- nivo-slider css -->
        <link rel="stylesheet" href="../css/nivo-slider.css">  
        <!-- magnific-popup css -->
        <link rel="stylesheet" href="../css/magnific-popup.css">       
        <!--linearicons css -->
        <link rel="stylesheet" href="../css/linearicons-icon-font.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <!-- style css -->
        <link rel="stylesheet" href="../css/style.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="../css/responsive.css" />
        <!-- modernizr css -->
        <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
    <?php include('../partials/header.php'); 
if (isset($_GET['details_id'])) {
    $productID = $_GET['details_id'];
    $Productmodel = new Product($productID);



    if ($Productmodel) {
?>
    <div class="page-title-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-title">
                    <h3>Product Details </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-title-wrapper-end -->
<!-- all-hyperion-page-start -->
<div class="all-hyperion-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <!-- product-simple-area-start -->
                <div class="product-simple-area ptb-80">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <div class="tab-content">
                                <?php
                                $productImages = explode(',', $Productmodel->getProductPicture());
                                foreach ($productImages as $index => $image) {
                                ?>
                                    <div class="tab-pane<?php echo ($index === 0) ? ' active' : ''; ?>" id="view<?php echo $index + 1; ?>">
                                        <a class="image-link" href="../uploads/<?php echo $image; ?>"><img src="../uploads/<?php echo $image; ?>" alt=""></a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <!-- Nav tabs -->
                            <ul class="sinple-tab-menu" role="tablist">
                                <?php
                                foreach ($productImages as $index => $image) {
                                ?>
                                    <li class="<?php echo ($index === 0) ? 'active' : ''; ?>">
                                        <a href="#view<?php echo $index + 1; ?>" data-toggle="tab">
                                            <img style="width: 79px; height: 99px;" src="../uploads/<?php echo $image; ?>" alt="" />
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="product-simple-content">
                                <div class="sinple-c-title">
                                <h3><?php echo $Productmodel->getProductName(); ?></h3>

                                </div>
                                <div class="checkbox">
                                <span><i class="fa fa-check-square" aria-hidden="true"></i><?php echo ($Productmodel->getAvailability() ? 'In stock' : 'Out of stock'); ?></span>

                                </div>
                              	<?php
                             
                                $productTypeId = $Productmodel->getProductType();
$typeName = $Productmodel->getProductTypeName($productTypeId);

echo '<span style ="font-size: 30px;
    font-weight: 900;
    margin-bottom: 20px; color:black">' . $typeName . '</span>';
                               
                              ?>
                              
                              
								
                                <h4>EGP<?php echo  $Productmodel->getPrice(); ?></h4>
                                <button class="btn btn-lg btn-success" type="submit">
                                      
                                      <a class="add-cart-produt" href="cart.php?cart_id=<?= $productID ?>"><span class="lnr lnr-cart"></span> Add to Cart</a>
                            </button>

                                <br />
                                <br />
                                <div class="quick-add-to-cart">
                                    
                                        <button type="button" class="btn btn-lg btn-warning col-sm-12">
                                            <span class="lnr lnr-cart"></span>Buy Now
                                        </button>
                                    
									<div class="action-heiper">
											<!--<a href="#"><span class="lnr lnr-sync"></span></a>-->
											<a href="cart.php?cart_id=<?= $productID?>"><span class="lnr lnr-cart"></span></a>
											<a href="cart.php?wishlist_id=<?= $productID ?>"><span class="lnr lnr-heart"></span></a>

										</div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product-simple-area-end -->
            </div>
        </div>
    </div>
</div>

<!-- Tab panes -->
<div class="tab-content">
											<div class="tab-pane active" id="details">
												<div class="product-info-tab-content">
                                                <p>Elevate your style with our exquisite collection of jewelry. Embrace the elegance of finely crafted pieces that radiate sophistication and charm. Whether it's a special occasion or everyday beauty, our jewelry is designed to make you shine.</p>
                                                <ul>
                                                    <li>Stunning jewelry with intricate details.</li>
                                                    <li>Handpicked for your pleasure.</li>
                                                    <li>Customized pieces to match your unique style.</li>
                                                    <li>Precious gems and metals.</li>
                                                    <li>Carefully crafted for a lasting shine.</li>
                                                </ul>
    


												</div>
											</div>
                        <!-- Product Description Tab -->
                        <div class="product-info-detailed pb-80">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-info-tab">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="details">
                                                <div class="product-info-tab-content">
                                                    <p><?php echo $Productmodel->getDescription() ?></p>
                                                    <!-- Additional product details can be displayed here -->
                                                </div>
                                            </div>
                                            <!-- Add similar tab content for other product details as needed -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    } else {
        echo 'Product not found';
    }
} else {
    echo 'Product ID not provided';
}
?>

                                            
                                          
        <!-- all-hyperion-page-end -->
        <!-- Icons related start -->
        <section class="icon_section">
        <div class="container">
        <div class="row">
        <div class="col-md-3 col-sm-3">
        <h4 style="padding:5px 0;"><img src="../img/004-delivery-truck.png"></h4>
        <h5 style="padding:5px 0;">Free Home Delivery</h5>
        <p>Whatever you order, our products ship free. Always.</p>
        </div>
        
         <div class="col-md-3 col-sm-3"><h4 style="padding:5px 0;"><img src="../img/003-undo-button.png"></h4>
        <h5 style="padding:5px 0;">On-The-Spot Returns</h5>
        <p>Didn't like it? No problem. Return it on the spot at the time of delivery.</p></div>
         
          <div class="col-md-3 col-sm-3">
          <h4 style="padding:5px 0;"><img src="../img/002-cash-money.png"></h4>
        <h5 style="padding:5px 0;">C.O.D</h5>
        <p>You can pay by Cash or Card at the time of delivery.</p></div>
      
      
        </div>
        </div>
        </section>
         <!-- Icons related Ends -->
         
         
         
         
        
        <!-- contact-area-start -->
        <?php include('../partials/footer.php'); ?>
        
        <!-- all js here -->
        <!-- jquery latest version -->
        <script src="../js/vendor/jquery-1.12.0.min.js"></script>
        <!-- bootstra../p js -->
        <script src="../js/bootstrap.min.js"></script>
        <!-- owl.caro../usel js -->
        <script src="../js/owl.carousel.min.js"></script>
        <!-- meanmenu../ js -->
        <script src="../js/jquery.meanmenu.js"></script>
        <!-- jquery-u../i js -->
        <script src="../js/jquery-ui.min.js"></script>
        <!-- wow js -->
        <script src="../js/wow.min.js"></script>   
        <!-- nivo.sli../der js -->
        <script src="../js/jquery.nivo.slider.js"></script>        
        <!-- magnific../-popup js -->
        <script src="../js/jquery.magnific-popup.min.js"></script> 
        <!-- scrolly ../js -->
        <script src="../js/jquery.scrolly.js"></script>            
        <!-- plugins ../js -->
        <script src="../js/plugins.js"></script>
        <!-- main js ../-->
        <script src="../js/main.js"></script>
    </body>
</html>


