<?php
namespace MattMVC\Models;

class User extends \MattMVC\Models\Db\UserDB
{

	function __construct( $fields = null )
	{
		parent::__construct( $fields );
	}

}
