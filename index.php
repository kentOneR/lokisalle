<?php
    include_once('inc/header.php');

    $roomReq = $pdo->prepare("SELECT * FROM salle");
    $roomReq->execute();
    $roomReq = $roomReq->fetchAll(PDO::FETCH_ASSOC);
?>
    <!-- Header -->

    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <!-- 1er slide -->
                <div class="carousel-item active" style="background-image: url('img/slider01.jpg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Besoin d'un lieu pour vos événements?
                            <br>Réunions | séminaires | formations</h2>
                        <h4>
                            <b>[ L O K I S A L L E ]</b> le service de location de salle
                            <br>qui simplifie l'organisation de tous vos événements</h4>
                    </div>
                </div>
    </header>
    <!-- Fin du Header -->


    <!-- FORMULAIRE -->
    <?php include_once('template/search-room-form.php'); ?>



    <!-- Services -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-subheading text-muted">Nos engagements</h2>
                </div>
            </div>
            <br>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Rapide et efficace</h4>
                    <p class="text-muted">Réservez votre espace de travail en 3 clics
                        <br>parmis plus de 500 lieux vérifiés.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Un service sur mesure</h4>
                    <p class="text-muted">A l'heure, à la journée ou à la semaine, trouvez la salle qui vous correspond.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Des tarifs accessibles</h4>
                    <p class="text-muted">Accedez à des locaux professionnels à des tarifs compétitifs grâce à notre réseau Lokisalle</p>
                </div>
            </div>
        </div>
    </section>

    <!--Fin  Services -->

    <div class="room-container">
        <?php
    foreach ($roomReq as $key => $room) { ?>
            <div class="room-wrapper" data-room-id="<?= $room['id_salle'] ?>">
                <h2>
                    <?= $room['titre'] ?>
                </h2>
                <img src="img/room/<?= $room['photo'] ?>" alt="salle <?= $room['titre'] ?>">
                <p class="room-description">
                    <?= $room['description'] ?>
                </p>
                <span class="price"></span>
            </div>
            <?php } ?>

    </div>

    <?php include_once('inc/footer.php'); ?>