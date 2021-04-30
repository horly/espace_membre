<?php

    //connexion à la base de données 
    include('connexting_database.php');
    
    $user_id =  htmlspecialchars($_POST['user_id']);
    $civilite =  htmlspecialchars($_POST['civilite']);
    $nom =  htmlspecialchars($_POST['nom']);
    $surname =  htmlspecialchars($_POST['surname']);
    $date_naissance =  htmlspecialchars($_POST['date_naissance']);
    $adresse =  htmlspecialchars($_POST['adresse']);
    $emailadresse =  htmlspecialchars($_POST['emailadresse']);


    $update_user = $bdd->prepare("UPDATE user SET civilite = ?, name = ?, surname = ?, date_naissance = ?, adresse = ?, email = ? WHERE id = ?");
    $update_user->execute(array($civilite, $nom, $surname, $date_naissance, $adresse, $emailadresse, $user_id)); 

    $status = "success";

    echo $status;

?>