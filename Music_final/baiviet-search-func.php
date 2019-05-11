<?php
  function search($keyword) {
    require 'data/connect-select-db.php';
    $keyword = trim($keyword);
/*  $arr = str_getcsv($keyword, ' ');
    $i = 1;
    $new_kw = $arr[0];
    if (count($arr) > 1) {
      while ($i < count($arr)) {
        $new_kw = $new_kw . "%' OR tieude LIKE '%" . $arr[$i];
        $i++;
      }
    }
    $query = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia WHERE tieude LIKE '%$new_kw%'";
*/
    $query = "SELECT * FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia WHERE MATCH(tieude) AGAINST('$keyword' IN BOOLEAN MODE)";

    $result = $conn->query($query) or die("Query failed: " . $conn->error);
  return $result;
}
?>
