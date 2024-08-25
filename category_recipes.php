<?php
session_start();
require_once('functions.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: guest_categories.php');
    exit();
}

$categoryId = $_GET['id'];


$category = getCategoryById($categoryId);


$pdo = getDbConnect();


$recipes = getRecipesByCategory($categoryId, $pdo);

include_once('template/guest_header.php'); 

?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Recipes in <?php echo htmlspecialchars($category['name']); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="guest_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo htmlspecialchars($category['name']); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recipes List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Ingredients</th>
                                        <th>Preparation</th>
                                        <th>Cooking Time</th>
                                        <th>Serving Size</th>
                                        <th>Special Instructions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recipes as $recipe): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($recipe['title']); ?></td>
                                            <td><?php echo htmlspecialchars($recipe['ingredients']); ?></td>
                                            <td><?php echo htmlspecialchars($recipe['preparation']); ?></td>
                                            <td><?php echo htmlspecialchars($recipe['cooking_time']); ?></td>
                                            <td><?php echo htmlspecialchars($recipe['serving_size']); ?></td>
                                            <td><?php echo htmlspecialchars($recipe['special_instructions']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once('template/footer.php'); // Assuming this includes the AdminLTE footer ?>
