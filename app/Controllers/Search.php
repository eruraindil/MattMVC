<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Models\Article as Articles;
use MattMVC\Models\ArticleCategory;

class Search extends Controller
{
  public function index($value = null)
  {
    if(isset($value) ) {
      $articles = Articles::getObjsBySearch($value);
      $this->template("header",
        [
          "title" => "Search",
        //  "subtitle" => $article->getAuthorObj()->getName(),
          "subtitle" => App::NAME . " " . App::TAGLINE,
          "categories" => ArticleCategory::getObjsAll(),
          "query" => $value,
        ]);
      // $this->template("hero", ["title" => "News"]);
      $this->view("search/index", ["articles" => $articles, "query" => $value]);
      $this->template("footer");
    } else {
      header("Location: /");
    }
  }

  public function query()
  {
    if( isset($_GET['q']) ) {
      header("Location: /search/{$_GET['q']}");
    } else {
      header("Location: /");
    }
  }
}
