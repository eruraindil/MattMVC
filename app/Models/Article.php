<?php
namespace MattMVC\Models;

class Article extends \MattMVC\Models\Db\ArticleDB
{

	function __construct( $fields = null )
	{
		parent::__construct( $fields );
	}

}
