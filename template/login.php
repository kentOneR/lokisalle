<?php 

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    session_destroy();
    // unset($_SESSION['member']);
}

if(userConnect()) {
    header('location:profil.php');
    exit();
} 

?>

<div id="connexion-overlay" class="hidden">
    <form id="connexion-form" method="post">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" class="form-control" name="pseudo" id="check-pseudo" placeholder="Votre pseudo">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="check-password" placeholder="Votre mot de passe"><br>
        <input type="submit" class="btn btn-default" value="Valider">
    </form>
    <div id="login-result"></div>
</div>
