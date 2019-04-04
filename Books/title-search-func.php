<?php

  function search($keyword) {
    include 'connect.php';
    $keyword = trim($keyword);
    $new_kw  = str_replace(" ", "%' OR title LIKE '%", $keyword);
    $query   = "SELECT * FROM classics WHERE title LIKE '%$new_kw%'";

    $result  = $conn->query($query)
      or die("Query failed: " . $conn->error);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<p><i>$row[title]</i>.$row[author]($row[year]).</p>";
        }
      }
      else {
        echo "No title found";
      }
  }
 ?>
