<?php

namespace Novus\App;

abstract class ErrorHandler {

  public static function handlePHPErrors() {
    // Display PHP errors
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
  }
}
