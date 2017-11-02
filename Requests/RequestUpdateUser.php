<?php 

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
				// return preg_match('/^[\w]+$/', $value);
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
			'password'  => 'min:10',
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
			'password.min'  => 'Le mot de passe doit contenir minimum 10 charactères',
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

				if(!Validator::checkers()[$checker]($valueToCheck,$attr)){
					
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