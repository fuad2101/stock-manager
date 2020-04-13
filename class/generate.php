<?php
require_once'db.php';
// Database Handler
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=ilkoom','root','');
// Create User Table
$query = 'DROP TABLE IF EXISTS user';
$result = $pdo->query($query);
if ($result) {
    echo "Tabel User dihapus <br>";
}
$query = "CREATE TABLE user (username VARCHAR(50) PRIMARY KEY,password VARCHAR(255),email VARCHAR(100))";
$result = $pdo->query($query);

if ($result) {
    echo "Tabel User dibuat <br>";
}else {
    echo"Ada kesalahan";
}
$hash_password = password_hash('yudistar241789',PASSWORD_DEFAULT);
$query = "INSERT INTO user VALUES ('admin',$hash_password,'fuady.teknikinformatika@gmail.com')";
$pdo->query($query);

if ($result) {
    echo "User baru admin dibuat <br>";
}else {
    echo"Ada kesalahan";
}


