    <?php
    $page_title = "Add Category";
    include "includes/header.php";
    ?>
    <?php 
    $filepath = dirname(__FILE__);
    include $filepath ."/../config/dbconn.php";
    $error = [];
    $data = [];
    
    if(isset($_POST["addCategory"])){
        $category_name = $_POST["category_name"];
        $category_slug = $_POST["category_slug"];

        // check category name is not empty
        if(empty($category_name)){
            $error['category_name'] = "Category name is required";
        }else{
            $data['category_name'] = $category_name;
        }

        // check category slug is not empty
        if(empty($category_slug)){
            $error['category_slug'] = "Category slug is required";
        }else{
            $data["category_slug"] = $category_slug;
        }
        if(empty($error['category_name']) || empty($error['category_slug'])){
            try{
                $query = "INSERT INTO categories (name, slug) VALUES (:category_name, :category_slug)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
                $stmt->bindParam(':category_slug', $category_slug, PDO::PARAM_STR);
                if($stmt->execute()){
                    $_SESSION['success'] = "Category added successfully";
                    echo "<script>window.location.href = 'category.php';</script>";
                };
            }
            catch(PDOException $e){
                die('Could not insert category: ' . $e->getMessage());
            }}
    }
    ?>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Add Category</h1>
            <a href="category.php" class="d-none d-sm-inline btn btn-danger btn-sm">
                <i class="fas fa-chevron-left fa-sm text-white"></i>
                Back to Category
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Category</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control">
                        <small class="form-text text-danger">
                            <?php echo $error['category_name'] ?? '' ?>
                        </small>
                    </div>
                    <div class=" form-group">
                        <label for="slug">Category Slug</label>
                        <input type="text" name="category_slug" id="slug" class="form-control">
                        <small class="form-text text-danger">
                            <?php echo $error['category_slug'] ?? '' ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addCategory" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>

    <script>
$('#category_name').on('keyup', function() {
    $("#slug").val('')
    var category = $(this).val();
    category = slugify(category);
    $("#slug").val(category)
});

function slugify(text) {
    return text.toLowerCase()
        .replace(text, text)
        .replace(/^-+|-+$/g, '')
        .replace(/\s/g, '-')
        .replace(/\-\-+/g, '-')
}
    </script>
    </body>

    </html>