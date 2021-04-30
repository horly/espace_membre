<?php 
	//connexion à la base de données 
	include('connexting_database.php');

	$id_art = $_POST['id_art'];
	$image = $_POST['base64'];

	$update_profile = $bdd->prepare("UPDATE article SET photo = ? WHERE id = ?"); 
	$update_profile->execute(array($id_art, $id_art)) or die (print_r($update_profile->errorInfo()));

	$folderPath = "images/articles/";
	$image_parts = explode(";base64,",$image);
	$image_type_aux = explode("image/", $image_parts[0]);
	$image_type = $image_type_aux[1];
	$image_base64 = base64_decode($image_parts[1]);
	$file = $folderPath  . $id_art . '.png';
	file_put_contents($file, $image_base64);
?>