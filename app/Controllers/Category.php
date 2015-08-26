<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Models\Article
use MattMVC\Models\ArticleCategory;

class Category extends Controller
{
  public function index($id)
  {
    if(isset($id)) {
      $this->template("header",
        [
          "title" => App::NAME,
          "subtitle" => App::TAGLINE,
          "categories" => ArticleCategory::getObjsAll(),
        ]);
      // $this->template("hero", ["title" => "News"]);
      $this->view("front/index", ["articles" => Article::getObjsByCategory($id)]);
      $this->template("footer");
    } else {
      header("Location: /");
    }
  }
}
