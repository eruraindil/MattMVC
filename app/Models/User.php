<?php
namespace MattMVC\Models;

use MattMVC\Helpers\Image;

class User extends \MattMVC\Models\Db\UserDB
{

	function __construct( $fields = null )
	{
		parent::__construct( $fields );
	}

	public function viewImage()
	{
		return Image::viewSqlBlobAsImg($this->getPhoto());
	}
}
