<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "web_dasar";

try {
    // Pastikan variabel $pdo didefinisikan di sini
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>