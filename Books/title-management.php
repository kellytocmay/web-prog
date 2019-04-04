<?php

  require "connect.php";
  require "title-delete-process.php";
  require "title-add-process.php";
  require "title-add-form.php";
  require "title-list-delete-form.php";

  $query  = "SELECT * FROM classics";
  $result = $conn->query($query)
      or die("DB Access error: " . mysql_error());

  while ($row = $result->fetch_assoc()) {
    del_form_gen($row);
  }
  $conn->close()   ;
 ?>
