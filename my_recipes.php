<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once('functions.php');

$recipes = getUserRecipes($_SESSION['user_id']);
?>

<?php include_once('template/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Recipes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">My Recipes</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Submitted Recipes</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Ingredients</th>
                                        <th>Preparation</th>
                                        <th>Cooking Time</th>
                                        <th>Serving Size</th>
                                        <th>Special Instructions</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recipes as $recipe): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($recipe['title']); ?></td>
                                        <td><?php echo htmlspecialchars($recipe['ingredients']); ?></td>
                                        <td><?php echo htmlspecialchars($recipe['preparation']); ?></td>
                                        <td><?php echo htmlspecialchars($recipe['cooking_time']); ?> minutes</td>
                                        <td><?php echo htmlspecialchars($recipe['serving_size']); ?></td>
                                        <td><?php echo htmlspecialchars($recipe['special_instructions']); ?></td>
                                        <td><?php echo htmlspecialchars($recipe['created_at']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once('template/footer.php'); ?>
