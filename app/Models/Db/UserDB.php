<?php
namespace MattMVC\Models\Db;

use MattMVC\Models\Gen\ModelClass as Model;

class UserDB implements \MattMVC\Models\Gen\ModelInterface
{
	protected $db;
	protected $photo;
	protected $website;
	protected $id;
	protected $email;
	protected $password;

	function __construct( $fields = null )
	{
		foreach( $fields as $key => $value ) {
			$this->$key = $value;
		}
		$model = new Model();
		$this->db = $model->getDb();
	}

	public function getPhoto()
	{
		return $this->photo;
	}
	public function setPhoto($photo)
	{
		$this->photo = $photo;
	}
	public function getWebsite()
	{
		return $this->website;
	}
	public function setWebsite($website)
	{
		$this->website = $website;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($email)
	{
		$this->email = $email;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function save()
	{
		$obj = self::getObj($this->id);
		$data = array('website' => $this->website, 'id' => $this->id, 'email' => $this->email, 'email' => $this->email);		if($obj) {//update
			$this->db->update("User",$data,array('id' => $this->id));
			return $this->id;
		} else {//insert
			$this->db->insert("User",$data);
			$obj = self::getObj("select * from User where website = :website AND id = :id AND email = :email AND email = :email",array(':website' => $this->website, ':id' => $this->id, ':email' => $this->email, ':email' => $this->email));
			return $obj->id;
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($sql,$params = array())
	{
		$model = new Model();
		$db = $model->getDb();
		if(\is_numeric($sql) == 'integer') {
			$obj = $db->select('select * from User where id = :id limit 1', array(':id' => $sql));
		} else {
			$obj = $db->select($sql . ' limit 1',$params);
		}
		return $obj ? new \MattMVC\Models\User($obj[0]) : null;
	}

	public static function getObjs($sql,$params = array())
	{
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql,$params);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \MattMVC\Models\User($obj);
		}
		return $output;
	}

	public static function getObjsAll()
	{
		return self::getObjs('select * from User');
	}

	public static function getObjByPhoto($photo)
	{
		return self::getObj('select * from User where photo = :photo',array(':photo' => $photo));
	}

	public static function getObjsByPhoto($photo)
	{
		return self::getObjs('select * from User where photo = :photo',array(':photo' =>$photo));
	}

	public static function getObjByWebsite($website)
	{
		return self::getObj('select * from User where website = :website',array(':website' => $website));
	}

	public static function getObjsByWebsite($website)
	{
		return self::getObjs('select * from User where website = :website',array(':website' =>$website));
	}

	public static function getObjById($id)
	{
		return self::getObj('select * from User where id = :id',array(':id' => $id));
	}

	public static function getObjsById($id)
	{
		return self::getObjs('select * from User where id = :id',array(':id' =>$id));
	}

	public static function getObjByEmail($email)
	{
		return self::getObj('select * from User where email = :email',array(':email' => $email));
	}

	public static function getObjsByEmail($email)
	{
		return self::getObjs('select * from User where email = :email',array(':email' =>$email));
	}

	public static function getObjByPassword($password)
	{
		return self::getObj('select * from User where password = :password',array(':password' => $password));
	}

	public static function getObjsByPassword($password)
	{
		return self::getObjs('select * from User where password = :password',array(':password' =>$password));
	}

}
