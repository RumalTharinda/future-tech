
<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Waiting Orders List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Waiting Orders List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">




        <div class="card recent-sales overflow-auto">



            <div class="card-body">
                <h5 class="card-title">Waiting Orders List <span>| This Month</span></h5>

                <?php
                // $Cdate=date('Y-m-d');//
                $db = dbconn();
                $sql = "SELECT * FROM tbl_oder LEFT JOIN tbl_biling ON tbl_biling.oder_id=tbl_oder.order_id LEFT JOIN tbl_order_item ON tbl_order_item.oder_id=tbl_oder.order_id LEFT JOIN shipping ON shipping.oder_id=tbl_oder.order_id LEFT JOIN tbl_product ON tbl_product.product_id=tbl_order_item.product_id LEFT JOIN tbl_stock ON tbl_stock.stock_id=tbl_order_item.stock_id WHERE tbl_oder.order_date > DATE_ADD(NOW(), INTERVAL -30 DAY) AND tbl_oder.order_status = 'waiting'";
                $result = $db->query($sql);
                ?> 




                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>

                           
                            <th scope="col">Status</th>
                             <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>


                                <tr>
                                    <th scope="row"><a href="#"><?= $i ?></a></th>
                                    <td><?= $row['biling_title'] ?>  <?= $row['biling_persons_first_name'] ?>  <?= $row['biling_persons_last_name'] ?></td>
                                   <!--  <td><a href="#" class="text-primary">At praesentium minu</a></td>   --> 
                                    
                                    <td><span class="badge bg-success"><?= $row['order_status'] ?></span></td>
                                    <td>RS:<?= number_format($row['biling_total_amount']) ?></td>
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
    </section>
</main>

<?php
include '../footer.php';
?>
