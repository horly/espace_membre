<?php

    //connexion à la base de données 
	include('connexting_database.php');

    $id_art = htmlspecialchars($_POST['id_art']);

    $delete = $bdd->prepare("DELETE FROM article WHERE id = ?");
    $delete->execute(array($id_art));

    

?>