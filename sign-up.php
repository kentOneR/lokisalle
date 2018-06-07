<?php 

require_once('inc/header.php');

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


<form method="post">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre pseudo">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe">
    <label for="name">Nom</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Votre nom">
    <label for="firstname">Prénom</label>
    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Votre prénom">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Votre email">
    <label for="sexe">Sexe</label>
    <input type="radio" class="form-control" name="sexe" id="sexe-h" value="m" checked>Homme
    <input type="radio" class="form-control" name="sexe" id="sexe-f" value="f">Femme
    <label for="city">Ville</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Votre ville">
    <label for="zipcode">Code postal</label>
    <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Votre code postal">
    <label for="address">Adresse</label>
    <input type="text" class="form-control" name="address" id="address" placeholder="Votre adresse"><br>
    <input type="submit" class="btn btn-default" value="Valider">
</form>
<br>

<?= $content ?>

<?php require_once('inc/footer.php'); ?>