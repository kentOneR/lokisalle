<?php
    include_once('inc/header.php');

    if(userConnect()) {
        $id_member = $_SESSION['membre']['id_membre'];
        $memberReq = $pdo->prepare("SELECT * FROM membre WHERE id_membre = ?");
        $memberReq->execute(array($id_member));
        $memberReq = $memberReq->fetchAll(PDO::FETCH_ASSOC);
        $memberReq = $memberReq[0];

        $pos = array_search($_GET['id-room'], $_SESSION['basket']['id-room']);
        $dateArrival = $_SESSION['basket']['arrival'][$pos];
        $dateDeparture = $_SESSION['basket']['departure'][$pos];

    } else {
        header('location:index.php');
    }
    if(isset($_GET['id-room']) && !empty($_GET['id-room'])) {
        $roomReq = $pdo->prepare("SELECT * FROM salle WHERE id_salle = ?");
        $roomReq->execute(array($_GET['id-room']));
        $roomReq = $roomReq->fetch(PDO::FETCH_ASSOC);
    }

?>

<h1>Votre réservation</h1>

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
<div class="room-description-wrapper">
    <h4>Description</h4>
    <p><?= $roomReq['description'] ?></p>
    <h4>Localisation</h4>
    <div class="map-responsive">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20996.89965735575!2d2.37898935!3d48.86559999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e394fef5115%3A0x3ba0440da060f971!2sRichelieu+-+Drouot!5e0!3m2!1sfr!2sfr!4v1528460018566" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
<div class="room-additionnal-info">
    <h4>Informations complémentaire</h4>
    <div class="room-left-info">
        <p>Capacité: <?= $roomReq['capacite'] ?></p>
        <p>Catégorie: <?= $roomReq['categorie'] ?></p>
    </div>
    <div class="room-middle-info">
        <p>Date d'arrivée: <?= $dateArrival ?></p>
        <p>Date de départ: <?= $dateDeparture ?></p>
    </div>
    <div class="room-right-info">
        <p>Adresse: <?= $roomReq['adresse'].', '.$roomReq['cp'].' '.$roomReq['ville'] ?></p>
        <p>Prix total: <?= calcNbOfDays($dateArrival, $dateDeparture) * $roomReq['prix'] ?> €</p>
    </div>
</div>
<div class="confirm-booking">
    <form id="confirm-booking" action="inc/function.booking.php" method="post">
        <input type="hidden" name="id-room" id="id-room" value="<?= $_GET['id-room'] ?>">
        <input type="hidden" name="id-member" id="id-member" value="<?= $id_member ?>">
        <input type="hidden" name="arrival-date" id="arrival-date" value="<?= $dateArrival ?>">
        <input type="hidden" name="departure-date" id="departure-date" value="<?= $dateDeparture ?>">
        <input type="submit" name="confirm" value="Confirmer la réservation">
    </form>
    <div id="confirm-result"></div>
</div>

<?php include_once('inc/footer.php'); ?>