<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/product/add.php">Manage Product</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    $PName = '';
    $PModel = '';
    $PItemCode = '';
    $PWeight = '';
    $PWarranty = '';
    $Description = '';
    $Overview = '';

    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {

        $PName = dataclean($PName);
        $PModel = dataclean($PModel);
        $PItemCode = dataclean($PItemCode);
        $PWeight = dataclean($PWeight);
        $PWarranty = dataclean($PWarranty);
        $Description = dataclean($Description);
        $Overview = dataclean($Overview);

        $message = array();

        if (empty($PName)) {
            $message['err_PName'] = "The Product Name should not be blank...!";
        }
        if (empty($PModel)) {
            $message['err_PModel'] = "The Product Model should not be blank...!";
        }
        if (empty($PItemCode)) {
            $message['err_PItemCode'] = "The Product Item Code should not be blank...!";
        }
        if (empty($PWeight)) {
            $message['err_PWeight'] = "The Product Weight should not be blank...!";
        }
        if (empty($PWarranty)) {
            $message['err_PWarranty'] = "The Product Warranty should not be blank...!";
        }
        if (empty($Description)) {
            $message['err_Description'] = "The Description should not be blank...!";
        }
        if (empty($Overview)) {
            $message['err_Overview'] = "The Overview should not be blank...!";
        }









        if (empty($message)) {
            $db = dbconn();
            $sql = "UPDATE tbl_product SET product_name='$PName',product_model='$PModel',product_item_code='$PItemCode',product_brand='$PBrand',product_categories='$PCategories',product_weight='$PWeight',product_description='".mysqli_real_escape_string($db, $Description)."',product_overview='".mysqli_real_escape_string($db, $Overview)."',product_warranty='$PWarranty',product_states='$PState',product_featured_product='$FProduct' WHERE product_id='$product_id'";
            $db->query($sql);

            header('Location:add.php');
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_product WHERE product_id='$product_id' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $PName = $row['product_name'];
    $PModel = $row['product_model'];
    $PItemCode = $row['product_item_code'];
    $PBrand = $row['product_brand'];
    $PCategories = $row['product_categories'];
    $PWeight = $row['product_weight'];
    $PWarranty = $row['product_warranty'];
    $PState = $row['product_states'];
    $FProduct = $row['product_featured_product'];
    $Description = $row['product_description'];
    $Overview = $row['product_overview'];
    ?>




    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Courier</h5>



                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate enctype="multipart/form-data">  

                    <div class="col-md-12">
                        <label for="inputName5" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="PName" name="PName" value="<?= @$PName ?>"> 
                        <div class="text-danger"><?= @$message['err_PName'] ?></div>  <!-- error message -->                        
                    </div>

                    <div class="col-md-6">
                        <label for="inputName5" class="form-label">Product Model</label>
                        <input type="text" class="form-control" id="PModel" name="PModel" value="<?= @$PModel ?>"> 
                        <div class="text-danger"><?= @$message['err_PModel'] ?></div>  <!-- error message -->                        
                    </div>

                    <div class="col-md-6">
                        <label for="inputName5" class="form-label">Product Item Code</label>
                        <input type="text" class="form-control" id="PItemCode" name="PItemCode" value="<?= @$PItemCode ?>"> 
                        <div class="text-danger"><?= @$message['err_PItemCode'] ?></div>  <!-- error message -->                        
                    </div>

                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Product Brand</label>
                        <select id="PBrand" class="form-select" name="PBrand">
                            <option value="">--</option>
                            <?php
                            $db = dbconn();

                            $sql = "SELECT brand_name, brand_id FROM tbl_brands ORDER BY brand_name ASC";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $brand_name = $row["brand_name"];
                                    $brand_id = $row["brand_id"];
                                    ?>

                                    <option value='<?= $brand_id ?>'  <?php
                            if ($row['brand_id'] == $PBrand) {
                                echo 'selected';
                            }
                                    ?>><?= $brand_name ?></option>;
                                            <?php
                                        }
                                    } else {
                                        echo "<option value=''>No brand data found</option>";
                                    }
                                    ?>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Product Categories</label>
                        <select id="PCategories" class="form-select" name="PCategories">
                            <option value="">--</option>
                            <?php
                            $db = dbconn();

                            $sql = "SELECT categories_name,categories_id FROM tbl_categories ORDER BY categories_name ASC";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $categories_name = $row["categories_name"];
                                    $categories_id = $row["categories_id"];
                                    ?>

                                    <option value='<?= $categories_id ?>'  <?php
                            if ($row['categories_id'] == $PCategories) {
                                echo 'selected';
                            }
                                    ?>><?= $categories_name ?></option>;
                                            <?php
                                        }
                                    } else {
                                        echo "<option value=''>No brand data found</option>";
                                    }
                                    ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="inputName5" class="form-label">Product Weight</label>
                        <input type="text" class="form-control" id="PWeight" name="PWeight" value="<?= @$PWeight ?>"> 
                        <div class="text-danger"><?= @$message['err_PWeight'] ?></div>  <!-- error message -->                        
                    </div>

                    <div class="col-md-6">
                        <label for="inputName5" class="form-label">Product Warranty</label>
                        <input type="text" class="form-control" id="PWarranty" name="PWarranty" value="<?= @$PWarranty ?>"> 
                        <div class="text-danger"><?= @$message['err_PWarranty'] ?></div>  <!-- error message -->                        
                    </div>

                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Product State</label>
                        <select id="PState" class="form-select" name="PState" >
                            <option value="">--</option>
                            <option value="In Stock" <?php
                                    if ($PState == 'In Stock') {
                                        echo 'selected';
                                    }
                                    ?> >In Stock</option>

                            <option value="out of stock" <?php
                            if ($PState == 'out of stock') {
                                echo 'selected';
                            }
                                    ?> >out of stock</option>

                            <option value="coming soon" <?php
                            if ($PState == 'coming soon') {
                                echo 'selected';
                            }
                                    ?> >coming soon</option>

                        </select>
                    </div>
                    
                     <div class="col-md-6">
                                    <label for="inputState" class="form-label">Featured Product</label>
                                    <select id="FProduct" class="form-select" name="FProduct" >
                                        <option value="">--</option>
                                        <option value="Featured" <?php
                                        if (@$FProduct == 'Featured') {
                                            echo 'selected';
                                        }
                                        ?> >Yes</option>

                                        <option value="No" <?php
                                        if (@$FProduct == 'No') {
                                            echo 'selected';
                                        }
                                        ?> >No</option>
                                                                                

                                    </select>
                                </div> 

                    <div class="col-md-12">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control" id="Description" name="Description" rows="3"><?= isset($Description) ? $Description : '' ?></textarea>
                        <div class="text-danger"><?= isset($message['err_Description']) ? $message['err_Description'] : '' ?></div>
                    </div>

                    <div class="col-md-12">
                        <label for="Overview" class="form-label">Overview</label>
                        <textarea class="form-control" id="Overview" name="Overview" rows="5"><?= isset($Overview) ? $Overview : '' ?></textarea>
                        <div class="text-danger"><?= isset($message['err_Overview']) ? $message['err_Overview'] : '' ?></div>
                    </div>










                    <div class="text-center">
                        <input type="hidden" name="product_id" value="<?= $product_id ?>">

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