<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Supplier</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/supplier/add.php">Manage Supplier</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {


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
            $sql = "UPDATE tbl_supplier SET supplier_first_name='$FirstName',supplier_last_name='$LastName',supplier_title='$Title',supplier_company_name='$CompanyName',supplier_company_address_line1='$CompanyAddressLine1',supplier_company_address_line2='$CompanyAddressLine2',supplier_company_address_line3='$CompanyAddressLine3',supplier_mobile='$Mobile',supplier_company_email='$CompanyEmail',supplier_company_phone='$CompanyPhone' WHERE supplier_id='$supplier_id'";
            $db->query($sql);

            header('Location:add.php');
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_supplier WHERE supplier_id='$supplier_id' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $FirstName = $row['supplier_first_name'];
    $LastName = $row['supplier_last_name'];
    $Title = $row['supplier_title'];
    $CompanyName = $row['supplier_company_name'];
    $CompanyAddressLine1 = $row['supplier_company_address_line1'];
    $CompanyAddressLine2 = $row['supplier_company_address_line2'];
    $CompanyAddressLine3 = $row['supplier_company_address_line3'];
    $Mobile = $row['supplier_mobile'];
    $CompanyPhone = $row['supplier_company_phone'];
    $CompanyEmail = $row['supplier_company_email'];
    
    ?>




    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Categories</h5>



                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">  

                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Supplier Title</label>
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
                        <input type="hidden" name="supplier_id" value="<?= $supplier_id ?>">
                       
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