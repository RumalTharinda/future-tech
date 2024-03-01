
<?php
include '../header.php';
include '../menu.php';

$db = dbconn();

// Handle search query
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
     $search = dataclean($search);

    // Construct the SQL query with the search condition
    $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id LEFT JOIN tbl_supplier ON tbl_supplier.supplier_id=tbl_stock.supplier_id WHERE tbl_product.product_name LIKE '%$search%' OR tbl_supplier.supplier_company_name LIKE '%$search%'";
} else {
    // Default query to fetch all stock items
    $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id LEFT JOIN tbl_supplier ON tbl_supplier.supplier_id=tbl_stock.supplier_id";
}

// Handle sorting
if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
    $sql .= " ORDER BY tbl_product.product_name ASC";
}

$result = $db->query($sql);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Stock</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Stock</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting Stock</h5>

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
                                    <th data-sortable="true" style="width: 5.656934306569343">#</th>
                                    <th data-sortable="true" style="width: 34.919708029197082%;">Product Name</th>
                                    <th data-sortable="true" style="width: 15.77372262773723%;">Purchase Date</th>
                                    <th data-sortable="true" style="width: 10.77372262773723%;">Stock Unit Price</th>
                                    <th data-sortable="true" style="width: 6.306569343065693%;">Stock Quantity</th>
                                    <th data-sortable="true" style="width: 9.306569343065693%;">Stock Sale Price</th>
                                    <th data-sortable="true" style="width: 17.77372262773723%;">Supplier</th>
                                    <th data-sortable="true" aria-sort="descending" class="datatable-descending" style="width: 7.34306569343066%;">Discount</th>
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
                                            <td><?= $row['product_name'] ?> </td>
                                            <td><?= $row['stock_purchase_date'] ?></td>
                                            <td>Rs:<?= number_format($row['stock_unite_price']) ?></td>
                                            <td><?= $row['stock_quantity'] ?></td>
                                            <td>Rs:<?= number_format($row['stock_sale_price']) ?></td>
                                            <td><?= $row['supplier_company_name'] ?></td>
                                            <td><?= $row['stock_discount'] ?>%</td>
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
