<?php

require_once('init.inc.php');

if($_POST){
    $erreur = true;
    sleep(0.1); // Une pause de 0.1 sec

    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlentities(addslashes($value));
    }
    $pseudo = $_POST['pseudo'];

    $r = $pdo->prepare("SELECT * FROM membre WHERE pseudo = ? ");
    $r->execute(array($pseudo));
    
    if($r->rowCount() === 1) {
        $membre = $r->fetch(PDO::FETCH_ASSOC);
        if(password_verify($_POST['password'], $membre['mdp'])) {

            $erreur = false;

            $_SESSION['membre']['pseudo'] = $membre['pseudo'];
            $_SESSION['membre']['name'] = $membre['nom'];
            $_SESSION['membre']['firstname'] = $membre['prenom'];
            $_SESSION['membre']['email'] = $membre['email'];
            $_SESSION['membre']['sexe'] = $membre['civilite'];
            $_SESSION['membre']['statut'] = $membre['statut'];
  
        } else { ?>
            <div class="alert alert-danger">Erreur mot de passe</div>
        <?php }
    } else { ?>
        <div class="alert alert-danger">Pseudo inconnu</div>
    <?php }

    if(!$erreur) { ?>
        <div class="alert alert-success">Bravo vous êtes connnecté :)</div>
    <?php }

}

?>