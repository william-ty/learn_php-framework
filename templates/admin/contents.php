<?php

if (isset($data['contents'])) {
  echo "Contents!";
  foreach ($data['contents'] as $key => $value) {
    echo "<div style='background-color:pink; margin: 1rem 0; '>" . $value->getName() . "</div>";
  }
} else {
  echo "No Contents found!";
}


?>