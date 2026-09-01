<?php
require("./db.php");

$result = $pdo->query("SELECT * FROM people");
$colors = ["pink", "blue", "green", "yellow", "orange"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>People</title>
  <link rel="stylesheet" href="./css/home.css">
</head>
<body>
  <header class="page-header">
    <div>
      <span class="eyebrow">DATABASE / PEOPLE</span>
      <h1>People.</h1>
      <p>A very serious database for very serious people.</p>
    </div>

    <div class="header-badge">
      <?php echo $result->rowCount(); ?> PEOPLE
    </div>
  </header>
  <main>
    <!-- CREATE PERSON -->
    <section class="create-card">
      <div class="section-title">
        <span class="number">01</span>
        <div>
          <h2>Add someone</h2>
          <p>Create a new person in the database.</p>
        </div>
      </div>
      <form action="create.php" method="post" class="create-form">
        <label>
          Name
          <input
            type="text"
            name="name"
            placeholder="John Doe"
            required
          >
        </label>
        <label>
          Age
          <input
            type="number"
            name="age"
            placeholder="21"
            min="0"
            required
          >
        </label>
        <label>
          City
          <input
            type="text"
            name="city"
            placeholder="Copenhagen"
            required
          >
        </label>
        <button type="submit">
          + Add person
        </button>
      </form>
    </section>

    <!-- PEOPLE -->
    <section class="people-section">
      <div class="section-heading">
        <div>
          <span class="eyebrow">DATABASE / ENTRIES</span>
          <h2>Everyone</h2>
        </div>
        <span class="count">
          <?php echo $result->rowCount(); ?> entries
        </span>
      </div>

      <div class="people-grid">
        <?php foreach ($result as $row): ?>
          <?php $color = $colors[array_rand($colors)]; ?>
          <article class="person <?php echo $color; ?>">
            <div class="person-number">
              #<?php echo $row["id"]; ?>
            </div>
            <div class="person-content">
              <h3 class="person-name">
                <?php echo ucfirst(htmlspecialchars($row["name"])); ?>
              </h3>
              <div class="person-details">
                <span>
                  AGE
                  <strong><?php echo htmlspecialchars($row["age"]); ?></strong>
                </span>
                <span>
                  CITY
                  <strong><?php echo ucfirst(htmlspecialchars($row["city"])); ?></strong>
                </span>
              </div>
            </div>

            <div class="actions">
              <button class="actions-toggle" type="button">
                ⋮
              </button>
              <div class="actions-menu">
                <a href="update.php?id=<?php echo $row["id"]; ?>">
                  Edit
                </a>
                <form action="delete.php" method="post">
                  <input
                    type="hidden"
                    name="id"
                    value="<?php echo $row["id"]; ?>">
                  <button
                    type="submit"
                    class="delete"
                    onclick="return confirm('Are you sure you want to delete this person?')">
                    Delete
                  </button>
                </form>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <script>
    document.querySelectorAll(".actions-toggle").forEach(button => {
      button.addEventListener("click", event => {
        event.stopPropagation();
        const menu = button.nextElementSibling;
        document.querySelectorAll(".actions-menu").forEach(otherMenu => {
          if (otherMenu !== menu) {
            otherMenu.classList.remove("open");
          }
        });
        menu.classList.toggle("open");
      });
    });

    document.addEventListener("click", () => {
      document.querySelectorAll(".actions-menu").forEach(menu => {
        menu.classList.remove("open");
      });
    });
  </script>
</body>
</html>