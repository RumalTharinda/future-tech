
<?php
include '../header.php';
include '../menu.php';

$db = dbconn();

// Handle search query
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
     $search = dataclean($search);

    // Construct the SQL query with the search condition
    $sql = "SELECT * FROM tbl_oder LEFT JOIN tbl_customer ON tbl_customer.customer_id=tbl_oder.customer_id WHERE order_status='delivered' AND tbl_customer.customer_first_name LIKE '%$search%' OR tbl_oder.order_date LIKE '%$search%' OR tbl_customer.customer_last_name LIKE '%$search%'";
} else {
    // Default query to fetch all stock items
    $sql = "SELECT * FROM tbl_oder LEFT JOIN tbl_customer ON tbl_customer.customer_id=tbl_oder.customer_id WHERE order_status='delivered'";
}

// Handle sorting
if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
    $sql .= " ORDER BY tbl_customer.customer_first_name ASC";
}

$result = $db->query($sql);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Payments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>payment/view.php">Payment</a></li>
                <li class="breadcrumb-item active">Manage Payment</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting Order</h5>

                <!-- Search Bar -->
                <form method="GET" action="<?= $_SERVER['PHP_SELF'] ?>" class="datatable-search-form">
                    <div class="datatable-search">
                        <input class="datatable-input" name="search" placeholder="Search..." type="search" title="Search within table" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                        <button type="submit" class="btn btn-primary">Search</button>

                        <!-- Button to arrange product names in alphabetical order -->
                        <button type="submit" class="btn btn-primary" name="sort" value="alphabetical">Sort by (A-Z)</button>
                    </div>
                </form>

                <!-- Table with stripped rows -->
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                    <div class="datatable-container">
                        <table class="table datatable datatable-table">
                            <!-- Table headers -->
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 5%">#</th>
                                    <th data-sortable="true" style="width: 50%;">Customer Name</th>
                                    <th data-sortable="true" style="width: 20%;">Order Date</th>                                   
                                    <th data-sortable="true" style="width: 15%;">Status</th>
                                    <th data-sortable="true" style="width: 10%;"></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr data-index="0">
                                            <td><?= $i ?></td>
                                            <td><?= $row['customer_title'] ?> <?= $row['customer_first_name'] ?> <?= $row['customer_last_name'] ?></td>
                                            <td><?= $row['order_date'] ?></td>
                                            <td><?= $row['order_status'] ?></td>
                                            
                                             <td>
                                                <form method="post" action="payment.php?order_id=<?= $row['order_id'] ?>" class="row g-3" novalidate>
                                                    <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>"> 
                                                    <button class="btn btn-primary" type="submit" name="action" value="edit" >View</button>
                                                </form>    
                                            </td>
                                            
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    // No records found
                                    echo '<tr><td colspan="7">No records found.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </section>
</main>

<?php
include '../footer.php';
?>
