<!-- 
define('DB_HOST', 'localhost');
define('DB_NAME', 'recipe_share');
define('DB_USER', 'root');
define('DB_PASS', '');

function getDbConnect() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $conn = new PDO($dsn, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}

function getUserCount(){
    $query = $this->conn->prepare("SELECT COUNT(*) FROM users");
    $query->execute();
    $result = $query->fetchColumn();
    return $result;
}

    //FOR CATEGORY COUNT
function getCategoryCount(){
    $query = $this->conn->prepare("SELECT COUNT(*) FROM categories");
    $query->execute();
    $result = $query->fetchColumn();
    return $result;
}

    //FOR RECIPE COUNT
function getRecipeCount(){
    $query = $this->conn->prepare("SELECT COUNT(*) FROM recipes");
    $query->execute();
    $result = $query->fetchColumn();
    return $result;
} -->




<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'recipe_share');
define('DB_USER', 'root');
define('DB_PASS', '');

function getDbConnect() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $conn = new PDO($dsn, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}

class dbcon {
    private $conn;

    public function __construct() {
        $this->conn = getDbConnect();
    }

    public function getUserCount() {
        $query = $this->conn->prepare("SELECT COUNT(*) FROM users");
        $query->execute();
        $result = $query->fetchColumn();
        return $result;
    }

    public function getCategoryCount() {
        $query = $this->conn->prepare("SELECT COUNT(*) FROM categories");
        $query->execute();
        $result = $query->fetchColumn();
        return $result;
    }

    public function getRecipeCount() {
        $query = $this->conn->prepare("SELECT COUNT(*) FROM recipes");
        $query->execute();
        $result = $query->fetchColumn();
        return $result;
    }
}
?>







