<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Brands</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Brands</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <?php
    $db = dbconn();

    // Handle search query
    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        $search = dataclean($search);

        // Construct the SQL query with the search condition
        $sql = "SELECT * FROM tbl_brands WHERE brand_name LIKE '%$search%'";
    } else {
        // Default query to fetch all stock items
        $sql = "SELECT * FROM tbl_brands";
    }

    // Handle sorting
    if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
        $sql .= " ORDER BY brand_name ASC";
    }

    $result = $db->query($sql);
    ?>


    

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting brands</h5>


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
                                <th data-sortable="true" style="width: 5.656934306569343">#</th>
                                <th data-sortable="true" style="width: 40%;"> Brand Name</th>
                                <th data-sortable="true" style="width: 40%;">Brand Img</th>


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
                                        <td><?= $row['brand_name'] ?> </td>
                                        <td><?= $row['brand_img'] ?></td>





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