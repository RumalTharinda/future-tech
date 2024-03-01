<?php
include '../header.php';
include '../menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Message</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SYSTEM_PATH ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
     extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
        $db = dbconn();
        $sql = "DELETE FROM tbl_message WHERE message_id ='$message_id'";
        $db->query($sql);
    }
    ?>





    <?php
    $db = dbconn();
    $sql = "SELECT * FROM tbl_message";
    $result = $db->query($sql);
    ?>

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exciting Messages</h5>


                <!-- Table with stripped rows -->

                <div class="datatable-container">
                    <table class="table datatable datatable-table">
                        <thead>
                            <tr>
                                <th data-sortable="true" style="width: 5%">#</th>
                                <th data-sortable="true" style="width: 20%;">Name</th>                                    
                                <th data-sortable="true" style="width: 10%;">Email</th>
                                <th data-sortable="true" style="width: 60%;">Message</th>

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
                                        <td><?= $row['message_persons_name'] ?></td>
                                        <td><?= $row['message_email'] ?></td>
                                        <td><?= $row['message_message'] ?></td>


                                        <td>
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3" novalidate>
                                                <input type="hidden" name="message_id" value="<?= $row['message_id'] ?>"> 
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

</main>

<?php
include '../footer.php';
?>