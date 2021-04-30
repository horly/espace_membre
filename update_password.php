<?php

    //connexion à la base de données 
    include('connexting_database.php');

    $user_id = htmlspecialchars($_POST['user_id']);
    $new_pwd = htmlspecialchars($_POST['new_pwd']);
    $current_pwd = htmlspecialchars($_POST['current_pwd']);

    $select_pwd = $bdd->prepare("SELECT * FROM user WHERE id = ?");
    $select_pwd->execute(array($user_id));

    $infos_user = $select_pwd->fetch();
    $current_pwd_hash = sha1($current_pwd);

    $status = "failed";

    if($current_pwd_hash  == $infos_user['password'])
    {
        $status = "success";

        $new_pwd_hash = sha1($new_pwd);

        $update_user = $bdd->prepare("UPDATE user SET password = ? WHERE id = ?");
        $update_user->execute(array($new_pwd_hash, $user_id));

    }

    echo $status;

?>