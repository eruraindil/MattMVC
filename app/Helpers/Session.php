<?php
namespace MattMVC\Helpers;

class Session
{
  public static function getRememberMeFlag()
  {
    return isset($_SESSION["remember"]) ? $_SESSION["remember"] : null;
  }

  public static function getUsername()
  {
    return isset($_SESSION["username"]) ? $_SESSION["username"] : null;
  }

  public static function loggedIn()
  {
    return null !== self::getUsername() ? self::getUsername() : false;
  }

  public static function rememberMe()
  {
    return null !== self::getRememberMeFlag() ? self::getRememberMeFlag() : false;
  }

  public static function setRememberMeFlag()
  {
    $_SESSION["remember"] = true;
  }

  public static function setUsername($username)
  {
    $_SESSION["username"] = $username;
  }

  public static function unsetRememberMeFlag()
  {
    session_unset(self::getRememberMeFlag());
  }

  public static function unsetLoggedIn()
  {
    session_unset(self::getUsername());
  }
}
