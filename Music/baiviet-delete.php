<?php
  require 'data/connect-select-db.php';



  $sql = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia";
  $result = $conn->query($sql);

  if (isset($_POST['ma_bviet_del'])) {
    $ma_bviet = $_POST['ma_bviet_del'];
    $d_query = "DELETE FROM baiviet WHERE ma_bviet='$ma_bviet'";
    if (!$conn->query($d_query))
      echo "<h3>DELETE FAILED. " .mysql_error() . "</h3>";
    else
      echo "Đã xóa";
    $result = $conn->query($sql);
  }
  if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html>
<body>
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
  <tr>
    <td></td>
    <td>
      <form class="" action="baiviet-delete.php" method="post">
        <input type='submit' value='Xóa bài viết'>
        <input type='hidden' name='ma_bviet_del' value="<?php echo $row[0] ?>">
      </form>
    </td>
  </tr>
  <hr>
  <?php
      }
    }
  ?>
</table>

</body>
</html>
