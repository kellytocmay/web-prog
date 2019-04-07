<?php
  echo <<<_ADD_TITILE_FORM
  <form action="title-management.php" method="POST">
    <pre>
          ISBN  <input type="text" name="isbn"/>
         Title  <input type="text" name="title"/>
        Author  <input type="text" name="author"/>
          Year  <input type="text" name="year"/>
      Category  <input type="text" name="type"/>
                <input type="submit" value="Add Record">
    </pre>
    <input type="hidden" name="add" value="yes">
  </form>
  _ADD_TITILE_FORM;

 ?>
