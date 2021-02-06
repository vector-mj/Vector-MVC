<?php
class Display_model extends Model
{

  function __construct()
  {
    parent::__construct();
  }

  // you can make model function like this:
  ////////////////////////////////////////////
  public function check($username,$password){
    $res = $this->db->Select('users',['*'],['username'=>$username,'password'=>$password]);
  }
  ///////////////////////////////////////////
}
