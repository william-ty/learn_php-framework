<?php

namespace Novus\Controller;

class AdminController {

  public function index() {

    $ctrlName = __CLASS__;

    return [
      "page_name" => $ctrlName,
      "data" => [
        "view" => "admin/index.php",
        // "user" => "USER SESSION DATA !",
        // "contents" => "Contents !"
      ]
    ];
  }
}