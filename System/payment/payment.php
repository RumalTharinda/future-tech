<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Payment</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Payment</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <?php
            $db = dbconn();
            $sqlp = "SELECT * FROM tbl_oder LEFT JOIN tbl_biling ON tbl_biling.oder_id=tbl_oder.order_id LEFT JOIN tbl_order_item ON tbl_order_item.oder_id=tbl_oder.order_id LEFT JOIN shipping ON shipping.oder_id=tbl_oder.order_id LEFT JOIN tbl_product ON tbl_product.product_id=tbl_order_item.product_id LEFT JOIN tbl_stock ON tbl_stock.stock_id=tbl_order_item.stock_id WHERE tbl_oder.order_id='$order_id'";
            $resultp = $db->query($sqlp);
            $rowp = $resultp->fetch_assoc();
            
            ?> 
    
    

    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'approved') {
        $db = dbconn();
        
        $sql = "UPDATE tbl_oder SET order_status='paid' WHERE order_id='$order_id'";
        $db->query($sql);
        
        $payamount=$biling_total_amount;
        $paydate=date('Y-m-d');
        $sqlpay = "INSERT INTO tbl_payment(order_id,payment_date,payment_amount)VALUES('$order_id','$paydate','$payamount')";
        $db->query($sqlpay);

        header('Location:manage.php');
    }
    ?>

    <div class="card">
        

        <section class="section">


            

            <section class="section">
                <div class="card">
                    <div class="card-body">

                        <h3 class="card-header"> Billing Name:<?= $rowp['biling_title'] ?>  <?= $rowp['biling_persons_first_name'] ?>  <?= $rowp['biling_persons_last_name'] ?> </h3>
                        <h3 class="card-header"> Shipping Address:<?= $rowp['shipping_address_line1'] ?><?= $rowp['shipping_address_line2'] ?><?= $rowp['shipping_address_line3'] ?> </h3>
                        <h3 class="card-header"> Billing Total Rs:<?= number_format($rowp['biling_total_amount']) ?></h3>
                        <h3 class="card-header"> Order status:<?= $rowp['order_status'] ?></h3>

                    </div>

                </div>





            </section>

            <section>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment</h5> 

                        <div class="d-grid gap-2 col-6 mx-auto">

                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                                <input type="hidden" name="order_id" value="<?= $order_id ?>"> 
                                <input type="hidden" name="biling_total_amount" value="<?= $rowp['biling_total_amount'] ?>">
                                <button class="btn btn-primary btn-block col-12" type="submit" name="action" value="approved">Paid <span class="bi bi-coin"></span></button>
                            </form>




                        </div>




                    </div>
                </div>
            </section>
    </div>

</main>

<?php
include '../footer.php';
ob_end_flush();
?>
