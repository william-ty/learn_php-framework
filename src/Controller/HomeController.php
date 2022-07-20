<?php

namespace Novus\Controller;

class HomeController {

  public function index() {

    $ctrlName = __CLASS__;

    return [
      "page_name" => $ctrlName,
      "data" => [
        "welcome" => "Welcome to novus!",
        "view" => "home/welcome.php"
      ]
    ];
  }
}