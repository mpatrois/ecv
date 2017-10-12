<?php

require 'Router.php';
require 'Model/User.php';



$userModel = new User();

// print($userModel);
Router::route('/users', function() use ($userModel){

	header('Content-type: application/json');
	print json_encode($userModel->all());
});

Router::route('/users/(\d+)', function($id) use ($userModel){

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$data = json_decode(file_get_contents('php://input'));
		$userModel->update($data);
	}else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
		header('Content-type: application/json');
		print json_encode($userModel->find($id));
	}
});


Router::route('/',function(){
	readfile('app.html');
});

// Router::route('public/(\d+)',function($file){
// 	print($file);
// });


return Router::execute($_SERVER['REQUEST_URI']);

// print($_SERVER['REQUEST_URI']);