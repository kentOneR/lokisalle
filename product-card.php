<?php
    include_once('inc/header.php');
    if(isset($_GET['id-room']) && !empty($_GET['id-room'])) {
        $roomReq = $pdo->prepare("SELECT * FROM salle WHERE id_salle = ?");
        $roomReq->execute(array($_GET['id-room']));
        $roomReq = $roomReq->fetch(PDO::FETCH_ASSOC);
    }
?>

<h1><?= $roomReq['titre'] ?></h1>
<div class="room-main-picture">
    <img src="img/room/<?= $roomReq['photo'] ?>" alt="<?= $roomReq['titre'] ?>">
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
        <p>Adresse: <?= $roomReq['adresse'].', '.$roomReq['cp'].' '.$roomReq['ville'] ?></p>
        <p>Prix: <?= $roomReq['prix'] ?> €/jour</p>
    </div>
    <div class="room-right-info">
        <form id="book-room" action="booking.php" method="post">
            <input type="hidden" name='id-room' id='id-room' value="<?= $roomReq['id_salle'] ?>">
            <label for="arrival-date">Date d'arrivée</label><br>
            <input type="text" id="search-from" name="arrival-date" required autocomplete="off"><br>
            <label for="departure-date">Date de départ</label><br>
            <input type="text" id="search-to" name="departure-date" required autocomplete="off">
            <input type="submit" id="booking" name="booking" value="réserver" <?= (!userConnect()) ? 'disabled' : '' ?> >
        </form>
    </div>
    <div id="room-result"></div>
    <?php if(!userConnect()): ?>
        <div class="alert alert-danger" role="alert">Veuillez vous connecter ou vous inscrire</div>
    <?php endif; ?>
</div>
<h2>Autres salles</h2>
<div id="rooms-slider">
    <?php
        $roomListReq = $pdo->prepare("SELECT * FROM salle");
        $roomListReq->execute();
        $roomListReq = $roomListReq->fetchAll(PDO::FETCH_ASSOC);

    foreach ($roomListReq as $key => $room) { ?>
        <div class="room-slide">
            <a href="product-card.php?id-room=<?= $room['id_salle'] ?>">
                <img src="img/room/<?= $room['photo'] ?>" alt="<?= $room['titre'] ?>">
            </a>
        </div>
    <?php } ?>

</div>


<?php include_once('inc/footer.php'); ?>