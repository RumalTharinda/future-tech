<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Supplier</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/index.php">Supplier</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage Supplier</h5>

                <?php
                $FirstName = '';
                $LastName = '';
                $CompanyName = '';
                $CompanyAddressLine1 = '';
                $CompanyAddressLine2 = '';
                $CompanyAddressLine3 = '';
                $Mobile = '';
                $CompanyPhone = '';
                $CompanyEmail = '';

                extract($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $FirstName = dataclean($FirstName);
                    $LastName = dataclean($LastName);
                    $CompanyName = dataClean($CompanyName);
                    $CompanyAddressLine1 = dataclean($CompanyAddressLine1);
                    $CompanyAddressLine2 = dataclean($CompanyAddressLine2);
                    $CompanyAddressLine3 = dataclean($CompanyAddressLine3);
                    $Mobile = dataclean($Mobile);
                    $CompanyPhone = dataclean($CompanyPhone);
                    $CompanyEmail = dataclean($CompanyEmail);

                    $message = array();

                    if (empty($FirstName)) {
                        $message['err_Fname'] = "The Frist Name should not be blank...!";
                    }
                    if (empty($LastName)) {
                        $message['err_Lname'] = "The Last Name should not be blank...!";
                    }
                    if (empty($CompanyName)) {
                        $message['err_Cname'] = "The Company Name should not be blank...!";
                    }
                    if (empty($CompanyEmail)) {
                        $message['err_email'] = "The Company Email should not be blank...!";
                    }
                    if (empty($CompanyAddressLine1)) {
                        $message['err_AddLine1'] = "The Address Line 1 should not be blank...!";
                    }
                    if (empty($CompanyAddressLine2)) {
                        $message['err_AddLine2'] = "The Address Line 2 should not be blank...!";
                    }
                    if (empty($CompanyAddressLine3)) {
                        $message['err_AddLine3'] = "The Address Line 3 should not be blank...!";
                    }
                    if (empty($CompanyPhone)) {
                        $message['err_phone'] = "The Phone number should not be blank...!";
                    }
                    if (empty($Mobile)) {
                        $message['err_mobile'] = "The Mobile number should not be blank...!";
                    }


                    if (!empty($CompanyEmail)) {
                        if (!filter_var($CompanyEmail, FILTER_VALIDATE_EMAIL)) {
                            $message['err_email'] = "Invailed Email...!";
                        }
                    }

                    if (!empty($FirstName) && !empty($LastName)) {
                        $db = dbconn();
                        $sql = "SELECT * FROM tbl_supplier WHERE supplier_first_name='$FirstName' AND supplier_last_name='$LastName'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            $message['err_Fname'] = "The Name Already exists...!";
                            $message['err_Lname'] = "The Name Already exists...!";
                        }
                    }

                    if (!empty($Mobile)) {
                        $valid = validateNumber($Mobile);
                        if (!$valid) {
                            $message['err_mobile'] = "Invalid Mobile...!";
                        }
                    }

                    if (!empty($CompanyPhone)) {
                        $valid = validateNumber($CompanyPhone);
                        if (!$valid) {
                            $message['err_phone'] = "Invalid Mobile...!";
                        }
                    }



                    if (empty($message)) {
                        $db = dbconn();
                        $sql = "INSERT INTO tbl_supplier(supplier_first_name,supplier_last_name,supplier_title,supplier_company_name,supplier_company_address_line1,supplier_company_address_line2,supplier_company_address_line3,supplier_mobile,supplier_company_phone,supplier_company_email)VALUES('$FirstName','$LastName','$Title','$CompanyName','$CompanyAddressLine1','$CompanyAddressLine2','$CompanyAddressLine3','$Mobile','$CompanyPhone','$CompanyEmail')";
                        $db->query($sql);

                        // Display successfully added! message //
                        echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New supplier successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';

                        // Clear the supplier field //

                        $FirstName = '';
                        $LastName = '';
                        $CompanyName = '';
                        $CompanyAddressLine1 = '';
                        $CompanyAddressLine2 = '';
                        $CompanyAddressLine3 = '';
                        $Mobile = '';
                        $CompanyPhone = '';
                        $CompanyEmail = '';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
                    $db = dbconn();
                    $sql = "DELETE FROM tbl_supplier WHERE supplier_id='$supplier_id' ";
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
                    $sql = "SELECT * FROM tbl_supplier WHERE supplier_first_name LIKE '%$search%' OR supplier_last_name LIKE '%$search%' OR supplier_company_name LIKE '%$search%'";
                } else {
                    // Default query to fetch all stock items
                    $sql = "SELECT * FROM tbl_supplier";
                }

                // Handle sorting
                if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
                    $sql .= " ORDER BY supplier_first_name ASC";
                }

                $result = $db->query($sql);
                ?>

                <section class="section">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Exciting Supplier</h5>


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
                                            <th data-sortable="true" style="width: 20.919708029197082%;">Supplier Name</th>
                                            <th data-sortable="true" style="width: 14.77372262773723%;">Supplier's Company Name</th>
                                            <th data-sortable="true" style="width: 9.306569343065693%;">Supplier's Company Email</th>
                                            <th data-sortable="true" style="width: 9.306569343065693%;">Supplier's Company Phone</th>
                                            <th data-sortable="true" style="width: 9.306569343065693%;">Supplier's Mobile</th>
                                            <th data-sortable="true" aria-sort="descending" class="datatable-descending" style="width: 19.34306569343066%;">Supplier's Company Address</th>
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
                                                    <td><?= $row['supplier_title'] ?> <?= $row['supplier_first_name'] ?> <?= $row['supplier_last_name'] ?></td>
                                                    <td><?= $row['supplier_company_name'] ?></td>
                                                    <td><?= $row['supplier_company_email'] ?></td>
                                                    <td><?= $row['supplier_company_phone'] ?></td>
                                                    <td><?= $row['supplier_mobile'] ?></td>
                                                    <td><?= $row['supplier_company_address_line1'] ?> <?= $row['supplier_company_address_line2'] ?> <?= $row['supplier_company_address_line3'] ?></td>
                                                    <td>
                                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                            <input type="hidden" name="supplier_id" value="<?= $row['supplier_id'] ?>"> 
                                                            <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="supplier_id" value="<?= $row['supplier_id'] ?>"> 
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
            <h5 class="card-title">New Supplier</h5>


            <!-- Multi Columns Form -->  

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>

                <div class="col-md-4">
                    <label for="inputState" class="form-label">Supplier Title</label>
                    <select id="Title" class="form-select" name="Title" >
                        <option value="">--</option>
                        <option value="Mr." <?php
                        if (@$Title == 'available') {
                            echo 'selected';
                        }
                        ?>>Mr.</option>
                        <option value="Mis." <?php
                        if (@$Title == 'Mis.') {
                            echo 'selected';
                        }
                        ?>>Mis.</option>
                        <option value="Miss." <?php
                        if (@$Title == 'Miss.') {
                            echo 'selected';
                        }
                        ?>>Miss.</option>
                        <option value="Dr." <?php
                        if (@$Title == 'Dr.') {
                            echo 'selected';
                        }
                        ?>>Dr.</option>
                        <option value="Prof." <?php
                        if (@$Title == 'Prof.') {
                            echo 'selected';
                        }
                        ?>>Prof.</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="FirstName" class="form-label">Supplier First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?= @$FirstName ?>">
                    <div class="text-danger"><?= @$message['err_Fname'] ?></div>  <!-- error message -->
                </div>

                <div class="col-md-12">
                    <label for="LastName" class="form-label">Supplier Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" value="<?= @$LastName ?>">
                    <div class="text-danger"><?= @$message['err_Lname'] ?></div>  <!-- error message -->
                </div>                   

                <div class="col-md-12">
                    <label for="LastName" class="form-label">Supplier's Company Name</label>
                    <input type="text" class="form-control" id="CompanyName" name="CompanyName" value="<?= @$CompanyName ?>">
                    <div class="text-danger"><?= @$message['err_Cname'] ?></div>  <!-- error message -->
                </div>                   

                <div class="col-12">
                    <label for="inputAddress" class="form-label">Supplier's Company Address</label>

                    <input type="text" class="form-control" id="CompanyAddressLine1" name="CompanyAddressLine1" placeholder="Line1" value="<?= @$CompanyAddressLine1 ?>">
                    <div class="text-danger"><?= @$message['err_AddLine1'] ?></div>  <!-- error message -->

                    <input type="text" class="form-control" id="CompanyAddressLine2" name="CompanyAddressLine2" placeholder="Line2" value="<?= @$CompanyAddressLine2 ?>">
                    <div class="text-danger"><?= @$message['err_AddLine2'] ?></div>  <!-- error message -->

                    <input type="text" class="form-control" id="CompanyAddressLine3" name="CompanyAddressLine3" placeholder="Line3" value="<?= @$CompanyAddressLine3 ?>">
                    <div class="text-danger"><?= @$message['err_AddLine3'] ?></div>  <!-- error message -->

                </div>

                <div class="col-md-12">
                    <label for="Email" class="form-label">Supplier's Company Email</label>
                    <input type="email" class="form-control" id="CompanyEmail" name="CompanyEmail" value="<?= @$CompanyEmail ?>">
                    <div class="text-danger"><?= @$message['err_email'] ?></div>  <!-- error message -->
                </div>

                <div class="col-md-6">
                    <label for="inputPhone" class="form-label">Supplier's Company Phone</label>
                    <input type="text" class="form-control" id="CompanyPhone" name="CompanyPhone" value="<?= @$CompanyPhone ?>">
                    <div class="text-danger"><?= @$message['err_phone'] ?></div>  <!-- error message -->
                </div>

                <div class="col-md-6">
                    <label for="inputMobile" class="form-label">Supplier's Mobile</label>
                    <input type="text" class="form-control" id="Mobile" name="Mobile" value="<?= @$Mobile ?>">
                    <div class="text-danger"><?= @$message['err_mobile'] ?></div>  <!-- error message -->
                </div>                


                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End Multi Columns Form -->

        </div>
    </div>

</section>

</main>

<?php
include '../footer.php';
?>