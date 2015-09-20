<?php
namespace MattMVC\Models\Db;

use MattMVC\Models\Gen\ModelClass as Model;

class ArticleDB implements \MattMVC\Models\Gen\ModelInterface
{
	protected $db;
	protected $id;
	protected $title;
	protected $body;
	protected $author;
	protected $category;
	protected $timestamp;

	function __construct( $fields = null )
	{
		foreach( $fields as $key => $value ) {
			$this->$key = $value;
		}
		$model = new Model();
		$this->db = $model->getDb();
	}

	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getTitle()
	{
		return $this->title;
	}
	public function setTitle($title)
	{
		$this->title = $title;
	}
	public function getBody()
	{
		return $this->body;
	}
	public function setBody($body)
	{
		$this->body = $body;
	}
	public function getAuthor()
	{
		return $this->author;
	}
	public function setAuthor($author)
	{
		$this->author = $author;
	}
	public function getCategory()
	{
		return $this->category;
	}
	public function setCategory($category)
	{
		$this->category = $category;
	}
	public function getTimestamp()
	{
		return $this->timestamp;
	}
	public function setTimestamp($timestamp)
	{
		$this->timestamp = $timestamp;
	}

	public function save()
	{
		$obj = self::getObj($this->id);
		$data = array('id' => $this->id, 'title' => $this->title, 'body' => $this->body, 'author' => $this->author, 'category' => $this->category, 'timestamp' => $this->timestamp, 'timestamp' => $this->timestamp);
		if($obj) {//update
			$this->db->update("Article",$data,array('id' => $this->id));
			return $this->id;
		} else {//insert
			$this->db->insert("Article",$data);
			$obj = self::getObj("select * from Article where title = :title AND body = :body AND author = :author AND category = :category AND category = :category",array(':title' => $this->title, ':body' => $this->body, ':author' => $this->author, ':category' => $this->category, ':category' => $this->category));
			return $obj->id;
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($sql,$params = array())
	{
		$model = new Model();
		$db = $model->getDb();
		if(\is_numeric($sql) == 'integer') {
			$obj = $db->select('select * from Article where id = :id limit 1', array(':id' => $sql));
		} else {
			$obj = $db->select($sql . ' limit 1',$params);
		}
		return $obj ? new \MattMVC\Models\Article($obj[0]) : null;
	}

	public static function getObjs($sql,$params = array())
	{
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql,$params);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \MattMVC\Models\Article($obj);
		}
		return $output;
	}

	public static function getObjsAll()
	{
		return self::getObjs('select * from Article');
	}

	public static function getObjById($id)
	{
		return self::getObj('select * from Article where id = :id',array(':id' => $id));
	}

	public static function getObjsById($id)
	{
		return self::getObjs('select * from Article where id = :id',array(':id' =>$id));
	}

	public static function getObjByTitle($title)
	{
		return self::getObj('select * from Article where title = :title',array(':title' => $title));
	}

	public static function getObjsByTitle($title)
	{
		return self::getObjs('select * from Article where title = :title',array(':title' =>$title));
	}

	public static function getObjByBody($body)
	{
		return self::getObj('select * from Article where body = :body',array(':body' => $body));
	}

	public static function getObjsByBody($body)
	{
		return self::getObjs('select * from Article where body = :body',array(':body' =>$body));
	}

	public static function getObjByAuthor($author)
	{
		return self::getObj('select * from Article where author = :author',array(':author' => $author));
	}

	public static function getObjsByAuthor($author)
	{
		return self::getObjs('select * from Article where author = :author',array(':author' =>$author));
	}

	public static function getObjByCategory($category)
	{
		return self::getObj('select * from Article where category = :category',array(':category' => $category));
	}

	public static function getObjsByCategory($category)
	{
		return self::getObjs('select * from Article where category = :category',array(':category' =>$category));
	}

	public static function getObjByTimestamp($timestamp)
	{
		return self::getObj('select * from Article where timestamp = :timestamp',array(':timestamp' => $timestamp));
	}

	public static function getObjsByTimestamp($timestamp)
	{
		return self::getObjs('select * from Article where timestamp = :timestamp',array(':timestamp' =>$timestamp));
	}

}
