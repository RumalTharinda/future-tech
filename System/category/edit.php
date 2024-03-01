<?php
ob_start();
extract($_GET);


include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Categories</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/Brands/add.php">Manage Categories</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
     

    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {


         $CategoryName = dataclean($CategoryName);

        $message = array();

         
                    if (empty($CategoryName)) {
                        $message['err_categoryname'] = "The Category Name should not be blank...!";
                    }




        if (empty($message)) {
            $db = dbconn();
            $sql = "UPDATE tbl_categories SET categories_id='$categories_id',brand_name='$CategoryName' WHERE categories_id='$categories_id'";
            $db->query($sql);

            header('Location:add.php');
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_categories WHERE categories_id='$categories_id' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $CategoryName = $row['categories_name'];
    
    ?>




    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Categories</h5>



                <!-- Multi Columns Form -->  

                 <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">  

                            <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="CategoryName" name="CategoryName" value="<?= @$CategoryName ?>">
                                        <div class="text-danger"><?= @$message['err_categoryname'] ?></div>  <!-- error message -->
                                    </div>
                                </div>

                            <div class="text-center">
                                <input type="hidden" name="categories_id" value="<?= $categories_id ?>">
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