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
    $query = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia WHERE MATCH(tieude) AGAINST('$keyword' IN BOOLEAN MODE)";

    $result = $conn->query($query) or die("Query failed: " . $conn->error);

  if ($result->num_rows > 0) {
  ?>
    <h3>Kết quả tìm kiếm: <?php echo $result->num_rows ?> bài viết</h3>
  <?php
    while($row = $result->fetch_row()) {
  ?>
  <table>
    <tr>
      <td class="title">Mã bài viết</td>
      <td><?php echo $row[0]; ?></td>
    </tr>
    <tr>
      <td class="title">Tiêu đề</td>
      <td><?php echo $row[1]; ?></td>
    </tr>
    <tr>
      <td class="title">Tác giả</td>
      <td><?php echo $row[2]; ?></td>
    </tr>
    <tr>
      <td class="title">Ngày viết</td>
      <td><?php echo $row[3]; ?></td>
    </tr>
    <tr>
      <td class="title">Bài hát</td>
      <td><?php echo $row[4]; ?></td>
    </tr>
    <tr>
      <td class="title">Thể loại</td>
      <td><?php echo $row[5]; ?></td>
    </tr>
    <tr>
      <td class="title">Tóm tắt</td>
      <td>
        <?php
          $last = 49;
          while (!ctype_space(mb_substr($row[6], $last, 1))) {
            $last++;
          }
          echo mb_substr($row[6], 0, $last). "...";
        ?>
      </td>
    </tr>
    <hr>
    <?php
        }
      }
  else
    echo "No tilte found";
}
?>
