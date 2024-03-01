<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Employee</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/index.php">Employee</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage Employee</h5>

                <?php
                $FirstName = '';
                $LastName = '';
                $Email = '';
                $AddressLine1 = '';
                $AddressLine2 = '';
                $AddressLine3 = '';
                $Phone = '';
                $Mobile = '';
                $JobTitle = '';
                $UserName = '';
                $Password = '';

                extract($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $FirstName = dataclean($FirstName);
                    $LastName = dataclean($LastName);
                    $Email = dataclean($Email);
                    $AddressLine1 = dataclean($AddressLine1);
                    $AddressLine2 = dataclean($AddressLine2);
                    $AddressLine3 = dataclean($AddressLine3);
                    $Phone = dataclean($Phone);
                    $Mobile = dataclean($Mobile);
                    $JobTitle = dataclean($JobTitle);
                    $UserName = dataclean($UserName);
                    $Password = dataclean($Password);

                    $message = array();

                    if (empty($FirstName)) {
                        $message['err_Fname'] = "The Frist Name should not be blank...!";
                    }
                    if (empty($LastName)) {
                        $message['err_Lname'] = "The Last Name should not be blank...!";
                    }
                    if (empty($Email)) {
                        $message['err_email'] = "The Email should not be blank...!";
                    }
                    if (empty($AddressLine1)) {
                        $message['err_AddLine1'] = "The Address Line 1 should not be blank...!";
                    }
                    if (empty($AddressLine2)) {
                        $message['err_AddLine2'] = "The Address Line 2 should not be blank...!";
                    }
                    if (empty($AddressLine3)) {
                        $message['err_AddLine3'] = "The Address Line 3 should not be blank...!";
                    }
                    if (empty($Phone)) {
                        $message['err_phone'] = "The Phone number should not be blank...!";
                    }
                    if (empty($Mobile)) {
                        $message['err_mobile'] = "The Mobile number should not be blank...!";
                    }
                    if (empty($JobTitle)) {
                        $message['err_job'] = "The Job Title should not be blank...!";
                    }
                    if (empty($UserName)) {
                        $message['err_username'] = "The User Name should not be blank...!";
                    }
                    if (empty($Password)) {
                        $message['err_password'] = "The Password should not be blank...!";
                    }

                    if (!empty($Email)) {
                        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                            $message['err_email'] = "Invailed Email...!";
                        } else {
                            $db = dbconn();
                            $sql = "SELECT * FROM tbl_employees WHERE employee_email='$Email'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $message['err_email'] = "The Email Already exist...!";
                            }
                        }
                    }

                    if (!empty($UserName)) {

                        $db = dbconn();
                        $sql = "SELECT * FROM tbl_users WHERE 	user_name='$UserName'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            $message['err_username'] = "The User Name Already exist...!";
                        }
                    }

                    if (!empty($Password)) {
                        $valid = validatePasswordStrength($Password);
                        if (!$valid) {
                            $message['err_password'] = "Invalid Password...!";
                        }
                    }

                    if (!empty($Mobile)) {
                        $valid = validateNumber($Mobile);
                        if (!$valid) {
                            $message['err_mobile'] = "Invalid Mobile Number...!";
                        }
                    }

                    if (!empty($Phone)) {
                        $valid = validateNumber($Phone);
                        if (!$valid) {
                            $message['err_phone'] = "Invalid Phone Number...!";
                        }
                    }



                    if (empty($message)) {
                        $Password = sha1($Password); //increption algo//
                        $db = dbconn();
                        $sql = "INSERT INTO tbl_users(user_name,user_password,user_status,user_role) VALUES('$UserName','$Password','1','$JobTitle')";
                        $db->query($sql);
                        $userid = $db->insert_id;
                        $sql = "INSERT INTO tbl_employees(user_id,employee_first_name,employee_last_name,employee_title,employee_address_line1,employee_address_line2,employee_address_line3,employee_mobile,employee_phone,employee_email,employee_job_title) VALUES('$userid','$FirstName','$LastName','$Title','$AddressLine1','$AddressLine2','$AddressLine3','$Mobile','$Phone','$Email','$JobTitle')";
                        $db->query($sql);

                        // Display successfully added! message //
                        echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New User successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';
                        //echo '<div class="alert alert-success" role="alert">Brand successfully added! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        // Clear the BrandName field //

                        $FirstName = '';
                        $LastName = '';
                        $Email = '';
                        $AddressLine1 = '';
                        $AddressLine2 = '';
                        $AddressLine3 = '';
                        $Phone = '';
                        $Mobile = '';
                        $JobTitle = '';
                        $UserName = '';
                        $Password = '';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
                    $db = dbconn();
                    $sql = "DELETE FROM tbl_employees WHERE employee_id='$employee_id' ";
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
                    $sql = "SELECT * FROM tbl_employees WHERE employee_first_name LIKE '%$search%' OR employee_last_name  LIKE '%$search%' OR employee_title LIKE '%$search%' OR employee_job_title LIKE '%$search%'";
                } else {
                    // Default query to fetch all stock items
                    $sql = "SELECT * FROM tbl_employees";
                }

                // Handle sorting
                if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
                    $sql .= " ORDER BY employee_first_name ASC";
                }

                $result = $db->query($sql);
                ?>

                <section class="section">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Exciting Employees</h5>




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
                                            <th data-sortable="true" style="width: 27.919708029197082%;">Name</th>
                                            <th data-sortable="true" style="width: 20.77372262773723%;">Position</th>
                                            <th data-sortable="true" style="width: 10.77372262773723%;">User ID</th>
                                            <th data-sortable="true" style="width: 9.306569343065693%;">Phone</th>
                                            <th data-sortable="true" aria-sort="descending" class="datatable-descending" style="width: 26.34306569343066%;">Email</th>
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
                                                    <td><?= $row['employee_title'] ?> <?= $row['employee_first_name'] ?> <?= $row['employee_last_name'] ?></td>
                                                    <td><?= $row['employee_job_title'] ?></td>
                                                    <td><?= $row['user_id'] ?></td>
                                                    <td><?= $row['employee_phone'] ?></td>
                                                    <td><?= $row['employee_email'] ?></td>
                                                    <td>
                                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                            <input type="hidden" name="employee_id" value="<?= $row['employee_id'] ?>"> 
                                                            <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="employee_id" value="<?= $row['employee_id'] ?>"> 
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
                            <div class="datatable-bottom">
                                <div class="datatable-info">Showing 1 to 5 of 5 entries</div>
                                <nav class="datatable-pagination"><ul class="datatable-pagination-list"></ul></nav>
                            </div></div>
                        <!-- End Table with stripped rows -->

                    </div>
            </div>

    </section>


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">New Employee</h5>








            <!-- Multi Columns Form -->  

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>

                <div class="col-md-4">
                    <label for="inputState" class="form-label">Title</label>
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
                    <label for="FirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?= @$FirstName ?>">
                    <div class="text-danger"><?= @$message['err_Fname'] ?></div>  <!-- error message -->
                </div>

                <div class="col-md-12">
                    <label for="LastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" value="<?= @$LastName ?>">
                    <div class="text-danger"><?= @$message['err_Lname'] ?></div>  <!-- error message -->
                </div>



                <div class="col-md-12">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" value="<?= @$Email ?>">
                    <div class="text-danger"><?= @$message['err_email'] ?></div>  <!-- error message -->
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>

                    <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" placeholder="Line1" value="<?= @$AddressLine1 ?>">
                    <div class="text-danger"><?= @$message['err_AddLine1'] ?></div>  <!-- error message -->

                    <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" placeholder="Line2" value="<?= @$AddressLine2 ?>">
                    <div class="text-danger"><?= @$message['err_AddLine2'] ?></div>  <!-- error message -->

                    <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" placeholder="Line3" value="<?= @$AddressLine3 ?>">
                    <div class="text-danger"><?= @$message['err_AddLine3'] ?></div>  <!-- error message -->
                </div>

                <div class="col-md-6">
                    <label for="inputPhone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="Phone" name="Phone" value="<?= @$Phone ?>">
                    <div class="text-danger"><?= @$message['err_phone'] ?></div>  <!-- error message -->
                </div>

                <div class="col-md-6">
                    <label for="inputMobile" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="Mobile" name="Mobile" value="<?= @$Mobile ?>">
                    <div class="text-danger"><?= @$message['err_mobile'] ?></div>  <!-- error message -->
                </div>

                <div class="col-4">
                    <label for="Job" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="JobTitle" name="JobTitle" value="<?= @$JobTitle ?>">
                    <div class="text-danger"><?= @$message['err_job'] ?></div>  <!-- error message -->
                </div>

                <div class="col-md-12">
                    <label for="FirstName" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="UserName" name="UserName" value="<?= @$UserName ?>">
                    <div class="text-danger"><?= @$message['err_username'] ?></div>  <!-- error message -->
                </div>

                <div class="col-md-12">
                    <label for="LastName" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" name="Password" value="<?= @$Password ?>">
                    <div class="text-danger"><?= @$message['err_password'] ?></div>  <!-- error message -->
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