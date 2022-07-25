<?php

namespace Novus\Controller;

use Novus\Repository\ContentRepository;

class AdminController
{

  private $repository;

  public function __construct()
  {
    $this->repository = new ContentRepository();
  }

  public function index()
  {

    $ctrlName = __CLASS__;


    return [
      "page_name" => $ctrlName,
      "data" => [
        "view" => "admin/index.php",
        // "user" => "USER SESSION DATA !",
      ]
    ];
  }

  public function contents()
  {

    $ctrlName = __CLASS__;

    $contents = $this->repository->getAll();


    return [
      "page_name" => $ctrlName,
      "data" => [
        "view" => "admin/contents.php",
        "contents" => $contents
      ]
    ];
  }
  public function search(array $request)
  {

    $get = $request['get'];

    $ctrlName = __CLASS__;

    $contents = $this->repository->search($get['char']) ?: null;

    if (isset($get['order'])) {
      $get['order'] === "asc" && rsort($contents);
      $get['order'] === "desc" && sort($contents);
    }


    return [
      "page_name" => $ctrlName,
      "data" => [
        "view" => "admin/contents.php",
        "contents" => $contents
      ]
    ];
  }
  public function readName()
  {

    $ctrlName = __CLASS__;

    $content = $this->repository->getAll()[0];


    return [
      "page_name" => $ctrlName,
      "data" => [
        "view" => "admin/contentName.php",
        "content" => $content
      ]
    ];
  }
  public function editContentName(array $request)
  {
    $post = $request['post'];

    $ctrlName = __CLASS__;

    $content = $this->repository->getAll()[0];

    var_dump($post);
    var_dump($content->getId());

    if (isset($post['edit_content_name'])) {
      $this->repository->editContentName($post['name'], $content->getId());
      header("Location:admin/contents/" . $content->getId() . "name");
    }

    return [
      "page_name" => $ctrlName,
      "data" => [
        "view" => "admin/editContentName.php",
        "content" => $content
      ]
    ];
  }
}