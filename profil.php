<?php
    include_once('inc/header.php');

    if(userConnect()) {
        $id_member = $_SESSION['membre']['id_membre'];
        $memberReq = $pdo->prepare("SELECT * FROM membre WHERE id_membre = ?");
        $memberReq->execute(array($id_member));
        $memberReq = $memberReq->fetchAll(PDO::FETCH_ASSOC);
        $memberReq = $memberReq[0];

        if(isset($_GET['action']) && $_GET['action'] == 'clear-basket'){
            unset($_SESSION['basket']);
            header('location:profil.php?action=pending-booking');
        }

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
<div class="profil-container">
    <h1>Mon compte</h1>
    <div class="row">
        <div class="profil-wrapper col-lg-6">
            <h2>Vos informations</h2>
            <p>Pseudo: <?= $memberReq['pseudo'] ?></p>
            <p>Nom: <?= $memberReq['nom'] ?></p>
            <p>Prenom: <?= $memberReq['prenom'] ?></p>
            <p>Civilité: <?= ($memberReq['civilite'] == 'm') ? 'homme' : 'femme'; ?></p>
            <p>Email: <?= $memberReq['email'] ?></p>
        </div>
        <div class="address-wrapper col-lg-6">
            <h2>Adresse de facturation</h2>
            <p>Adresse: <?= $memberReq['adresse'] ?></p>
            <p>Code postale: <?= $memberReq['cp'] ?></p>
            <p>Ville: <?= $memberReq['ville'] ?></p>
        </div>
    </div>

    <?php include_once('template/pending-booking.php'); ?>
    <?php include_once('template/confirm-booking.php'); ?>
    <?php include_once('template/add-review.php'); ?>
</div>


<?php include_once('inc/footer.php'); ?>