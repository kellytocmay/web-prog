<?php include "dropboxMaker.php" ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/validateForm.js" charset="utf-8"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" charset="utf-8"></script>
  <link rel="stylesheet" type="text/css" href="jquery.datepick.package-5.1.0/css/smoothness.datepick.css">
  <script type="text/javascript" src="jquery.datepick.package-5.1.0/js/jquery.plugin.js" charset="utf-8"></script>
  <script type="text/javascript" src="jquery.datepick.package-5.1.0/js/jquery.datepick.js" charset="utf-8"></script>
  <script type="text/javascript" src="jquery.datepick.package-5.1.0/js/jquery.datepick-vi.js" charset="utf-8"></script>
  <script type="text/javascript">
    $(function() {
      $("#ngayviet").datepick({dateFormat: 'yyyy/mm/dd'});
    });
  </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Music is my life</title>
	<link rel="stylesheet" type="text/css" href="css/my-music-basic.css">
	<link rel="stylesheet" type="text/css" href="css/my-music-layout.css">
  <link rel="stylesheet" type="text/css" href="css/my-music-final.css">
</head>
<body>
  <div id="container">

    <?php
      require 'header.php';
      require 'music-bar.php';
      require 'music-menu.php';
    ?>

    <div id="allentries">
      <div class="entry">
        <form name="insertForm" class="" action="music-add.php" onsubmit="return validateForm()" method="post">
          <table>
            <tr>
              <td class="title">Mã bài viết</td>
              <td><input type="text" name="ma_bviet" value="<?php include "get_ma_bviet-func.php";
                                                                  echo get_ma_bviet()?>"></td>
            </tr>
            <tr>
              <td class="title">Tiêu đề</td>
              <td><input type="text" name="tieude" value=""></td>
            </tr>
            <tr>
              <td class="title">Tác giả</td>
              <td>
                <select class="" name="ma_tgia">
                  <?php dropboxMaker("tacgia", "ma_tgia", "ten_tgia") ?>
                </select>
              </td>
            </tr>
            <tr>
              <td class="title">Ngày viết</td>
              <td><input type="text" name="ngayviet" id="ngayviet" value=""></td>
            </tr>
            <tr>
              <td class="title">Bài hát</td>
              <td><input type="text" name="ten_bhat" value=""></td>
            </tr>
            <tr>
              <td class="title">Thể loại</td>
              <td>
                <select class="" name="ma_tloai">
                  <?php dropboxMaker("theloai", "ma_tloai", "ten_tloai") ?>
                </select>
              </td>
            </tr>
            <tr>
              <td class="title">Tóm tắt</td>
              <td><input type="text" name="tomtat" value=""></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" value="Thêm bài viết"></td>
            </tr>
          </table>
        </form>
        <?php
          require 'data/connect-select-db.php';
          if (isset($_POST["tieude"])) {
            $ma_bviet = $_POST["ma_bviet"];
            $tieude = $_POST["tieude"];
            $ma_tgia = $_POST["ma_tgia"];
            $ngayviet = $_POST["ngayviet"];
            $ten_bhat = $_POST["ten_bhat"];
            $ma_tloai = $_POST["ma_tloai"];
            $tomtat = $_POST["tomtat"];
            $image_name = "bviet_" . $ma_bviet . ".jpg";
            $query = "INSERT INTO baiviet VALUES "
              . "('$ma_bviet', '$tieude', '$ten_bhat', '$ma_tloai', '$tomtat', NULL, '$ma_tgia', '$ngayviet', NULL, '$image_name')"; //concat("bviet_", ma_bviet, ".jpg")
            if (!$conn->query($query))
              echo "<h3>INSERT failed. " . $conn->error . "</h3>";
            else
              echo "*Bài viết '$tieude' đã được thêm<br>";
          }
        ?>
        <hr>
        <?php
          $sql = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_row()) {
              echo "$row[0]. <b>$row[1] (</b>";
              if ($row[1] != $row[4]) echo "<b>$row[4] -- </b>";
              echo "<b>$row[5]).</b> $row[2], $row[3]<br>";
            }
          }
        ?>
      </div>
    </div>
  </div>
  <?php include 'music-footer.php'; ?>
</body>
  <script type="text/javascript" src="js/date.js" charset="utf-8"></script>
</html>
