<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Chef/Cook') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');

$error = '';
$message = '';

// Check if recipe ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $error = 'Recipe ID is missing.';
} else {
    $recipeId = $_GET['id'];
    $recipe = getRecipeById($recipeId);

    if (!$recipe) {
        $error = 'Recipe not found.';
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_recipe']) && empty($error)) {
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $preparation = $_POST['preparation'];
    $cooking_time = $_POST['cooking_time'];
    $serving_size = $_POST['serving_size'];
    $special_instructions = $_POST['special_instructions'];
    $description = $_POST['description'];
    $published = isset($_POST['published']) ? 1 : 0;

    // Handle image upload
    $recipeImage = $recipe['image_path']; // Default to existing image
    if (isset($_FILES['recipeImage']) && $_FILES['recipeImage']['error'] == 0) {
        $targetDir = "uploads/recipes/";
        $imageFileType = strtolower(pathinfo($_FILES['recipeImage']['name'], PATHINFO_EXTENSION));
        $targetFile = $targetDir . uniqid() . '.' . $imageFileType;

        $check = getimagesize($_FILES['recipeImage']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['recipeImage']['tmp_name'], $targetFile)) {
                $recipeImage = $targetFile; // Update to new image path
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error = "File is not an image.";
        }
    }

    // Update the recipe if no errors
    if (empty($error)) {
        if (updateRecipe($recipeId, $title, $ingredients, $preparation, $cooking_time, $serving_size, $special_instructions, $description, $published, $recipeImage)) {
            $message = "Recipe updated successfully.";
            $recipe = getRecipeById($recipeId); // Reload the recipe details
            header('Location: chef_dashboard.php');
        } else {
            $error = "Error updating recipe.";
        }
    }
}

include_once('template/chef_header.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Recipe</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php else : ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Recipe</h3>
                            </div>
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <?php if (!empty($message)) : ?>
                                        <div class="alert alert-success"><?php echo $message; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($error)) : ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="title">Recipe Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ingredients">Ingredients</label>
                                        <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="preparation">Preparation</label>
                                        <textarea class="form-control" id="preparation" name="preparation" rows="5" required><?php echo htmlspecialchars($recipe['preparation']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="cooking_time">Cooking Time</label>
                                        <input type="text" class="form-control" id="cooking_time" name="cooking_time" value="<?php echo htmlspecialchars($recipe['cooking_time']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="serving_size">Serving Size</label>
                                        <input type="text" class="form-control" id="serving_size" name="serving_size" value="<?php echo htmlspecialchars($recipe['serving_size']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="special_instructions">Special Instructions</label>
                                        <textarea class="form-control" id="special_instructions" name="special_instructions" rows="3"><?php echo htmlspecialchars($recipe['special_instructions']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($recipe['description']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="recipeImage">Recipe Image</label>
                                        <input type="file" class="form-control" id="recipeImage" name="recipeImage">
                                        <?php if (!empty($recipe['image_path'])) : ?>
                                            <img src="<?php echo htmlspecialchars($recipe['image_path']); ?>" alt="Recipe Image" style="max-width: 200px; margin-top: 10px;">
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="published" name="published" <?php echo $recipe['published'] ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="published">Published</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="edit_recipe">Save Changes</button>
                                    <a href="chef_dashboard.php" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once('template/footer.php'); ?>
