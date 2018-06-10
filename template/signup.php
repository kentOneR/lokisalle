

<div id="signup-overlay" class="hidden">
    <div class="form-wrapper">
        <h3>Inscription</h3>
        <form id="signup-form" method="post">
            <label for="pseudo">Pseudo</label><br>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre pseudo" autocomplete="choose your pseudo" required>
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe" autocomplete="choose your password" required>
            <label for="name">Nom</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Votre nom" autocomplete="family-name" required>
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Votre prénom" autocomplete="given-name" required>
            <label for="sex">Sexe</label>
            <select name="sex" id="sex" class="form-control">
                <option value="f">Femme</option>
                <option value="m">Homme</option>
            </select>
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Votre email" autocomplete="your email" required>
            <label for="address">Adresse</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="Votre adresse" autocomplete="your address" required>
            <label for="cp">Code postal</label>
            <input type="text" class="form-control" name="cp" id="cp" placeholder="Votre code postal" autocomplete="your zip code" required>
            <label for="city">Ville</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="Votre ville" autocomplete="your city" required>
            <label for="country">Pays</label>
            <input type="text" class="form-control" name="country" id="country" placeholder="Votre pays" autocomplete="your country" required>
            <input type="submit" class="btn btn-default" value="Valider">
        </form>
        <div id="signup-result"></div>
    </div>
</div>
