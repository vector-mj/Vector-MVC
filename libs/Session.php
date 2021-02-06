<?php
class Session
{
  function __construct()
  {}
  public static function init()
  {
    session_start();
  }
  public static function set($key , $value)
  {
      $_SESSION[$key] = $value;
      return true;
  }
  public static function get($key)
  {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }else {
      return false;
    }
  }

  public static function destroy()
  {
    session_destroy();
  }

}