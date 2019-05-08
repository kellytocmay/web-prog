<?php
  $record_page = 2;

  function compute_paging($search_kw) {
    require 'data/connect-select-db.php';
    global $record_page;
    $query = "SELECT * FROM baiviet as bv, theloai as tl, tacgia as tg" .
        " WHERE bv.ma_tloai=tl.ma_tloai AND bv.ma_tgia=tg.ma_tgia AND" .
        " (tieude LIKE '%$search_kw%')";
    $q_result = mysqli_query($conn,$query);
//  $row = $result->fetch_row();
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
    require 'data/connect-select-db.php';
    global $record_page;
    $search_kw = trim($keyword);
    $paging = compute_paging($search_kw);
    $query = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia WHERE MATCH(tieude) AGAINST('$keyword' IN BOOLEAN MODE)"
            . "LIMIT $paging[p_start], $record_page";

//    $search_kw = trim($keyword);
/*  $arr = str_getcsv($keyword, ' ');
    $i = 1;
    $new_kw = $arr[0];
    if (count($arr) > 1) {
      while ($i < count($arr)) {
        $new_kw = $new_kw . "%' OR tieude LIKE '%" . $arr[$i];
        $i++;
      }
    }
    $query = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia WHERE tieude LIKE '%$new_kw%'";
*/
//    $query = "SELECT ma_bviet, tieude, ten_tgia, ngayviet, ten_bhat, ten_tloai, tomtat FROM baiviet b JOIN theloai th ON b.ma_tloai = th.ma_tloai JOIN tacgia t ON b.ma_tgia = t.ma_tgia WHERE MATCH(tieude) AGAINST('$keyword' IN BOOLEAN MODE)";

    $result = $conn->query($query) or die("Query failed: " . $conn->error);
  return $paging;
}

  function page_nav_links($paging, $search_kw) {
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
