<?php
extract($_GET);
//echo $productid;//

include '../header.php';
include '../menu.php';

extract($_POST);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product spec</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/product/view.php">Product View</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    $db = dbconn();
    $sqlp = "SELECT * FROM tbl_product WHERE product_id='$productid'";
    $resultp = $db->query($sqlp);
    $rowp = $resultp->fetch_assoc();
    ?> 

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h3 class="card-header"> Product name: <?= $rowp['product_name'] ?> </h3>
            </div>




            <?php
            

            
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {



                $spec_cate_name = dataClean($spec_cate_name);

                $message = array();

                if (empty($spec_cate_name)) {
                    $message['err_spec_cate_name'] = "The spec_cate_name should not be blank...!";
                }


                if (empty($message)) {
                    $db = dbconn();

                    $sql = "INSERT INTO tbl_spec_cate(product_id,spec_cate_name)VALUES('$productid','$spec_cate_name')";
                    $db->query($sql);

                    // Display successfully added! message //
                    echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New Product Spec successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';

                    $spec_cate_name = '';
                }
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
                $db = dbconn();
                $sql = "DELETE FROM tbl_spec_cate WHERE spec_cate_id='$spec_cate_id ' ";
                $db->query($sql);
            }
            ?>

            <?php
            $db = dbconn();
            // $sql = "SELECT tbl_product.product_name, tbl_spec_cate.spec_cate_name, tbl_spec_cate.spec_cate_id , tbl_product_specifications.product_specification_property, tbl_product_specifications.product_specifications_value FROM tbl_product_specifications LEFT JOIN tbl_product ON tbl_product.product_id=tbl_product_specifications.product_id LEFT JOIN tbl_spec_cate ON tbl_spec_cate.spec_cate_id=tbl_product_specifications.product_specification_categoriess WHERE tbl_product.product_id='$productid'";
            $sql = "SELECT tbl_product.product_name,tbl_product.product_id, tbl_spec_cate.spec_cate_id,tbl_spec_cate.spec_cate_name FROM tbl_spec_cate LEFT JOIN tbl_product ON tbl_product.product_id=tbl_spec_cate.product_id WHERE tbl_product.product_id='$productid'";

            $result = $db->query($sql);
            ?>

            <section class="section">



                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Exciting Product Specification Categories</h5>




                        <div class="datatable-container">
                            <table class="table datatable datatable-table">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" style="width: 2%">#</th>
                                        <th data-sortable="true" style="width: 44%;">Specification Categories</th>



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
                                                <td><?= $row['spec_cate_name'] ?></td>



                                                <td>
                                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                        <input type="hidden" name="spec_cate_id" value="<?= $row['spec_cate_id'] ?>"> 
                                                        <input type="hidden" name="productid" value="<?= $row['product_id'] ?>"> 
                                                        <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                    </form>    
                                                </td>

                                                <td>
                                                    <form method="post" action="edit_spec_name.php" class="row g-3" novalidate>
                                                        <input type="hidden" name="spec_cate_id" value="<?= $row['spec_cate_id'] ?>"> 
                                                        <input type="hidden" name="productid" value="<?= $row['product_id'] ?>"> 
                                                        <button class="btn btn-primary" type="submit" name="action" value="edit" >EDIT</button>
                                                    </form>    
                                                </td>

                                                <td>
                                                    <form method="post" action="add_spec.php?spec_cate_id=<?= $row['spec_cate_id'] ?>" class="row g-3" novalidate>
                                                        <input type="hidden" name="spec_cate_id" value="<?= $row['spec_cate_id'] ?>"> 
                                                        <input type="hidden" name="productid" value="<?= $row['product_id'] ?>"> 
                                                        <button class="btn btn-primary" type="submit" name="action" value="spec_cate_id">Spec</button>
                                                    </form>
                                                </td>








                                            </tr>

                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </section>







            <section class="section">



                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Product Specification Categories</h5>



                        <!-- Multi Columns Form -->  

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>



                            <div class="col-md-12">
                                <label for="spec_cate_name" class="form-label"> Product Specification Categories </label>
                                <input type="text" class="form-control" id="spec_cate_name" name="spec_cate_name" value="<?= @$spec_cate_name ?>">
                                <div class="text-danger"><?= @$message['err_spec_cate_name'] ?></div>  <!-- error message -->
                            </div>                   


                            <div class="text-center">
                                <input type="hidden" name="productid" value="<?= $productid ?>"></input>

                                <button type="submit" name="action" value="save" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </section>

        </div>
    </section>

</main>

<?php
include '../footer.php';
?>