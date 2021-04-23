<?php

if(isset($_COOKIE['auth']) && !isset($_SESSION['connect'])) {

    //VARIABLE
    $secret = htmlspecialchars($_COOKIE['auth']);

    //VERIFICATION
    require('db/dbConnexion.php');

    // REQUETE SI L'UTILISATEUR EXISTE BIEN
    $req = $db->prepare("SELECT cout(*) as numberAccount FROM user WHERE secret = ?");
    $req->execute(array($secret));

    // REQUETE POUR RECUPERER LES INFORMATIOS DE L'UTILISATEUR
    while($user = $req->fetch()) {
        if($user['numberAccount'] == 1){

            $reqUser = $db->prepare("SELECT * FROM user WHERE secret = ?");
            $reqUser->execute(array($secret));

            while($userAccount = $reqUser->fetch()) {
                $_SESSION['connect'] = 1;
		        $_SESSION['email'] = $userAccount['email'];
            }
        }
    }
}


?>