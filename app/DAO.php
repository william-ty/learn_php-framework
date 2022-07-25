<?php

namespace Novus\App;

abstract class DAO
{

  protected $pdo;
  private $host;
  private $db;
  private $port;
  private $user;

  private $password;

  public function __construct()
  {

    try {

      $this->host = Config::$config['host'];
      $this->db = Config::$config['db'];
      $this->port = Config::$config['port'];
      $this->user = Config::$config['user'];
      $this->password = Config::$config['password'];

      $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db . ";";

      // Make DB Connection
      $pdo = new \PDO($dsn, $this->user, $this->password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);

    // $GLOBALS['pdo'] = $pdo;

    }
    catch (\PDOException $e) {
      die($e->getMessage());
    }

    $this->pdo = $pdo;
  }
}