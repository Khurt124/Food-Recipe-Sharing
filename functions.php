    <?php
    require_once('config.php');


function saveUser($firstName, $lastName, $username, $email, $password, $role) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 


    $conn = getDbConnect();
    
    $checkQuery = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $checkQuery->bindParam(':username', $username);
    $checkQuery->execute();
    $usernameExists = $checkQuery->fetchColumn();

    if ($usernameExists > 0) {
        return false; 
    }


    $q = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, password, role) VALUES (:first_name, :last_name, :username, :email, :password, :role)");
    $q->bindParam(':first_name', $firstName);
    $q->bindParam(':last_name', $lastName);
    $q->bindParam(':username', $username);
    $q->bindParam(':email', $email);
    $q->bindParam(':password', $hashedPassword); 
    $q->bindParam(':role', $role);

    return $q->execute();
}


function authenticateUser($email, $password) {
    $user = getUserByEmail($email);

    if ($user) {
        echo "User retrieved from database: ";
        print_r($user);

        if (password_verify($password, $user['password'])) {
            return $user;
        } else {
            echo "Incorrect password";
            return false;
        }
    } else {
        echo "User not found";
        return false;
    }
}

function getUserByEmail($email) {
    $conn = getDbConnect();
    $q = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $q->bindParam(':email', $email);
    $q->execute();
    return $q->fetch(PDO::FETCH_ASSOC);
}

function getUserById($id) {
    $conn = getDbConnect();
    $q = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $q->bindParam(':id', $id);
    $q->execute();
    return $q->fetch(PDO::FETCH_ASSOC);
}

function getAllUsers() {
    $conn = getDbConnect();
    $q = $conn->query("SELECT * FROM users");
    return $q->fetchAll(PDO::FETCH_ASSOC);
}


function updateUser($id, $username, $email, $first_name, $last_name, $role) {
    try {
        $conn = getDbConnect();
        $q = $conn->prepare("UPDATE users SET username = :username, email = :email, first_name = :first_name, last_name = :last_name, role = :role WHERE id = :id");
        $q->bindParam(':id', $id);
        $q->bindParam(':username', $username);
        $q->bindParam(':email', $email);
        $q->bindParam(':first_name', $first_name);
        $q->bindParam(':last_name', $last_name);
        $q->bindParam(':role', $role);
        return $q->execute();
    } catch (PDOException $e) {
        echo "Error updating user: " . $e->getMessage();
        return false;
    }
}


function deleteUser($id) {
    try {
        $conn = getDbConnect();
        $q = $conn->prepare("DELETE FROM users WHERE id = :id");
        $q->bindParam(':id', $id);
        return $q->execute();
    } catch (PDOException $e) {
        echo "Error deleting user: " . $e->getMessage();
        return false;
    }
}


function saveRecipe($user_id, $title, $ingredients, $preparation, $cooking_time, $serving_size, $special_instructions, $category_id, $published, $recipeImage, $description) {
    try {
        $conn = getDbConnect();
        $q = $conn->prepare("INSERT INTO recipes (user_id, title, ingredients, preparation, cooking_time, serving_size, special_instructions, category_id, published, created_at, image_path, description) VALUES (:user_id, :title, :ingredients, :preparation, :cooking_time, :serving_size, :special_instructions, :category_id, :published, NOW(), :image_path, :description)");
        $q->bindParam(':user_id', $user_id);
        $q->bindParam(':title', $title);
        $q->bindParam(':ingredients', $ingredients);
        $q->bindParam(':preparation', $preparation);
        $q->bindParam(':cooking_time', $cooking_time);
        $q->bindParam(':serving_size', $serving_size);
        $q->bindParam(':special_instructions', $special_instructions);
        $q->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $q->bindParam(':published', $published, PDO::PARAM_INT);
        $q->bindParam(':image_path', $recipeImage);
        $q->bindParam(':description', $description);

        $q->execute();

        return $conn->lastInsertId();
    } catch (PDOException $e) {
        echo "Error saving recipe: " . $e->getMessage();
        return false;
    }
}


