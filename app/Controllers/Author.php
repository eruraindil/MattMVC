<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Models\Article;
use MattMVC\Models\ArticleCategory;

class Author extends Controller
{
  public function index($id)
  {
    if(isset($id)) {
      $author = Article::getObjsByAuthor($id);
      $this->template("header",
        [
          "title" => $author[0]->getAuthorObj()->getName(),
          "subtitle" => App::NAME . " " . App::TAGLINE,
          "categories" => ArticleCategory::getObjsAll(),
        ]);
      // $this->template("hero", ["title" => "News"]);
      $this->view("front/author", ["articles" => $author]);
      $this->template("footer");
    } else {
      header("Location: /");
    }
  }
}
