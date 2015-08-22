<?php

if (file_exists('../vendor/autoload.php')) {
  require '../vendor/autoload.php';
} else {
  echo "<h1>Please install via composer.json</h1>";
}

define('ENVIRONMENT', 'development');

if (defined('ENVIRONMENT')) {
  switch (ENVIRONMENT) {
    case 'development':
      error_reporting(E_ALL);
      break;
    case 'production':
      error_reporting(0);
      break;
    default:
      exit('The application environment is not set correctly.');
  }
}

include '../app/core/Debug.php';
mattMVC\core\Debug::register();

//Generate an errors
if( this_function_does_not_exists( $and_this_var_does_not_exists ) )
{
	return $and_this_var_does_not_exists;
}
//$app = new mattMVC\core\App();