function getUserRecipes($user_id) {
    $conn = getDbConnect();

    $query = "SELECT * FROM recipes WHERE user_id = :user_id ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getRecipesByChefId($chefId) {
    global $db;

    $query = "SELECT * FROM recipes WHERE chef_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $chefId);
    $stmt->execute();
    $result = $stmt->get_result();

    $recipes = [];
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }

    return $recipes;
}

function getPublishedRecipes() {
    $conn = getDbConnect();
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE published = 1");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllCategories() {
    try {
        $conn = getDbConnect();
        $q = $conn->query("SELECT * FROM categories");
        return $q->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching categories: " . $e->getMessage();
        return false;
    }
}


function addCategory($category_name) {
    $conn = getDbConnect();

    $checkQuery = $conn->prepare("SELECT COUNT(*) as count FROM categories WHERE name = :category_name");
    $checkQuery->bindParam(':category_name', $category_name);
    $checkQuery->execute();
    $result = $checkQuery->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        return false;
    }

    $query = $conn->prepare("INSERT INTO categories (name) VALUES (:category_name)");
    $query->bindParam(':category_name', $category_name);
    return $query->execute();
}

function categoryExists($categoryName) {
    $conn = getDbConnect();
    $q = $conn->prepare("SELECT COUNT(*) FROM categories WHERE name = :name");
    $q->bindParam(':name', $categoryName);
    $q->execute();
    return $q->fetchColumn() > 0;
}

function getCategoryById($categoryId) {
    $conn = getDbConnect();
    $q = $conn->prepare("SELECT id, name FROM categories WHERE id = :id");
    $q->bindParam(':id', $categoryId);
    $q->execute();
    return $q->fetch(PDO::FETCH_ASSOC);
}

function getCategoryName($categoryId) {
    $conn = getDbConnect();
    $q = $conn->prepare("SELECT id, name FROM categories WHERE id = :id");
    $q->bindParam(':id', $categoryId);
    $q->execute();
    $record =  $q->fetch(PDO::FETCH_ASSOC);
    return $record['name'];
}

function updateCategory($categoryId, $categoryName) {
    $conn = getDbConnect();
    $q = $conn->prepare("UPDATE categories SET name = :name WHERE id = :id");
    $q->bindParam(':name', $categoryName);
    $q->bindParam(':id', $categoryId);
    return $q->execute();
}

function deleteCategory($categoryId) {
    $conn = getDbConnect();
    $q = $conn->prepare("DELETE FROM categories WHERE id = :id");
    $q->bindParam(':id', $categoryId);
    return $q->execute();
}


function getRecipesById($chefId) {
    try {
        $conn = getDbConnect();
        $q = $conn->prepare("SELECT * FROM recipes WHERE user_id = :chef_id");
        $q->bindParam(':chef_id', $chefId);
        $q->execute();
        $recipes = $q->fetchAll(PDO::FETCH_ASSOC);

        if ($recipes === false) {
            return [];
        }

        return $recipes;
    } catch (PDOException $e) {
        echo "Error fetching recipes: " . $e->getMessage();
        return false;
    }
}


function updateRecipe($id, $title, $ingredients, $preparation, $cooking_time, $serving_size, $special_instructions, $description, $published, $image_path = null) {
    $conn = getDbConnect();
    
    // Base SQL query
    $sql = "UPDATE recipes SET 
                title = :title, 
                ingredients = :ingredients, 
                preparation = :preparation, 
                cooking_time = :cooking_time, 
                serving_size = :serving_size, 
                special_instructions = :special_instructions, 
                description = :description, 
                published = :published";
    
    // Add image path to the query if provided
    if ($image_path !== null) {
        $sql .= ", image_path = :image_path";
    }

    $sql .= " WHERE id = :id";
    
    $q = $conn->prepare($sql);

    // Bind parameters
    $q->bindParam(':id', $id, PDO::PARAM_INT);
    $q->bindParam(':title', $title);
    $q->bindParam(':ingredients', $ingredients);
    $q->bindParam(':preparation', $preparation);
    $q->bindParam(':cooking_time', $cooking_time);
    $q->bindParam(':serving_size', $serving_size);
    $q->bindParam(':special_instructions', $special_instructions);
    $q->bindParam(':description', $description);
    $q->bindParam(':published', $published, PDO::PARAM_INT);
    
    if ($image_path !== null) {
        $q->bindParam(':image_path', $image_path);
    }

    return $q->execute();
}


