<?php
    include_once('inc/header.php');

    if(userConnect()) {
        $id_member = $_SESSION['membre']['id_membre'];
        $memberReq = $pdo->prepare("SELECT * FROM membre WHERE id_membre = ?");
        $memberReq->execute(array($id_member));
        $memberReq = $memberReq->fetchAll(PDO::FETCH_ASSOC);
        $memberReq = $memberReq[0];
    } else {
        header('location:index.php');
    }

?>

<nav id="nav-admin">
    <ul>
        <li><a href="profil.php?action=edit-profil">Mettre à jour mon profil</a></li>
        <li><a href="profil.php?action=pending-booking">Mes réservations en attente</a></li>
        <li><a href="profil.php?action=confirm-booking">Mes réservations confirmées</a></li>
    </ul>
</nav>

<h1>Mon compte</h1>

<div class="profil-wrapper">
    <h2>Vos informations</h2>
    <p>Pseudo: <?= $memberReq['pseudo'] ?></p>
    <p>Nom: <?= $memberReq['nom'] ?></p>
    <p>Prenom: <?= $memberReq['prenom'] ?></p>
    <p>Civilité: <?= ($memberReq['civilite'] == 'm') ? 'homme' : 'femme'; ?></p>
    <p>Email: <?= $memberReq['email'] ?></p>
</div>
<div class="address-wrapper">
    <h2>Adresse de facturation</h2>
    <p>Adresse: <?= $memberReq['adresse'] ?></p>
    <p>Code postale: <?= $memberReq['cp'] ?></p>
    <p>Ville: <?= $memberReq['ville'] ?></p>
</div>

<?php include_once('template/pending-booking.php'); ?>
<?php include_once('template/confirm-booking.php'); ?>

<?php include_once('inc/footer.php'); ?>