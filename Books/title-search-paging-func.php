<?php
  $record_page = 2;

  function compute_paging($search_kw) {
    global $record_page;
    $query = "SELECT count(*) FROM classics "
            . "WHERE title LIKE '%search_kw%'";
    $result = $conn->query($query);
    $row = $result->fetch_row();
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
    global $record_page;
    $search_kw = str_replace(" ", "%' OR title LIKE '%", trim($keyword));
    $paging = compute_paging($search_kw);
    $query = "SELECT * FROM classics WHERE title LIKE '%search_kw%'".
            . "LIMIT $paging[p_start], $record_page";

    $result = $conn->query($query) or die("Query failed: " . $conn->error);
    while ($row = $result->fetch_assoc())
      echo "<p><i>$row[title]</i>. $row[author] ($row[year]).";
    if (result->num_rows == 0)
      echo "No title found";
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
