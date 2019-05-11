<?php
  function get_ma_bviet() {
    require 'data/connect-select-db.php';
    $query = "SELECT MAX(ma_bviet) from baiviet";
    $result = $conn->query($query) or die("Query failed: " . $conn->error);
    $row = $result->fetch_row();
    return $row[0]+1;
  }
?>
