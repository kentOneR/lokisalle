<?php
    include_once('inc/header.php');
    if(isset($_GET['id-room']) && !empty($_GET['id-room'])) {
        $roomReq = $pdo->prepare("SELECT * FROM salle WHERE id_salle = ?");
        $roomReq->execute(array($_GET['id-room']));
        $roomReq = $roomReq->fetch(PDO::FETCH_ASSOC);

        $reviewReq = $pdo->prepare("SELECT a.commentaire, a.note, a.date_enregistrement, m.pseudo FROM avis a, membre m WHERE a.id_salle = ? && a.id_membre = m.id_membre");
        $reviewReq->execute(array($_GET['id-room']));
        $reviewReq = $reviewReq->fetchAll(PDO::FETCH_ASSOC);
    }
?>
    <header>
        <div class="visual-header">
        </div>
    </header>

    <?php include_once('template/search-room-form.php')?>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 presentation">
                <h1>
                    <?= $roomReq['titre'] ?>
                </h1>

                <div class="room-description-wrapper">
                    <h4>Description</h4>
                    <p>
                        <?= $roomReq['description'] ?>
                    </p>
                </div>
                <div class="room-additionnal-info">
                    <h4>Informations complémentaire</h4>
                    <div class="room-left-info">
                        <p>Capacité:
                            <?= $roomReq['capacite'] ?>
                        </p>
                        <p>Catégorie:
                            <?= $roomReq['categorie'] ?>
                        </p>
                    </div>
                    <div class="room-middle-info">
                        <p>Adresse:
                            <?= $roomReq['adresse'].' '.$roomReq['cp'].' '.$roomReq['ville'] ?>
                        </p>
                        <p>Prix:
                            <?= $roomReq['prix'] ?> €/jour</p>
                    </div>
                    <div class="room-right-info">
                        <form id="book-room" action="booking.php" method="post">
                            <input type="hidden" name='id-room' id='id-room' value="<?= $roomReq['id_salle'] ?>">
                            <label for="arrival-date">Date d'arrivée</label>
                            <br>
                            <input type="text" id="inputBookIn" name="arrival-date" required autocomplete="off">
                            <br>
                            <label for="departure-date">Date de départ</label>
                            <br>
                            <input type="text" id="inputBookOut" name="departure-date" required autocomplete="off">
                            <input type="submit" id="booking" name="booking" value="réserver" <?=( !userConnect()) ? 'disabled' : '' ?> >
                        </form>
                    </div>
                    <div id="room-result"></div>
                    <?php if(!userConnect()): ?>
                    <div class="alert alert-danger" role="alert">Veuillez vous connecter ou vous inscrire</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-8 presentation">
                <div class="room-main-picture">
                    <img src="img/room/<?= $roomReq['photo'] ?>" alt="<?= $roomReq['titre']?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3>Localisation</h3>
                <div class="map-responsive">
                    <iframe src="https://www.google.com/maps?q=<?= $roomReq['adresse'].' '.$roomReq['cp'].' '.$roomReq['ville'].' '.$roomReq['pays'] ?>&z=13&output=embed"
                        width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-6">
                <h3>Avis</h3>
                <?php if(empty($reviewReq)) { ?>
                    <p>Aucun avis pour cette salle</p>
                <?php } else {
                    foreach ($reviewReq as $key => $review) { ?>
                        <div class="review-wrapper">
                            <?php for ($i=0; $i < $review['note']; $i++) { ?>
                                   <i class="fas fa-star"></i>
                            <?php } ?>
                            <p><?= $review['commentaire'] ?></p>
                            <span><?= $review['pseudo'] ?></span>
                            <span><?= $review['date_enregistrement'] ?></span>
                        </div>
                    <?php }
                }
                if(userConnect()) {?>
                <a href="profil.php?action=add-review&id-room=<?= $roomReq['id_salle'] ?>">Laisser un avis</a>
                <?php } ?>
            </div>
        </div>

        <h3>Autres salles</h3>
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

    </div>



    <?php include_once('inc/footer.php'); ?>