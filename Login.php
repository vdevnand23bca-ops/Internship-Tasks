<?php
// Database connection settings
$host = 'localhost';
$db = 'car_accessories_managment_database'; // Replace with your actual database name
$user = 'root'; // Replace with your MySQL username
$pass = ''; // Replace with your MySQL password (blank for XAMPP default)

try {
    // PDO connection to MySQL database
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

