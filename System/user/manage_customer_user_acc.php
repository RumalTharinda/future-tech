<?php
include '../header.php';
include '../menu.php';
?>




 <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'disable') {

        $db = dbconn();
        $sql = "UPDATE tbl_users SET user_status='0' WHERE user_id='$user_id'";
        $db->query($sql);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'able') {

        $db = dbconn();
        $sql = "UPDATE tbl_users SET user_status='1' WHERE user_id='$user_id'";
        $db->query($sql);
    }
    ?>

    <?php
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

    // Construct the SQL query with the search condition for user account name and customer name
    $sql = "SELECT * FROM tbl_customer 
            LEFT JOIN tbl_users ON tbl_users.user_id=tbl_customer.user_id 
            WHERE tbl_users.user_name LIKE '%$search%' 
           
            OR tbl_customer.customer_first_name LIKE '%$search%' 
            OR tbl_customer.customer_last_name LIKE '%$search%'";
} else {
    // Default query to fetch all customers
    $sql = "SELECT * FROM tbl_customer LEFT JOIN tbl_users ON tbl_users.user_id=tbl_customer.user_id";
}

// Handle sorting
if (isset($_GET['sort']) && $_GET['sort'] === 'alphabetical') {
    $sql .= " ORDER BY tbl_users.user_name ASC";
}


$result = $db->query($sql);
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Customer User Account</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Manage Customer User Account</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


   


  

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting Users</h5>


                <!-- Search bar && sorting btn -->
                <form method="GET" action="<?= $_SERVER['PHP_SELF'] ?>" class="datatable-search-form">
                    <div class="datatable-search">
                        <input class="datatable-input" name="search" placeholder="Search..." type="search" title="Search within table" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <button type="submit" class="btn btn-primary" name="sort" value="alphabetical">Sort by (A-Z)</button>
                    </div>
                </form>


                <!-- Table -->
                <div class="datatable-container">
                    <table class="table datatable datatable-table">
                        <thead>
                            <tr>
                                <th data-sortable="true" style="width: 5%">#</th>
                                <th data-sortable="true" style="width: 40%;">User Account Name</th> 
                                <th data-sortable="true" style="width: 50%;">Customer Name</th>
                                <th data-sortable="true" style="width: 5%;">State</th>

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
                                        <td><?= $row['user_name'] ?></td>
                                        <td><?= $row['customer_title'] ?> <?= $row['customer_first_name'] ?> <?= $row['customer_last_name'] ?></td>
                                        <td><?= $row['user_status'] ?></td>

                                        <td>
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                <input type="hidden" name="customer_id" value="<?= $row['customer_id'] ?>"> 
                                                <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                            </form>    
                                        </td>

                                        <td>
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>"> 
                                                <button class="btn btn-primary" type="submit" name="action" value="disable" >Disable</button>
                                            </form>    
                                        </td>

                                        <td>
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>"> 
                                                <button class="btn btn-primary" type="submit" name="action" value="able" >Reinstate</button>
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