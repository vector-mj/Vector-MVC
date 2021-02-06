<?php

class View
{
  public $data = null;
  function __construct()
  {}
  public function render($view,$loadHeaderFooter = true,$data=null)
  {
    if ($loadHeaderFooter) {
      require('views/statics/header.php');
      require('views/'.$view.'.php');
      require('views/statics/footer.php');
    }else {
      require('views/'.$view.'.php');
    }
    $this->data = $data;
  }

  public function renderAdminView($view,$loadHeaderFooter = true,$data=null)
  {
    if ($loadHeaderFooter) {
      require('views/statics/admin/header.php');
      require('views/'.$view.'.php');
      require('views/statics/admin/footer.php');
    }else {
      require('views/'.$view.'.php');
    }
    $this->data = $data;
  }
}
