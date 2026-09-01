<?php
$host = "localhost";
$dbname = "php_intro";
$username = "root";
$password = "root";
try {
  $pdo = new PDO(
    "mysql:host=$host;
    dbname=$dbname;
    charset=utf8",
    $username,
    $password,
  );
} catch (PDOException $error) {
  echo "error: " . $error;
}
