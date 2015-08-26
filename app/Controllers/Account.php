<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Models\Article;
use MattMVC\Models\ArticleCategory;
use MattMVC\Models\User;

class Account extends Controller
{
  public function index()
  {
    if(isset($_SESSION["username"])) {
      $this->template("header",
        [
          "title" => App::NAME,
          "subtitle" => App::TAGLINE,
          "categories" => ArticleCategory::getObjsAll(),
        ]);
      // $this->template("hero", ["title" => "News"]);
      $this->view("account/index", ["user" => User::getObjByEmail($_SESSION["username"])]);
      $this->template("footer");
    } else {
      header("Location: /");
    }
  }
}
