<?php
namespace MattMVC\Helpers;

use MattMVC\Core\App;

class Cookie
{

  public static function getAuthKey()
  {
    return isset($_COOKIE[App::NAME . "_authKey"]) ? $_COOKIE[App::NAME . "_authKey"] : null;
  }

  public static function getUsername()
  {
    return isset($_COOKIE[App::NAME . "_username"]) ? $_COOKIE[App::NAME . "_username"] : null;
  }

  //remember me for 7 days by default
  public static function setRememberMeCookies($email, $auth, $length = 604800)
  {
    setcookie(self::getUsername(), $email, time() + $length);
    setcookie(self::getAuthKey(), $auth, time() + $length);
  }

  public static function setAuthKey($authKey)
  {
    $_COOKIE[App::NAME . "_authKey"] = $authKey;
  }

  public static function setUsername($username)
  {
    $_COOKIE[App::NAME . "_username"] = $username;
  }

  public static function unsetRememberMeCookies()
  {
    self::setRememberMeCookies("", "", -60);
  }
}
