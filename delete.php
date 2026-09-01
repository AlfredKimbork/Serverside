<?php
require "./db.php";

$id = $_POST["id"];

$delete = $pdo->prepare("DELETE FROM people WHERE id = ?");
$delete->execute([$id]);

header("Location: index.php");
