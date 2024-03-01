<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Product</a></li>
                <li class="breadcrumb-item active">Delete</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <div class="col-md-6">
        <label for="inputName5" class="form-label">Description</label>
        <input type="text" class="form-control" id="Description" name="Description" value="<?= @$Description ?>"> 
        <div class="text-danger"><?= @$message['err_Description'] ?></div>  <!-- error message -->                        
    </div>

    <div class="col-md-12">
        <label for="inputName5" class="form-label">Overview</label>
        <input type="text" class="form-control" id="Overview" name="Overview" value="<?= @$Overview ?>"> 
        <div class="text-danger"><?= @$message['err_Overview'] ?></div>  <!-- error message -->                        
    </div>



    <div class="col-md-6">
        <label>Upload Product image</label>
        <input class="form-control" type="file" name="Productimg">
        <div class="text-danger"><?= @$message['error_file'] ?></div>  <!-- error message -->

    </div>

    <? php
    $file_name_new = $row['product_img'];




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


    ?>
















</main>

<?php
include '../footer.php';
?>