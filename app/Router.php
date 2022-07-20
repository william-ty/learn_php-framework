<?php


namespace Novus\App;
// use Novus\Controller\HomeController;
use Novus\Controller\AdminController;
use Novus\Controller\TestController;
use Novus\App\Config;
use Helper;
// require_once("routing.php");

// use Novus\Controller\HomeController;


abstract class Router
{

  // TODO - Extract Routing
  private static $routing = [
    '/' => 'HomeController',
    '/home' => 'HomeController',
    '/home/index' => ['HomeController', 'index'],
    '/unknown' => 'UnknownController',
    '/admin' => 'AdminController',
    '/test' => 'TestController'
  ];

  // private static $routing 

  public static function getRouting()
  {
    return ((new Config($GLOBALS['root_dir'].  '/config/routing.json'))->loadJson());
    // Helper::prettyVarExport((new Config($GLOBALS['root_dir'].  '/config/routing.json'))->loadJson());

  }

  public static function handleRequest()
  {
    // Helper::prettyVarExport(self::getRouting());

    $uri = $_SERVER['REQUEST_URI'];
    $routeFound = null;

    $ctrl = "";
    foreach (self::getRouting() as $route => $controller) {
      if ($route === $uri) {
        $ctrl = $controller;
        $routeFound = true;
      }
    }

    if ($routeFound) {

      $method = "index";

      $ctrls_location = "src/Controller/";

      if (is_array($ctrl)) {
        $method = $ctrl[1];
        $ctrl = $ctrl[0];
      }

      $file = $ctrls_location . $ctrl . ".php";

      if (file_exists($file)) {
        $result = [
          "ctrl" => $ctrl,
          "method" => $method
        ];

        // $c = new HomeController();
        // return $c->index();

        $_ctrlname = "Novus\Controller\\" . $result["ctrl"];
        $_ctrl = new $_ctrlname();
        $_method = $result["method"];
        return $_ctrl->$_method();

      }
      else {
        return null;
      }

    }
    else {
      return "404";
    }

  }


  public static function redirectTo($ctrl = null, $method = null, $id = null)
  {
    header("Location:?ctrl=" . $ctrl . "&method=" . $method . "&id=" . $id);
    die();
  }
}



// ---------------- 

// $ctrl = array_filter($routing, function($value){
//   if($uri === $value) return $value;
//   // var_dump($value);
//   // return($value);
// });


// file_exists($file) ? include($file) : function(){
//   echo "Controller not found";
// };

// var_dump($file);

// return $ctrl;


// $url = $_SERVER['uri'];
// Router::redirectTo("home","index",1);
// return $ctrl->$method($id);


// $test = yaml_parse("./routing.yaml");
// $uri = str_replace("/", "", $_SERVER['REQUEST_URI']);