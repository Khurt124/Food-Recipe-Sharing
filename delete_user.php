<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: admin_dashboard.php');
    exit();
}

$user_id = $_GET['id'];

if (deleteUser($user_id)) {
    $_SESSION['message'] = "User deleted successfully.";
} else {
    $_SESSION['error'] = "Error deleting user.";
}

header('Location: manage_users.php');
exit();
?>
