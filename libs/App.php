<?php
/**
 *
 */
class App
{
  function __construct()
  {
    if (isset($_GET['url'])) {
      $url = $_GET['url'] ;
    }else {
      $url = DEFAULT_CONTROLLER . '/' . DEFAULT_METHOD ;
    }
      $url = rtrim($url,'/');
      $url = explode('/',$url);
      $controllerPath = 'controllers/'.$url[0].'.php';
      if (file_exists($controllerPath)) {

        require($controllerPath);
        $controller = new $url[0]();
        //load controllers model if exist
        $controller->load_model($url[0]);

        if (isset($url[1])) {
          if (isset($url[2])) {
            $controller->{$url[1]}($url[2]);
          }else {
            $controller->{$url[1]}();
          }
        }else {
          //admin/ no method name exist
          $controller->{DEFAULT_METHOD}();
        }
      }else {
        echo '404 NOT FOUND';
        return false;
      }

  }
}



?>
