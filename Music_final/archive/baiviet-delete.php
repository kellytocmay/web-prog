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
      echo "Đã xóa bài viết ";
      echo $_POST['ten_bviet_del'];
    $result = $conn->query($sql);
  }
  if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Music is my life</title>
  	<link rel="stylesheet" type="text/css" href="css/my-music-basic.css" />
  	<link rel="stylesheet" type="text/css" href="css/my-music-layout.css" />
  </head>
  <style media="screen">
    td.title {text-align: right; padding-right: 15px}
  </style>
<body>
  <h1>Xóa bài viết</h1>
    <hr>
    <form name="s_form" action="baiviet-delete.php" method="post">
        <input type="text" name="search_kw" id="search_kw" size="40"
               value='<?php empty($_POST['search_kw']) || print $_POST['search_kw'];?>'>

        <input type="submit" name="locbaiviet" value="Lọc bài viết">
    </form>
<?php
  //count
  if (isset($_POST['search_kw'])) {
    $search_kw = $_POST['search_kw'];
  }
  else {
    $search_kw = '';
  }
    include 'baiviet-search-func.php';
    $result = search($search_kw);
    if ($result->num_rows > 0) {
    ?>
      <h2>Số bài viết: <?php echo $result->num_rows ?></h2>
    <?php
/*      $keyword = trim($_POST['search_kw']);
  else
      $keyword = '';

  $new_kw = str_replace(" ", "%' OR lower(tieude) LIKE '%", $keyword);
  $query = "SELECT * FROM baiviet as bv, theloai as tl, tacgia as tg" .
      " WHERE bv.ma_tloai=tl.ma_tloai AND bv.ma_tgia=tg.ma_tgia AND" .
      " (tieude LIKE '%$new_kw%')";
  $q_result = mysqli_query($conn,$query);

  $row_count = mysqli_num_rows($q_result);
  echo "<h2>Số bài viết: " . $row_count . "</h2>";*/
    }
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
      <form class="" action="baiviet-delete.php" method="post" onsubmit="return confirm('Bạn chắc chắn muốn xóa bài viết?');">
        <input type='submit' value='Xóa bài viết'>
        <input type='hidden' name='ma_bviet_del' value="<?php echo $row[0] ?>">
        <input type='hidden' name='ten_bviet_del' value="<?php echo $row[1] ?>">
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
