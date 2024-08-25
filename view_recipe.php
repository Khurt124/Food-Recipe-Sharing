<?php
require_once('functions.php');

// Check if recipe ID is provided
if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];
    
    // Fetch recipe details by ID
    $recipe = getRecipeById($recipeId); // Implement this function to fetch recipe data from the database

    if ($recipe) {
        // Display the recipe details
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
    <title><?php echo htmlspecialchars($recipe['title']); ?> · Recipe Details</title>

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
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
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

<main class="position-relative">

    <a href="index.php" class="position-absolute top-0 end-0 m-4">
        <i class="fa-solid fa-arrow-left fa-2xl"></i>
        <br>
    </a>

    <div class="card mx-auto mb-5" style="width: 60%;">
        <div class="mt-5">
            <br>
            <h5 class="h1 text-center"><?php echo htmlspecialchars($recipe['title']); ?></h5>
            <p class="lead text-center"><?php echo htmlspecialchars($recipe['description']); ?></p>
        </div>

         <br>
        <img src="<?php echo htmlspecialchars($recipe['image_path']); ?>" class="img-fluid" alt="...">
        <br>

        <div class="card mx-auto" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item lead fw-semibold">Cooking Time: <?php echo htmlspecialchars($recipe['cooking_time']) ?> minutes</li>
                <li class="list-group-item lead fw-semibold">Serving Size: <?php echo htmlspecialchars($recipe['serving_size']) ?> person/s</li>
            </ul>
        </div>

        <div>
            <h5 class="h2 text-center mt-5">Ingredients</h5>
            <ul class="lead">
                <?php
                // Split the ingredients string by commas (assuming ingredients are separated by commas)
                $ingredients = explode("\n", $recipe['ingredients']);
                foreach ($ingredients as $ingredient) {
                    echo '<li>' . htmlspecialchars($ingredient) . '</li>';
                }
                ?>
            </ul>
        </div>

        <div>
            <h5 class="h2 text-center">Preparation</h5>
            <br>
            <div class="lead">
                <?php
                // Split the directions string by line breaks (assuming each step is on a new line)
                $preparation = explode("\n", $recipe['preparation']);
                $step = 1; // Initialize the step counter
                foreach ($preparation as $direction) {
                    echo '<p><h5>Step ' . $step . ':</h5> ' . htmlspecialchars($direction) . '</p>';
                    $step++; // Increment the step counter
                }
                ?>
            </div>
        </div>

        <?php if (!empty($recipe['special_instructions'])): ?>
        <div>
            <h5 class="h2 fst-italic">Special Instructions</h5>
            <p class="lead fw-medium fst-italic"><?php echo htmlspecialchars($recipe['special_instructions']); ?></p>
        </div>
        <?php endif; ?>

    </div>
</main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
    } else {
        echo "Recipe not found.";
    }
} else {
    echo "Invalid request.";
}
?>
