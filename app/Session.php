<?php

abstract class Session
{

  function checkUserSession()
  {
    if (!isset($_SESSION['user'])) {
      header("Location:index.php?page=login");
    }
    else {
      return true;
    }
  }

}