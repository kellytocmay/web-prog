<?php
  function del_form_gen($row) {
    echo <<<_DEL_TITLE_FORM
    <form action="baiviet-delete.php" method="POST" onsubmit="return confirm('Do you really want to delete it?');">
      <pre>
              Mã bài viết $row[ma_bviet]
              Tiêu đề     $row[tieude]
              Tác giả     $row[ten_tgia]
              Ngày viết   $row[ngayviet]
              Bài hát     $row[ten_bhat]
              Thể loại    $row[ten_tloai]
              Tóm tắt     $row[tomtat]
              <input type="submit" value="DELETE">
      </pre>
      <input type="hidden" name="delete" value="yes">
      <input type="hidden" name="ma_bviet_del" value="ma_bviet">
    </form>
    _DEL_TITLE_FORM;
  } //ad_form_gen();

 ?>
