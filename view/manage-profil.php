<?php

if(isset($_GET['action']) && $_GET['action'] == 'edit-profil') {
    
?>
<h2>Modifier mon profil</h2>
 
<form action="model/manage.profil.php" method="post">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo" autocomplete="choose your pseudo" required value="<?= $memberReq['pseudo'] ?>">
            <label for="name">Nom</label>
            <input type="text" class="form-control" name="name" placeholder="Votre nom" autocomplete="family-name" required value="<?= $memberReq['nom'] ?>">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="firstname" placeholder="Votre prénom" autocomplete="given-name" required value="<?= $memberReq['prenom'] ?>">
            <label for="sex">Sexe</label>
            <select name="sex" class="form-control">
                <option value="f" <?= ($memberReq['civilite'] == 'f') ? 'selected' : ''; ?> >Femme</option>
                <option value="m" <?= ($memberReq['civilite'] == 'm') ? 'selected' : ''; ?> >Homme</option>
            </select>
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Votre email" autocomplete="your email" required value="<?= $memberReq['email'] ?>">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" name="address" placeholder="Votre adresse" autocomplete="your address" required value="<?= $memberReq['adresse'] ?>">
            <label for="cp">Code postal</label>
            <input type="text" class="form-control" name="cp" placeholder="Votre code postal" autocomplete="your zip code" required value="<?= $memberReq['cp'] ?>">
            <label for="city">Ville</label>
            <input type="text" class="form-control" name="city" placeholder="Votre ville" autocomplete="your city" required value="<?= $memberReq['ville'] ?>">
            <input type="submit" class="btn btn-default" value="Valider">
</form>

<?php } ?>