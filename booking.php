<?php
    require_once('controller/frontend.php');
    require_once('view/header.php');

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
    if(isset($_GET)){
        foreach ($_GET as $key => $value) {
            $_GET[$key] = htmlentities(addslashes($value));
        }
    }
    if(isset($_GET['id-room']) && !empty($_GET['id-room'])) {
        $roomReq = $pdo->prepare("SELECT * FROM salle WHERE id_salle = ?");
        $roomReq->execute(array($_GET['id-room']));
        $roomReq = $roomReq->fetch(PDO::FETCH_ASSOC);
    }

?>
    <div class="main-container container-fluid">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <h3>Vos informations</h3>
                <p>Pseudo:
                    <?= $memberReq['pseudo'] ?>
                </p>
                <p>Nom:
                    <?= $memberReq['nom'] ?>
                </p>
                <p>Prenom:
                    <?= $memberReq['prenom'] ?>
                </p>
                <p>Civilité:
                    <?= ($memberReq['civilite'] == 'm') ? 'homme' : 'femme'; ?>
                </p>
                <p>Email:
                    <?= $memberReq['email'] ?>
                </p>
            </div>
            <div class="col-sm-6 col-lg-4">
                <h3>Adresse de facturation</h3>
                <p>Adresse:
                    <?= $memberReq['adresse'] ?>
                </p>
                <p>Code postale:
                    <?= $memberReq['cp'] ?>
                </p>
                <p>Ville:
                    <?= $memberReq['ville'] ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Confirmer votre réservation</h1>
                <h2>
                    <?= $roomReq['titre'] ?>
                </h2>
            </div>
            <div class="col-12 col-sm-6">
                <div class="room-main-picture">
                    <img src="img/room/<?= $roomReq['photo'] ?>" alt="<?= $roomReq['titre']?>">
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="room-description-wrapper">
                    <p>
                        <?= $roomReq['description'] ?>
                    </p>
                </div>
                <div class="">
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <?= $roomReq['adresse'].', '.$roomReq['cp'].' '.$roomReq['ville'] ?>
                    </p>
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
                            <?= calcNbOfDays($dateArrival, $dateDeparture) * $roomReq['prix'] ?> €
                        </span>
                    </p>
                </div>
                <div class="">
                    <p>
                        <span class="mr-2">
                            <i class="far fa-calendar-alt"></i>
                            <?= $dateArrival ?>
                        </span>
                        <span>
                            <i class="far fa-calendar-alt"></i>
                            <?= $dateDeparture ?>
                        </span>
                    </p>
                </div>
                <div class="">
                    <form id="confirm-booking" action="inc/function.booking.php" method="post">
                        <input type="hidden" name="id-room" id="id-room" value="<?= $_GET['id-room'] ?>">
                        <input type="hidden" name="id-member" id="id-member" value="<?= $id_member ?>">
                        <input type="hidden" name="arrival-date" id="arrival-date" value="<?= $dateArrival ?>">
                        <input type="hidden" name="departure-date" id="departure-date" value="<?= $dateDeparture ?>">
                        <input class="form-control btn btn-green col-12 col-sm-8 offset-sm-4 col-lg-6 offset-lg-6" type="submit" name="confirm" value="Confirmer la réservation">
                    </form>
                    <div id="confirm-result"></div>
            </div>
            </div>

        </div>
    </div>



    <?php include_once('view/footer.php'); ?>