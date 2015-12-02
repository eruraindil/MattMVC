<?php
namespace MattMVC\Models;

use MattMVC\Models\User;

use MattMVC\Helpers\DateTime;
use MattMVC\Helpers\Image;
use MattMVC\Core\Debug;

class Article extends \MattMVC\Models\Db\ArticleDB
{
	const CONTEXT_LENGTH = 40;
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

	public function viewSearchContext($slug)
	{
		$index = strpos($this->body, $slug);
		//Debug::printData($index);
		if( $index !== false) {
			$start = $index - self::CONTEXT_LENGTH;
			$length = strlen($slug);
			$end = $length + self::CONTEXT_LENGTH;

			return "&hellip;" .
				substr($this->body, $start, self::CONTEXT_LENGTH) .
				"<strong>" . substr($this->body, $index, $length) . "</strong>" .
				substr($this->body, $index + $length, self::CONTEXT_LENGTH) .
				"&hellip;";
		} else return "NOPE";
	}

	public static function getObjsBySearch($slug)
	{
		$sql = "SELECT * FROM Article WHERE body LIKE :slug";
		$params = [
			":slug" => "%$slug%",
		];
		return self::getObjs($sql, $params);
	}
}
