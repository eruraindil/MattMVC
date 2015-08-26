<?php
namespace MattMVC\Controllers;

use MattMVC\Core\App;
use MattMVC\Core\Controller;

use MattMVC\Models\Article;
use MattMVC\Models\ArticleCategory;

class Front extends Controller
{
  public function index()
  {
    $this->template("header",
      [
        "title" => App::NAME,
        "subtitle" => App::TAGLINE,
        "categories" => ArticleCategory::getObjsAll(),
      ]);
    // $this->template("hero", ["title" => "News"]);
    $this->view("front/index", ["articles" => Article::getObjsAll()]);
    $this->template("footer");
  }

  // temporary to get some content into the db.
  public function encode()
  {
    $fp = file_get_contents("/home/matthew/Pictures/matt.jpg");
    echo base64_encode($fp);
  }
}
