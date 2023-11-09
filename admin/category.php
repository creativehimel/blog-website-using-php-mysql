    <?php
    $page_title = "Category";
    include "includes/header.php";
    ?>
    <?php
        $filepath = dirname(__FILE__);
    include $filepath ."/../config/dbconn.php";
    ?>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Category</h1>
            <a href="add-category.php" class="d-none d-sm-inline btn btn-primary btn-sm">
                <i class="fas fa-plus fa-sm text-white"></i>
                Add New Category
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <?php 
                    if(isset($_SESSION['success'])){?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong></strong><?php echo $_SESSION['success']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                    }
                    unset($_SESSION['success']);
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $query = "SELECT * FROM categories";
                             $stmt = $pdo->query($query);
                             $categories = $stmt->fetchAll(PDO::FETCH_OBJ);
                             if($categories != null){
                                 foreach($categories as $key => $category){
                                     ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $category->name; ?></td>
                                <td><?php echo $category->slug; ?></td>
                                <td>
                                    <a href="edit-category.php?id=<?php echo $category->id; ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete-category.php?id=<?php echo $category->id; ?>"
                                        onclick="return confirm('Are you sure to delete?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                 }}
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->
    <?php include "includes/footer.php"; ?>
    <!-- Page level plugins -->
    <script src="./assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="./assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./assets/js/demo/datatables-demo.js"></script>
    </body>

    </html>