<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Categories</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Categories</a></li>
                <li class="breadcrumb-item active">Manage</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage Categories</h5>

                <?php
                $CategoryName = '';

                extract($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $CategoryName = dataclean($CategoryName);

                    $message = array();

                    if (empty($CategoryName)) {
                        $message['err_categoryname'] = "The Category Name should not be blank...!";
                    }

                    if (empty($message)) {
                        $db = dbconn();
                        $sql = "INSERT INTO tbl_categories(categories_name)VALUES('$CategoryName')";
                        $db->query($sql);

                        // Display successfully added! message //
                        echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New Category successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';

                        // Clear the category Name field //
                        $CategoryName = '';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
                    $db = dbconn();
                    $sql = "DELETE FROM tbl_categories WHERE categories_id='$categories_id' ";
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
                    $sql = "SELECT * FROM tbl_categories WHERE categories_name LIKE '%$search%'";
                } else {
                    // Default query to fetch all stock items
                    $sql = "SELECT * FROM tbl_categories";
                }

                // Handle sorting
                if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
                    $sql .= " ORDER BY categories_name ASC";
                }

                $result = $db->query($sql);
                ?>

                <section class="section">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Exciting Category</h5>


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
                                            <th data-sortable="true" style="width: 5%">#</th>
                                            <th data-sortable="true" style="width: 27.919708029197082%;"> Category Name</th>
                                            
                                            <th data-sortable="true" style="width: 5%"></th>
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
                                                    <td><?= $row['categories_name'] ?> </td>
                                                    
                                                    <td>
                                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                            <input type="hidden" name="categories_id" value="<?= $row['categories_id'] ?>"> 
                                                            <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="categories_id" value="<?= $row['categories_id'] ?>"> 
                                                            <button class="btn btn-primary" type="submit" name="action" value="edit" >EDIT</button>
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

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add News Category</h5>




                <!-- Category Form -->

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="CategoryName" name="CategoryName" value="<?= @$CategoryName ?>">
                            <div class="text-danger"><?= @$message['err_categoryname'] ?></div>  <!-- error message -->
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                <!-- End Category Form -->

            </div>
        </div>

    </section>

</main>

<?php
include '../footer.php';
?>