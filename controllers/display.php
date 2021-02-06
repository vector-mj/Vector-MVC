<?php
class display extends Controller{
    public function __construct(){
        parent::__construct();
    }
    // you can load view and model like this:
    ///////////////////////////////////////////////
    public function home(){
        $this->view->render('main',false);
        echo $this->model->check('Admin','admin');
    }
    ///////////////////////////////////////////////
}

?>