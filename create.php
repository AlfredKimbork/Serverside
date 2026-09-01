<?php
require "./db.php";

$name = $_POST["name"];
$age = $_POST["age"];
$city = $_POST["city"];

$insert = $pdo->prepare("INSERT INTO people (name, age, city) VALUES (?, ?, ?)");
$insert->execute([$name, $age, $city]);

header("Location: index.php");

