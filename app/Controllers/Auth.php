<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;
use MattMVC\Models\User;

class Auth extends Controller
{
  public function index() {
    $this->template("header",
      [
        "title" => "Login",
        "subtitle" => "",
        "categories" => $categories,
      ]);
    // $this->template("hero", ["title" => "News"]);
    $this->view("auth/index");
    $this->template("footer");
  }

  public function login()
  {
    $user = User::getObjByEmail($_POST['email']);
    if(isset($user) && $user->password == $_POST['password']) {

      header("Location: /");
    } else {
      header("Location: /auth")
    }
  }
}
