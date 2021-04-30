<?php

    //connexion à la base de données 
	include('connexting_database.php');

    $id_cat_art = htmlspecialchars($_POST['id_cat_art']);

    $delete = $bdd->prepare("DELETE FROM cat_article WHERE id = ?");
    $delete->execute(array($id_cat_art));

    

?>