<?php
extract($_GET);


//Brand edit Img//

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Brand Image</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/Brands/add.php">Brand Manage</a></li>
                <li class="breadcrumb-item active">Edit Img</li>
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
           $sql = "UPDATE tbl_brands SET brand_img='$file_name_new' WHERE brand_id='$brand_id'";
            $db->query($sql);
        }
    }


    
    ?>












    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">New Image</h5>



                <!-- Multi Columns Form -->  

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate enctype="multipart/form-data">





                    <div class="col-md-6">
                        <label>Upload Product image</label>
                        <input class="form-control" type="file" name="img">
                        <div class="text-danger"><?= @$message['error_file'] ?></div>  <!-- error message -->

                    </div>            




                    <div class="text-center">
                        <input type="text" name="brand_id" value="<?= $brand_id ?>"></input>
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
?><?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

