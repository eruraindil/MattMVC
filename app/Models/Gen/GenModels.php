<?php
namespace MattMVC\Models\Gen;

use \MattMVC\Core\App;
use \MattMVC\Core\Database;
use \MattMVC\Core\Debug;

class GenModels
{
  private $isSqlite = false;

  public function __construct()
  {
    $db = Database::get();

    $this->isSqlite = App::DB_TYPE == 'sqlite';
    if($this->isSqlite) {
      $query = $db->prepare("select name from sqlite_master where type='table'");
    } else {
      $query = $db->prepare("show tables from " . DB_NAME);
    }

    $query->execute();

    //$tables = array();
    while($rows = $query->fetch(Database::FETCH_CLASSTYPE)){
      if($this->isSqlite) {
        $tableQuery = $db->prepare("PRAGMA TABLE_INFO(" . $rows[0] . ");");
      } else {
        $tableQuery = $db->prepare("show columns from " . $rows[0]);
      }
      $tableQuery->execute();

      $rows['columns'] = array();
      while($tableRows = $tableQuery->fetch(Database::FETCH_OBJ)) {
        $rows['columns'][] = $tableRows;
      }

      $this->genFile($rows);
    }
  }

  public function genFile($table)
  {
    // echo "<pre>" . print_r($table,1) . "</pre>";
    // return;

    $fnDB = $table[0] . "DB.php";
    $flDB = __DIR__ . "/../Db/" . $fnDB;

    $foDB = new \SplFileObject( $flDB, "w");
    $foDB->fwrite($this->writeDBFile($table));
    \chmod($flDB ,0775);

    $fn = $table[0] . ".php";
    $fl = __DIR__ . "/../" . $fn;

    if(!file_exists($fl)) {
      $fo = new \SplFileObject( $fl, "x");
      if( isset($fo) ) {
        $fo->fwrite($this->writeFile($table));
        \chmod($fl ,0775);
      }
    }
  }

