<?php

if (file_exists('../vendor/autoload.php')) {
  require '../vendor/autoload.php';
} else {
  echo "<h1>Please install via composer.json</h1>";
}

use mattMVC\core\Debug;
Debug::alert("This is my :text:", array(
	"text"	=>	"alert"
))
//$app = new mattMVC\core\App();
