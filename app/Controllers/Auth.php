<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Helpers\Cookie;
use MattMVC\Helpers\Session;
use MattMVC\Helpers\String;

use MattMVC\Models\User;
use MattMVC\Models\ArticleCategory;

class Auth extends Controller
{
  public function index()
  {
    if(Session::loggedIn) {
      header("Location: /");
    } else {
      $this->template("header",
        [
          "title" => App::NAME,
          "subtitle" => App::TAGLINE,
          "categories" => ArticleCategory::getObjsAll(),
        ]);
      // $this->template("hero", ["title" => "News"]);
      $this->view("auth/index");
      $this->template("footer");
    }
  }

  public function login()
  {
    $user = User::getObjByEmail($_POST["email"]);
    if(isset($user) && password_verify($_POST["password"], $user->getPassword())) {
      Session::setUsername($user->getEmail());

      $user->setAuthKey(String::generateRandomString());
      $user->save();

      if(isset($_POST['remember-me'])) {
        Session::setRememberMeFlag();
        Cookie::setRememberMeCookies($user->getEmail(),$user->getAuthKey());
      }
      header("Location: /");
    } else {
      header("Location: /auth");
    }
  }

  public function logout()
  {
    if(Session::loggedIn()) {
      if(Session::rememberMe()) {
        Session::unsetRememberMeFlag();
        Cookie::unsetRememberMeCookies("", "", -60);
      }
      Session::unsetLoggedIn();
      session_unset();
    }
    header("Location: /");
  }

  public function test($password)
  {
  //  echo String::generateRandomString();

  //echo password_hash ($password , PASSWORD_BCRYPT);
  }
}
