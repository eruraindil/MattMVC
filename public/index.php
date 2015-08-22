<?php

if (file_exists('../vendor/autoload.php')) {
  require '../vendor/autoload.php';
} else {
  echo "<h1>Please install via composer.json</h1>";
}

use MattMVC\Core\Debug;
use MattMVC\Core\App;
Debug::register();

define('ENVIRONMENT', 'development');
if (defined('ENVIRONMENT')) {
  switch (ENVIRONMENT) {
    case 'development':

      break;
    case 'production':
      Debug::debug( false );//true = show erros; false hide errors
      break;
    default:
      exit('The application environment is not set correctly.');
  }
}

$app = new App();
