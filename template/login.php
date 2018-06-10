<?php 

if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_destroy();
    header('location:index.php');
}

?>

<div id="connexion-overlay" class="hidden">
    <div class="form-wrapper">
        <h3>Connexion</h3>
        <form id="connexion-form" method="post">
            <label for="check-pseudo">Pseudo</label><br>
            <input type="text" class="form-control" name="check-pseudo" id="check-pseudo" placeholder="Votre pseudo" autocomplete="your pseudo">
            <label for="check-password">Mot de passe</label>
            <input type="password" class="form-control" name="check-password" id="check-password" placeholder="Votre mot de passe" autocomplete="current-password"><br>
            <input type="submit" class="btn btn-default" value="Valider">
        </form>
        <div id="login-result"></div>
    </div>
</div>
