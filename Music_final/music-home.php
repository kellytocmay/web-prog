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

      <?php
        require 'data/connect-select-db.php';
        $sql = "SELECT * FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia order by ngayviet desc limit 5";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_array()) {
      ?>
            <div class="entry">
              <h2><span class="date"><?php echo $row["ngayviet"] ?></span> <?php echo $row["tieude"] ?></h2>
              <p><img src="images/<?php echo $row["image_name"] ?>" alt=""></p>
              <p><?php echo $row["tomtat"] ?></p>
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
