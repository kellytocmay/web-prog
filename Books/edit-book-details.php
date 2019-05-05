<?php
  if (isset($_POST['edit']) && isset($_POST['isbn'])) {
?>
    <div style='cursor: pointer;' onclick="window.open('dailyreport', '_self');">Daily Report</div>
<?php
    $isbn = $_POST['isbn'];
    $query = "UPDATE classics SET (
      title = $_POST['title'];
      author = $_POST['author'];
      year = $_POST['year'];
      type = $_POST['type'];
    ) WHERE isbn='$isbn'";

    if (!$conn->query($query)) {
      echo "<h3> edit failed: " . $isbn . ". Error: "
            . $conn_error . "</h3>";
    }
    else {
      echo "*Title '$isbn' has been updated<br>";
    }
  }
 ?>
