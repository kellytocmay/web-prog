<?php
  require 'sql_config.php';

  $conn = new mysqli($host, $username, $password, $dbname)
    or die("Couldn't connect to the '$dbname' DB: " . $conn.connect_error);

//  $conn->query("SET NAMES '$charset'")
  mysqli_set_charset($conn,$charset)
    or die("Couldn''t load charset utf8: " . $conn->error);
?>
