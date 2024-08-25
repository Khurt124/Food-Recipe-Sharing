<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    $categoryName = $_POST['category_name'];
    
    if (addCategory($categoryName)) {
        $_SESSION['message'] = "Category added successfully.";
    } else {
        $_SESSION['error'] = "Error adding category.";
    }
    header('Location: manage_categories.php');
    exit();
}

$categories = getAllCategories();
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
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php
                    echo htmlspecialchars($_SESSION['message']);
                    unset($_SESSION['message']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php
                    echo htmlspecialchars($_SESSION['error']);
                    unset($_SESSION['error']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="row mb-5">             
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category ID</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($category['id']); ?></td>
                                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                                        <td>
                                            <a href="edit_category.php?id=<?php echo htmlspecialchars($category['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <?php if (!categoryHasRecipes($category['id'])): ?>
                                                <a href="delete_category.php?id=<?php echo htmlspecialchars($category['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="row d-flex justify-content-end">
                <div class="col-md-4 ">
                    <div class="card">
                        <div class="card-header ">
                            <h3>Add Category</h3>
                        </div>
                        <form role="form" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" required>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-success" name="add_category">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>   
            </div>            
        </div>
    </section>
</div>
<?php include_once('template/footer.php'); ?>
