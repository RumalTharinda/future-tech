<?php
include '../header.php';
include '../menu.php';
?>



<?php
$db = dbconn();

// Handle search query
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $search = dataclean($search);

    // Construct the SQL query with the search condition for user account name and customer name
    $sql = "SELECT * FROM tbl_product LEFT JOIN tbl_brands ON tbl_brands.brand_id=tbl_product.product_brand LEFT JOIN tbl_categories ON tbl_categories.categories_id=tbl_product.product_categories
            
            WHERE tbl_product.product_name LIKE '%$search%' 
           
            OR tbl_product.product_brand LIKE '%$search%' 
            OR tbl_product.product_categories LIKE '%$search%'";
} else {
    // Default query to fetch all customers
    $sql = "SELECT * FROM tbl_product LEFT JOIN tbl_brands ON tbl_brands.brand_id=tbl_product.product_brand LEFT JOIN tbl_categories ON tbl_categories.categories_id=tbl_product.product_categories";
}

// Handle sorting
if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
    $sql .= " ORDER BY tbl_product.product_name ASC";
}


$result = $db->query($sql);

?>




<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Product</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
   

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting Products</h5>


                <!-- Search bar && (A-Z)sort -->
                <form method="GET" action="<?= $_SERVER['PHP_SELF'] ?>" class="datatable-search-form">
                    <div class="datatable-search">
                        <input class="datatable-input" name="search" placeholder="Search..." type="search" title="Search within table" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                         <button type="submit" class="btn btn-primary" name="sort" value="alphabetical">Sort by (A-Z)</button>
                    </div>
                </form>
                
                
                    <div class="datatable-container">
                        <table class="table datatable datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 5.656934306569343">#</th>
                                    <th data-sortable="true" style="width: 27.919708029197082%;">Product Name</th>
                                    <th data-sortable="true" style="width: 9.306569343065693%;">Product Brand</th>
                                    <th data-sortable="true" style="width: 9.306569343065693%;">Product Categories</th>
                                    <th data-sortable="true" style="width: 20.77372262773723%;">Product Model</th>
                                    <th data-sortable="true" style="width: 10.77372262773723%;">Product Item Code</th>
                                    <th data-sortable="true" style="width: 9.306569343065693%;">Product Warranty</th>
                                    <th data-sortable="true" style="width: 9.306569343065693%;">Product State</th>

                                    <th data-sortable="true" style="width: 9.306569343065693%;"></th>

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
                                            <td><?= $row['product_name'] ?></td>
                                            <td><?= $row['brand_name'] ?></td>
                                            <td><?= $row['categories_name'] ?></td>
                                            <td><?= $row['product_model'] ?></td>
                                            <td><?= $row['product_item_code'] ?></td>                                            
                                            <td><?= $row['product_warranty'] ?></td>
                                            <td><?= $row['product_states'] ?></td>

                                            
                                            <td>
                                                <form method="post" action="add_spec_name.php?productid=<?= $row['product_id'] ?>" class="row g-3" novalidate>
                                                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>"> 
                                                    <button class="btn btn-primary" type="submit" name="action" value="edit" >Add spec</button>
                                                </form>    
                                            </td>



                                        </tr>

                                        <?php
                                        $i++;
                                    }
                                } else {
                                // No records found
                                echo '<tr><td colspan="4">No records found.</td></tr>';
                            }
                                ?>
                            </tbody>
                        </table>
                    </div>
                   
                <!-- End Table with stripped rows -->

            </div>
        </div>

    </section>

</main>

<?php
include '../footer.php';
?>