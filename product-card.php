<?php
    require_once('controller/frontend.php');
    require_once('view/header.php');

    if(isset($_POST['id-room']) || isset($_GET['id-room'])) {
        (isset($_POST['id-room'])) ? $rooms = $_POST : $rooms = $_GET;
        foreach ($rooms as $key => $value) {
            $rooms[$key] = htmlentities(addslashes($value));
        }

        $req = getThisRoom($rooms['id-room']);
        $roomReq = $req->fetch(PDO::FETCH_ASSOC);

        $req = getThisRoomReviews($rooms['id-room']);
        $reviewReq = $req->fetchAll(PDO::FETCH_ASSOC);
    }
?>
    <header>
        <div class="visual-header d-none d-sm-block">
        </div>
    </header>

    <?php include_once('view/search-room-form.php')?>

    <div class="main-container container-fluid mt-4">
        <div class="row">
            <div class="room-container no-gutters-md d-md-flex flex-wrap justify-content-center">
                <div class="col-12">
                    <h1><?= $roomReq['titre'] ?></h1>
                </div>
                <div class="col-12 col-md-6">
                    <div class="room-main-picture">
                        <img src="img/room/<?= $roomReq['photo'] ?>" alt="<?= $roomReq['titre']?>">
                    </div>
                    <div class="col-12">
                        <p>
                            <?= $roomReq['description'] ?>
                        </p>
                        <p>
                            <span class="mr-2">
                                <i class="fas fa-user-friends"></i>
                                <?= $roomReq['capacite'] ?> places
                            </span>
                            <span class="mr-2">
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
                    <div class="d-flex">
                        <form id="book-room" class="d-flex flex-wrap" action="booking.php" method="post">
                            <input type="hidden" name='id-room' id='id-room' value="<?= $roomReq['id_salle'] ?>">
                            <div class="col-sm-6">
                                <label for="arrival-date">
                                    <i class="far fa-calendar-alt"></i> Arrivée</label>
                                <br>
                                <input class="form-control" type="text" id="inputBookIn" value="<?= (isset($_POST['arrival-date'])) ? $_POST['arrival-date'] : '' ?>" name="arrival-date" required autocomplete="off">
                            </div>
                            <div class="col-sm-6">
                                <label for="departure-date"><i class="far fa-calendar-alt"></i> Départ</label>
                                <br>
                                <input class="form-control" type="text" id="inputBookOut" value="<?= (isset($_POST['departure-date'])) ? $_POST['departure-date'] : '' ?>" name="departure-date" required autocomplete="off">
                            </div>
                            <div class="col-12">
                                <input class="form-control btn btn-green mt-3 col-sm-6 offset-sm-6" type="submit" id="booking" name="booking" value="réserver" <?=( !userConnect())
                                    ? 'disabled' : '' ?> >
                            </div>
                        </form>
                        <div id="room-result" class=""></div>
                        <?php if(!userConnect()): ?>
                        <div class="alert alert-danger" role="alert">Veuillez vous
                            <a class="show-login" href="">connecter</a> ou vous
                            <a id="show-signup" href="">inscrire</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="w100 d-md-flex flex-wrap justify-content-center">
                <div class="col-sm-12 col-lg-8 pt-2 pb-2 bg-grey">
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
                        <button type="button" class="btn btn-green col-8 col-sm-4 mt-3 offset-4 offset-sm-8">Laisser un avis</button>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    <?php include_once('view/room-slider.php'); ?>
    <?php include_once('view/footer.php'); ?>