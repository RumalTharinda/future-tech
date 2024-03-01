
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">




                    <!-- Sales/Orders Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Sales <span>| This Month</span></h5>
                                <?php
                                $db = dbconn();

                                // Get the number of sales for this month
                                $currentYear = date('Y');
                                $currentMonth = date('m');
                                $sqlSales = "SELECT COUNT(*) AS salesCount FROM tbl_oder WHERE YEAR(order_date) = '$currentYear' AND MONTH(order_date) = '$currentMonth'";
                                $resultSales = $db->query($sqlSales);
                                $rowSales = $resultSales->fetch_assoc();
                                $salesCount = $rowSales['salesCount'];

                                // Get the number of sales for the previous month
                                $previousMonth = ($currentMonth - 1 <= 0) ? 12 : $currentMonth - 1;
                                $previousYear = ($currentMonth - 1 <= 0) ? $currentYear - 1 : $currentYear;
                                $sqlPreviousSales = "SELECT COUNT(*) AS previousSalesCount FROM tbl_oder WHERE YEAR(order_date) = '$previousYear' AND MONTH(order_date) = '$previousMonth'";
                                $resultPreviousSales = $db->query($sqlPreviousSales);
                                $rowPreviousSales = $resultPreviousSales->fetch_assoc();
                                $previousSalesCount = $rowPreviousSales['previousSalesCount'];

                                // Calculate the percentage increase
                                $percentageIncrease = ($previousSalesCount > 0) ? (($salesCount - $previousSalesCount) / $previousSalesCount) * 100 : 0;
                                ?>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $salesCount; ?></h6>
                                        <span class="text-danger small pt-1 fw-bold"><?php echo number_format($percentageIncrease, 2); ?>%</span>
                                        <span class="text-muted small pt-2 ps-1"><?php echo ($percentageIncrease > 0) ? 'increase' : 'decrease'; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->





                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-12">
                        <div class="card info-card revenue-card">
                              <?php

                               $db = dbconn();

                                // Get the number of sales for this month
                                $currentYear = date('Y');
                                $currentMonth = date('m');
                                $sqlRevenue = "SELECT SUM(biling_total_amount) AS RevenueCount FROM tbl_biling INNER JOIN tbl_oder ON tbl_oder.order_id=tbl_biling.oder_id WHERE YEAR(order_date) = '$currentYear' AND MONTH(order_date) = '$currentMonth' AND order_status='paid'";
                                $resultRevenue = $db->query($sqlRevenue);
                                $rowRevenue = $resultRevenue->fetch_assoc();
                                $RevenueCount = $rowRevenue['RevenueCount'];
                                
                                
                                 // Get the number of sales for the previous month
                                $previousMonth = ($currentMonth - 1 <= 0) ? 12 : $currentMonth - 1;
                                $previousYear = ($currentMonth - 1 <= 0) ? $currentYear - 1 : $currentYear;
                                $sqlPreviousRevenue = "SELECT COUNT(*) AS previousRevenueCount FROM tbl_biling INNER JOIN tbl_oder ON tbl_oder.order_id=tbl_biling.oder_id WHERE YEAR(order_date) = '$currentYear' AND MONTH(order_date) = '$currentMonth' AND order_status='paid'";
                                $resultPreviousRevenue = $db->query($sqlPreviousRevenue);
                                $rowPreviousRevenue = $resultPreviousRevenue->fetch_assoc();
                                $previousRevenueCount = $rowPreviousRevenue['previousRevenueCount'];

                                // Calculate the percentage increase
                                $percentageIncreaseRevenueCount = ($previousRevenueCount > 0) ? (($RevenueCount - $previousRevenueCount) / $previousRevenueCount) * 100 : 0;
                                
                                
                                  ?>

                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>| This Month</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rs:<?php echo number_format($RevenueCount); ?></h6>
                                        <span class="text-danger small pt-1 fw-bold"><?php echo number_format($previousRevenueCount, 2); ?>%</span>
                                        <span class="text-muted small pt-2 ps-1"><?php echo ($previousRevenueCount > 0) ? 'increase' : 'decrease'; ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->





                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Customers <span>| This Month</span></h5>
                                <?php
                                $db = dbconn();

                                // Get the count of customers added this month
                                $currentYear = date('Y');
                                $currentMonth = date('m');
                                $sqlCustomers = "SELECT COUNT(*) AS customerCount FROM tbl_customer WHERE YEAR(add_date) = '$currentYear' AND MONTH(add_date) = '$currentMonth'";
                                $resultCustomers = $db->query($sqlCustomers);
                                $rowCustomers = $resultCustomers->fetch_assoc();
                                $customerCount = $rowCustomers['customerCount'];

                                // Get the count of customers added in the previous month
                                $previousMonth = ($currentMonth - 1 <= 0) ? 12 : $currentMonth - 1;
                                $previousYear = ($currentMonth - 1 <= 0) ? $currentYear - 1 : $currentYear;
                                $sqlPreviousCustomers = "SELECT COUNT(*) AS previousCustomerCount FROM tbl_customer WHERE YEAR(add_date) = '$previousYear' AND MONTH(add_date) = '$previousMonth'";
                                $resultPreviousCustomers = $db->query($sqlPreviousCustomers);
                                $rowPreviousCustomers = $resultPreviousCustomers->fetch_assoc();
                                $previousCustomerCount = $rowPreviousCustomers['previousCustomerCount'];

                                // Calculate the percentage increase
                                $percentageIncrease = ($previousCustomerCount > 0) ? (($customerCount - $previousCustomerCount) / $previousCustomerCount) * 100 : 0;
                                ?>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $customerCount; ?></h6>
                                        <span class="text-danger small pt-1 fw-bold"><?php echo number_format($percentageIncrease, 2); ?>%</span>
                                        <span class="text-muted small pt-2 ps-1"><?php echo ($percentageIncrease > 0) ? 'increase' : 'decrease'; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customers Card -->






                   






                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            

                            <div class="card-body">
                                <h5 class="card-title">Orders <span>| This Week</span></h5>

                                <?php
                               // $Cdate=date('Y-m-d');//
                                $db = dbconn();                               
                                $sql = "SELECT * FROM tbl_oder LEFT JOIN tbl_biling ON tbl_biling.oder_id=tbl_oder.order_id LEFT JOIN tbl_order_item ON tbl_order_item.oder_id=tbl_oder.order_id LEFT JOIN shipping ON shipping.oder_id=tbl_oder.order_id LEFT JOIN tbl_product ON tbl_product.product_id=tbl_order_item.product_id LEFT JOIN tbl_stock ON tbl_stock.stock_id=tbl_order_item.stock_id WHERE tbl_oder.order_date > DATE_ADD(NOW(), INTERVAL -7 DAY)";
                                $result = $db->query($sql);
                                
                                ?> 




                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
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
                                                    <td>RS:<?= number_format($row['biling_total_amount']) ?></td>
                                                    <td><span class="badge bg-success"><?= $row['order_status'] ?></span></td>
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
                    </div><!-- End Recent Sales -->





                   

                </div>
            </div><!-- End Left side columns -->

           

        </div>
    </section>

</main><!-- End #main -->
