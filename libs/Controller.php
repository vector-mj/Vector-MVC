<?php
class Controller
{

  function __construct()
  {
    $this->view = new View();
  }

  public function load_model($modelName)
  {
    if ($modelName != null) {
      $modelPath = 'models/'.$modelName.'_model.php';
      if (file_exists($modelPath)) {
        require_once($modelPath);
        // create new object
        $className = $modelName.'_model';
        $this->model =new $className;
      }else {
        return false;
      }
    }
  }
}
