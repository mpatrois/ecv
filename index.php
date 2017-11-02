<?php

require 'Router.php';
require 'Model/User.php';
require 'Requests/RequestUpdateUser.php';


$userModel = new User();

// print($userModel);
Router::route('/users', function() use ($userModel){
	header('Content-type: application/json');
	print json_encode($userModel->all());
});

Router::route('/users/(\d+)', function($id) use ($userModel){
	
	header('Content-type: application/json');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$data = json_decode(file_get_contents('php://input'));
		
		$messages = RequestUpdateUser::runValidation($data);
		if(count($messages)>0){
			header("HTTP/1.1 401 Unauthorized");
			print json_encode($messages);
		}else{
			$result = $userModel->update($data);
			print json_encode($result);
		}
		
		

	}else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
		$result = $userModel->find($id);
		header('Content-type: application/json');
		print json_encode($result);
	}

});


Router::route('/',function(){
	readfile('app.html');
});


return Router::execute($_SERVER['REQUEST_URI']);