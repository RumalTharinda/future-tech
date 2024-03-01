<?php
ob_start();
extract($_GET);


include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Brands</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/Brands/add.php">Manage Brands</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
     

    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {


        $BrandName = dataclean($BrandName);

        $message = array();

         if (empty($BrandName)) {
                        $message['err_brandname'] = "The Brand Name should not be blank...!";
                    }





        if (empty($message)) {
            $db = dbconn();
            $sql = "UPDATE tbl_brands SET brand_id='$brand_id',brand_name='$BrandName' WHERE brand_id='$brand_id'";
            $db->query($sql);

            header('Location:add.php');
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_brands WHERE brand_id='$brand_id' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $BrandName = $row['brand_name'];
    
    ?>




    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Brand</h5>



                <!-- Multi Columns Form -->  

                 <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">  

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Brand Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="BrandName" name="BrandName" value="<?= @$BrandName ?>">
                                    <div class="text-danger"><?= @$message['err_brandname'] ?></div>  <!-- error message -->
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="hidden" name="brand_id" value="<?= $brand_id ?>">
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