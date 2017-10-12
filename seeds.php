<?php

$configDB = json_decode(file_get_contents('config.json'), false);
$dataUsers = json_decode(file_get_contents('dataUsers.json'), false);

// var_dump($configDB);
// var_dump($dataUsers);


$pdo = null;

try {
	
	$host = $configDB->host;
	$database = $configDB->database;
	$user = $configDB->user;
	$password = $configDB->password;

    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);

    $sqlResetDB = file_get_contents('database/fullOperations.sql');

    $pdo->exec($sqlResetDB);
    // foreach($pdo->query('SELECT * from users') as $row) {
    //     print_r($row);
    // }

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


if($pdo!=null){

    // foreach($pdo->query('SELECT * from users') as $row) {
    //     print_r($row);
    // }


    $insertUser = $pdo->prepare("INSERT INTO users (id, firstname, lastname) VALUES (null, :firstname, :lastname)");
    $insertPhone = $pdo->prepare("INSERT INTO users_phones (user_id,phone_number,phone_type_id) VALUES (:userid, :phone_number,:phone_type_id)");


    foreach ($dataUsers as $user) {
    
        $insertUser->execute([
            ':firstname' => $user->firstname, 
            ':lastname' => $user->lastname
        ]);
        
        $userId = $pdo->lastInsertId();
        
        foreach ($user->phones as $phone) {
            $insertPhone->execute([
                ':userid' => $userId, 
                ':phone_number' => $phone->phone_number, 
                ':phone_type_id' => $phone->phone_type_id
            ]);
        }




    }








}