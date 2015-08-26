<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

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

      header("Location: /");
    } else {
      header("Location: /auth");
    }
  }
  public function logout()
  {
    if(isset($_SESSION["username"])) {
      unset($_SESSION["username"]);
      session_unset();
    }
    header("Location: /");
  }
}
