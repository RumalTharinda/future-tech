<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Customer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/index.php">Customer</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">New Customer</h5>

                <?php
                $FirstName = '';
                $LastName = '';
                $Email = '';
                $AddressLine1 = '';
                $AddressLine2 = '';
                $AddressLine3 = '';
                $Phone = '';
                $Mobile = '';
                
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
                            $sql = "SELECT * FROM tbl_customer WHERE customer_email='$Email'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $message['err_email'] = "The Email Already exist...!";
                            }
                        }
                    }

                    if (!empty($UserName)) {

                        $db = dbconn();
                        $sql = "SELECT * FROM tbl_users WHERE user_name='$UserName'";
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
                        $sql = "INSERT INTO tbl_users(user_name,user_password,user_status) VALUES('$UserName','$Password','1')";
                        $db->query($sql);
                        $userid = $db->insert_id;
                        $sql = "INSERT INTO tbl_customer(user_id,customer_first_name,customer_last_name,customer_title,customer_address_line1,customer_address_line2,customer_address_line3,customer_mobile,customer_phone,customer_email) VALUES('$userid','$FirstName','$LastName','$Title','$AddressLine1','$AddressLine2','$AddressLine3','$Mobile','$Phone','$Email')";
                        $db->query($sql);

                        // Display successfully added! message //
                        echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New Customer successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';
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
                       
                        $UserName = '';
                        $Password = '';
                    }
                }
                ?>

                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>

                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Title</label>
                        <select id="Title" class="form-select" name="Title" >
                           <option value="">--</option>
                            <option value="Mr." <?php
                            if ($Title == 'available') {
                                echo 'selected';
                            }
                            ?>>Mr.</option>
                            <option value="Mis." <?php
                            if ($Title == 'Mis.') {
                                echo 'selected';
                            }
                            ?>>Mis.</option>
                            <option value="Miss." <?php
                            if ($Title == 'Miss.') {
                                echo 'selected';
                            }
                            ?>>Miss.</option>
                            <option value="Dr." <?php
                            if ($Title == 'Dr.') {
                                echo 'selected';
                            }
                            ?>>Dr.</option>
                            <option value="Prof." <?php
                            if ($Title == 'Prof.') {
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