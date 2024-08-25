<?php
session_start();
require_once('functions.php');

$categories = getAllCategories();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Chef/Cook') {
    header('Location: login.php');
    exit();
}
?>
<?php include_once('template/chef_header.php'); ?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="chef_dashboard.php" class="brand-link">
        <img src="http://localhost/recipe_share/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Chef Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="http://localhost/recipe_share/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
          <a href="#" class="d-block">Welcome, <?php echo $_SESSION['username']; ?>!</a>
            </div>
        </div>

            <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="chef_dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Manage Recipe</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="add_recipe.php" class="nav-link">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Add Recipe</p>
                    </a>
                </li>
                <li class="nav-item fixed-bottom ml-2">
                    <a class="nav-link" href="logout.php">
                      <i class="nav-icon fas fa-power-off ml-5"></i>
                      <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Adding Recipe</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="chef_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a>Add Recipe</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Add Recipe Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add Recipe</h3>
                        </div>
                        <form method="post" action="submit_recipe.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="recipeName">Recipe Name</label>
                                    <input type="text" class="form-control" id="recipeName" name="recipeName" placeholder="Enter recipe name">
                                </div>
                                <div class="form-group">
                                    <label for="ingredients">Ingredients</label>
                                    <textarea class="form-control" id="ingredients" name="ingredients" rows="3" placeholder="List ingredients"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="preparationSteps">Preparation Steps</label>
                                    <textarea class="form-control" id="preparationSteps" name="preparationSteps" rows="3" placeholder="Describe preparation steps"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="cookingTime">Cooking Time</label>
                                    <input type="text" class="form-control" id="cookingTime" name="cookingTime" placeholder="Enter cooking time (e.g., 30 minutes)">
                                </div>
                                <div class="form-group">
                                    <label for="servingSize">Serving Size</label>
                                    <input type="text" class="form-control" id="servingSize" name="servingSize" placeholder="Enter serving size (e.g., serves 4)">
                                </div>
                                <div class="form-group">
                                    <label for="specialInstructions">Special Instructions</label>
                                    <textarea class="form-control" id="specialInstructions" name="specialInstructions" rows="3" placeholder="Any special instructions"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter recipe description"></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="recipeImage">Recipe Image</label>
                                    <input type="file" class="form-control" id="recipeImage" name="recipeImage">
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="publishRecipe" name="publishRecipe">
                                    <label class="form-check-label" for="publishRecipe">Publish Recipe</label>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Submit Recipe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include_once('template/footer.php'); ?>
