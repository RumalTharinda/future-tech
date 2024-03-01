<?php
extract($_GET);
//echo $spec_cate_id;//

include '../header.php';
include '../menu.php';
extract($_POST);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product spec</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/product/add_spec_name.php?productid=<?= $productid ?>">Product View</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    
     <?php
    $db = dbconn();
    $sqlp = "SELECT * FROM tbl_spec_cate WHERE spec_cate_id='$spec_cate_id'";
    $resultp = $db->query($sqlp);
    $rowp = $resultp->fetch_assoc();
    ?> 

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h3 class="card-header"> Specification Categories: <?= $rowp['spec_cate_name'] ?> </h3>
            </div>
    
    
    
    
    

    <?php
   
    

    
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
            $sql = "INSERT INTO tbl_product_specifications(spec_cate_id,product_specification_property,product_specifications_value)VALUES('$spec_cate_id','$SpecificationProperty','$SpecificationsValue')";
            $db->query($sql);

            // Display successfully added! message //
            echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>New Product Spec successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';

            // Clear the BrandName field //


            $SpecificationProperty = '';
            $SpecificationsValue = '';
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
        $db = dbconn();
        $sql = "DELETE FROM tbl_product_specifications WHERE product_specifications_id='$product_specifications_id' ";
        $db->query($sql);
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT tbl_product_specifications.product_specifications_id,tbl_spec_cate.spec_cate_id, tbl_product_specifications.product_specification_property, tbl_product_specifications.product_specifications_value, tbl_spec_cate.spec_cate_name FROM tbl_product_specifications LEFT JOIN tbl_spec_cate ON tbl_spec_cate.spec_cate_id=tbl_product_specifications.spec_cate_id LEFT JOIN tbl_product ON tbl_product.product_id=tbl_spec_cate.product_id WHERE tbl_product_specifications.spec_cate_id= '$spec_cate_id'";
    $result = $db->query($sql);
    ?>

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting Product spec</h5>

                
                    <div class="datatable-container">
                        <table class="table datatable datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 5%">#</th>
                                    <th data-sortable="true" style="width: 40%;">specification property</th>
                                    <th data-sortable="true" aria-sort="descending" class="datatable-descending" style="width: 35%;">specifications value</th>
                                    <th data-sortable="true" style="width: 10%"></th>
                                    <th data-sortable="true" style="width: 10%;"></th>
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
                                            <td><?= $row['product_specification_property'] ?></td>
                                            <td><?= $row['product_specifications_value'] ?></td>



                                            <td>
                                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                    <input type="hidden" name="product_specifications_id" value="<?= $row['product_specifications_id'] ?>"> 
                                                    <input type="hidden" name="spec_cate_id" value="<?= $row['spec_cate_id'] ?>"> 
                                                    <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                </form>    
                                            </td>

                                            <td>
                                                <form method="post" action="edit_spec.php" class="row g-3" novalidate>
                                                    <input type="hidden" name="product_specifications_id" value="<?= $row['product_specifications_id'] ?>">
                                                    <input type="hidden" name="spec_cate_id" value="<?= $row['spec_cate_id'] ?>"> 
                                                    <button class="btn btn-primary" type="submit" name="action" value="edit" >EDIT</button>
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
                <h5 class="card-title">New Product Spec</h5>



                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>



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
                        <input type="hidden" name="spec_cate_id" value="<?= $spec_cate_id ?>"></input>
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