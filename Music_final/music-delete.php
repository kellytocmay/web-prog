<!DOCTYPE html>
<html>
<head>
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
        <form name="s_form" action="music-delete.php" method="post">
            <input type="text" name="search_kw" id="search_kw" size="40"
                   value='<?php empty($_POST['search_kw']) || print $_POST['search_kw'];?>'>

            <input type="submit" name="locbaiviet" value="Lọc bài viết">
        </form>
        <?php
        require 'data/connect-select-db.php';

        $sql = "SELECT * FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia";
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
          if (isset($_POST['search_kw'])) {

            include 'baiviet-search-func.php';
				//		include 'baiviet-search-func-paging.php';
            $result = search($_POST['search_kw']);
				//		echo "<br><hr> ";
        //    page_nav_links($result, $_POST['search_kw']);
          }
          ?>
            <h2>Số bài viết: <?php echo $result->num_rows ?></h2>
          <?php
            while($row = $result->fetch_array()) {
          ?>
            <div class="entry">
              <h2><span class="date"><?php echo $row["ngayviet"] ?></span> <?php echo $row["tieude"] ?></h2>
              <p><img src="images/<?php echo $row["image_name"] ?>" alt=""></p>
              <p><?php echo $row["tomtat"] ?></p>
              <form id="delform" action="music-delete.php" method="post" onsubmit="return confirm('Bạn chắc chắn muốn xóa bài viết?');">
                <input type='submit' value='Xóa bài viết'>
                <input type='hidden' name='ma_bviet_del' value="<?php echo $row["ma_bviet"] ?>">
                <input type='hidden' name='ten_bviet_del' value="<?php echo $row["tieude"] ?>">
              </form>
            </div>
          <?php
            }
        }
        ?>
      </div>
    </div>
  </div>
  <?php include 'music-footer.php'; ?>
</body>
</html>
