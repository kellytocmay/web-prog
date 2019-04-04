<?php
  if (isset($_POST["add"])) {
    $isbn = $_POST["isbn"];
    $author = $_POST["author"];
    $title = $_POST["title"];
    $year = $_POST["year"];
    $type = $_POST["type"];
    $query = "INSERT INTO classics VALUES "
        . "('$isbn','$author','$title','$year','$type',0)";

    if (!$conn->query($query))
      echo "<h3>INSERT failed. " . mysql_error() . "</h3>";
    else {
      echo "*Title '$isbn' has been added<br>";
    }
  }
 ?>
