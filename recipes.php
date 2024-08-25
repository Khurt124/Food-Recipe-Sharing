<?php
session_start();

require_once('functions.php');

$publishedRecipes = getPublishedRecipes();

include('header.php');
?>

<!-- Page Content -->
<div class="container">
    <h2>Published Recipes</h2>
    <div class="row">
        <?php foreach ($publishedRecipes as $recipe) : ?>
            <div class="col-md-4">
                <h3><?php echo $recipe['title']; ?></h3>
                <p><?php echo $recipe['description']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php 
// Include footer
include('footer.php');

// If the user is logged in, redirect to their dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: chef_dashboard.php");
    exit();
}
?>
