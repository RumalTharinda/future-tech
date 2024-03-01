
<?php
session_start();
include '../System/function.php';
include '../System/config.php';
extract($_GET);
extract($_POST);
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
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

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
                            <h2>Shop</h2>
                            <div class="breadcrumb__option">
                                <a href="index.php">Home</a>
                                <span>Shop</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->





        <!-- Product Section Begin -->
        <section class="product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="sidebar">
                            <div class="sidebar__item">
                                <h4>Available Brands</h4>
                                <ul>

                                    <?php
                                    $db = dbconn();

                                    $sql = "SELECT brand_name, brand_id FROM tbl_brands ORDER BY brand_name ASC";
                                    $result = $db->query($sql);

                                    if ($result->num_rows > 0) {
                                        $i = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            ?>



                                            <li><a href="shop.php?brand_id=<?= $row['brand_id'] ?>"><?= $row['brand_name'] ?></a></li>




                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>


                            </div>




                            


                            <div class="sidebar__item">
                                <div class="latest-product__text">
                                    <h4>Latest Products</h4>



                                    <div class="latest-product__slider owl-carousel">
                                        <div class="latest-prdouct__slider__item">



                                            <h5>Latest Graphics Cards</h5>

                                            <!-- Latest Graphics Cards  product  -->

                                            <?php
                                            $db = dbconn();
                                            $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id WHERE tbl_stock.stock_purchase_date > DATE_ADD(NOW(), INTERVAL -25 DAY) AND tbl_product.product_categories = '14'";

                                            $resultgc = $db->query($sql);

                                            if ($resultgc->num_rows > 0) {
                                                $i = 1;
                                                while ($rowgc = $resultgc->fetch_assoc()) {

                                                    $DiscountPrice = $rowgc['stock_sale_price'] * (1 - $rowgc['stock_discount'] / 100);
                                                    ?>


                                                    <a href="product_details.php?stock_id=<?= $rowgc['stock_id'] ?>" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img  src="../System/product/img/<?= $rowgc['product_img'] ?>" alt="">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6><?= $rowgc['product_name'] ?></h6>

                                                            <span>Rs:<?= number_format($DiscountPrice, 2) ?></span>
                                                        </div>
                                                    </a>

                                                    <?php
                                                }
                                            }
                                            ?>

                                            <!-- End Latest Processors all product  -->


                                        </div>
                                        <div class="latest-prdouct__slider__item">
                                            <h5>Latest Processors</h5>

                                            <!-- Latest Latest Processors  product  -->

                                            <?php
                                            $db = dbconn();
                                            $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id WHERE tbl_stock.stock_purchase_date > DATE_ADD(NOW(), INTERVAL -25 DAY) AND tbl_product.product_categories = '11'";

                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {
                                                $i = 1;
                                                while ($row = $result->fetch_assoc()) {

                                                    $DiscountPrice = $row['stock_sale_price'] * (1 - $row['stock_discount'] / 100);
                                                    ?>


                                                    <a href="product_details.php?stock_id=<?= $row['stock_id'] ?>" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img width="75" src="../System/product/img/<?= $row['product_img'] ?>" alt="">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6><?= $row['product_name'] ?></h6>

                                                            <span>Rs:<?= number_format($DiscountPrice, 2) ?></span>

                                                        </div>
                                                    </a>

                                                    <?php
                                                }
                                            }
                                            ?>

                                            <!-- End Latest Graphics Cards all product  -->

                                        </div>
                                        <div class="latest-prdouct__slider__item">
                                            <h5>Latest Laptop</h5>

                                            <!-- Latest Laptop  product  -->

                                            <?php
                                            $db = dbconn();
                                            $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id WHERE tbl_stock.stock_purchase_date > DATE_ADD(NOW(), INTERVAL -25 DAY) AND tbl_product.product_categories = '2'";

                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {
                                                $i = 1;
                                                while ($row = $result->fetch_assoc()) {

                                                    $DiscountPrice = $row['stock_sale_price'] * (1 - $row['stock_discount'] / 100);
                                                    ?>


                                                    <a href="product_details.php?stock_id=<?= $row['stock_id'] ?>" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img width="75" src="../System/product/img/<?= $row['product_img'] ?>" alt="">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6><?= $row['product_name'] ?></h6>
                                                            <span>Rs:<?= number_format($DiscountPrice, 2) ?></span>
                                                        </div>
                                                    </a>

                                                    <?php
                                                }
                                            }
                                            ?>

                                            <!-- End Latest Laptop  product  -->


                                        </div>
                                        <div class="latest-prdouct__slider__item">
                                            <h5>Latest Destop</h5>

                                            <!-- Latest Destop  product  -->

                                            <?php
                                            $db = dbconn();
                                            $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id WHERE tbl_stock.stock_purchase_date > DATE_ADD(NOW(), INTERVAL -25 DAY) AND tbl_product.product_categories = '1'";

                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {
                                                $i = 1;
                                                while ($row = $result->fetch_assoc()) {

                                                    $DiscountPrice = $row['stock_sale_price'] * (1 - $row['stock_discount'] / 100);
                                                    ?>


                                                    <a href="product_details.php?stock_id=<?= $row['stock_id'] ?>" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img width="75" src="../System/product/img/<?= $row['product_img'] ?>" alt="">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6><?= $row['product_name'] ?></h6>
                                                            <span>Rs:<?= number_format($DiscountPrice, 2) ?></span>

                                                        </div>
                                                    </a>

                                                    <?php
                                                }
                                            }
                                            ?>

                                            <!-- End Latest Desktop all product  -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7">
                        <div class="product__discount">
                            <div class="section-title product__discount__title">
                                <h2>Sale Off</h2>
                            </div>
                            <div class="row">
                                <div class="product__discount__slider owl-carousel">

                                    <!-- Sale Off all product  -->

                                    <?php
                                    $where = null;
                                    if (!empty(@$brand_id)) {
                                        $where = " AND tbl_product.product_brand='$brand_id'";
                                    }

                                    if (!empty(@$categories_id)) {
                                        $where = " AND tbl_categories.categories_id='$categories_id'";
                                    }

                                    if (!empty(@$product_name)) {
                                        $where = " AND tbl_product.product_name like '%$product_name%'";
                                    }

                                    $db = dbconn();
                                    $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id LEFT JOIN tbl_categories ON tbl_categories.categories_id=tbl_product.product_categories WHERE tbl_stock.stock_discount > '0' $where";

                                    $result = $db->query($sql);

                                    if ($result->num_rows > 0) {
                                        $i = 1;
                                        while ($row = $result->fetch_assoc()) {

                                            $DiscountPrice = $row['stock_sale_price'] * (1 - $row['stock_discount'] / 100);
                                            ?>



                                            <div class="col-lg-4">
                                                <div class="product__discount__item">
                                                    <div class="product__discount__item__pic set-bg"
                                                         data-setbg="../System/Product/img/<?= $row['product_img'] ?>">
                                                        <div class="product__discount__percent">-<?= $row['stock_discount'] ?>%</div>
                                                        <ul class="product__item__pic__hover">
                                                           
                                                            <li><a href="product_details.php?stock_id=<?= $row['stock_id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product__discount__item__text">
                                                        <span>Only <?= $row['stock_quantity'] ?> left in stock</span>
                                                        <h5><a href="product_details.php?stock_id=<?= $row['stock_id'] ?>"><?= $row['product_name'] ?></a></h5>
                                                        <div class="product__item__price">Rs:<?= number_format($DiscountPrice, 2) ?><span>Rs:<?= number_format($row['stock_sale_price']) ?></span></div>
                                                    </div>                                                                                
                                                </div>
                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>



                                    <!-- Sale Off all product  -->

                                </div>
                            </div>
                        </div>
                        <div class="filter__item">
                            <div class="row">
                                <div class="col-lg-4 col-md-5">
                                    
                                </div>

                                <?php
                                $db = dbconn();
                                $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id LEFT JOIN tbl_categories ON tbl_categories.categories_id=tbl_product.product_categories $where";
                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    $i = 1;
                                    $count = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $count++;
                                    }
                                }
                                ?>



                                <div class="col-lg-4 col-md-4">
                                    <div class="filter__found">
                                        <h6><span><?php echo $count; ?></span> Products found</h6>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">


                            <!-- Adding all product  -->


                            <?php
                            $where = null;
                            if (!empty(@$brand_id)) {
                                $where = " WHERE tbl_product.product_brand='$brand_id'";
                            }

                            if (!empty(@$categories_id)) {
                                $where = " WHERE tbl_categories.categories_id='$categories_id'";
                            }

                            if (!empty(@$product_name)) {
                                $where = " WHERE tbl_product.product_name like '%$product_name%'";
                            }






                            $db = dbconn();
                            $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id LEFT JOIN tbl_categories ON tbl_categories.categories_id=tbl_product.product_categories $where";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                $i = 1;

                                while ($row = $result->fetch_assoc()) {

                                    $DiscountPrice = $row['stock_sale_price'] * (1 - $row['stock_discount'] / 100);
                                    ?>


                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="../System/Product/img/<?= $row['product_img'] ?>">
                                                <ul class="product__item__pic__hover">
                                                    
                                                    <li><a href="product_details.php?stock_id=<?= $row['stock_id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6><a href="product_details.php?stock_id=<?= $row['stock_id'] ?>"><?= $row['product_name'] ?></a></h6>
                                                <h5>Rs:<?= number_format($DiscountPrice, 2) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>


                            <!-- End Adding all product  -->


                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Product Section End -->




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