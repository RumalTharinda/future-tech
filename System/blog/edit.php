<?php
ob_start();
extract($_GET);

include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>/blog/blog.php">Manage Blog</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    
    
    <?php
    $Blog = '';

    
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {


        $Blog = dataclean($Blog);

        
        $message = array();

        if (empty($Blog)) {
            $message['err_blog'] = "The Blog should not be blank...!";
        }
        
      




        if (empty($message)) {
        $db = dbconn();
       echo $sql = "UPDATE tbl_blog SET product_id='$PName', blog_blog='".mysqli_real_escape_string($db, $Blog)."' WHERE blog_id='$blog_id'";
        $db->query($sql);

        header('Location: blog.php');
        }
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_blog WHERE blog_id='$blog_id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $PName = $row['product_id'];
    $Blog = $row['blog_blog'];
    ?>




    <section class="section">



        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Courier</h5>



                <!-- Multi Columns Form -->  

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

                    
                    
                    
                    <div class="text-center">
                        <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
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