<?php 

// Suppression d'un membre
if(isset($_GET['action']) && $_GET['action'] == 'delete-member' && isset($_GET['id_member'])){
    var_dump($_GET['id_member']);
    $deleteReq = $pdo->prepare("DELETE FROM membre WHERE id_membre = ?");
    $deleteReq->execute(array($_GET['id_member']));

    header('location:admin?action=show-member');

}

if(isset($_GET['action']) && ($_GET['action'] == "add-member" || $_GET['action'] == "edit-member")) :

    // récupération des membres
    if(isset($_GET['id_member'])) {
        $r = $pdo->prepare("SELECT * FROM membre WHERE id_membre = ? ");
        $r->execute(array($_GET['id_member']));
        $member = $r->fetch(PDO::FETCH_ASSOC);
    }

    $id_member = (isset($member['id_membre'])) ? $member['id_membre'] : '';
    $pseudo = (isset($member['pseudo'])) ? $member['pseudo'] : '';
    $name = (isset($member['nom'])) ? $member['nom'] : '';
    $firstname = (isset($member['prenom'])) ? $member['prenom'] : '';
    $email = (isset($member['email'])) ? $member['email'] : '';
    $sex = (isset($member['civilite'])) ? $member['civilite'] : '';
    $status = (isset($member['statut'])) ? $member['statut'] : '';

?>
    <h2>Gestion des membres</h2>

    <form class="col-sm-6" action="inc/function.member.php" method="post">
        <input type="hidden" class="form-control" name="admin-id-member" id="admin-id-member" placeholder="Votre pseudo" value="<?= $id_member ?>" autocomplete="family-name">
        <label for="adminpseudo">Pseudo</label><br>
        <input type="text" class="form-control" name="adminpseudo" id="adminpseudo" placeholder="Votre pseudo" value="<?= $pseudo ?>">
        <label for="adminname">Nom</label>
        <input type="text" class="form-control" name="adminname" id="adminname" placeholder="Votre nom" value="<?= $name?>" autocomplete="family-name">
        <label for="adminfirstname">Prénom</label>
        <input type="text" class="form-control" name="adminfirstname" id="adminfirstname" placeholder="Votre prénom" value="<?= $firstname ?>" autocomplete="given-name">
        <label for="adminemail">Email</label>
        <input type="email" class="form-control" name="adminemail" id="adminemail" placeholder="Votre email" value="<?= $email ?>" autocomplete="email">
        <label for="adminsexe">Sexe</label>
        <select class="form-control" name="adminsexe" id="adminsexe">
            <option value="m" <?= ($sex == "m") ? ' selected' : '' ;?> >Homme</option>
            <option value="f" <?= ($sex == "f") ? ' selected' : '' ;?> >Femme</option>
        </select><br>
        <label for="adminstatut">Statut</label>
        <select class="form-control" name="adminstatut" id="adminstatut">
            <option value="0" <?= ($status == 0) ? ' selected' : '' ;?> >Membre</option>
            <option value="1" <?= ($status == 1) ? ' selected' : '' ;?> >Admin</option>
        </select><br>
        <input type="submit" class="btn btn-default" name="managemember" id="managemember" value="Valider">
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


