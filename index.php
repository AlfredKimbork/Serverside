<?php
  echo "hello world";
  $name = $_POST["name"] ?? "";
  $age = $_POST["age"] ?? "";
  $city = $_POST["city"] ?? "";
?>
<form action="" method="post">
  <input type="text" name="name" placeholder="Your name">
  <input type="number" name="age" placeholder="your age">
  <input type="text" name="city" placeholder="your city">
  <input type="submit">
</form>
<?php if($name): ?><p>greetings <?php echo $name ?></p><?php endif ?>
<?php if($age): ?><p>you are <?php echo $age ?> years old</p><?php endif ?>
<?php if($city): ?><p>you are from <?php echo $city ?></p><?php endif ?>