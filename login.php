<?php
	//connexion à la base de données 
	include('connexting_database.php');

	$email = $_GET['email']; 

	//on recupère l'id de l'utilisateur àpartir de son adresse émail 
	$get_user = $bdd->prepare('SELECT * FROM user WHERE email = ?');
	$get_user->execute(array($email));

	$info_user = $get_user->fetch();
	$get_id = $info_user['id'];

	header('location:profile.php?id='.$get_id);
?>