<?php

// $configDB = json_decode(file_get_contents('config.json'), false);

// $pdo = null;

// $pdo = new PDO("mysql:host=$configDB->host;dbname=$configDB->database", $configDB->user, $configDB->password);

// $query = $pdo->prepare("SELECT * FROM users");
// $query->execute();
// $results = $query->fetchAll(PDO::FETCH_ASSOC);
// $json = json_encode($results);

// header('Content-type: application/json');
// echo $json;

// require 'Model/User.php';

// header('Content-type: application/json');

// $userModel = new User();
// echo json_encode($userModel->all());