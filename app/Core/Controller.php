<?php
namespace MattMVC\Core;

use MattMVC\Core\App as App;

class Controller
{
  // abstract public function index();

  public function template($template, $data = [])
  {
    require_once(__DIR__ . '/../Templates/' . $template . ".php");
  }

  public function view($view, $data = [])
  {
    require_once(__DIR__ . '/../Views/' . $view . ".php");
  }
}
