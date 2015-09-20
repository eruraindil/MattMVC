<?php
namespace MattMVC\Models\Db;

use MattMVC\Models\Gen\ModelClass as Model;

class ArticleCategoryDB implements \MattMVC\Models\Gen\ModelInterface
{
	protected $db;
	protected $id;
	protected $name;

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
	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}

	public function save()
	{
		$obj = self::getObj($this->id);
		$data = array('id' => $this->id, 'name' => $this->name, 'name' => $this->name);
		if($obj) {//update
			$this->db->update("ArticleCategory",$data,array('id' => $this->id));
			return $this->id;
		} else {//insert
			$this->db->insert("ArticleCategory",$data);
			$obj = self::getObj("select * from ArticleCategory where name = :name",array(':name' => $this->name));
			return $obj->id;
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($sql,$params = array())
	{
		$model = new Model();
		$db = $model->getDb();
		if(\is_numeric($sql) == 'integer') {
			$obj = $db->select('select * from ArticleCategory where id = :id limit 1', array(':id' => $sql));
		} else {
			$obj = $db->select($sql . ' limit 1',$params);
		}
		return $obj ? new \MattMVC\Models\ArticleCategory($obj[0]) : null;
	}

	public static function getObjs($sql,$params = array())
	{
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql,$params);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \MattMVC\Models\ArticleCategory($obj);
		}
		return $output;
	}

	public static function getObjsAll()
	{
		return self::getObjs('select * from ArticleCategory');
	}

	public static function getObjById($id)
	{
		return self::getObj('select * from ArticleCategory where id = :id',array(':id' => $id));
	}

	public static function getObjsById($id)
	{
		return self::getObjs('select * from ArticleCategory where id = :id',array(':id' =>$id));
	}

	public static function getObjByName($name)
	{
		return self::getObj('select * from ArticleCategory where name = :name',array(':name' => $name));
	}

	public static function getObjsByName($name)
	{
		return self::getObjs('select * from ArticleCategory where name = :name',array(':name' =>$name));
	}

}
