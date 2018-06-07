<?php 

require_once('init.inc.php');

if(userConnect()) {
    header('location:profil.php');
    exit();
}

if($_POST){
    $erreur = '';

    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlentities(addslashes($value));
    }
    $pseudo = $_POST['pseudo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $address = $_POST['address'];


    if(strlen($pseudo) <= 3 || strlen($pseudo) > 20) {
        $erreur .= '<div class="alert alert-danger">Erreur taille pseudo</div>';
    }
    $r = executeRequest("SELECT * FROM membre WHERE pseudo = '$pseudo'");
    if($r->rowCount() >= 1) {
        $erreur .= '<div class="alert alert-danger">Pseudo indisponible</div>';
    }


    if(empty($erreur)) {
        executeRequest("INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse) VALUES (
        '$pseudo', 
        '$password', 
        '$name',
        '$firstname',
        '$email',
        '$sexe',
        '$city',
        '$zipcode',
        '$address'
        )");
        $content .= '<div class="alert alert-success">Inscription validée! <a href="'.URL.'connexion.php">Cliquez ici pour vous connecter</a></div>';
    }
    $content .= $erreur; // Affiche les erreurs
}


?>