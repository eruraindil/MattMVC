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
		$rawBody = strip_tags($this->body);
		$rawBodyLength = strlen($rawBody);
		$index = strpos($rawBody, $slug);

		if( $index !== false) {
			$start = max($index - self::CONTEXT_LENGTH, 0);
			$length = strlen($slug);
			$end = min($index + self::CONTEXT_LENGTH, $rawBodyLength);

			//Debug::printData(substr($rawBody, $start, min(self::CONTEXT_LENGTH, $index)));
			return ($start > self::CONTEXT_LENGTH ? "&hellip;" : "") .
				substr($rawBody, $start, min(self::CONTEXT_LENGTH, $index)) .
				"<strong>" . substr($rawBody, $index, $length) . "</strong>" .
				substr($rawBody, $index + $length, self::CONTEXT_LENGTH) .
				($end < $rawBodyLength ? "&hellip;" : "");
		} else return "NOPE";
	}

	public function viewTeaser()
	{
		return substr(strip_tags($this->body),0,200) . "&hellip;";
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
