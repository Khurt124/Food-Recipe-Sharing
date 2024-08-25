<?php
session_start();
require_once('functions.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: guest_categories.php');
    exit();
}

$categoryId = $_GET['id'];

$category = getCategoryById($categoryId);

$recipes = getRecipesByCategory($categoryId);

?>

<?php include_once('template/guest_header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Recipes in <?php echo htmlspecialchars($category['name']); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Recipe Categories</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Browse by Category</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                <?php foreach ($categories as $category): ?>
                                    <li>
                                        <a href="guest_category_recipes.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once('template/footer.php'); ?>
