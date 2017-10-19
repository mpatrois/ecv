<?php 

require 'Validator.php';


class RequestUpdateUser{
	
	static public function rules(){
		return [
			'firstname' => 'required',
			'lastname'  => 'required',
			'email'     => 'email',
			'password'  => 'min8',
		];
	}

	static public function messages(){
		return [
			'firstname' => 'Le prénom doit être renseigné',
			'lastname' => 'Le nom doit être renseigné',
			'email'     => 'Le mail doit être valide',
			'password'  => 'Le mot de passe doit contenir minimum 8 charactères',
		];
	}

	static public function runValidation($data){
		$data = json_decode(json_encode($data), true);
		$messages = [];
		foreach (self::rules() as $field => $checker) {

			if(!Validator::checkers()[$checker]($data[$field])){
				$messages[$field] = self::messages()[$field];
			}
		}
		return $messages;
	}
} 