<?php

namespace Novus;

use Novus\App\Router;
use Novus\App\ErrorHandler;
use Novus\App\Config;
use Novus\App\Autoloader;
// use Novus\Controller;
// use Novus\Controller\HomeController;

require_once "app/Autoloader.php";
Autoloader::register();

// require_once "src/Controller/HomeController.php";
require_once "app/Router.php";

include "app/ErrorHandler.php";
include "app/Config.php";
include "app/Helper.php";

// Handle PHP Errors
ErrorHandler::handlePHPErrors();

// Define gloabal variables
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', '.'.DS); // "./"
$GLOBALS['root_dir'] =  $_SERVER["DOCUMENT_ROOT"];
$GLOBALS['base_dir'] = str_replace(__DIR__, '/', $_SERVER["DOCUMENT_ROOT"]);
$GLOBALS['view_path'] = $GLOBALS['root_dir'].'template'.DS;


// Handle Request
$result = Router::handleRequest();

Router::getRouting();

// (new Config(__DIR__ .  '/config/routing.json'))->loadJson();
// (new Config(__DIR__ .  '/.env'))->load();
// echo getEnv('test');


switch ($result) {
  case null:
    echo "Warning, no controller found!";
    break;

  case "404":
    echo "Error 404";
    break;

  case true:

    $data = isset($result['data']) ? $result['data'] : null;
    $pageName = isset($result['page_name']) ? $result['page_name'] : null;
    $view = isset($result['view']) ? $result['view'] : null;
    $view && include $GLOBALS['view_path'].$result['view'];
  
    include "templates/base.php";
    break;
}