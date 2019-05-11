<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $record_page = 2;

      function compute_paging($search_kw) {
        include 'data/connect-select-db.php';
        global $record_page;
        $query = "SELECT count(*) FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia WHERE MATCH(tieude) AGAINST('$search_kw' IN BOOLEAN MODE)";
        $q_result = $conn->query($query) or die("Query failed: " . $conn->error);
        $row = $q_result->fetch_row();
        $p_total = ceil($row[0]/$record_page);
        $page = (isset($_POST["page"]))? $_POST["page"] : 1;
        $start = ($page - 1) * $record_page;
        $p_next = ($page > 1)? $page -1 : 0;
        $p_pre = ($page < $p_total)? $page + 1 : 0;
        return array("p_total"=>$p_total, "p_no"=>$page,
                     "p_start"=>$start, "p_pre"=>$p_next,
                     "p_next"=>$p_pre, "total"=>$row[0]);
      }

      function search($keyword) {
        include 'data/connect-select-db.php';
        global $record_page;
        $keyword = trim($keyword);
        $paging = compute_paging($keyword);
        $query = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia WHERE MATCH(tieude) AGAINST('$keyword' IN BOOLEAN MODE)"
                . "LIMIT $paging[p_start], $record_page";


        $result = $conn->query($query) or die("Query failed: " . $conn->error);

        if ($result->num_rows > 0) {
        ?>
          <h3>Kết quả tìm kiếm: <?php echo $result->num_rows ?> bài viết</h3>
        <?php
          while($row = $result->fetch_array()) {
            $t_tomtat = $row["tomtat"];
//            $cutpoint = mb_strpos($t_tomtat, " ", 150);
//            $t_tomtat = mb_substr($t_tomtat, 0, $cutpoint);
        ?>
            <div class="s_entry">
              <div class="s_title"><?php echo $row["tieude"] ?></div>
              <div class="s_subtitle"><?php echo $row["ngayviet"] ?> -- <?php echo $row["ten_tgia"] ?></div>
              <div class="s_tomtat">
                <span class="bhat_tloai"><?php echo $row["ten_bhat"] ?> (<?php echo $row["ten_tloai"] ?>)</span>
                <?php echo $t_tomtat ?>...
              </div>
            </div>
      </div>
        <?php
          }
        }


      return $paging;
    }

      function page_nav_links($paging, $search_kw) {
        include 'data/connect-select-db.php';
        echo "Page $paging[p_no]/$paging[p_total]";

        if ($paging['p_pre'] > 0) {
          echo "<a href='baiviet-sarch.php?search_kw=$search_kw " .
               "&page=" .$paging['p_pre']."'>Previous</a>";
        }

        if ($paging['p_pre'] < 0) {
          echo "<a href='baiviet-sarch.php?search_kw=$search_kw " .
               "&page=" .$paging['p_next']."'>Next</a>";
        }
      }
    ?>

  </body>
</html>
