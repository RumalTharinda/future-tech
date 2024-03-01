<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Home page</a></li>
                <li class="breadcrumb-item active">Manage</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage Blog</h5>

                <?php
                $Blog = '';  // new //



                extract($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                   
                    
                    
                    $Blog = dataclean($Blog);

                    

                    $message = array();

                    if (empty($Blog)) {
                        $message['err_blog'] = "The Blog should not be blank...!";
                    }
                    
                    
                    if (empty($message)) {
                        $file = $_FILES['Productimg'];
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
                        $sql = "INSERT INTO tbl_blog(product_id,blog_blog,blog_file)VALUES('$PName','".mysqli_real_escape_string($db, $Blog)."','$file_name_new')";
                        $db->query($sql);

                        // Display successfully added! message //
                        echo '<div id="liveAlertPlaceholder"><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>Bolg successfully added!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div><div></div></div>';
                        
                       
                        $Blog = '';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
                    $db = dbconn();
                    $sql = "DELETE FROM tbl_blog WHERE blog_id='$blog_id' ";
                    $db->query($sql);
                }
                ?>



                <?php
                $db = dbconn();
                $sql = "SELECT * FROM tbl_blog LEFT JOIN tbl_product ON tbl_product.product_id=tbl_blog.product_id";
             
                $result = $db->query($sql);
                ?>

                <section class="section">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Exciting Blogs</h5>


                            <!-- Table with stripped rows -->

                            <div class="datatable-container">
                                <table class="table datatable datatable-table">
                                    <thead>
                                        <tr>
                                            <th data-sortable="true" style="width: 5%">#</th>
                                            <th data-sortable="true" style="width: 10%;"> Blog ID</th>
                                            <th data-sortable="true" style="width: 30%;"> Product Name</th>
                                         
                                            <th data-sortable="true" style="width: 5%"></th>
                                            <th data-sortable="true" style="width: 5%"></th>
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
                                                    <td><?= $row['blog_id'] ?> </td>
                                                    <td><?= $row['product_name'] ?> </td>
                                                  

                                                    <td>
                                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                            <input type="hidden" name="blog_id" value="<?= $row['blog_id'] ?>"> 
                                                            <button class="btn btn-danger" type="submit" name="action" value="delete" >DELETE</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="edit.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="blog_id" value="<?= $row['blog_id'] ?>"> 
                                                            <button class="btn btn-primary" type="submit" name="action" value="edit" >EDIT</button>
                                                        </form>    
                                                    </td>

                                                    <td>
                                                        <form method="post" action="img_edit.php" class="row g-3" novalidate>
                                                            <input type="hidden" name="blog_id" value="<?= $row['blog_id'] ?>"> 
                                                            <button class="btn btn-primary" type="submit" name="action" value="editimg" >EDIT Img</button>
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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Blog</h5>






                        <!-- Brands Form -->

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate enctype="multipart/form-data">

                            <div class="col-md-12">
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
                                            if ($row['product_id'] == @$PName) {
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


                            <div class="col-md-12">
                                <label for="Overview" class="form-label">Blog</label>
                                <textarea class="form-control" id="Blog" name="Blog" rows="8"><?= isset($Blog) ? $Blog : '' ?></textarea>
                                <div class="text-danger"><?= isset($message['err_Blog']) ? $message['err_Blog'] : '' ?></div>
                            </div>

                            <div class="col-md-12">
                                <label>Upload Product image</label>
                                <input class="form-control" type="file" name="Productimg">
                                <div class="text-danger"><?= @$message['error_file'] ?></div>  <!-- error message -->

                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
?>
