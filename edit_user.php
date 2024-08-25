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
$user = getUserById($user_id);

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $role = $_POST['role'];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (empty($username) || strpos($username, ' ') !== false) {
        $error = "Username cannot contain spaces.";
    } elseif (usernameExists($username, $user_id)) {
        $error = "Username already exists.";
    } else {
        if (updateUser($user_id, $username, $email, $first_name, $last_name, $role)) {
            $_SESSION['message'] = "User updated successfully.";
            header('Location: manage_users.php');
            exit();
        } else {
            $error = "Error updating user.";
        }
    }
}
?>

<?php include_once('template/header.php'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <?php if ($message): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3>Edit User</h3>
                        </div>
                        <form role="form" method="post" action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username ?? $user['username']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email ?? $user['email']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name ?? $user['first_name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name ?? $user['last_name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role">
                                        <option value="Admin" <?php if (($role ?? $user['role']) === 'Admin') echo 'selected'; ?>>Admin</option>
                                        <option value="Chef/Cook" <?php if (($role ?? $user['role']) === 'Chef/Cook') echo 'selected'; ?>>Chef/Cook</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-success mr-3" name="update_user">Update User</button>
                                <a href="manage_users.php" class="btn btn-info">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('template/footer.php'); ?>
