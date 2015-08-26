<?php
namespace MattMVC\Core;

use MattMVC\Core\Router;
use MattMVC\Models\Gen\GenModels;

class App
{
  private $router;
  const NAME = "Jam";
  const TAGLINE = "Alternative Newsweekly";
  const DB_TYPE = "sqlite";
  const DB_FILE = "../app/development.db";
  const DB_HOST = "";
  const DB_NAME = "";
  const DB_USER = "";
  const DB_PASS = "";
  const DB_PREFIX = "";

  public function __construct()
  {
    if(ENVIRONMENT == 'development') {
      new GenModels();
    }
    session_start();
    $this->router = new Router();
  }
}
