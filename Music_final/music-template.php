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
        echo "Content goes here!!!";
      ?>
    </div>
  </div>
  <?php include 'music-footer.php'; ?>
</body>
</html>
