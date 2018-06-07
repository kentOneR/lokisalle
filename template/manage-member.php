<?php 

if(isset($_GET['action']) && ($_GET['action'] == "add-member" || $_GET['action'] == "edit-member")) :

    // récupération des membres
    if(isset($_GET['action']) && $_GET['action'] == 'update') {
        $r = $pdo->prepare("SELECT * FROM membre WHERE id_membre = $_GET[id_membre]");
        $r->execute(array($_GET[id_membre]));
        $member = $r->fetch(PDO::FETCH_ASSOC);
    }

    $id_member = (isset($member['id_membre'])) ? $member['id_membre'] : '';
    $pseudo = (isset($member['pseudo'])) ? $member['pseudo'] : '';
    $name = (isset($member['nom'])) ? $member['nom'] : '';
    $firstname = (isset($member['prenom'])) ? $member['prenom'] : '';
    $email = (isset($member['email'])) ? $member['email'] : '';
    $sex = (isset($member['sexe'])) ? $member['sexe'] : '';
    $city = (isset($member['ville'])) ? $member['ville'] : '';
    $zipcode = (isset($member['cp'])) ? $member['cp'] : '';
    $address = (isset($member['adresse'])) ? $member['adresse'] : '';
    $status = (isset($member['statut'])) ? $member['statut'] : '';

?>
    <h2>Gestion des membres</h2>

    <form class="col-sm-6" method="post">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre pseudo" value="<?= $pseudo ?>">
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Votre nom" value="<?= $name?>">
        <label for="firstname">Prénom</label>
        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Votre prénom" value="<?= $firstname ?>">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Votre email" value="<?= $email ?>">
        <label for="sexe">Sexe</label>
        <select class="form-control" name="sexe" id="sexe">
            <option value="m" <?= ($sex == "m") ? ' selected' : '' ;?> >Homme</option>
            <option value="f" <?= ($sex == "f") ? ' selected' : '' ;?> >Femme</option>
        </select><br>
        <label for="statut">Statut</label>
        <select class="form-control" name="statut" id="statut">
            <option value="0" <?= ($status == 0) ? ' selected' : '' ;?> >Membre</option>
            <option value="1" <?= ($status == 1) ? ' selected' : '' ;?> >Admin</option>
        </select><br>
        <input type="submit" class="btn btn-default" value="Valider">
    </form>

<?php elseif(isset($_GET['action']) && $_GET['action'] == "show-member"):
    $r = $pdo->prepare("SELECT * FROM membre");
    $r->execute();
    $memberList = $r->fetchAll(PDO::FETCH_ASSOC);
    $columnMembreList = $r->columnCount();

    ?>
    <h2>Liste des membres</h2>
    <table border="1" cellpadding="5">
        <tr>
        <?php for ($i=0; $i < $columnMembreList  ; $i++) { 
            $column = $r->getColumnMeta($i);
            if($column['name'] != 'mdp') { ?>
            <th><?=$column['name']?></th>
        <?php }
        } ?>
            <th>Modification</th>
            <th>Suppression</th>
        </tr>
        <?php foreach ($memberList as $key => $membre) { ?>
            <tr>
                <?php foreach ($membre as $key => $value) {
                    if($key != 'mdp') { ?>
                        <td> <?= $value ?></td>
                <?php }
                } ?>
                <td><a href="?action=edit-member&id_member=<?= $membre['id_membre'] ?>">Modif</a></td>
                <td><a href="?action=delete-member&id_member=<?= $membre['id_membre'] ?>" onClick="confirm(\'En êtes vous sur?\')">Suppr</a></td>
            </tr>
        <?php } ?>
    </table>


<?php endif; ?>


