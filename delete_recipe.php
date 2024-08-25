<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Chef/Cook') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: chef_dashboard.php');
    exit();
}

$recipeId = $_GET['id'];


if (deleteRecipe($recipeId)) {

    $_SESSION['message'] = "Recipe deleted successfully.";
} else {

    $_SESSION['error'] = "Error deleting recipe.";
}

header('Location: chef_dashboard.php');
exit();
?>
