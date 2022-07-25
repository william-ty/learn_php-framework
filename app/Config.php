<?php

namespace Novus\App;

class Config
{

  static $config = array();
  protected string $filePath;
  protected string $fileExtension;

  public function __construct(string $filePath)
  {
    if (!file_exists($filePath)) {
      throw new \InvalidArgumentException(sprintf('%s does not exist', $filePath));
    }
    $this->filePath = $filePath;
    $this->fileExtension = pathinfo($this->filePath, PATHINFO_EXTENSION);

  }

  public function load()
  {
    if (!is_readable($this->filePath)) {
      throw new \RuntimeException(sprintf('%s file is not readable', $this->filePath));
    }

    $fileExtension = pathinfo($this->filePath, PATHINFO_EXTENSION);

    if ($fileExtension === 'ini' || $fileExtension === 'env') {


      $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

      foreach ($lines as $line) {

        if (strpos(trim($line), '#') === 0) {
          continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
          // putenv(sprintf('%s=%s', $name, $value)); // echo getEnv('host');
          // $_ENV[$name] = $value;

          self::$config[$name] = $value;
        }

      }
    }
    else {
      echo "invalid file extension";
    }

  }

  public function loadJson()
  {
    $json = file_get_contents($this->filePath);
    return json_decode($json, true);
  }

}