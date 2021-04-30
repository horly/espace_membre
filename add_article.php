<?php

    //connexion à la base de données 
	include('connexting_database.php');

    $name_article = htmlspecialchars($_POST['name_article']);
    $cat_article = htmlspecialchars($_POST['cat_article']);
    $prix_achat_article = htmlspecialchars($_POST['prix_achat_article']);
    $prix_vente_article = htmlspecialchars($_POST['prix_vente_article']);
    $stock_article = htmlspecialchars($_POST['stock_article']);
    $get_id = htmlspecialchars($_POST['get_id']);

    $createdAt = date('Y-m-d h:i:sa');
    $updatedAt = date('Y-m-d h:i:sa');

    $insert = $bdd->prepare("INSERT INTO article(name, prix_achat, prix_vente, stock, createdAt, updatedAt, id_cat_art, id_user) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $insert->execute(array($name_article, $prix_achat_article, $prix_vente_article, $stock_article, $createdAt, $updatedAt, $cat_article, $get_id));

    echo "success";

?>