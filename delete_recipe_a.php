<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');


if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Recipe ID is missing.";
    header('Location: view_user_recipes.php');
    exit();
}


$recipe_id = $_GET['id'];


if (deleteRecipe($recipe_id)) {
    $_SESSION['message'] = "Recipe deleted successfully.";
} else {
    $_SESSION['error'] = "Error deleting recipe.";
}


header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
