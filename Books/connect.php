<?php
  $conn = @new mysqli("localhost","root","","books");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_eorror);
  }
  echo "Connect successfully";
 ?>
