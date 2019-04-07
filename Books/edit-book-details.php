<?php
  if (isset($_POST['edit']) && isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
    $query = "ALTER TABLE classics WHERE isbn='$isbn'" ADD (

    );

    if (!$conn->query($query)) {
      echo "<h3> DELETE failed: " . $isbn . ". Error: "
            . $conn_error . "</h3>";
    }
    else {
      echo "*Title '$isbn' has been deleted<br>";
    }
  }
 ?>
