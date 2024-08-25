<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: manage_users.php');
    exit();
}


$user_id = $_GET['id'];


$user = getUserById($user_id);

$recipes = getUserRecipes($user_id);
?>

<?php include_once('template/header.php'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recipes Published by <?php echo htmlspecialchars($user['username']); ?></h3>
                            <div class="card-tools">
                                <a href="manage_users.php" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Recipe Name</th>
                                        <th>Date Published</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recipes as $recipe) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($recipe['title']); ?></td>
                                            <td><?php echo htmlspecialchars($recipe['created_at']); ?></td>
                                            <!-- <td>
                                                <a href="view_recipe.php?id=<?php echo htmlspecialchars($recipe['id']); ?>" class="btn btn-info">View</a>
                                                <a href="delete_recipe_a.php?id=<?php echo htmlspecialchars($recipe['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</a>
                                            </td> -->
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once('template/footer.php'); ?>
