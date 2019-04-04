<html>
  <body>
    <form action="title-search-adv.php" method="POST">
      <input type="text" size="40" name="search_kw"
      value="<?php if (!empty($POST['search_kw'])) echo $_POST['search_kw'];?>"/>
      <input type="submit" value="Search title">
      <hr>
    </form>
    <h3>Search result</h3>
    <?php
    if (isset($_POST['search_kw'])) {
      include 'title-search-func.php';
      search($_POST['search_kw']);
    }
     ?>

  </body>
</html>
