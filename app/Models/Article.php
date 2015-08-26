<?php
namespace MattMVC\Models;

use MattMVC\Models\User;

use MattMVC\Helpers\DateTime;
use MattMVC\Helpers\Image;

class Article extends \MattMVC\Models\Db\ArticleDB
{
	private $authorObj;

	function __construct( $fields = null )
	{
		parent::__construct( $fields );
	}

	public function getAuthorObj()
	{
		if(isset($this->authorObj)) {
			return $this->authorObj;
		} else {
			$this->authorObj = User::getObjById($this->author);
			return $this->authorObj;
		}
	}

	public function getTimestampGeneral()
	{
		return DateTime::formatForSite($this->getTimestamp());
	}

	public function getTimestampPrecise()
	{
		return DateTime::formatPercise($this->getTimestamp());
	}
}
