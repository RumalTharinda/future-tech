
<?php
include '../header.php';
include '../menu.php';

$db = dbconn();

// Handle search query
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
     $search = dataclean($search);

    // Construct the SQL query with the search condition
    $sql = "SELECT * FROM tbl_payment LEFT JOIN tbl_oder ON tbl_oder.order_id=tbl_payment.order_id LEFT JOIN tbl_biling ON tbl_biling.oder_id=tbl_oder.order_id WHERE tbl_biling.biling_persons_first_name LIKE '%$search%' OR tbl_payment.payment_date LIKE '%$search%' OR tbl_biling.biling_persons_last_name LIKE '%$search%'";
} else {
    // Default query to fetch all stock items
    $sql = "SELECT * FROM tbl_payment LEFT JOIN tbl_oder ON tbl_oder.order_id=tbl_payment.order_id LEFT JOIN tbl_biling ON tbl_biling.oder_id=tbl_oder.order_id";
}

// Handle sorting
if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
    $sql .= " ORDER BY tbl_biling.biling_persons_first_name ASC";
}

$result = $db->query($sql);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Payments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">View</li>
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
                                    <th data-sortable="true" style="width: 50%;">Biling Name</th>
                                    <th data-sortable="true" style="width: 30%;">Payment Date</th>                                   
                                    <th data-sortable="true" style="width: 15%;">Payment amount</th>
                                    
                                    
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
                                            <td><?= $row['biling_title'] ?> <?= $row['biling_persons_first_name'] ?> <?= $row['biling_persons_last_name'] ?></td>
                                            <td><?= $row['payment_date'] ?></td>
                                            <td><?= $row['payment_amount'] ?></td>
                                            
                                             
                                            
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
