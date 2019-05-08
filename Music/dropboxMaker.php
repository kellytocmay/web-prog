<?php
  function dropboxMaker($table, $value, $displayValue){
    require 'data/connect-select-db.php';
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    while ($row = $result->fetch_array()) {
      echo "<option value = '", $row[$value], "'>";
      echo $row[$displayValue], "</option>";
    }
  }
?>
