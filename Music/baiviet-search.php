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
    <h2>Tìm kiếm bài viết</h2>
    <hr>
    <form class="" action="baiviet-search.php" method="post">
      <input type="text" size="40" name="search_kw" value="<?php if (!empty($_POST['search_kw']))
        echo $_POST['search_kw'];?>"/>
      <input type="submit" value="Tìm kiếm">
      <br>
    </form>
    <?php
      if (isset($_POST['search_kw'])) {
        include 'baiviet-search-func.php';
        search($_POST['search_kw']);
      }
    ?>
  </body>
</html>
