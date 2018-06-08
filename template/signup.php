

<div id="signup-overlay" class="hidden">
    <form id="signup-form" method="post">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre pseudo" autocomplete="choose your pseudo">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe" autocomplete="choose your password">
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Votre nom" autocomplete="family-name">
        <label for="firstname">Prénom</label>
        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Votre prénom" autocomplete="given-name">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Votre email" autocomplete="your email">
        <label for="sex">Sexe</label>
        <select name="sex" id="sex" class="form-control">
            <option value="f">Femme</option>
            <option value="m">Homme</option>
        </select>
        <input type="submit" class="btn btn-default" value="Valider">
    </form>
    <div id="signup-result"></div>
</div>
