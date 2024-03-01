<?php
session_start();
include '../system/function.php';
?>

<!DOCTYPE html>
<html lang="zxx">
      <head>
        <meta charset="UTF-8">
        <meta name="description" content="Ogani Template">
        <meta name="keywords" content="Ogani, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Shop - Future-Tech | Official Online Store</title>
        <link rel="icon" type="image/x-icon" href="img\images.jpg">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>

    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Humberger Begin -->
        <div class="humberger__menu__overlay"></div>
        <div class="humberger__menu__wrapper">
            <div class="humberger__menu__logo">
                <a href="index.php"><img src="img/logo.png" alt=""></a>
            </div>


            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $discount = ($value['product_price'] * $value['product_qty']) * ($value['product_discount'] / 100);
                ?>

                <div class="humberger__menu__cart">
                    <ul>

                        <li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>Rs:<?= number_format($total) ?></span></div>
                </div>

                <?php
                $total += $value['product_price'] * $value['product_qty'] - $discount;
            }
            ?>


            <div class="humberger__menu__widget">
                <div class="header__top__right__language">
                    <img src="img/language.png" alt="">
                    <div><i class="fa fa-cog fa-spin"></i>  Settings</div>
                    <span class="arrow_carrot-down"></span>
                    <ul>
                        <li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                        <li><a href="register.php"><i class="fa fa-user"></i> Register</a></li>
                    </ul>
                </div>

            </div>
            <nav class="humberger__menu__nav mobile-menu">
                <ul>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="#">Pages</a>
                        <ul class="header__menu__dropdown">

                            <li><a href="cart.php">Shoping Cart</a></li>
                            <li><a href="checkout">Check Out</a></li>

                        </ul>
                    </li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
            <div class="header__top__right__social">
                <a href="https://web.facebook.com/groups/434557290530740"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-pinterest-p"></i></a>
            </div>
            <div class="humberger__menu__contact">
                <ul>
                    <li><i class="fa fa-envelope"></i> future.tech.colombo@gmail.com</li>
                    <li>Free Shipping for all Order of Rs:500000</li>
                </ul>
            </div>
        </div>
        <!-- Humberger End -->

        <!-- Header Section Begin -->
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="header__top__left">
                                <ul>
                                    <li><i class="fa fa-envelope"></i> future.tech.colombo@gmail.com</li>
                                    <li>Free Shipping for all Order of Rs:500000</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a href="https://web.facebook.com/groups/434557290530740"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                </div>
                                <div class="header__top__right__language">
                                    <img src="img/flag.png" alt="">
                                    <div><i class="fa fa-cog fa-spin"></i>  Settings</div>
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <li><a href="login.php"><i class="fa fa-sign-in"></i> Login</a></li>
                                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                                        <li><a href="register.php"><i class="fa fa-id-card"></i> Register</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header__logo">
                            <a href="index.php"><img src="img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li class="active"><a href="shop.php">Shop</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="header__menu__dropdown">

                                        <li><a href="cart.php">Shoping Cart</a></li>
                                        <li><a href="checkout.php">Check Out</a></li>

                                    </ul>
                                </li>
                                <li><a href="blog.php">Blog</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </nav>
                    </div>




                    <div class="humberger__menu__cart">


                        <ul>
                            
                            <li><a href="cart.php" style="color: black"><i class="fa fa-shopping-bag"></i> <span>_</span></a></li>
                        </ul>
                        
                         </div>


                        <?php
                        $total = 0;
                         if(isset($_SESSION['cart'])){
                        foreach ($_SESSION['cart'] as $key => $value) {

                            $discount = ($value['product_price'] * $value['product_qty']) * ($value['product_discount'] / 100);
                            $total += $value['product_price'] * $value['product_qty'] - $discount;
                             }
                         }
                            ?>

                            
                            <div class="header__cart__price">item: <span>Rs:<?= number_format($total) ?></span></div>

                            <?php
                       
                        ?>





                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Hero Section Begin -->
        <section class="hero hero-normal">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="hero__categories">
                            <div class="hero__categories__all">
                                <i class="fa fa-bars"></i>
                                <span>All Categories</span>
                            </div>
                            <ul>
                                <?php
                                $db = dbconn();

                                $sql = "SELECT * FROM tbl_categories ORDER BY categories_name ASC";
                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        ?>



                                        <li><a href="shop.php?categories_id=<?= $row['categories_id'] ?>"><?= $row['categories_name'] ?></a></li>





                                        <?php
                                    }
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="hero__search">
                            <div class="hero__search__form">
                                <form action="shop.php" method="post">
                                    
                                    <input type="text" name="product_name" placeholder="What do yo u need?">
                                    <button type="submit" class="site-btn">SEARCH</button>
                                </form>
                            </div>
                            <div class="hero__search__phone">
                                <div class="hero__search__phone__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hero__search__phone__text">
                                    <h5>0115587630</h5>
                                    <span>support 24/7 time</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->





        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section set-bg" data-setbg="img/lineimg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>Customer Register</h2>
                            <div class="breadcrumb__option">
                                <a href="index.php">Home</a>
                                <span>Register</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->





        <!-- Checkout Section Begin -->
        <section class="checkout spad">
            <div class="container">
                <div class="row">

                    <div class="checkout__form">
                        <h4>Personal Details</h4>

                        <?php
                        $FirstName = '';
                        $LastName = '';
                        $Email = '';
                        $AddressLine1 = '';
                        $AddressLine2 = '';
                        $AddressLine3 = '';
                        $Phone = '';
                        $Mobile = '';

                        $UserName = '';
                        $Password = '';

                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            $FirstName = dataclean($FirstName);
                            $LastName = dataclean($LastName);
                            $Email = dataclean($Email);
                            $AddressLine1 = dataclean($AddressLine1);
                            $AddressLine2 = dataclean($AddressLine2);
                            $AddressLine3 = dataclean($AddressLine3);
                            $Phone = dataclean($Phone);
                            $Mobile = dataclean($Mobile);

                            $UserName = dataclean($UserName);
                            $Password = dataclean($Password);

                            $message = array();

                            if (empty($FirstName)) {
                                $message['err_Fname'] = "The Frist Name should not be blank...!";
                            }
                            if (empty($LastName)) {
                                $message['err_Lname'] = "The Last Name should not be blank...!";
                            }
                            if (empty($Email)) {
                                $message['err_email'] = "The Email should not be blank...!";
                            }
                            if (empty($AddressLine1)) {
                                $message['err_AddLine1'] = "The Address Line 1 should not be blank...!";
                            }
                            if (empty($AddressLine2)) {
                                $message['err_AddLine2'] = "The Address Line 2 should not be blank...!";
                            }
                            if (empty($AddressLine3)) {
                                $message['err_AddLine3'] = "The Address Line 3 should not be blank...!";
                            }
                            if (empty($Phone)) {
                                $message['err_phone'] = "The Phone number should not be blank...!";
                            }
                            if (empty($Mobile)) {
                                $message['err_mobile'] = "The Mobile number should not be blank...!";
                            }

                            if (empty($UserName)) {
                                $message['err_username'] = "The User Name should not be blank...!";
                            }
                            if (empty($Password)) {
                                $message['err_password'] = "The Password should not be blank...!";
                            }
                             if (empty($termsAndConditions)) {
                                $message['err_termsAndConditions'] = "The termsAndConditions should be agreed...!";
                            }

                            if (!empty($Email)) {
                                if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                                    $message['err_email'] = "Invailed Email...!";
                                } else {
                                    $db = dbconn();
                                    $sql = "SELECT * FROM tbl_customer WHERE customer_email='$Email'";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        $message['err_email'] = "The Email Already exist...!";
                                    }
                                }
                            }

                            if (!empty($UserName)) {

                                $db = dbconn();
                                $sql = "SELECT * FROM tbl_users WHERE user_name='$UserName'";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    $message['err_username'] = "The User Name Already exist...!";
                                }
                            }

                            if (!empty($Password)) {
                                $valid = validatePasswordStrength($Password);
                                if (!$valid) {
                                    $message['err_password'] = "Invalid Password...!";
                                }
                            }

                            if (!empty($Mobile)) {
                                $valid = validateNumber($Mobile);
                                if (!$valid) {
                                    $message['err_mobile'] = "Invalid Mobile Number...!";
                                }
                            }

                            if (!empty($Phone)) {
                                $valid = validateNumber($Phone);
                                if (!$valid) {
                                    $message['err_phone'] = "Invalid Phone Number...!";
                                }
                            }



                            if (empty($message))  {
                                $Password = sha1($Password); //increption algo//
                                $Cdate=date('Y-m-d');
                                $db = dbconn();
                                $sql = "INSERT INTO tbl_users(user_name,user_password,user_status) VALUES('$UserName','$Password','1')";
                                $db->query($sql);
                                $userid = $db->insert_id;
                                $sql = "INSERT INTO tbl_customer(user_id,customer_first_name,customer_last_name,customer_title,customer_address_line1,customer_address_line2,customer_address_line3,customer_mobile,customer_phone,customer_email,add_date) VALUES('$userid','$FirstName','$LastName','$Title','$AddressLine1','$AddressLine2','$AddressLine3','$Mobile','$Phone','$Email','$Cdate')";
                                $db->query($sql);

                                // Display successfully added! message //
                                echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New Customer successfully added!</div>  </div></div><div></div></div>';

                                $FirstName = '';
                                $LastName = '';
                                $Email = '';
                                $AddressLine1 = '';
                                $AddressLine2 = '';
                                $AddressLine3 = '';
                                $Phone = '';
                                $Mobile = '';

                                $UserName = '';
                                $Password = '';
                            }
                        }
                        ?>
 
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate >
                            <div class="row">

                                <div class="col-lg-8 col-md-6">


                                    <div class="checkout__input">
                                        <p>Title<span>*</span></p>
                                        <label for="inputState" class="form-label"></label>
                                        <select id="Title" class="form-select" name="Title" >
                                            <option value="">--</option>
                                            <option value="Mr." <?php
                                            if (@$Title == 'available') {
                                                echo 'selected';
                                            }
                                            ?>>Mr.</option>
                                            <option value="Mis." <?php
                                            if (@$Title == 'Mis.') {
                                                echo 'selected';
                                            }
                                            ?>>Mis.</option>
                                            <option value="Miss." <?php
                                            if (@$Title == 'Miss.') {
                                                echo 'selected';
                                            }
                                            ?>>Miss.</option>
                                            <option value="Dr." <?php
                                            if (@$Title == 'Dr.') {
                                                echo 'selected';
                                            }
                                            ?>>Dr.</option>
                                            <option value="Prof." <?php
                                            if (@$Title == 'Prof.') {
                                                echo 'selected';
                                            }
                                            ?>>Prof.</option>



                                        </select>
                                    </div>



                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?= @$FirstName ?>">
                                        <div class="text-danger"><?= @$message['err_Fname'] ?></div>  <!-- error message -->
                                    </div>



                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" class="form-control" id="LastName" name="LastName" value="<?= @$LastName ?>">
                                        <div class="text-danger"><?= @$message['err_Lname'] ?></div>  <!-- error message -->
                                    </div>



                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" class="form-control" id="Email" name="Email" value="<?= @$Email ?>">
                                        <div class="text-danger"><?= @$message['err_email'] ?></div>  <!-- error message -->
                                    </div>

                                    <div class="checkout__input">
                                        <p>Address<span>*</span></p>
                                        <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" placeholder="Line1" value="<?= @$AddressLine1 ?>">
                                        <div class="text-danger"><?= @$message['err_AddLine1'] ?></div>  <!-- error message -->
                                        <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" placeholder="Line2" value="<?= @$AddressLine2 ?>">
                                        <div class="text-danger"><?= @$message['err_AddLine2'] ?></div>  <!-- error message -->

                                        <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" placeholder="Line3" value="<?= @$AddressLine3 ?>">
                                        <div class="text-danger"><?= @$message['err_AddLine3'] ?></div>  <!-- error message -->
                                    </div>

                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" class="form-control" id="Phone" name="Phone" value="<?= @$Phone ?>">
                                        <div class="text-danger"><?= @$message['err_phone'] ?></div>  <!-- error message -->
                                    </div>

                                    <div class="checkout__input">
                                        <p>Mobile<span>*</span></p>
                                        <input type="text" class="form-control" id="Mobile" name="Mobile" value="<?= @$Mobile ?>">
                                        <div class="text-danger"><?= @$message['err_mobile'] ?></div>  <!-- error message -->
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>User Name<span>*</span></p>
                                                <input type="text" class="form-control" id="UserName" name="UserName" value="<?= @$UserName ?>">
                                                <div class="text-danger"><?= @$message['err_username'] ?></div>  <!-- error message -->
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p>Password<span>*</span></p>
                                                <input type="password" class="form-control" id="Password" name="Password" value="<?= @$Password ?>">
                                                <div class="text-danger"><?= @$message['err_password'] ?></div>  <!-- error message -->
                                            </div>
                                        </div>
                                    </div>





                                    <div class="checkout__input__checkbox">
                                        <label for="termsAndConditions">
                                            Terms and Conditions                                            
                                            <input type="checkbox" name="termsAndConditions" id="termsAndConditions">
                                            <div class="text-danger"><?= @$message['err_termsAndConditions'] ?></div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>



                                    <p>Terms of service are the legal agreements between a service provider and a person who wants to use that service. The person must agree to abide by the terms of service in order to use the offered service.</p>

                                </div>
                                <div class="col-lg-4 col-md-6">

                                </div>
                            </div>

                            <div class="site-btn">
                                <button type="submit" class="site-btn">Submit</button>


                            </div>
                        </form>
                    </div>
                </div>
        </section>
        <!-- Checkout Section End -->



       <!-- Footer Section Begin -->
        <footer class="footer spad">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-12 col-sm-6">
                        <div class="footer__about">
                            <div class="footer__about__logo">
                                <a href="./index.html"><img src="img/logo.png" alt=""></a>
                            </div>
                            <ul>
                                <li>Address:128 Dr NM Perera Mawatha Rd,Colombo 08</li>
                                <li>Phone: 0115587630</li>
                                <li>Email: future.tech.colombo@gmail.com</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                        <div class="footer__widget">
                            <h6>Useful Links</h6>
                            <ul>
                                <li><a href="about_us.php">About Us</a></li>
                                <li><a href="about_our_shop.php">About Our Shop</a></li>
                                <li><a href="secure_shipping.php">Secure Shopping</a></li>
                                <li><a href="privacy_policy.php">Privacy Policy</a></li>

                            </ul>
                            <ul>
                                <li><a href="who_we_are.php">Who We Are</a></li>
                                <li><a href="our_service.php">Our Services</a></li>
                                <li><a href="delivery_info.php">Delivery infomation</a></li>
                                <li><a href="contact.php">Contact</a></li>


                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer__widget">

                            <div class="footer__widget__social">
                                <a href="https://web.facebook.com/groups/434557290530740"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer__copyright">
                            <div class="footer__copyright__text"><p>
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |  by <a href="about_us.php" target="_blank" style="color: black">Future-tech</a>
                                </p></div>
                            <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->
        
        
        
        
        <!-- Js Plugins -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>



    </body>

</html>