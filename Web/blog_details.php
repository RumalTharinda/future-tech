
<?php
session_start();
include '../System/function.php';
include '../System/config.php';
extract($_GET);
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


    <!--                                     Head Section End                                             -->
    
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/lineimg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog Details</h2>
                        <div class="breadcrumb__option">
                            <a href="blog.php">Blog</a>
                            <span>Blog Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    
    
    
    
    
    
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                
                
                
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        
                        
                        
                          <?php
                            $db = dbconn();
                            $sql = "SELECT * FROM tbl_blog LEFT JOIN tbl_product ON tbl_product.product_id=tbl_blog.product_id WHERE tbl_blog.product_id ='$product_id'";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {

                                   
                                    ?>
                        
   
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="../System/blog/img/<?= $row['blog_file'] ?>" alt="<?= $row['product_name'] ?>">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i><?= $row['blog_add_date'] ?></li>
                                        
                                    </ul>
                                    <h5><a href="#"><?= $row['product_name'] ?></a></h5>
                                    
                                    <p><?php echo nl2br($row['blog_blog']); ?></p>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <?php
                                }
                            }
                            ?>
                        
                        
                        
                        
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

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