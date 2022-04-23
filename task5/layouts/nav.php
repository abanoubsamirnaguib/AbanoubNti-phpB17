<!-- header start -->
<header class="header-area gray-bg clearfix">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="logo">
                        <a href="index.php">
                            <img alt="" src="assets/img/logo/logo.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-6">
                    <div class="header-bottom-right">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="top-hover"><a href="index.php">home</a>
                                    </li>
                                    <li><a href="shop.php">shop</a>
                                     
                                    </li>
                                    <li><a href="Last4Product.php?NumOfProd=4">last 4 Products</a></li>
                                    <li><a href="contact.php">contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-currency">
                            <?php
                            if (isset($_SESSION['user'])) { ?>
                                <span class="digit"><?= $_SESSION['user']->first_name ?> <i class="ti-angle-down"></i></span>
                                <div class="dollar-submenu">
                                    <ul>
                                        <li><a href="myAccount.php">My Account</a></li>
                                        <li><a href="../App/Http/Post/logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            <?php } else { ?>
                                <span class="digit">Welcome <i class="ti-angle-down"></i></span>
                                <div class="dollar-submenu">
                                    <ul>
                                        <li><a href="signin.php">Signin</a></li>
                                        <li><a href="signup.php">Signup</a></li>

                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="header-cart">
                            <a href="#">
                                <div class="cart-icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                            </a>
                            <div class="shopping-cart-content">
                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-1.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Phantom Remote </a></h4>
                                            <h6>Qty: 02</h6>
                                            <span>$260.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="ion ion-close"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Phantom Remote</a></h4>
                                            <h6>Qty: 02</h6>
                                            <span>$260.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="ion ion-close"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-total">
                                    <h4>Shipping : <span>$20.00</span></h4>
                                    <h4>Total : <span class="shop-total">$260.00</span></h4>
                                </div>
                                <div class="shopping-cart-btn">
                                    <a href="cart-page.php">view cart</a>
                                    <a href="checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="#">HOME</a>
                                <ul>
                                    <li><a href="index.php">home version 1</a></li>
                                    <li><a href="index-2.php">home version 2</a></li>
                                </ul>
                            </li>
                            <li><a href="#">pages</a>
                                <ul>
                                    <li><a href="about-us.php">about us </a></li>
                                    <li><a href="shop.php">shop Grid</a></li>
                                    <li><a href="shop-list.php">shop list</a></li>
                                    <li><a href="product-details.php">product details</a></li>
                                    <li><a href="cart-page.php">cart page</a></li>
                                    <li><a href="checkout.php">checkout</a></li>
                                    <li><a href="wishlist.php">wishlist</a></li>
                                    <li><a href="my-account.php">my account</a></li>
                                    <li><a href="login-register.php">login / register</a></li>
                                    <li><a href="contact.php">contact</a></li>
                                </ul>
                            </li>
                            <li><a href="shop.php"> Shop </a>
                         
                            </li>
                            <li><a href="#">BLOG</a>
                       
                            </li>
                            <li><a href="contact.php"> Contact us </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->