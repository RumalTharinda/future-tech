<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
extract($_POST);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Product spec</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/product/add_spec.php">Manage Product spec</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    $SpecificationProperty = '';
    $SpecificationsValue = '';

    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {


        $SpecificationProperty = dataclean($SpecificationProperty);
        $SpecificationsValue = dataClean($SpecificationsValue);

        $message = array();

        if (empty($SpecificationProperty)) {
            $message['err_SpecificationProperty'] = "The Specification Property should not be blank...!";
        }
        if (empty($SpecificationsValue)) {
            $message['err_SpecificationsValue'] = "The Specifications Value should not be blank...!";
        }



        if (empty($message)) {
            $db = dbconn();
            $sql = "UPDATE tbl_product_specifications SET product_specification_property='$SpecificationProperty',product_specifications_value='$SpecificationsValue' WHERE product_specifications_id='$product_specifications_id'";
            $db->query($sql);

            header("Location:add_spec.php?spec_cate_id=$spec_cate_id");
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_product_specifications WHERE product_specifications_id='$product_specifications_id' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $SpecificationProperty = $row['product_specification_property'];
    $SpecificationsValue = $row['product_specifications_value'];
    ?>




    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Courier</h5>



                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">  





                    <div class="col-md-12">
                        <label for="LastName" class="form-label">Product Specification Property</label>
                        <input type="text" class="form-control" id="SpecificationProperty" name="SpecificationProperty" value="<?= @$SpecificationProperty ?>">
                        <div class="text-danger"><?= @$message['err_SpecificationProperty'] ?></div>  <!-- error message -->
                    </div>                   

                    <div class="col-md-12">
                        <label for="LastName" class="form-label">Product Specifications Value</label>
                        <input type="text" class="form-control" id="SpecificationsValue" name="SpecificationsValue" value="<?= @$SpecificationsValue ?>">
                        <div class="text-danger"><?= @$message['err_SpecificationsValue'] ?></div>  <!-- error message -->
                    </div>                   



                    <div class="text-center">
                      
                        <input type="text" name="product_specifications_id" value="<?= $product_specifications_id ?>">
                        <input type="text" name="spec_cate_id" value="<?= $spec_cate_id ?>">


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