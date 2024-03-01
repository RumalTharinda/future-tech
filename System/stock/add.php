<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Stock</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/index.php">Stock</a></li>
                <li class="breadcrumb-item active">Manage</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage Stock</h5>

                <?php
                $DateOfPurchase = '';
                $UnitePrice = '';
                $Quantity = '';
                $SalePrice = '';
                $Discount = '';

                extract($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {


                    $DateOfPurchase = dataclean($DateOfPurchase);
                    $UnitePrice = dataClean($UnitePrice);
                    $Quantity = dataclean($Quantity);
                    $SalePrice = dataclean($SalePrice);
                    $Discount = dataclean($Discount);

                    $message = array();

                    if (empty($DateOfPurchase)) {
                        $message['err_DateOfPurchase'] = "The Date Of Purchase should not be blank...!";
                    }
                    if (empty($UnitePrice)) {
                        $message['err_UnitePrice'] = "The Unite Price should not be blank...!";
                    }
                    if (empty($Quantity)) {
                        $message['err_Quantity'] = "The Quantity should not be blank...!";
                    }

                    if (empty($SalePrice)) {
                        $message['err_SalePrice'] = "The Sale Price should not be blank...!";
                    }


                    if (!empty($UnitePrice)) {
                        $valid = validateNumber($UnitePrice);
                        if (!$valid) {
                            $message['err_UnitePrice'] = "Invalid Unite Price...!";
                        }
                    }

                    if (!empty($SalePrice)) {
                        $valid = validateNumber($SalePrice);
                        if (!$valid) {
                            $message['err_SalePrice'] = "Invalid Sale Price...!";
                        }
                    }

                    if (!empty($Quantity)) {
                        $valid = validateNumber($Quantity);
                        if (!$valid) {
                            $message['err_Quantity'] = "Invalid Quantity Price...!";
                        }
                    }



                    if (empty($message)) {
                        $db = dbconn();
                        $sql = "INSERT INTO tbl_stock(product_id,supplier_id,stock_purchase_date,stock_unite_price,stock_quantity,stock_sale_price,stock_discount)VALUES('$PName','$SName','$DateOfPurchase','$UnitePrice','$Quantity','$SalePrice','$Discount')";
                        $db->query($sql);

                        // Display successfully added! message //
                        echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New Stock successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';

                        // Clear the BrandName field //


                        $DateOfPurchase = '';
                        $UnitePrice = '';
                        $Quantity = '';
                        $SalePrice = '';
                        $Discount = '';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
                    $db = dbconn();
                    $sql = "DELETE FROM tbl_stock WHERE stock_id ='$stock_id ' ";
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
                    $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id WHERE tbl_product.product_name LIKE '%$search%'";
                } else {
                    // Default query to fetch all stock items
                    $sql = "SELECT * FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id";
                }

                // Handle sorting
                if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
                    $sql .= " ORDER BY tbl_product.product_name ASC";
                }

                $result = $db->query($sql);
                ?>






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


                            <div class="datatable-container">
                                <table class="table datatable datatable-table">
                                    <thead>
                                        <tr>
                                            <th data-sortable="true" style="width: 5.656934306569343">#</th>
                                            <th data-sortable="true" style="width: 22.919708029197082%;">Product Name</th>
                                            <th data-sortable="true" style="width: 15.77372262773723%;">Stock purchase date</th>
                                            <th data-sortable="true" style="width: 13.77372262773723%;">Stock unite price</th>
                                            <th data-sortable="true" style="width: 9.306569343065693%;">Stock quantity</th>
                                            <th data-sortable="true" style="width: 13.306569343065693%;">Stock sale price</th>
                                            <th data-sortable="true" aria-sort="descending" class="datatable-descending" style="width: 10.34306569343066%;">Stock discount</th>
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
                                                    <td><?= $row['product_name'] ?> </td>
                                                    <td><?= $row['stock_purchase_date'] ?></td>
                                                    <td>Rs:<?= number_format($row['stock_unite_price']) ?></td>
                                                    <td><?= $row['stock_quantity'] ?></td>
                                                    <td>Rs:<?= number_format($row['stock_sale_price']) ?></td>
                                                    <td><?= $row['stock_discount'] ?>%</td>

                                                    <td>
                                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                            <input type="hidden" name="stock_id" value="<?= $row['stock_id'] ?>"> 
                                                            <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="stock_id" value="<?= $row['stock_id'] ?>"> 
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



                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Stock</h5>

                        <!-- Multi Columns Form -->  

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>

                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Product Name</label>
                                <select id="PName" class="form-select" name="PName">
                                    <option value="">--</option>
                                    <?php
                                    $db = dbconn();

                                    $sql = "SELECT * FROM tbl_product ORDER BY product_name ASC";
                                    $result = $db->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $product_id = $row["product_id"];
                                            $product_name = $row['product_name'];
                                            ?>
                                            <option value='<?= $product_id ?>' <?php
                                            if ($row['product_id'] == @$PName) {
                                                echo 'selected';
                                            }
                                            ?>><?= $product_name ?></option>;
                                                    <?php
                                                }
                                            } else {
                                                echo "<option value=''>No categorie data found</option>";
                                            }
                                            ?>

                                </select>
                            </div>


                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Supplier Name</label>
                                <select id="SName" class="form-select" name="SName">
                                    <option value="">--</option>
                                    <?php
                                    $db = dbconn();

                                    $sql = "SELECT * FROM tbl_supplier ORDER BY supplier_company_name ASC";
                                    $result = $db->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $supplier_id = $row["supplier_id"];
                                            $supplier_company_name = $row['supplier_company_name'];
                                            ?>
                                            <option value='<?= $supplier_id ?>' <?php
                                            if ($row['supplier_id'] == @$SName) {
                                                echo 'selected';
                                            }
                                            ?>><?= $supplier_company_name ?></option>;
                                                    <?php
                                                }
                                            } else {
                                                echo "<option value=''>No categorie data found</option>";
                                            }
                                            ?>

                                </select>
                            </div>



                            <div class="col-md-12">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date Of Purchase</label>
                                <input type="date" class="form-control" id="DateOfPurchase" name="DateOfPurchase" value="<?= @$DateOfPurchase ?>">
                                <div class="text-danger"><?= @$message['err_DateOfPurchase'] ?></div>  <!-- error message -->
                            </div>


                            <div class="col-md-12">
                                <label for="LastName" class="form-label">Unite Price Rs:</label>
                                <input type="text" class="form-control" id="UnitePrice" name="UnitePrice" value="<?= @$UnitePrice ?>">
                                <div class="text-danger"><?= @$message['err_UnitePrice'] ?></div>  <!-- error message -->
                            </div>                   

                            <div class="col-md-12">
                                <label for="LastName" class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="Quantity" name="Quantity" value="<?= @$Quantity ?>">
                                <div class="text-danger"><?= @$message['err_Quantity'] ?></div>  <!-- error message -->
                            </div>                   



                            <div class="col-md-12">
                                <label for="Email" class="form-label">Sale Price Rs:</label>
                                <input type="email" class="form-control" id="SalePrice" name="SalePrice" value="<?= @$SalePrice ?>">
                                <div class="text-danger"><?= @$message['err_SalePrice'] ?></div>  <!-- error message -->
                            </div>

                            <div class="col-md-6">
                                <label for="inputPhone" class="form-label">Discount</label>
                                <input type="text" class="form-control" id="Discount" name="Discount" value="<?= @$Discount ?>">
                                <div class="text-danger"><?= @$message['err_Discount'] ?></div>  <!-- error message -->
                            </div>



                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

                </section>

            </div>
        </div>

    </section>

</main>

<?php
include '../footer.php';
?>