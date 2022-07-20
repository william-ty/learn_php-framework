<?php

namespace Novus\App;

class DAO {

  private $host;
  private $db;
  private $port;
  private $user;
  
  private $password;
  
  public function __construct($host, $db, $port, $user, $password)
  {
    $this->host = $host;
    $this->db = $db;
    $this->db = $db;
    $this->port = $port;
    $this->user = $user;
    $this->password = $password;
  }

  public static function connect()
  {
  
    try {
      $dsn = "pgsql:host=".self::$host.";port=".self::$port.";dbname=".self::$db.";";
      
      // Make DB Connection
      $pdo = new \PDO($dsn, self::$user, self::$password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
      
      // $GLOBALS['pdo'] = $pdo;
  
    } catch (\PDOException $e) {
      die($e->getMessage());
    }      

    return $pdo;
  }
  
}