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
        <form class="" action="music-search.php" method="post">
          <input type="text" size="40" name="search_kw" value="<?php if (!empty($_POST['search_kw']))
            echo $_POST['search_kw'];?>"/>
          <input type="submit" value="Tìm kiếm">
          <br>
        </form>
        <?php
          if (isset($_POST['search_kw'])) {
//            include 'baiviet-search-func.php';
            include 'baiviet-search-func-paging.php';
            $result = search($_POST['search_kw']);
            echo "<br><hr> ";
            page_nav_links($result, $_POST['search_kw']);

            if ($result->num_rows > 0) {
            ?>
              <h3>Kết quả tìm kiếm: <?php echo $result->num_rows ?> bài viết</h3>
            <?php
              while($row = $result->fetch_array()) {
                $t_tomtat = $row["tomtat"];
								if (strlen($t_tomtat) > 150) {
									$cutpoint = mb_strpos($t_tomtat, " ", 150);
									$t_tomtat = mb_substr($t_tomtat, 0, $cutpoint);
								}
            ?>
                <div class="s_entry">
                  <div class="s_title"><?php echo $row["tieude"] ?></div>
                  <div class="s_subtitle"><?php echo $row["ngayviet"] ?> -- <?php echo $row["ten_tgia"] ?></div>
                  <div class="s_tomtat">
                    <span class="bhat_tloai"><?php echo $row["ten_bhat"] ?> (<?php echo $row["ten_tloai"] ?>)</span>
                    <?php echo $t_tomtat ?>...
                  </div>
                </div>

            <?php
              }
						?>
					</div>
						<?php
            }
          }
          ?>
      </div>
  </div>
  <?php include 'music-footer.php'; ?>
</body>
</html>
