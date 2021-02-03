<?php
	
	//connexion à la base de données 
	include('connexting_database.php');

	$name = htmlspecialchars($_POST['name']);
	$surname = htmlspecialchars($_POST['surname']);
	$birthday = htmlspecialchars($_POST['birthday']);
	$genre = htmlspecialchars($_POST['genre']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$adresse = htmlspecialchars($_POST['adresse']);

	$password = sha1($password);

	$get_email = $bdd->prepare('SELECT * FROM user WHERE email = ?');
	$get_email->execute(array($email));

	$info_user = $get_email->rowCount();

	$exist = 0;

	if(preg_match('/^[1-9]+/', $info_user))
	{
		$exist = 1;
	}
	else
	{
		$insert_user = $bdd->prepare('INSERT INTO user(name, surname, date_naissance, civilite, adresse, email, password) VALUES(?, ?, ?, ?, ?, ?, ?)');
		$insert_user->execute(array($name, $surname, $birthday, $genre, $adresse, $email, $password));

		$exist = 0;
	}

	echo $exist;
?>