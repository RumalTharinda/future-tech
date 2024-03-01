<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Employee</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/Employee/add.php">Manage Employee</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
  

    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {


        $FirstName = dataclean($FirstName);
        $LastName = dataclean($LastName);
        $Email = dataclean($Email);
        $AddressLine1 = dataclean($AddressLine1);
        $AddressLine2 = dataclean($AddressLine2);
        $AddressLine3 = dataclean($AddressLine3);
        $Phone = dataclean($Phone);
        $Mobile = dataclean($Mobile);
        $JobTitle = dataclean($JobTitle);
        

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
       
        if (!empty($Email)) {
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $message['err_email'] = "Invailed Email...!";
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
            $db = dbconn();
            $sql = "UPDATE tbl_employees SET user_id='$user_id',employee_title='$Title',employee_first_name='$FirstName',employee_last_name='$LastName',employee_email='$Email',employee_address_line1='$AddressLine1',employee_address_line2='$AddressLine2',employee_address_line3='$AddressLine3',employee_phone='$Phone',employee_mobile='$Mobile',employee_job_title='$JobTitle' WHERE employee_id='$employee_id'";
            $db->query($sql);

            header('Location:add.php');
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_employees WHERE employee_id='$employee_id' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
    $Title = $row['employee_title'];
    $FirstName = $row['employee_first_name'];
    $LastName = $row['employee_last_name'];
    $Email = $row['employee_email'];
    $AddressLine1 = $row['employee_address_line1'];
    $AddressLine2 = $row['employee_address_line2'];
    $AddressLine3 = $row['employee_address_line3'];
    $Phone = $row['employee_phone'];
    $Mobile= $row['employee_mobile'];
    $JobTitle = $row['employee_job_title'];
    
    ?>




    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Categories</h5>



                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">  

                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Title</label>
                        <select id="Title" class="form-select" name="Title" >
                            <option value="">--</option>
                            <option value="Mr." <?php
                            if (@$Title == 'Mr.') {
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

                  

                    <div class="text-center">
                        <input type="hidden" name="employee_id" value="<?= $employee_id ?>">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <button type="submit" name="action" value="save"  class="btn btn-primary">Submit</button>                                
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
ob_end_flush();
?>