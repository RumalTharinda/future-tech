<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Customer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Customer</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
        $db = dbconn();
        $sql = "DELETE FROM tbl_customer WHERE customer_id='$customer_id' ";
        $db->query($sql);
    }
    ?>


    <?php
    $db = dbconn();

    // Handle search query
    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        $search = dataclean($search);

        // Construct the SQL query with the search condition
        $sql = "SELECT * FROM tbl_customer WHERE customer_first_name LIKE '%$search%' OR customer_last_name  LIKE '%$search%' OR customer_title LIKE '%$search%'";
    } else {
        // Default query to fetch all stock items
        $sql = "SELECT * FROM tbl_customer";
    }

    // Handle sorting
    if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
        $sql .= " ORDER BY customer_first_name ASC";
    }

    $result = $db->query($sql);
    ?>


   

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting Customers</h5>


                <!-- Search Bar -->
                <form method="GET" action="<?= $_SERVER['PHP_SELF'] ?>" class="datatable-search-form">
                    <div class="datatable-search">
                        <input class="datatable-input" name="search" placeholder="Search..." type="search" title="Search within table" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                        <button type="submit" class="btn btn-primary">Search</button>

                        <!-- Button to arrange product names in alphabetical order -->
                        <button type="submit" class="btn btn-primary" name="sort" value="alphabetical">Sort by (A-Z)</button>
                    </div>
                </form>



                <div class="datatable-container">
                    <table class="table datatable datatable-table">
                        <thead>
                            <tr>
                                <th data-sortable="true" style="width: 3.656934306569343%">#</th>
                                <th data-sortable="true" style="width: 24.919708029197082%;">Customer Name</th>
                                <th data-sortable="true" style="width: 10.77372262773723%;">User ID</th>  
                                <th data-sortable="true" style="width: 9.306569343065693%;">Email</th>
                                <th data-sortable="true" style="width: 9.306569343065693%;">Phone</th>
                                <th data-sortable="true" style="width: 9.306569343065693%;">Mobile</th>
                                <th data-sortable="true" aria-sort="descending" class="datatable-descending" style="width: 19.34306569343066%;">Address</th>
                                <th data-sortable="true" style="width: 5%;"></th>
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
                                        <td><?= $row['user_id'] ?></td>
                                        <td><?= $row['customer_email'] ?></td>
                                        <td><?= $row['customer_phone'] ?></td>
                                        <td><?= $row['customer_mobile'] ?></td>
                                        <td><?= $row['customer_address_line1'] ?> <?= $row['customer_address_line2'] ?> <?= $row['customer_address_line3'] ?></td>

                                        <td>
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                <input type="hidden" name="customer_id" value="<?= $row['customer_id'] ?>"> 
                                                <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
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
                
            <!-- End Table with stripped rows -->

        </div>
        </div>

    </section>

</main>

<?php
include '../footer.php';
?>