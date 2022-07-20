<?php

namespace Novus\Controller;

class AdminController {

  public function index() {

    $ctrlName = __CLASS__;

    return [
      "page_name" => $ctrlName,
      "data" => [
        "user" => "USER SESSION DATA !",
        "contents" => "Contents !"
      ]
    ];
  }
}