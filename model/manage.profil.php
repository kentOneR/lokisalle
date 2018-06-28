<?php

require_once('init.inc.php');

if(isset($_POST)) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlentities(addslashes($value));
    }
    $id_member = $_SESSION['membre']['id_membre'];

    $req = $pdo->prepare("UPDATE membre SET 
        pseudo = '$_POST[pseudo]',
        nom = '$_POST[name]', 
        prenom = '$_POST[firstname]', 
        email = '$_POST[email]', 
        civilite = '$_POST[sex]', 
        adresse = '$_POST[address]',
        cp = '$_POST[cp]',
        ville = '$_POST[city]'
        WHERE id_membre = ? ");
    $req->execute(array($id_member));

    header('location:../profil.php');

}


?>