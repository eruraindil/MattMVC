<?php
namespace MattMVC\core;

class Router {

  protected $controller = "auth";
  protected $method = "index";
  protected $params = [];

  public function __construct() {
    $url = $this->parseUrl();

    if(file_exists("../Controllers/" . $url[0] . ".php")) {
      $this->controller = $url[0];
      unset($url[0]);
    }

  }

  public function parseUrl() {
    if(isset($_GET["url"])) {
      return $url = explode("/",filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
    }
  }
}
