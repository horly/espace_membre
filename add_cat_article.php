<?php

    //connexion à la base de données 
	include('connexting_database.php');

    $name_cat_article = htmlspecialchars($_POST['name_cat_article']);
    $get_id = htmlspecialchars($_POST['get_id']);

    $createdAt = date('Y-m-d h:i:sa');
    $updatedAt = date('Y-m-d h:i:sa');

    $insert = $bdd->prepare("INSERT INTO cat_article(name, createdAt, updatedAt, id_user) VALUES(?, ?, ?, ?)");
    $insert->execute(array($name_cat_article, $createdAt, $updatedAt, $get_id));

    echo "success";

?>