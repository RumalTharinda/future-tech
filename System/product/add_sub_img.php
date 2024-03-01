<?php
extract($_GET);
//echo $productid;//

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Sub Images</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/product/add.php">Product Manage</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {




        $message = array();

     

        if (empty($message)) {
            $file = $_FILES['img'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $allowed = array('txt', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif');
            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    if ($file_size <= 2097152) {
                        $file_name_new = uniqid('', true) . '.' . $file_ext;
                        $file_destination = 'img/' . $file_name_new;
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            echo "The file was uploaded successfully.";
                        } else {
                            $message['error_file'] = "There was an error uploading the file.";
                        }
                    } else {
                        $message['error_file'] = "The file is too large.";
                    }
                } else {
                    $message['error_file'] = "There was an error uploading the file.";
                }
            } else {
                $message['error_file'] = "File type not allowed.";
            }
        }



        if (empty($message)) {
            $db = dbconn();
            $sql = "INSERT INTO tbl_sub_img(product_id,img_file)VALUES('$productid','$file_name_new')";
            $db->query($sql);
        }
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
        $db = dbconn();
        $sql = "DELETE FROM tbl_sub_img WHERE img_id='$img_id' ";
        $db->query($sql);
    }
    ?>


    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_sub_img LEFT JOIN tbl_product ON tbl_product.product_id=tbl_sub_img.product_id WHERE tbl_sub_img.product_id='$productid'";
    $result = $db->query($sql);
    ?>


    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting Images</h5>

                <!-- Table with stripped rows -->
              
                    <div class="datatable-container">
                        <table class="table datatable datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 2%">#</th>

                                    <th data-sortable="true" style="width: 20%;">Product Name</th>
                                    <th data-sortable="true" style="width: 18%;">Image</th>                                   

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

                                            <td><?= $row['product_name'] ?></td>
                                            <td><?= $row['img_file'] ?></td>

                                            <td>
                                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                    <input type="hidden" name="img_id" value="<?= $row['img_id'] ?>"> 
                                                    <input type="hidden" name="productid" value="<?= $productid ?>">
                                                    <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
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
                <h5 class="card-title">New Image</h5>



                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate enctype="multipart/form-data">





                    <div class="col-md-12">
                        <label>Upload Product image</label>
                        <input class="form-control" type="file" name="img">
                        <div class="text-danger"><?= @$message['error_file'] ?></div>  <!-- error message -->

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

</main>

<?php
include '../footer.php';
?>