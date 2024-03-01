<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
 extract($_POST);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit spec category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/product/add_spec_name.php?productid=<?= $productid?>">Manage Product spec</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    
    
    $spec_cate_name = '';
     
     
   extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {


         $spec_cate_name = dataClean($spec_cate_name);

        $message = array();

        if (empty($spec_cate_name)) {
            $message['err_spec_cate_name'] = "The spec_cate_name should not be blank...!";
        }



        if (empty($message)) {
            
            
            $db = dbconn();
         echo   $sql = "UPDATE tbl_spec_cate SET spec_cate_name='$spec_cate_name' WHERE spec_cate_id='$spec_cate_id'";
            $db->query($sql);
            

           header("Location:add_spec_name.php?productid=$product_id");
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_spec_cate LEFT JOIN tbl_product ON tbl_product.product_id=tbl_spec_cate.product_id WHERE spec_cate_id='$spec_cate_id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $spec_cate_name = $row['spec_cate_name'];
    $productid = $row['product_id']
   
    ?>




    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Courier</h5>



                <!-- Multi Columns Form -->  
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">  





                    <div class="col-md-12">
                        <label for="spec_cate_name" class="form-label"> Product Specification Categories </label>
                        <input type="text" class="form-control" id="spec_cate_name" name="spec_cate_name" value="<?= @$spec_cate_name ?>">
                        <div class="text-danger"><?= @$message['err_spec_cate_name'] ?></div>  <!-- error message -->
                    </div>                 



                    <div class="text-center">
                      
                        <input type="text" name="spec_cate_id" value="<?= $spec_cate_id ?>">
                        <input type="text" name="product_id" value="<?= $productid ?>">

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