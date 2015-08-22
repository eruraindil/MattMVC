<?php
include '../app/core/Debug.php';

//Catch Errors
mattMVC\core\Debug::register();

//Generate an errors
if( this_function_does_not_exists( $and_this_var_does_not_exists ) )
{
	return $and_this_var_does_not_exists;
}

?>
