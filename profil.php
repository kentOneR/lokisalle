<?php
    include_once('inc/header.php');

    if(userConnect()) {
        $id_member = $_SESSION['membre']['id_membre'];
        $memberReq = $pdo->prepare("SELECT * FROM membre WHERE id_membre = ?");
        $memberReq->execute(array($id_member));
        $memberReq = $memberReq->fetchAll(PDO::FETCH_ASSOC);
        $memberReq = $memberReq[0];
        var_dump($memberReq);
    }

?>

<h1>Mon compte</h1>

<div class="profil-wrapper">
    <h2>Vos informations</h2>
    <p>Pseudo: <?= $memberReq['pseudo'] ?></p>
    <p>Nom: <?= $memberReq['nom'] ?></p>
    <p>Prenom: <?= $memberReq['prenom'] ?></p>
    <p>Civilité: <?= $memberReq['civilite'] ?></p>
    <p>Email: <?= $memberReq['email'] ?></p>
</div>
<div class="address-wrapper">
    <h2>Adresse de facturation</h2>
    <p>Adresse: <?= $memberReq['adresse'] ?></p>
    <p>Code postale: <?= $memberReq['cp'] ?></p>
    <p>Ville: <?= $memberReq['ville'] ?></p>
    <p>Pays: <?= $memberReq['pays'] ?></p>
</div>

<?php include_once('inc/footer.php'); ?>