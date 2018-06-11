<?php 

require_once('init.inc.php');

// if(userConnect()) {
//     header('location:index.php');
//     exit();
// }

if($_POST){
    $error = false;

    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlentities(addslashes($value));
    }
    $pseudo = $_POST['pseudo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];

    if(strlen($pseudo) <= 3 || strlen($pseudo) > 20) { ?>
        <div class="alert alert-danger">Erreur taille pseudo</div>
    <?php $error = true;
    }
    $r = $pdo->prepare("SELECT * FROM membre WHERE pseudo = ? ");
    $r->execute(array($pseudo));
    if($r->rowCount() >= 1) { ?>
       <div class="alert alert-danger">Pseudo indisponible</div>

    <?php $error = true;
    }


    if(!$error) {
        $signupReq = $pdo->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, email, civilite, adresse, cp, ville) VALUES (
        '$pseudo', 
        '$password', 
        '$name',
        '$firstname',
        '$email',
        '$sexe',
        '$address',
        '$zip',
        '$city'
        )");
        $signupReq->execute(); ?>
        <div class="alert alert-success">Inscription validée! <a href="'.URL.'connexion.php">Cliquez ici pour vous connecter</a></div>
        <?php
    }

}

?>