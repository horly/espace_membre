<?php

    //connexion à la base de données 
	include('connexting_database.php');

    $name_article = htmlspecialchars($_POST['name_article']);
    $cat_article = htmlspecialchars($_POST['cat_article']);
    $prix_achat_article = htmlspecialchars($_POST['prix_achat_article']);
    $prix_vente_article = htmlspecialchars($_POST['prix_vente_article']);
    $stock_article = htmlspecialchars($_POST['stock_article']);
    $id_art = htmlspecialchars($_POST['id_art']);
    $get_id = htmlspecialchars($_POST['get_id']);

    $updatedAt = date('Y-m-d h:i:s');

    $update = $bdd->prepare("UPDATE article SET name = ?, prix_achat = ?, prix_vente = ?, stock = ?, updatedAt = ?, id_cat_art = ?, id_user = ? WHERE id = ?");
    $update->execute(array($name_article, $prix_achat_article, $prix_vente_article, $stock_article, $updatedAt, $cat_article, $get_id, $id_art));

    echo "success";

?>