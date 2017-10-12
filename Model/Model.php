<?php

  require 'Db.php';

class Model {


    public function __construct($table) {
      $this->table_name = $table;
    }

    public static function get_table(){
      return self::$table;
    }

    public function all() {
  		$db = Db::getInstance();
      $query = $db->prepare("SELECT * FROM $this->table_name");
  		$query->execute();
  		return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
      $db = Db::getInstance();
      $query = $db->prepare("SELECT * FROM $this->table WHERE id = :id");
      $query->execute(array('id' => intval($id)));
      return $query->fetch(PDO::FETCH_ASSOC);
    }

}


  
  
  
// class Animal {
//   public static $color = 'black';

//   public static function get_color()
//   {
//       return self::$color;
//   }
// }

// class Dog extends Animal {
//     public static $color = 'brown';

//     public static function get_color() 
//     {
//       return self::$color;
//     }
// }