  public function writeDBFile($table)
  {
    $output = "";
    $output .= "<?php\nnamespace MattMVC\\Models\\Db;\n\n";
    $output .= "use MattMVC\\Models\\Gen\\ModelClass as Model;\n\n";
    $output .= "class $table[0]DB implements \\MattMVC\\Models\\Gen\\ModelInterface\n{\n";

    $output .= "\tprotected \$db;\n";
    foreach($table['columns'] as $column) {
      $field = $this->getField($column);
      $output .= "\tprotected \$" . $field . ";\n";
    }

    $output .= "\n\tfunction __construct( \$fields = null )\n\t{\n";
    $output .= "\t\tforeach( \$fields as \$key => \$value ) {\n";
    $output .= "\t\t\t\$this->\$key = \$value;\n";
    $output .= "\t\t}\n";
    $output .= "\t\t\$model = new Model();\n";
		$output .= "\t\t\$this->db = \$model->getDb();\n";

    $output .= "\t}\n\n";

    foreach($table['columns'] as $column) {
      $field = $this->getField($column);
      $output .= "\tpublic function get" . \ucfirst($field) . "()\n\t{\n";
      $output .= "\t\treturn \$this->" . $field . ";\n";
      $output .= "\t}\n";

      $output .= "\tpublic function set" . \ucfirst($field) . "(\$" . $field . ")\n\t{\n";
      $output .= "\t\t\$this->" . $field . " = \$" . $field . ";\n";
      $output .= "\t}\n";
    }

    $output .= "\n\tpublic function save()\n\t{\n";
    $output .= "\t\t\$obj = self::getObj(\$this->id);\n";
    $output .= "\t\t\$data = array(";
    $i = 0;
    for($i; $i < \count($table['columns']); $i++) {
      $field = $this->getField($table['columns'][$i]);
      $output .= "'" . $field . "' => \$this->" . $field . ", ";
    }
    $output .= "'" . $field . "' => \$this->" . $field;
    $output .= ");\n";
    $output .= "\t\tif(\$obj) {//update\n";
    $output .= "\t\t\t\$this->db->update(\"" . App::DB_PREFIX . $table[0] . "\",\$data,array('id' => \$this->id));\n";
    $output .= "\t\t\treturn \$this->id;\n";
    $output .= "\t\t} else {//insert\n";
    $output .= "\t\t\t\$this->db->insert(\"" . App::DB_PREFIX . $table[0] . "\",\$data);\n";
    $output .= "\t\t\t\$obj = self::getObj(\"select * from " . App::DB_PREFIX . $table[0] . " where ";
    $i = 1;
    for($i; $i < \count($table['columns']) - 1; $i++) {
      $field = $this->getField($table['columns'][$i]);
      $output .= $field . " = :" . $field . " AND ";
    }
    $output .= $field . " = :" . $field;
    $output .= "\",array(";
    $i = 1;
    for($i; $i < \count($table['columns']) - 1; $i++) {
      $field = $this->getField($table['columns'][$i]);
      $output .= "':" . $field . "' => \$this->" . $field . ", ";
    }
    $output .= "':" . $field . "' => \$this->" . $field;
    $output .= "));\n";
    $output .= "\t\t\treturn \$obj->id;\n";
    $output .= "\t\t}\n";
    $output .= "\t}\n";

    $output .= "\n\t//////////////////////////////////////////////////////////////////////////////\n";

    $output .= "\tpublic static function getObj(\$sql,\$params = array())\n\t{\n";
    $output .= "\t\t\$model = new Model();\n";
    $output .= "\t\t\$db = \$model->getDb();\n";
    $output .= "\t\tif(\\is_numeric(\$sql) == 'integer') {\n";
    $output .= "\t\t\t\$obj = \$db->select('select * from " . App::DB_PREFIX . $table[0] . " where id = :id limit 1', array(':id' => \$sql));\n";
    $output .= "\t\t} else {\n";
    $output .= "\t\t\t\$obj = \$db->select(\$sql . ' limit 1',\$params);\n";
    $output .= "\t\t}\n";
    $output .= "\t\treturn \$obj ? new \\MattMVC\\Models\\" . $table[0] . "(\$obj[0]) : null;\n";
    $output .= "\t}\n\n";

    $output .= "\tpublic static function getObjs(\$sql,\$params = array())\n\t{\n";
    $output .= "\t\t\$model = new Model();\n";
    $output .= "\t\t\$db = \$model->getDb();\n";
    $output .= "\t\t\$objs = \$db->select(\$sql,\$params);\n";
    $output .= "\t\t\$output = array();\n";
    $output .= "\t\tforeach( \$objs as \$obj ) {\n";
    $output .= "\t\t\t\$output[] = new \\MattMVC\\Models\\" . $table[0] . "(\$obj);\n";
    $output .= "\t\t}\n";
    $output .= "\t\treturn \$output;\n";
    $output .= "\t}\n\n";

    $output .= "\tpublic static function getObjsAll()\n\t{\n";
    $output .= "\t\treturn self::getObjs('select * from " . App::DB_PREFIX . $table[0] . "');\n";
    $output .= "\t}\n\n";

    foreach($table['columns'] as $column) {
      $field = $this->getField($column);
      $output .= "\tpublic static function getObjBy" . \ucfirst($field) . "(\$" . $field . ")\n\t{\n";
      $output .= "\t\treturn self::getObj('select * from " . App::DB_PREFIX . $table[0] . " where " . $field . " = :" . $field . "',array(':" . $field . "' => \$" . $field . "));\n";
      $output .= "\t}\n\n";

      $output .= "\tpublic static function getObjsBy" . \ucfirst($field) . "(\$" . $field . ")\n\t{\n";
      $output .= "\t\treturn self::getObjs('select * from " . App::DB_PREFIX . $table[0] . " where " . $field . " = :" . $field . "',array(':" . $field . "' =>\$" . $field . "));\n";
      $output .= "\t}\n\n";
    }

    $output .= "}\n";

    return $output;
  }

  public function writeFile($table)
  {
    $output = "";
    $output .= "<?php\nnamespace MattMVC\\Models;\n\n";
    $output .= "class $table[0] extends \\MattMVC\\Models\\Db\\$table[0]DB\n{\n";

    // foreach($table['columns'] as $column) {
    //   $field = $this->getField($column);
    //   $output .= "\tprotected \$" . $field . ";\n";
    // }

    $output .= "\n\tfunction __construct( \$fields = null )\n\t{\n";
    $output .= "\t\tparent::__construct( \$fields );\n";
    $output .= "\t}\n\n";
    $output .= "}\n";

    return $output;
  }

  private function getField($obj) {
    if($this->isSqlite) {
      return $obj->name;
    } else {
      return $obj->Field;
    }
  }
}
