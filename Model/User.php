<?php

  require 'Model.php';

  class User extends Model {
    
    public $table = 'users';

    public function __construct() {
    	parent::__construct($this->table);
    }

    public function find($id) {
      $db = Db::getInstance();
      $query = $db->prepare("SELECT * FROM $this->table WHERE id = :id");
      $query->execute(array('id' => intval($id)));
      return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function udpate($data){
    	$db = Db::getInstance();
		$query = $db->prepare("SELECT * FROM $this->table WHERE id = :id");
		$query->execute(array('id' => intval($id)));
		return $query->fetch(PDO::FETCH_ASSOC);
    }

  }


?>