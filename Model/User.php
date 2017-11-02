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


  
  public function update($data){
  	$db = Db::getInstance();
		$query = $db->prepare(
     "UPDATE $this->table 
      SET firstname=:firstname,
      lastname=:lastname,
      email=:email,
      password=:password 
      WHERE id = :id"
    );
		
    $query->execute([
      'id' => $data->id,
      'lastname' => $data->lastname,
      'firstname' => $data->firstname,
      'email' => $data->email,
      'password' => $data->password,
    ]);

    return self::find($data->id);
  
  }
  

}


?>