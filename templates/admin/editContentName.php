<?php

if (isset($data['content'])) {
  $content = $data['content'];

  echo "Content 1!";
  echo "<div style='background-color:pink; margin: 1rem 0; '>" . $content->getName() . "</div>";
?>
  <form action="" method="post">
    <input value="<?php echo  $content->getName() ?>" type="text" name="name"><br>
    <br />
    <input type="submit" name="edit_content_name" value="Edit">
    <a href="/admin/contents">Cancel</a>
  </form>
  <?php
}
else {
  echo "No Contents found!";
}

?>