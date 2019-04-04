<?php
  if (isset($_POST['delete']) && isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
    $query = "DELETE FROM classics WHERE isbn='$isbn'";

    if (!$conn->query($query)) {
      echo "<h3> DELETE failed: " . $isbn . ". Error: "
            . $conn_error . "</h3>";
    }
    else {
      echo "*Title '$isbn' has been deleted<br>";
    }
  }
 ?>
