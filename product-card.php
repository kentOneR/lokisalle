<?php
    include_once('inc/header.php');
    if(isset($_GET['id-room']) && !empty($_GET['id-room'])) {
        foreach ($_GET as $key => $value) {
            $_GET[$key] = htmlentities(addslashes($value));
        }

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

    <div class="main-container container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h1>
                    <?= $roomReq['titre'] ?>
                </h1>
            </div>
            <div class="w100 d-md-flex flex-wrap justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="room-main-picture">
                        <img src="img/room/<?= $roomReq['photo'] ?>" alt="<?= $roomReq['titre']?>">
                    </div>
                    <div class="">
                        <p>
                            <?= $roomReq['description'] ?>
                        </p>
                    </div>
                    <div class="">
                        <p>
                            <span class="mr-3">
                                <i class="fas fa-user-friends"></i>
                                <?= $roomReq['capacite'] ?> places
                            </span>
                            <span class="mr-3">
                                <i class="fas fa-tags"></i>
                                <?= $roomReq['categorie'] ?>
                            </span>
                            <span>
                                <i class="fas fa-euro-sign"></i>
                                <?= $roomReq['prix'] ?> €/jour
                            </span>
                        </p>
                        <p>
                            <i class="fas fa-map-marker-alt"></i>
                            <?= $roomReq['adresse'].' '.$roomReq['cp'].' '.$roomReq['ville'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map-responsive">
                        <iframe src="https://www.google.com/maps?q=<?= $roomReq['adresse'].' '.$roomReq['cp'].' '.$roomReq['ville'].' '.$roomReq['pays'] ?>&z=13&output=embed"
                            width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="w100 d-md-flex flex-wrap justify-content-center">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="">
                        <h4>Sélectionnez vos dates</h4>
                        <form id="book-room" action="booking.php" method="post">
                            <input type="hidden" name='id-room' id='id-room' value="<?= $roomReq['id_salle'] ?>">
                            <label for="arrival-date">
                                <i class="far fa-calendar-alt"></i> Arrivée</label>
                            <br>
                            <input class="form-control" type="text" id="inputBookIn" name="arrival-date" required autocomplete="off">
                            <br>
                            <label for="departure-date">
                                <i class="far fa-calendar-alt"></i> Départ</label>
                            <br>
                            <input class="form-control" type="text" id="inputBookOut" name="departure-date" required autocomplete="off">
                            <input class="form-control btn btn-green col-12 col-sm-6 mt-3 offset-sm-6" type="submit" id="booking" name="booking" value="réserver"
                                <?=( !userConnect()) ? 'disabled' : '' ?> >
                        </form>
                    </div>
                    <div id="room-result" class=""></div>
                    <?php if(!userConnect()): ?>
                    <div class="alert alert-danger" role="alert">Veuillez vous
                        <a class="show-login" href="">connecter</a> ou vous
                        <a id="show-signup" href="">inscrire</a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-sm-6 col-md-8">
                    <div class="">
                        <h3>Avis</h3>
                        <?php if(empty($reviewReq)) { ?>
                        <p>Aucun avis pour cette salle</p>
                        <?php } else {
                                    foreach ($reviewReq as $key => $review) { ?>
                        <div class="review-wrapper">
                            <?php for ($i=0; $i < $review['note']; $i++) { ?>
                            <i class="fas fa-star"></i>
                            <?php } ?>
                            <p>
                                <?= $review['commentaire'] ?>
                            </p>
                            <span>
                                <?= $review['pseudo'] ?>
                            </span>
                            <span>
                                <?= date('d-m-Y', strtotime($review['date_enregistrement'])) ?>
                            </span>
                        </div>
                        <?php }
                                }
                                if(userConnect()) {?>
                        <a href="profil.php?action=add-review&id-room=<?= $roomReq['id_salle'] ?>">
                            <button type="button" class="btn btn-green col-8 col-sm-6 mt-3 offset-4 offset-sm-6">Laisser un avis</button>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    <?php include_once('template/room-slider.php'); ?>
    <?php include_once('inc/footer.php'); ?>