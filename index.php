<?php
  echo "hello world";
  $name = $_POST["name"] ?? "";
?>
<form action="" method="post">
  <input type="text" name="name">
  <input type="submit">
</form>
<?php echo $name ? "greetings " . $name : ""; ?>