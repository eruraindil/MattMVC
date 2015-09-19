<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Models\Article as Articles;
use MattMVC\Models\ArticleCategory;

class Article extends Controller
{
  public function index($id)
  {
    if(isset($id)) {
      $article = Articles::getObjById($id);
      $this->template("header",
        [
          "title" => $article->getTitle(),
        //  "subtitle" => $article->getAuthorObj()->getName(),
          "subtitle" => App::NAME . " / " . ArticleCategory::getObj($article->getCategory())->getName(),
          "categories" => ArticleCategory::getObjsAll(),
        ]);
      // $this->template("hero", ["title" => "News"]);
      $this->view("article/index", ["article" => $article]);
      $this->template("footer");
    } else {
      header("Location: /");
    }
  }
}
