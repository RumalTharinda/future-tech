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
                <li class="breadcrumb-item active">Manage</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage Brand</h5>

                <?php
                $BrandName = '';  // new //



                extract($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $BrandName = dataclean($BrandName);

                    // print_r($BrandName);

                    $message = array();

                    if (empty($BrandName)) {
                        $message['err_brandname'] = "The Brand Name should not be blank...!";
                    }


                    if (empty($message)) {
                        $file = $_FILES['img'];
                        $file_name = $file['name'];
                        $file_tmp = $file['tmp_name'];
                        $file_size = $file['size'];
                        $file_error = $file['error'];
                        $file_ext = explode('.', $file_name);
                        $file_ext = strtolower(end($file_ext));
                        $allowed = array('txt', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif');
                        if (in_array($file_ext, $allowed)) {
                            if ($file_error === 0) {
                                if ($file_size <= 2097152) {
                                    $file_name_new = uniqid('', true) . '.' . $file_ext;
                                    $file_destination = 'img/' . $file_name_new;
                                    if (move_uploaded_file($file_tmp, $file_destination)) {
                                        echo "The file was uploaded successfully.";
                                    } else {
                                        $message['error_file'] = "There was an error uploading the file.";
                                    }
                                } else {
                                    $message['error_file'] = "The file is too large.";
                                }
                            } else {
                                $message['error_file'] = "There was an error uploading the file.";
                            }
                        } else {
                            $message['error_file'] = "File type not allowed.";
                        }
                    }


                    if (empty($message)) {
                        $db = dbconn();
                        $sql = "INSERT INTO tbl_brands(brand_name,brand_img)VALUES('$BrandName','$file_name_new')";
                        $db->query($sql);

                        // Display successfully added! message //
                        echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>Brand successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';
                        //echo '<div class="alert alert-success" role="alert">Brand successfully added! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        // Clear the BrandName field //
                        $BrandName = '';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
                    $db = dbconn();
                    $sql = "DELETE FROM tbl_brands WHERE brand_id='$brand_id' ";
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
                                            <th data-sortable="true" style="width: 6%">#</th>
                                            <th data-sortable="true" style="width: 40%;"> Brand Name</th>
                                            <th data-sortable="true" style="width: 40%;">Brand Img</th>

                                            <th data-sortable="true" style="width: 5%"></th>
                                            <th data-sortable="true" style="width: 5%;"></th>
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
                                                    <td><?= $row['brand_name'] ?> </td>
                                                    <td><?= $row['brand_img'] ?></td>

                                                    <td>
                                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                            <input type="hidden" name="brand_id" value="<?= $row['brand_id'] ?>"> 
                                                            <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="brand_id" value="<?= $row['brand_id'] ?>"> 
                                                            <button class="btn btn-primary" type="submit" name="action" value="edit" >EDIT</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit_img.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="brand_id" value="<?= $row['brand_id'] ?>"> 
                                                            <button class="btn btn-primary" type="submit" name="action" value="editImg">Edit Img</button>
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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Brand</h5>






                        <!-- Brands Form -->

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate enctype="multipart/form-data">  

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Brand Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="BrandName" name="BrandName" value="<?= @$BrandName ?>">
                                    <div class="text-danger"><?= @$message['err_brandname'] ?></div>  <!-- error message -->
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Upload Product image</label>
                                <input class="form-control" type="file" name="img">
                                <div class="text-danger"><?= @$message['error_file'] ?></div>  <!-- error message -->

                            </div>         

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                        <!-- End Brands Form -->

                    </div>
                </div>

                </section>

                </main>

                <?php
                include '../footer.php';
                ?>