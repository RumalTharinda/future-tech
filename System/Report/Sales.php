
<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Sales</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Sales</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">


                <div class="card-body">
                    <h5 class="card-title">Sales <span>| This Month</span></h5>

                    <?php
                    // $Cdate=date('Y-m-d');//
                    $db = dbconn();
                    $sql = "SELECT * FROM tbl_payment LEFT JOIN tbl_oder ON tbl_oder.order_id=tbl_payment.order_id LEFT JOIN tbl_biling ON tbl_biling.oder_id=tbl_oder.order_id WHERE tbl_oder.order_date > DATE_ADD(NOW(), INTERVAL -30 DAY)";
                    $result = $db->query($sql);
                    ?> 




                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
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
                                        <td><?= $row['biling_title'] ?> <?= $row['biling_persons_first_name'] ?> <?= $row['biling_persons_last_name'] ?></td>
                                        <td>RS:<?= number_format($row['payment_amount']) ?></td>

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
</main>

<?php
include '../footer.php';
?>
