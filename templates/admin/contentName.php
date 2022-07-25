<?php

if (isset($data['content'])) {
  $content = $data['content'];

  echo "Content 1!";
  echo "<div style='background-color:pink; margin: 1rem 0; '>" . $content->getName() . "</div>";

  echo "<a href='/admin/contents/2/name/edit'>EDIT</a>";
}
else {
  echo "No Contents found!";
}

?>