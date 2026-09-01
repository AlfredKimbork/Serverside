<?php
require "./db.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $id = $_GET["id"] ?? null;
  $get_by_id = $pdo->prepare("SELECT * FROM people WHERE id = ?");
  $get_by_id->execute([$id]);
  $person = $get_by_id->fetch(PDO::FETCH_ASSOC);

  if (!$person) die("Person not found");

} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $age = $_POST["age"];
  $city = $_POST["city"];

  $update_by_id = $pdo->prepare("UPDATE people SET name = ?, age = ?, city = ? WHERE id = ?");
  $update_by_id->execute([$name, $age, $city, $id]);

  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    Edit <?php echo htmlspecialchars($person["name"]); ?>
  </title>
  <link rel="stylesheet" href="css/profile-page.css">
</head>

<body class="profile-page">
  <main class="profile-wrapper">
    <a href="index.php" class="back">
      ← Back to everyone
    </a>

    <section class="profile-card">
      <!-- LEFT -->
      <div class="profile-info">
        <span class="eyebrow">
          PROFILE / #<?php echo $person["id"]; ?>
        </span>
        <div class="avatar"><?php echo strtoupper(substr($person["name"], 0, 1)); ?></div>
        <h1><?php echo ucfirst(htmlspecialchars($person["name"])); ?></h1>
        <p class="profile-location"><?php echo ucfirst(htmlspecialchars($person["city"])); ?></p>

        <div class="profile-stats">
          <div>
            <span>AGE</span>
            <strong>
              <?php echo htmlspecialchars($person["age"]); ?>
            </strong>
          </div>
          <div>
            <span>ID</span>
            <strong>
              #<?php echo htmlspecialchars($person["id"]); ?>
            </strong>
          </div>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="profile-edit">
        <span class="eyebrow">
          EDIT / INFORMATION
        </span>
        <h2>
          Make some changes.
        </h2>

        <form action="update.php" method="post">
          <input
            type="hidden"
            name="id"
            value="<?php echo htmlspecialchars($person["id"]); ?>"
          >

          <label>
            Name
            <input
              type="text"
              name="name"
              value="<?php echo htmlspecialchars($person["name"]); ?>"
              required
            >
          </label>

          <label>
            Age
            <input
              type="number"
              name="age"
              value="<?php echo htmlspecialchars($person["age"]); ?>"
              min="0"
              required
            >
          </label>

          <label>
            City
            <input
              type="text"
              name="city"
              value="<?php echo htmlspecialchars($person["city"]); ?>"
              required
            >
          </label>

          <button
            type="submit"
            class="save-button">
            Save changes →
          </button>
        </form>
      </div>
    </section>
  </main>
</body>
</html>