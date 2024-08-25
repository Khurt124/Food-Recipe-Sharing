<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');


$categoryId = $_GET['id'];


$category = getCategoryById($categoryId);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_category'])) {

    $categoryName = $_POST['category_name'];


    if (categoryExists($categoryName) && $categoryName != $category['name']) {
        $error = "Category already exists.";
    } else {

        if (updateCategory($categoryId, $categoryName)) {

            $message = "Category updated successfully.";
        } else {
            // Error updating category
            $error = "Error updating category.";
        }
    }
}

?>

<?php include_once('template/header.php'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header ">
                            <h3>Edit Category</h3>
                        </div>
                        <form role="form" method="post">
                            <div class="card-body">
                                <?php if (isset($message)): ?>
                                    <div class="alert alert-success"><?php echo $message; ?></div>
                                <?php endif; ?>
                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger"><?php echo $error; ?></div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $category['name']; ?>" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success" name="edit_category">Save Changes</button>
                                <a href="manage_categories.php" class="btn btn-info">Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once('template/footer.php'); ?>
