<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit();
}

require_once('functions.php');

?>

<?php include_once('template/header.php'); ?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?php $dbcon = new dbcon();
                                echo $dbcon->getUserCount() . "<br>";
                                ?> 
                            </h3>
                            <h5>Chef</h5>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="add_user.php" class="small-box-footer">Manage Users<i class="fas fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                <?php $dbcon = new dbcon(); 
                                echo $dbcon->getCategoryCount() . "<br>"; 
                                ?>
                            </h3>
                            <h5>Category</h5>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pricetag"></i>
                        </div>
                        <a href="manage_users.php" class="small-box-footer">Manage Category<i class="fas fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?php $dbcon = new dbcon();
                                echo $dbcon->getRecipeCount() . "<br>";
                                ?>
                            </h3>
                            <h5>Recipe</h5>
                        </div>
                        <div class="icon">
                            <i class="ion ion-fork"></i>
                        </div>
                        <a href="#" class="small-box-footer">Manage Recipe<i class="fas fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('template/footer.php'); ?>
