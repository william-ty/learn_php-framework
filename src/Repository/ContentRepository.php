<?php


namespace Novus\Repository;

use Novus\App\Dao;
use Novus\App\Helper;
use Novus\Model\Content;

class ContentRepository extends DAO
{

  public function getAll()
  {
    // Get contents
    try {
      $sql = 'SELECT id_content, ct.id_content_type AS id_content_type, c.name AS content_name, data, created_at, updated_at, ct.name AS content_type_name, uid_content_type, c.id_user, u.firstname, u.lastname
      FROM "content" c
      JOIN "content_type" ct ON c.id_content_type = ct.id_content_type
      JOIN "user" u ON c.id_user = u.id_user;';
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    catch (\Throwable $th) {
      echo $th;
    }

    $contents = [];
    foreach ($results as $content) {
      // Helper::prettyVarExport($content);
      $contents[] = new Content(
        $content["id_content"],
        $content["id_user"],
        $content["content_type_name"],
        $content["content_name"],
        $content["data"],
        $content["created_at"],
        $content["updated_at"]
        );
    }
    return $contents;
  // $data['contents'] = $contents;
  // return $data;
  }
  public function search(string $search)
  {
    $search = "%" . $search . "%";

    // Get contents
    try {
      $sql = 'SELECT id_content, ct.id_content_type AS id_content_type, c.name AS content_name, data, created_at, updated_at, ct.name AS content_type_name, uid_content_type, c.id_user, u.firstname, u.lastname
      FROM "content" c
      JOIN "content_type" ct ON c.id_content_type = ct.id_content_type
      JOIN "user" u ON c.id_user = u.id_user
      WHERE c.name LIKE :search';
      // WHERE c.name LIKE \'%search=:search%\'';

      $args = ['search' => $search];
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':search', $search, \PDO::PARAM_STR);
      $stmt->execute($args);
      $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    catch (\Throwable $th) {
      echo $th;
    }

    $contents = [];
    foreach ($results as $content) {
      // Helper::prettyVarExport($content);
      $contents[] = new Content(
        $content["id_content"],
        $content["id_user"],
        $content["content_type_name"],
        $content["content_name"],
        $content["data"],
        $content["created_at"],
        $content["updated_at"]
        );
    }
    return $contents;
  }

  public function editContentName(string $name, $idContent)
  {
    var_dump($name);
    $args = [$name, $idContent];
    $sql = "UPDATE content
      SET name = :name
      WHERE id_content = :id_content";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
    $stmt->bindParam(':id_content', $idContent, \PDO::PARAM_INT);
    $stmt->execute($args);
  }
}