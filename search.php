<?php
require_once('functions.php');

$searchResults = [];
$query = '';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    error_log("Search query received: " . $query); // Log the query
    $searchResults = searchRecipes($query);
    error_log("Search results: " . print_r($searchResults, true)); // Log the results
} else {
    error_log("No search query received");
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Album example · Bootstrap v5.3</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .nav-link{
            transition: all 0.2s;
            position: relative;
        }

        .nav-link::after{
            transition: all 0.2s;
        }

        .nav-link:hover::after{
            content: '';
            height: 2px;
            width: 100%;
            background-color: orange;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        /* Login CSS */            
        .login-btn {
            color: white;
            text-decoration: none;
            font-size: 14px;
            border: none;
            background: none;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
        }

        .login-btn::before {
            margin-left: auto;
        }

        .login-btn::after, .login-btn::before {
            content: '';
            width: 0%;
            height: 2px;
            background: orange;
            display: block;
            transition: 0.5s;
        }

        .login-btn:hover::after, .login-btn:hover::before {
            width: 100%;
        }
    </style>
</head>
<body>
<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #1a1a1a; font-size: 14px;">
        <div class="container-fluid">
            <a class="navbar-brand ml-2" href="#" style="color: white;">My Food <span style="color: orange;">Recipe</span></a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item" style="margin-right: 1rem;">
                        <a class="nav-link" href="index.php" style="color: white;">Home</a>
                    </li>
                </ul>
                <button class="login-btn"><a href="login.php" style="text-decoration: none; color: orange;">Login</a></button>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="bg-image d-flex justify-content-center align-items-center" style="background-image: url(uploads/bg.jpg); height: 60vh;">
    <div>
      <form id="search-form" class="d-flex" action="search.php" method="GET">
        <input id="search-input" class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" style="width: 80vh; background-color: white; color: black;">
      </form>
    </div>
  </div>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                if (!empty($searchResults)) {
                    foreach ($searchResults as $result) {
                ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src="<?php echo $result['image_path']; ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" role="img" aria-label="Recipe Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['title']; ?></h5>
                                    <p class="card-text"><?php echo $result['description']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group col-12">
                                            <a href="view_recipe.php?id=<?php echo $result['id']; ?>" class="btn btn-dark btn-block">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<h1>No recipes found.</h1>";
                }
                ?>
            </div>
        </div>
    </div>
<?php include ('template/foot.php'); ?>

</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    // Add your JavaScript code here
</script>
</body>
</html>
