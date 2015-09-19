<?php
namespace MattMVC\Core;

use MattMVC\Core\Router;
use MattMVC\Models\Gen\GenModels;

use MattMVC\Models\User;

class App
{
  private $router;
  const NAME = "Grape Jelly";
  const TAGLINE = "Newsweekly";
  const DB_TYPE = "sqlite";
  const DB_FILE = "../app/development.db";
  const DB_HOST = "";
  const DB_NAME = "";
  const DB_USER = "";
  const DB_PASS = "";
  const DB_PREFIX = "";

  public function __construct()
  {
    if(ENVIRONMENT == 'development') {
      new GenModels();
    }
    session_start();
    $this->router = new Router();

    if(
      !isset($_SESSION["username"]) &&
      isset($_COOKIE[App::NAME . "_username"]) &&
      isset($_COOKIE[App::NAME . "_authKey"])
    ) {
      $user = User::getObjByAuthKey($_COOKIE[App::NAME . "_authKey"]);
      if(isset($user) && $user->getEmail() == $_COOKIE[App::NAME . "_username"]) {
        $_SESSION["username"] = $_COOKIE[App::NAME . "_username"];
        $_SESSION["remember"] = true;
      }
    }
  }
}
