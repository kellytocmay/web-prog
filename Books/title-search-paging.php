<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="title-search-paging.php" method="POST">
      <input type="text" size="40" name="search_kw"
        value='<?php empty($POST['search_kw']) ||
        print $_POST['search_kw'];?>'>
    <input type="submit" value="Seach title">
    </form>
    <hr>
    <h3>Search result</h3>
    <?php
    if (isset($_POST['search_kw'])) {
      include 'title-search-paging-func.php';
      $paging = search($_POST['search_kw']);
      echo "<br><hr>";
      page_nav_links($paging, $_POST['search_kw']);
    }
     ?>
  </body>
</html>
