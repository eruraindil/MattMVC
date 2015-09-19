<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Helpers\String;

use MattMVC\Models\User;
use MattMVC\Models\ArticleCategory;

class Auth extends Controller
{
  public function index()
  {
    if(isset($_SESSION["username"])) {
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
    if(isset($user) && $user->getPassword() == $_POST["password"]) {
      $_SESSION["username"] = $user->getEmail();

      $user->setAuthKey(String::generateRandomString());
      $user->save();

      if(isset($_POST['remember-me'])) {
        $_SESSION["remember"] = true;
        setcookie(App::NAME . "_username", $user->getEmail(), time() + 60*60*24*7);
        setcookie(App::NAME . "_authKey", $user->getAuthKey(), time() + 60*60*24*7);
      }
      header("Location: /");
    } else {
      header("Location: /auth");
    }
  }

  public function logout()
  {
    if(isset($_SESSION["username"])) {
      if(isset($_SESSION["remember"])) {
        unset($_SESSION["remember"]);
        setcookie(App::NAME . "_username", "", time() - 60);
        setcookie(App::NAME . "_authKey", "", time() - 60);
      }
      unset($_SESSION["username"]);
      session_unset();
    }
    header("Location: /");
  }
}
