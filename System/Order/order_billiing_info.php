<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/Order/view.php">Order</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'approved') {
        $db = dbconn();
        $sql = "UPDATE tbl_oder SET order_status='approved' WHERE order_id='$order_id'";
        $db->query($sql);
        header('Location:view.php');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'reject') {
        $db = dbconn();
        $sql = "UPDATE tbl_oder SET order_status='reject' WHERE order_id='$order_id'";
        $db->query($sql);
        header('Location:view.php');
    }
    ?>

 <div class="card">
    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_oder LEFT JOIN tbl_biling ON tbl_biling.oder_id=tbl_oder.order_id LEFT JOIN tbl_order_item ON tbl_order_item.oder_id=tbl_oder.order_id LEFT JOIN shipping ON shipping.oder_id=tbl_oder.order_id LEFT JOIN tbl_product ON tbl_product.product_id=tbl_order_item.product_id LEFT JOIN tbl_stock ON tbl_stock.stock_id=tbl_order_item.stock_id WHERE tbl_oder.order_id='$order_id'";

    $result = $db->query($sql);
    ?>

    <section class="section">


        <?php
        $db = dbconn();
        $sqlp = "SELECT * FROM tbl_oder LEFT JOIN tbl_biling ON tbl_biling.oder_id=tbl_oder.order_id LEFT JOIN tbl_order_item ON tbl_order_item.oder_id=tbl_oder.order_id LEFT JOIN shipping ON shipping.oder_id=tbl_oder.order_id LEFT JOIN tbl_product ON tbl_product.product_id=tbl_order_item.product_id LEFT JOIN tbl_stock ON tbl_stock.stock_id=tbl_order_item.stock_id WHERE tbl_oder.order_id='$order_id'";
        $resultp = $db->query($sqlp);
        $rowp = $resultp->fetch_assoc();
        ?> 

        <section class="section">
            <div class="card">
                <div class="card-body">
                    
                    <h3 class="card-header"> Billing Name:<?= $rowp['biling_title'] ?>  <?= $rowp['biling_persons_first_name'] ?>  <?= $rowp['biling_persons_last_name'] ?> </h3>
                    <h3 class="card-header"> Shipping Address:<?= $rowp['shipping_address_line1'] ?><?= $rowp['shipping_address_line2'] ?><?= $rowp['shipping_address_line3'] ?> </h3>
                    <h3 class="card-header"> Billing Total:RS:<?= number_format($rowp['biling_total_amount']) ?></h3>
                    <h3 class="card-header"> Order status:<?= $rowp['order_status'] ?></h3>
                   
                </div>

            </div>



            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Exciting Products</h5>


                    <div class="datatable-container">
                        <table class="table datatable datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 2%">#</th>
                                   
                                    <th data-sortable="true" style="width: 50%;">Ordered Items</th>
                                    <th data-sortable="true" style="width: 20%;">Price</th>
                                    <th data-sortable="true" style="width: 4%;">Discount</th>
                                    <th data-sortable="true" style="width: 4%;">Qty</th>
                                    <th data-sortable="true" style="width: 20%;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $order_id = $row['order_id']; // Assign value to $order_id
                                        ?>
                                        <tr data-index="0">
                                            <td><?= $i ?></td>
                                            
                                            <td><?= $row['product_name'] ?></td>
                                            <td>Rs:<?= number_format($row['price']) ?></td>
                                            <td><?= $row['stock_discount'] ?>%</td>
                                            <td><?= $row['item_qty'] ?></td>
                                            <td>Rs:<?= number_format($row['amount']) ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>

        <section>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage</h5> 

                    <div class="d-grid gap-2 col-6 mx-auto">

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            <input type="hidden" name="order_id" value="<?= $order_id ?>"> 
                            <button class="btn btn-primary btn-block col-12" type="submit" name="action" value="approved">Order Approved</button>
                        </form>


                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            <input type="hidden" name="order_id" value="<?= $order_id ?>"> 
                            <button class="btn btn-danger btn-block col-12"  type="submit" name="action" value="reject">Order Reject</button>
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
