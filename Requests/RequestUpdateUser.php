<?php 

// require 'Model/User.php';

class Validator{

	static public function checkers(){
		return [
			'required' => function($value,$params){
				return ($value != '' && $value != null);
			},
			'email' => function($value,$params){
				return filter_var($value, FILTER_VALIDATE_EMAIL);
			},
			'min' => function($value,$params){
				return strlen($value) >= $params[0];
			},
			'max' => function($value,$params){
				return strlen($value) <= $params[0];
			},
			'letters' => function ($value,$params)
			{
				return preg_match('/^[a-zA-Z]+$/', $value);
			},
			'confirmation' => function ($value,$params,$nameField,$allValues)
			{
				return $value == $allValues[$nameField.'_confirmation'];
			},
			'correct' => function ($value,$params,$nameField,$allValues)
			{
				$userModel = new User();
				$user = $userModel->find($allValues['id']);

				return $value == $user[$nameField];
			}
		];
	}
	
}

class RequestUpdateUser{
	
	static public function rules(){
		return [
			'firstname' => 'letters|min:2|max:20',
			'lastname'  => 'letters|min:2|max:20',
			'email'     => 'email',
			'password'  => 'correct',
			'new_password'  => 'min:10|confirmation',
		];
	}

	static public function messages(){
		return [
			'firstname.letters' => 'Le prénom ne doit contenir que des lettres',
			'firstname.min' => 'Le prénom doit contenir au moins 2 charactères',
			'firstname.max' => 'Le prénom doit contenir maximum 20 charactères',
			
			'lastname.letters' => 'Le nom ne doit contenir que des lettres',
			'lastname.min' => 'Le nom doit contenir au moins 2 charactères',
			'lastname.max' => 'Le nom doit contenir maximum 20 charactères',
			
			'email.email' => 'Le mail doit être valide',

			'password.correct'  => 'Le mot de passe utilisateur fourni n\'est pas le même quen BDD',

			'new_password.min'  => 'Le nouveau mot de passe doit contenir minimum 10 charactères',
			'new_password.confirmation'  => 'Le mot de passe de confirmation ne correspond pas',
		];
	}

	static public function runValidation($data){
		$data = json_decode(json_encode($data), true);
		$messages = [];
		foreach (self::rules() as $field => $checkersWithAttr) {
			
			$valueToCheck = $data[$field];

			$allCheckers = explode('|',$checkersWithAttr);
			
			foreach ($allCheckers as $checkerWithAttr) {

				$dataCheck = explode(':',$checkerWithAttr);
				$checker = array_shift($dataCheck);
				$attr = $dataCheck;

				if(!Validator::checkers()[$checker]($valueToCheck,$attr,$field,$data)){
					
					if(!isset($messages[$field])){
						$messages[$field] = [];
					}
					
					$messages[$field][] = self::messages()[$field.'.'.$checker];
				}
			}
			
			
		}
		return $messages;
	}
} 