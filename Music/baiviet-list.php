<?php
  require 'data/connect-select-db.php';
  $sql = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style media="screen">
    td.title {text-align: right; padding-right: 15px}
  </style>
  <body>
    <h2>Danh sách các bài viết</h2>
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
?>
    </table>
  </body>
</html>
