<?php

    //connexion à la base de données 
	include('connexting_database.php');

    $name_cat_article = htmlspecialchars($_POST['name_cat_article']);
    $id_cat_art = htmlspecialchars($_POST['id_cat_art']);

    $updatedAt = date('Y-m-d h:i:s');

    $update = $bdd->prepare("UPDATE cat_article SET name = ?, updatedAt = ? WHERE id = ?");
    $update->execute(array($name_cat_article, $updatedAt, $id_cat_art));

    echo "success";

?>