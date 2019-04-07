<?php
  function del_form_gen($row) {
    echo <<<_DEL_TITLE_FORM
    <form action="title-management.php" method="POST" onsubmit="return confirm('Do you really want to delete the book?');">
      <pre>
        ISBN  $row[isbn]
       Title  $row[title]
      Author  $row[author]
        Year  $row[year]
    Category  $row[type]
              <input type="submit" value="DELETE">
              <input type="submit" value="EDIT">
      </pre>
      <input type="hidden" name="delete" value="yes">
      <input type="hidden" name="isbn" value="$row[isbn]">
      <input type="hidden" name="edit" value="yes">
      <input type="hidden" name="edit" value="$row[isbn]">
    </form>

    _DEL_TITLE_FORM;
  } //ad_form_gen();
 ?>