function deleteRecipe($recipeId) {
    try {
        $conn = getDbConnect();
        $q = $conn->prepare("DELETE FROM recipes WHERE id = :recipe_id");
        $q->bindParam(':recipe_id', $recipeId);
        return $q->execute();
    } catch (PDOException $e) {
        echo "Error deleting recipe: " . $e->getMessage();
        return false;
    }
}



function getRecipesByCategory($categoryId, $pdo) {
    $query = "SELECT * FROM recipes WHERE category_id = ? AND published = 1 ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$categoryId]);
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $recipes;
}



function searchRecipesByTitle($searchQuery) {
    try {
        $conn = getDbConnect();
        $q = $conn->prepare("SELECT * FROM recipes WHERE title LIKE :search_query");
        $searchParam = '%' . $searchQuery . '%';
        $q->bindParam(':search_query', $searchParam, PDO::PARAM_STR);
        $q->execute();
        $results = $q->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        echo "Error searching recipes: " . $e->getMessage();
        return [];
    }
}



function getRecipeById($recipeId) {
    try {
        $conn = getDbConnect(); 
        $query = "SELECT * FROM recipes WHERE id = :recipe_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':recipe_id', $recipeId);
        $stmt->execute();
        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
        return $recipe; 
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error retrieving recipe: " . $e->getMessage();
        return false;
    }
}

function getReviewsByRecipeId($recipeId) {
    try {
        $conn = getDbConnect(); 
        $query = "SELECT reviews.rating, reviews.comment, reviews.created_at, users.username 
                  FROM reviews 
                  JOIN users ON reviews.user_id = users.id 
                  WHERE reviews.recipe_id = :recipe_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':recipe_id', $recipeId);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $reviews;
    } catch (PDOException $e) {
        echo "Error retrieving reviews: " . $e->getMessage();
        return false;
    }
}

function usernameExists($username, $user_id) {
    $conn = getDbConnect();
    $q = $conn->prepare("SELECT * FROM users WHERE username = :username AND id != :user_id");
    $q->bindParam(':username', $username);
    $q->bindParam(':user_id', $user_id);
    $q->execute();
    return $q->fetch(PDO::FETCH_ASSOC) !== false;
}

function categoryHasRecipes($categoryId) {
    $conn = getDbConnect();
    $q = $conn->prepare("SELECT COUNT(*) FROM recipes WHERE category_id = :category_id");
    $q->bindParam(':category_id', $categoryId);
    $q->execute();
    return $q->fetchColumn() > 1; //put zero/0 if the the category only has to check if it has recipe.
}

function searchRecipes($searchQuery) {
    try {
        $conn = getDbConnect();
        $stmt = $conn->prepare("SELECT recipes.*, categories.name AS category_name 
                                FROM recipes 
                                JOIN categories ON recipes.category_id = categories.id 
                                WHERE (recipes.title LIKE :searchQuery OR categories.name LIKE :searchQuery) 
                                AND recipes.published = 1");
        $searchParam = '%' . $searchQuery . '%';
        $stmt->bindParam(':searchQuery', $searchParam, PDO::PARAM_STR);
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $recipes;
    } catch (PDOException $e) {
        echo "Error searching recipes: " . $e->getMessage();
        return [];
    }
}
