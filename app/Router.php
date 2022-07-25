<?php


namespace Novus\App;
use Novus\Controller\AdminController;
use Novus\Controller\TestController;
use Novus\App\Config;
use Novus\App;

abstract class Router
{

  private static $request = array();

  public static function getRouting()
  {
    return ((new Config($GLOBALS['root_dir'] . '/config/routing.json'))->loadJson());
  }

  public static function handleRequest()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $uriWithoutParams = parse_url($uri)['path'];
    $routeFound = null;

    // preg_match_all('![0-9]+!', $uriWithoutParams, $urlIds);
    // var_dump($urlIds);

    $ctrl = "";

    foreach (self::getRouting() as $route => $controller) {


      // Checking if URI contains variables
      preg_match_all('(:[a-zA-Z]+)', $route, $routeVariables, PREG_OFFSET_CAPTURE);
      echo "-START-<br/>";
      var_dump("route : ");
      var_dump($route);
      echo "<br/>";

      Helper::prettyVarExport($routeVariables[0]);
      // var_dump($routeVariables[0]);
      // echo "COUNT : " . count($routeVariables[0]) . "<br/>";

      $newRoute = "";
      $lastVar = "";

      if (count($routeVariables[0]) > 0) {

        // Loop on variables to replace route variables with uri values
        foreach ($routeVariables[0] as $value) {

          // var_dump($routeVariables);
          echo "URI WITHOUT PARAMS URI: " . $uriWithoutParams . "<br/>";
          echo "VARIABLE INITIAL POS: " . $value[1] . " - VARIABLE : " . $value[0] . "<br/>";
          $pos = $value[1];
          if ($newRoute !== "") {
            $pos = $value[1] - strlen($lastVar) + 1;
          }
          echo "VARIABLE NEW POS: " . $pos . "<br/>";
          $trimmedUri = substr($uriWithoutParams, $pos);
          echo "TRIMMED URI: " . $trimmedUri . "<br/>";
          $lastCharacter = substr($trimmedUri, -1);
          echo "LAST CHAR: " . $lastCharacter . "<br/>";
          $lastCharacter !== "/" && $trimmedUri .= "/";
          echo "TRIMMED ROUTE 2 : " . $trimmedUri;
          echo "<br/>";
          preg_match('/^(.+?)(\/)/', $trimmedUri, $variable);
          // preg_match('/^(.+)(?=\/)/', $trimmedUri, $variable);
          echo "<br/>VAR : ";
          var_dump($variable);



          echo "<br/>VALUE: ";
          var_dump($value);
          echo "<br/>ROUTE: ";
          echo $route;
          echo "<br/>NEWROUTE: ";
          echo $newRoute;
          echo "<br/>LASTVAR: ";
          echo $lastVar;
          if (count($variable) > 0) {

            if ($newRoute !== "") {
              $newRoute = str_replace($value[0], $variable[1], $newRoute);
            }
            else {
              $newRoute = str_replace($value[0], $variable[1], $route);
            }
          }
          echo "<br/><br/>";
          $lastVar = $value[0];

          echo "<br/>NEWROUTE BIS: ";
          echo $newRoute;
          echo "<br/>LASTVAR BIS: ";
          echo $lastVar;

          //! Warning all values matching can be replaced = ":id" can only be single in route definition.
          //! Would need to change to 'position to be replaced' + 'value to replace length'
          if (count($variable) > 0) {
            echo "<br/>";
            echo "Value";
            echo "<br/>";
            echo $value[0];
            echo "<br/>";
            echo "Variable";
            echo "<br/>";
            echo $variable[1];
            echo "<br/>";
            echo "Route";
            echo "<br/>";
            echo $route;
            echo "yeaaa!";
            echo "<br/>";
            echo "REPLACED" . $newRoute;
            echo "<br/>";
            echo "yeaaa!<br/><br/>";
          }

        }
      }


      echo "<br/>";
      var_dump("uri");
      var_dump($uri);
      echo "<br/>";
      var_dump("uriWithoutParams : ");
      var_dump($uriWithoutParams);
      echo "<br/>";
      var_dump("routeVariables : ");
      var_dump($routeVariables);
      echo "<br/>";
      echo "<br/>";

      if ($newRoute !== "") {
        if ($newRoute === $uriWithoutParams) {
          $ctrl = $controller;
          $routeFound = true;
        }
      }

      if ($route === $uriWithoutParams) {
        $ctrl = $controller;
        $routeFound = true;
      }

    }

    if ($routeFound) {

      echo "POST! <br/>";
      var_dump($_POST);

      $method = "index";

      $ctrls_location = "src/Controller/";

      if (is_array($ctrl)) {
        $method = $ctrl[1];
        $ctrl = $ctrl[0];
      }

      echo "---------------";

      $file = $ctrls_location . $ctrl . ".php";
      echo "<br/>";
      echo $ctrls_location;
      echo "<br/>";

      if (file_exists($file)) {
        $result = [
          "ctrl" => $ctrl,
          "method" => $method
        ];

        $_ctrlname = "Novus\Controller\\" . $result["ctrl"];
        $_ctrl = new $_ctrlname();
        $_method = $result["method"];
        $_arg = "";

        if (count($_GET) > 0) {
          // Option : Secure $_GET
          // return $_ctrl->$_method($request); // Include Post, get...
          self::$request['get'] = $_GET;
        }

        if (count($_POST) > 0) {
          self::$request['post'] = $_POST;
        }


        return $_ctrl->$_method(self::$request);

      }
      else {
        return null;
      }

    }
    else {
      return 404;
    }

  }

  public static function redirectTo($ctrl = null, $method = null, $id = null)
  {
    header("Location:?ctrl=" . $ctrl . "&method=" . $method . "&id=" . $id);
    die();
  }
}