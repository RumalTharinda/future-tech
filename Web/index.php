
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
        <title>Future-Tech | Official Online Store</title>
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
                <a href="#"><img src="img/logo.png" alt=""></a>
            </div>
            <div class="humberger__menu__cart">
                <ul>
                    <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                    <li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                </ul>
                <div class="header__cart__price">item: <span>$150.00</span></div>
            </div>
            <div class="humberger__menu__widget">
                <div class="header__top__right__language">
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
                            <li><a href="checkout.php">Check Out</a></li>

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
                    <li><i class="fa fa-envelope"></i>future.tech.colombo@gmail.com</li>
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
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__left">
                                <ul>
                                    <li><i class="fa fa-envelope"></i> future.tech.colombo@gmail.com</li>
                                    <li>Free Shipping for all Order of Rs:500000</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
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
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="shop.php">Shop</a></li>
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
                    <div class="col-lg-3">
                        <div class="header__cart">
                            <ul>
                                <li><a href="cart.php" style="color: black"><i class="fa fa-shopping-bag"></i> <span></span></a></li>
                            </ul>
                            
                            
                            
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
                    </div>
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Hero Section Begin -->
        <section class="hero">
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



                        <!-- home imgs -->
                        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-interval="10000">
                                    <img src="img\homeImg\homeImg1.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item" data-interval="2000">
                                    <img src="img\homeImg\homeImg2.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item" data-interval="2000">
                                    <img src="img\homeImg\homeLogo3.png" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleInterval" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-target="#carouselExampleInterval" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                        <!-- HOME IMGS END -->





                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->




        <!-- Categories Section Begin -->
        <section class="categories">
            <div class="container">
                <div class="row">
                    <div class="categories__slider owl-carousel">

                        <?php
                        $db = dbconn();

                        $sql = "SELECT brand_name,brand_id,brand_img FROM tbl_brands ORDER BY brand_name ASC";
                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>


                                <div class="col-lg-3">
                                    <div class="categories__item set-bg" data-setbg="../System/Brands/img/<?= $row['brand_img'] ?>">
                                        <h5><a href="shop.php?brand_id=<?= $row['brand_id'] ?>"><?= $row['brand_name'] ?></a></h5>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                        ?>



                    </div>
                </div>
            </div>
        </section>
        <!-- Categories Section End -->






        <!-- Featured Section Begin -->
        <section class="featured spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Featured Product</h2>
                        </div>
                        <div class="featured__controls">
                            <ul>
                                <li><a style="color: black;" href="index.php">All</a></li>
                                <?php
                                $db = dbconn();

                                $sql = "SELECT * FROM tbl_categories ORDER BY categories_name ASC";
                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        ?>



                                        <li><a style="color: black;" href="index.php?categories_id=<?= $row['categories_id'] ?>"><?= $row['categories_name'] ?></a></li>





                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row featured__filter">

                    <?php
                    $where = null;

                    if (!empty(@$categories_id)) {
                        $where = " AND tbl_categories.categories_id='$categories_id'";
                    }



                    $db = dbconn();
                    $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id LEFT JOIN tbl_categories ON tbl_categories.categories_id=tbl_product.product_categories WHERE product_featured_product='Featured' $where";
                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {

                            $DiscountPrice = $row['stock_sale_price'] * (1 - $row['stock_discount'] / 100);
                            ?>



                            <div class="col-lg-3 col-md-3 col-sm-6 mix oranges fresh-meat">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="../System/Product/img/<?= $row['product_img'] ?>">
                                        <ul class="featured__item__pic__hover">
                                            
                                            <li><a href="product_details.php?stock_id=<?= $row['stock_id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="featured__item__text">
                                        <h6><a href="product_details.php?stock_id=<?= $row['stock_id'] ?>"><?= $row['product_name'] ?></a></h6>
                                        <h5>Rs:<?= number_format($DiscountPrice, 2) ?></h5>
                                    </div>
                                </div>
                            </div>




                            <?php
                        }
                    } else {
                        echo '<p>No records found.</p>';
                    }
                    ?>


                </div>
            </div>
        </section>
        <!-- Featured Section End -->

        <!-- Banner Begin -->
        <div class="banner">
            <div class="container">
                <div class="row">

                    <!-- Banner Begin  -->

                    <?php
                    $db = dbconn();
                    $sql = "SELECT * FROM tbl_banner";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>


                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="banner__pic">
                                    <img src="../System/banner/img/<?= $row['img_file'] ?>" alt="">
                                </div>
                            </div>


                            <?php
                        }
                    }
                    ?>







                </div>
            </div>
        </div>
        <!-- Banner End -->

        <!-- Latest Product Section Begin -->
        
        <!-- Latest Product Section End -->

        <!-- Blog Section Begin -->
        <section class="from-blog spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title from-blog__title">
                            <h2>From The Latest Blog</h2>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- Latest Blog  -->

                    <?php
                    $db = dbconn();
                    $sql = "SELECT * FROM tbl_blog LEFT JOIN tbl_product ON tbl_product.product_id=tbl_blog.product_id WHERE tbl_blog.blog_add_date > DATE_ADD(NOW(), INTERVAL -25 DAY)";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>



                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img width="75" src="../System/Product/img/<?= $row['product_img'] ?>" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i><?= $row['blog_add_date'] ?></li>
                                            
                                        </ul>
                                        <h5><a href="blog_details.php?product_id=<?= $row['product_id'] ?>"><?= $row['product_name'] ?></a></h5>
                                        <p><?= $row['product_description'] ?></p>

                                        <a href="blog_details.php?product_id=<?= $row['product_id'] ?>" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>


                            <?php
                        }
                    }
                    ?>








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