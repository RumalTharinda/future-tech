
<?php
include '../header.php';
include '../menu.php';

$db = dbconn();

// Get the count of registered customers for today
$currentDate = date('Y-m-d');
$sqlCustomersToday = "SELECT COUNT(*) AS customersToday FROM tbl_customer WHERE DATE(add_date) = '$currentDate'";
$resultCustomersToday = $db->query($sqlCustomersToday);
$rowCustomersToday = $resultCustomersToday->fetch_assoc();
$customersTodayCount = $rowCustomersToday['customersToday'];

// Get the count of sales for today

$sqlSales = "SELECT SUM(biling_total_amount) AS salesCount FROM tbl_biling INNER JOIN tbl_oder ON tbl_oder.order_id=tbl_biling.oder_id WHERE DATE(order_date) = '$currentDate' AND order_status='paid'";
$resultSales = $db->query($sqlSales);
$rowSales = $resultSales->fetch_assoc();
$salesCount = $rowSales['salesCount'];

// Get the count of orders in waiting status for the day
$sqlWaitingOrders = "SELECT COUNT(*) AS waitCount FROM tbl_oder WHERE DATE(order_date) = '$currentDate' AND order_status='waiting'";
$resultWaitingOrders = $db->query($sqlWaitingOrders);
$rowWaitingOrders = $resultWaitingOrders->fetch_assoc();
$waitCount = $rowWaitingOrders['waitCount'];


// Get the count of orders in approved status for the day
$sqlapprovedOrders = "SELECT COUNT(*) AS approvedCount FROM tbl_oder WHERE DATE(order_date) = '$currentDate' AND order_status='approved'";
$resultapprovedOrders = $db->query($sqlapprovedOrders);
$rowapprovedOrders = $resultapprovedOrders->fetch_assoc();
$approvedCount = $rowapprovedOrders['approvedCount'];

// Get the count of orders in delivered status for the day
$sqldeliveredOrders = "SELECT COUNT(*) AS deliveredCount FROM tbl_oder WHERE DATE(order_date) = '$currentDate' AND order_status='delivered'";
$resultdeliveredOrders = $db->query($sqldeliveredOrders);
$rowdeliveredOrders = $resultdeliveredOrders->fetch_assoc();
$deliveredCount = $rowdeliveredOrders['deliveredCount'];

// Get the count of orders in delivered status for the day
$sqlpaidOrders = "SELECT COUNT(*) AS paidCount FROM tbl_oder WHERE DATE(order_date) = '$currentDate' AND order_status='paid'";
$resultpaidOrders = $db->query($sqlpaidOrders);
$rowpaidOrders = $resultpaidOrders->fetch_assoc();
$paidCount = $rowpaidOrders['paidCount'];

?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daily Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Daily Report</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daily Report</h5>





                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>Registered Customers</td>
                            <td></td>
                            <td><?php echo $customersTodayCount; ?></td>
                        </tr>
                        <tr>

                            <td>Total sales</td>
                            <td></td>
                            <td>Rs:<?php echo number_format($salesCount); ?></td>
                        </tr>
                       
                        <tr>

                            <td>Approved Orders</td>
                            <td></td>
                            <td><?php echo $approvedCount; ?></td>
                        </tr>
                         <tr>

                            <td>Waiting List</td>
                            <td></td>
                            <td><?php echo $waitCount; ?></td>
                        </tr>
                        <tr>

                            <td>Delivered Orders</td>
                            <td></td>
                            <td><?php echo $deliveredCount; ?></td>
                        </tr>
                        <tr>

                            <td>Completed Orders</td>
                            <td></td>
                            <td><?php echo $paidCount; ?></td>
                        </tr>
                    </tbody>
                </table>



            </div>
        </div>
    </section>
</main>

<?php
include '../footer.php';
?>
