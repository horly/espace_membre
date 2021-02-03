<?php
	//connexion à la base de données 
	include('connexting_database.php');
	$password = htmlspecialchars($_POST['password']);
	$email = htmlspecialchars($_POST['email']);

	$password = sha1($password);

	$get_email = $bdd->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
	$get_email->execute(array($email, $password));

	$info_user = $get_email->rowCount();

	$exist = 0;

	if(preg_match('/^[1-9]+/', $info_user))
	{
		$exist = 1;
	}
	else
	{
		$exist = 0;
	}

	echo $exist;
	
?>