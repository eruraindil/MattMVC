<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Models\ArticleCategory;

class Front extends Controller
{
  public function index()
  {
    $categories = ArticleCategory::getObjsAll();
    $this->template("header",
      [
        "title" => App::NAME,
        "subtitle" => App::TAGLINE,
        "categories" => $categories,
      ]);
    // $this->template("hero", ["title" => "News"]);
    $this->view("front/index");
    $this->template("footer");
  }
}
