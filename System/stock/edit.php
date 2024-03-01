<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Stock</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/stock/add.php">Manage Stock</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    $DateOfPurchase = '';
    $UnitePrice = '';
    $Quantity = '';
    $SalePrice = '';
    $Discount = '';

    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {

        $DateOfPurchase = dataclean($DateOfPurchase);
        $UnitePrice = dataClean($UnitePrice);
        $Quantity = dataclean($Quantity);
        $SalePrice = dataclean($SalePrice);
        $Discount = dataclean($Discount);

        $message = array();

        if (empty($DateOfPurchase)) {
            $message['err_DateOfPurchase'] = "The Date Of Purchase should not be blank...!";
        }
        if (empty($UnitePrice)) {
            $message['err_UnitePrice'] = "The Unite Price should not be blank...!";
        }
        if (empty($Quantity)) {
            $message['err_Quantity'] = "The Quantity should not be blank...!";
        }
     
        if (empty($SalePrice)) {
            $message['err_SalePrice'] = "The Sale Price should not be blank...!";
        }


        if (!empty($UnitePrice)) {
            $valid = validateNumber($UnitePrice);
            if (!$valid) {
                $message['err_UnitePrice'] = "Invalid Unite Price...!";
            }
        }

        if (!empty($SalePrice)) {
            $valid = validateNumber($SalePrice);
            if (!$valid) {
                $message['err_SalePrice'] = "Invalid Sale Price...!";
            }
        }

        if (!empty($Quantity)) {
            $valid = validateNumber($Quantity);
            if (!$valid) {
                $message['err_Quantity'] = "Invalid Quantity Price...!";
            }
        }



        if (empty($message)) {
            $db = dbconn();
            $sql = "UPDATE tbl_stock SET product_id='$PName',supplier_id='$SName',stock_purchase_date='$DateOfPurchase',stock_unite_price='$UnitePrice',stock_quantity='$Quantity',stock_sale_price='$SalePrice',stock_discount='$Discount' WHERE stock_id='$stock_id'";
            $db->query($sql);

            header('Location:add.php');
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_stock WHERE stock_id='$stock_id' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $PName = $row['product_id'];
    $SName = $row['supplier_id'];
    $DateOfPurchase = $row['stock_purchase_date'];
    $UnitePrice = $row['stock_unite_price'];
    $Quantity = $row['stock_quantity'];
    $SalePrice = $row['stock_sale_price'];
    $Discount = $row['stock_discount'];
    
    ?>




    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Courier</h5>



                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">  

                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Product Name</label>
                        <select id="PName" class="form-select" name="PName">
                            <option value="">--</option>
                           <?php
                            $db = dbconn();


                            $sql = "SELECT * FROM tbl_product ORDER BY product_name ASC"; 
                            $result = $db->query($sql);


                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $product_id = $row["product_id"];
                                    $product_name = $row['product_name'];
                                    ?>
                                    <option value='<?= $product_id ?>' <?php
                            if ($row['product_id'] == $PName) {
                                echo 'selected';
                            }
                                    ?>><?= $product_name ?></option>;
                                            <?php
                                        }
                                    } else {
                                        echo "<option value=''>No categorie data found</option>";
                                    }
                                    ?>

                        </select>
                    </div>
                    
                    <div class="col-md-6">
                                <label for="inputState" class="form-label">Supplier Name</label>
                                <select id="SName" class="form-select" name="SName">
                                    <option value="">--</option>
                                   <?php
                            $db = dbconn();

                            $sql = "SELECT * FROM tbl_supplier ORDER BY supplier_company_name ASC"; 
                            $result = $db->query($sql);


                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $supplier_id = $row["supplier_id"];
                                    $supplier_company_name = $row['supplier_company_name'];
                                    ?>
                                    <option value='<?= $supplier_id  ?>' <?php
                            if ($row['supplier_id'] == @$SName) {
                                echo 'selected';
                            }
                                    ?>><?= $supplier_company_name ?></option>;
                                            <?php
                                        }
                                    } else {
                                        echo "<option value=''>No categorie data found</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                    

                    <div class="col-md-12">
                        <label for="inputDate" class="col-sm-2 col-form-label">Date Of Purchase</label>
                        <input type="date" class="form-control" id="DateOfPurchase" name="DateOfPurchase" value="<?= @$DateOfPurchase ?>">
                        <div class="text-danger"><?= @$message['err_DateOfPurchase'] ?></div>  <!-- error message -->
                    </div>


                    <div class="col-md-12">
                        <label for="LastName" class="form-label">Unite Price Rs:</label>
                        <input type="text" class="form-control" id="UnitePrice" name="UnitePrice" value="<?= @$UnitePrice ?>">
                        <div class="text-danger"><?= @$message['err_UnitePrice'] ?></div>  <!-- error message -->
                    </div>                   

                    <div class="col-md-12">
                        <label for="LastName" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="Quantity" name="Quantity" value="<?= @$Quantity ?>">
                        <div class="text-danger"><?= @$message['err_Quantity'] ?></div>  <!-- error message -->
                    </div>                   



                    <div class="col-md-12">
                        <label for="text" class="form-label">Sale Price Rs:</label>
                        <input type="text" class="form-control" id="SalePrice" name="SalePrice" value="<?= @$SalePrice ?>">
                        <div class="text-danger"><?= @$message['err_SalePrice'] ?></div>  <!-- error message -->
                    </div>

                    <div class="col-md-6">
                        <label for="inputPhone" class="form-label">Discount</label>
                        <input type="text" class="form-control" id="Discount" name="Discount" value="<?= @$Discount ?>">
                        <div class="text-danger"><?= @$message['err_Discount'] ?></div>  <!-- error message -->
                    </div>



                    <div class="text-center">
                        <input type="hidden" name="stock_id" value="<?= $stock_id ?>">

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