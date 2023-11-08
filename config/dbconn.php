<?php
define("DB_HOST", "localhost");
define("DB_USER","himel");
define("DB_PASSWORD","Admin123");
define("DB_NAME","blog_db");


try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo"Connection successful";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>