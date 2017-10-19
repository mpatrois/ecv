<?php

class Validator{

	static public function checkers(){
		return [
			'required' => function($value){
				return ($value != '' && $value != null);
			},
			'email' => function($value){
				return filter_var($value, FILTER_VALIDATE_EMAIL);
			},
			'min8' => function($value){
				return strlen($value) >= 8;
			},
		];
	}
	
}