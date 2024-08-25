<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Chef/Cook') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');


$chefId = $_SESSION['user_id'];
$recipes = getRecipesById($chefId);


if ($recipes === false) {
    $error = "Error fetching recipes. Please try again later.";
    $recipes = [];
}


$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

// Clear messages
unset($_SESSION['message'], $_SESSION['error']);
?>

<?php include_once('template/chef_header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Recipes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="chef_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a>Manage Recipe</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <a href="add_recipe.php" class="btn btn-info">Add Recipe</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($message): ?>
                                <div class="alert alert-success"><?php echo $message; ?></div>
                            <?php endif; ?>
                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Cooking Time</th>
                                        <th>Serving Size</th>
                                        <th>Published</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($recipes)): ?>
                                        <tr>
                                            <td colspan="10" class="text-center">No recipes found.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($recipes as $recipe): ?>
                                            <tr>
                                                <td><?php echo $recipe['title']; ?></td>
                                                
                                                <td><?php echo $recipe['cooking_time']; ?></td>
                                                <td><?php echo $recipe['serving_size']; ?></td>
                                                <td><?php echo $recipe['published'] ? 'Yes' : 'No'; ?></td>
                                                <td><?php echo getCategoryName($recipe['category_id']); ?></td>
                                                <td>
                                                    <a href="edit_recipe.php?id=<?php echo $recipe['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                                    <a href="delete_recipe.php?id=<?php echo $recipe['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include_once('template/footer.php'); ?>
