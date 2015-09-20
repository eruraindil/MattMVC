<?php
namespace MattMVC\Core;

use MattMVC\Core\Router;
use MattMVC\Models\Gen\GenModels;

use MattMVC\Helpers\Cookie;
use MattMVC\Helpers\Session;

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
      !Session::loggedIn() &&
      null !== Cookie::getUsername() &&
      null !== Cookie::getAuthKey()
    ) {
      $user = User::getObjByAuthKey(Cookie::getAuthKey());
      if(isset($user) && $user->getEmail() == Cookie::getUsername()) {
        Session::setUsername($user->getEmail());
        Session::setRememberFlag(true);
        Cookie::setRememberMeCookies($user->getEmail(),$user->getAuthKey());
      }
    }
  }
}
