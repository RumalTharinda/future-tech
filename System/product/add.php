<?php
include '../header.php';
include '../menu.php';
?>




<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Product</a></li>
                <li class="breadcrumb-item active">Manage</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage Product</h5>


                <?php
                $PName = '';
                $PModel = '';
                $PItemCode = '';
                $PWeight = '';
                $PWarranty = '';
                $Description = '';
                $Overview = '';

                extract($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $PName = dataclean($PName);
                    $PModel = dataclean($PModel);
                    $PItemCode = dataclean($PItemCode);
                    $PWeight = dataclean($PWeight);
                    $PWarranty = dataclean($PWarranty);
                    $Description = dataclean($Description);
                    $Overview = dataclean($Overview);

                    $message = array();

                    if (empty($PName)) {
                        $message['err_PName'] = "The Product Name should not be blank...!";
                    }
                    if (empty($PModel)) {
                        $message['err_PModel'] = "The Product Model should not be blank...!";
                    }
                    if (empty($PItemCode)) {
                        $message['err_PItemCode'] = "The Product Item Code should not be blank...!";
                    }
                    if (empty($PWeight)) {
                        $message['err_PWeight'] = "The Product Weight should not be blank...!";
                    }
                    if (empty($PWarranty)) {
                        $message['err_PWarranty'] = "The Product Warranty should not be blank...!";
                    }
                    if (empty($Description)) {
                        $message['err_Description'] = "The Description should not be blank...!";
                    }
                    if (empty($Overview)) {
                        $message['err_Overview'] = "The Overview should not be blank...!";
                    }






                    if (empty($message)) {
                        $file = $_FILES['Productimg'];
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
                        $sql = "INSERT INTO tbl_product(product_name, product_model, product_item_code, product_brand, product_categories, product_weight, product_warranty, product_states, product_featured_product, product_description, product_overview, product_img)VALUES('$PName', '$PModel', '$PItemCode', '$PBrand', '$PCategories', '$PWeight', '$PWarranty', '$PState', '$FProduct', '".mysqli_real_escape_string($db, $Description)."', '".mysqli_real_escape_string($db, $Overview)."','$file_name_new')";
                        $db->query($sql);

                        // Display successfully added! message //
                        echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New Product successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';

                        // Clear the BrandName field //

                        $PName = '';
                        $PModel = '';
                        $PItemCode = '';
                        $PWeight = '';
                        $PWarranty = '';
                        $Description = '';
                        $Overview = '';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
                    $db = dbconn();
                    $sql = "DELETE FROM tbl_product WHERE product_id = '$product_id' ";
                    $db->query($sql);
                }
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
            OR tbl_product.product_featured_product LIKE '%$search%'    
            OR tbl_product.product_categories LIKE '%$search%'";
                } else {
                    // Default query to fetch all customers
                    $sql = "SELECT * FROM tbl_product LEFT JOIN tbl_brands ON tbl_brands.brand_id=tbl_product.product_brand LEFT JOIN tbl_categories ON tbl_categories.categories_id=tbl_product.product_categories";
                }

                // Handle sorting
                if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
                    $sql = "SELECT * FROM tbl_product LEFT JOIN tbl_brands ON tbl_brands.brand_id=tbl_product.product_brand LEFT JOIN tbl_categories ON tbl_categories.categories_id=tbl_product.product_categories ORDER BY tbl_product.product_name ASC";
                }


                $result = $db->query($sql);
                ?>





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
                                            <th data-sortable="true" style="width: 61.919708029197082%">Product Name</th>
                                            <th data-sortable="true" style="width: 15.306569343065693%">Product Brand</th>
                                            <th data-sortable="true" style="width: 9.306569343065693%">Product Categories</th>

                                            <th data-sortable="true" style="width: 15.77372262773723%">Product Item Code</th>
                                            
                                            <th data-sortable="true" style="width: 14.006569343065693%">Product State</th>
                                            <th data-sortable="true" style="width: 5%">Featured</th>

                                            <th data-sortable="true" style="width: 5%"></th>
                                            <th data-sortable="true" style="width: 5%;"></th>
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
                                                    <td><?= $row['product_name'] ?></td>
                                                    <td><?= $row['product_brand'] ?></td>
                                                    <td><?= $row['product_categories'] ?></td>

                                                    <td><?= $row['product_item_code'] ?></td>                                            

                                                    <td><?= $row['product_states'] ?></td>
                                                    <td><?= $row['product_featured_product'] ?></td>


                                                    <td>
                                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>"> 
                                                            <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>"> 
                                                            <button class="btn btn-primary" type="submit" name="action" value="edit" >EDIT</button>
                                                        </form>    
                                                    </td>


                                                    <td>
                                                        <form method="post" action="add_sub_img.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="productid" value="<?= $row['product_id'] ?>"> 
                                                            <button class="btn btn-primary" type="submit" name="action" value="subimg">Sub Img</button>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit_img.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="productid" value="<?= $row['product_id'] ?>"> 
                                                            <button class="btn btn-primary" type="submit" name="action" value="editImg">Edit Img</button>
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





                <section class="section">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Products Form</h5>







                            <!-- Multi Columns Form -->
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate enctype="multipart/form-data">


                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="PName" name="PName" value="<?= @$PName ?>"> 
                                    <div class="text-danger"><?= @$message['err_PName'] ?></div>  <!-- error message -->                        
                                </div>

                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label">Product Model</label>
                                    <input type="text" class="form-control" id="PModel" name="PModel" value="<?= @$PModel ?>"> 
                                    <div class="text-danger"><?= @$message['err_PModel'] ?></div>  <!-- error message -->                        
                                </div>

                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label">Product Item Code</label>
                                    <input type="text" class="form-control" id="PItemCode" name="PItemCode" value="<?= @$PItemCode ?>"> 
                                    <div class="text-danger"><?= @$message['err_PItemCode'] ?></div>  <!-- error message -->                        
                                </div>

                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Product Brand</label>
                                    <select id="PBrand" class="form-select" name="PBrand">
                                        <option value="">--</option>
                                        <?php
                                        $db = dbconn();

                                        $sql = "SELECT brand_name, brand_id FROM tbl_brands ORDER BY brand_name ASC";
                                        $result = $db->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $brand_name = $row["brand_name"];
                                                $brand_id = $row["brand_id"];
                                                ?>

                                                <option value='<?= $brand_id ?>'  <?php
                                                if ($row['brand_id'] == @$PBrand) {
                                                    echo 'selected';
                                                }
                                                ?>><?= $brand_name ?></option>;
                                                        <?php
                                                    }
                                                } else {
                                                    echo "<option value=''>No brand data found</option>";
                                                }
                                                ?>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Product Categories</label>
                                    <select id="PCategories" class="form-select" name="PCategories">
                                        <option value="">--</option>
                                        <?php
                                        $db = dbconn();

                                        $sql = "SELECT categories_name,categories_id FROM tbl_categories ORDER BY categories_name ASC";
                                        $result = $db->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $categories_name = $row["categories_name"];
                                                $categories_id = $row["categories_id"];
                                                ?>

                                                <option value='<?= $categories_id ?>'  <?php
                                                if ($row['categories_id'] == @$PCategories) {
                                                    echo 'selected';
                                                }
                                                ?>><?= $categories_name ?></option>;
                                                        <?php
                                                    }
                                                } else {
                                                    echo "<option value=''>No brand data found</option>";
                                                }
                                                ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label">Product Weight</label>
                                    <input type="text" class="form-control" id="PWeight" name="PWeight" value="<?= @$PWeight ?>"> 
                                    <div class="text-danger"><?= @$message['err_PWeight'] ?></div>  <!-- error message -->                        
                                </div>

                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label">Product Warranty</label>
                                    <input type="text" class="form-control" id="PWarranty" name="PWarranty" value="<?= @$PWarranty ?>"> 
                                    <div class="text-danger"><?= @$message['err_PWarranty'] ?></div>  <!-- error message -->                        
                                </div>

                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Product State</label>
                                    <select id="PState" class="form-select" name="PState" >
                                        <option value="">--</option>
                                        <option value="In Stock" <?php
                                        if (@$PState == 'In Stock') {
                                            echo 'selected';
                                        }
                                        ?> >In Stock</option>

                                        <option value="out of stock" <?php
                                        if (@$PState == 'out of stock') {
                                            echo 'selected';
                                        }
                                        ?> >out of stock</option>
                                        <option value="coming soon" <?php
                                        if (@$PState == 'coming soon') {
                                            echo 'selected';
                                        }
                                        ?> >coming soon</option>

                                    </select>
                                </div> 

                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Featured Product</label>
                                    <select id="FProduct" class="form-select" name="FProduct" >
                                        <option value="">--</option>
                                        <option value="Featured" <?php
                                        if (@$FProduct == 'Featured') {
                                            echo 'selected';
                                        }
                                        ?> >Yes</option>

                                        <option value="No" <?php
                                        if (@$FProduct == 'No') {
                                            echo 'selected';
                                        }
                                        ?> >No</option>
                                                                                

                                    </select>
                                </div> 

                                <div class="col-md-12">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea class="form-control" id="Description" name="Description" rows="3"><?= isset($Description) ? $Description : '' ?></textarea>
                                    <div class="text-danger"><?= isset($message['err_Description']) ? $message['err_Description'] : '' ?></div>
                                </div>

                                <div class="col-md-12">
                                    <label for="Overview" class="form-label">Overview</label>
                                    <textarea class="form-control" id="Overview" name="Overview" rows="5"><?= isset($Overview) ? $Overview : '' ?></textarea>
                                    <div class="text-danger"><?= isset($message['err_Overview']) ? $message['err_Overview'] : '' ?></div>
                                </div>

                                <div class="col-md-12">
                                    <label>Upload Product image</label>
                                    <input class="form-control" type="file" name="Productimg">
                                    <div class="text-danger"><?= @$message['error_file'] ?></div>  <!-- error message -->

                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End Multi Columns Form -->

                        </div>
                    </div>
            </div>
        </div>

    </section>


</section>

</main>







<?php
include '../footer.php';
?>