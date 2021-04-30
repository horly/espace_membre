<?php
    
    //connexion à la base de données 
	include('connexting_database.php');

    $name_cat_article = htmlspecialchars($_POST['name_cat_article']);
    $id_user = htmlspecialchars($_POST['id_user']);

    $createdAt = date("Y-m-d h:i:sa");
    $updatedAt = date("Y-m-d h:i:sa");

    $insert = $bdd->prepare("INSERT INTO cat_article(name, createdAt, UpdatedAt, id_user) VALUES(?, ?, ?, ?)");
    $insert->execute(array($name_cat_article, $createdAt, $updatedAt, $id_user));

    echo "success";
?>