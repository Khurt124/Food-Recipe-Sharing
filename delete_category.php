<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');


$categoryId = $_GET['id'];


if (deleteCategory($categoryId)) {

    header('Location: manage_categories.php?message=Category deleted successfully.');
} else {

    header('Location: manage_categories.php?error=Error deleting category.');
}

exit();

?>
