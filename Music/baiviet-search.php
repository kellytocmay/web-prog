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
//        include 'baiviet-search-func.php';
        include 'baiviet-search-func-paging.php';
        $result = search($_POST['search_kw']);
        echo "<br><hr> ";
        page_nav_links($result, $_POST['search_kw']);
        if ($result->num_rows > 0) {
        ?>
          <h3>Kết quả tìm kiếm: <?php echo $result->num_rows ?> bài viết</h3>
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
        else
          echo "No title found";
      }
    ?>
    </table>
  </body>
</html>
