<?php
session_start();

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Chef/Cook') {
    header('Location: login.php');
    exit();
}

// Include necessary files
require_once('functions.php');

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

$categories = getAllCategories();

// Initialize variables to store form data
$recipeName = $ingredients = $preparationSteps = $cookingTime = $servingSize = $specialInstructions = $category_id = '';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $recipeName = $_POST['recipeName'];
    $ingredients = $_POST['ingredients'];
    $preparationSteps = $_POST['preparationSteps'];
    $cookingTime = $_POST['cookingTime'];
    $servingSize = $_POST['servingSize'];
    $specialInstructions = $_POST['specialInstructions'];
    $description = $_POST['description'];

    $publishRecipe = isset($_POST['publishRecipe']) ? 1 : 0; // Check if the publishRecipe checkbox is checked
    
    // Retrieve category ID from the form
    $category_id = $_POST['category_id'];

    $description = $_POST['description']; 

    // Handle image upload
    // Handle image upload
if (isset($_FILES['recipeImage']) && $_FILES['recipeImage']['error'] == 0) {
    $targetDir = "uploads/recipes/";
    $imageFileType = strtolower(pathinfo($_FILES['recipeImage']['name'], PATHINFO_EXTENSION));
    $targetFile = $targetDir . uniqid() . '.' . $imageFileType;

    // Check if file is an image
    $check = getimagesize($_FILES['recipeImage']['tmp_name']);
    if ($check !== false) {
        if (move_uploaded_file($_FILES['recipeImage']['tmp_name'], $targetFile)) {
            $recipeImage = $targetFile;

            // Save recipe to the database
            $recipe_id = saveRecipe($user_id, $recipeName, $ingredients, $preparationSteps, $cookingTime, $servingSize, $specialInstructions, $category_id, $publishRecipe, $recipeImage, $description);

            // Redirect to add_recipe.php with a success message or any other desired action
            header("Location: chef_dashboard.php?success=1");
            exit();
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            header('Location: add_recipe.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "File is not an image.";
        header('Location: add_recipe.php');
        exit();
    }
} else {
    $recipeImage = null; // No image uploaded

    // Save recipe to the database
    $recipe_id = saveRecipe($user_id, $recipeName, $ingredients, $preparationSteps, $cookingTime, $servingSize, $specialInstructions, $category_id, $publishRecipe, $recipeImage, $description);

    // Redirect to add_recipe.php with a success message or any other desired action
    header("Location: chef_dashboard.php?success=1");
    exit();
}


}
?>

<?php include_once('template/chef_header.php'); ?>

<?php include_once('template/footer.php'); ?>
