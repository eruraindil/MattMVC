<?php
namespace MattMVC\core;

use MattMVC\core\Router;
class App
{
  public function __construct() {
    $router = new Router();
    $url = $router->parseUrl();
  }
}
