<?php
    require_once('controller/frontend.php');
    require_once('view/header.php');

    $roomReq = showAllRooms();
    $roomReq->execute();
    $roomReq = $roomReq->fetchAll(PDO::FETCH_ASSOC);
?>
    <!-- Header -->

    <header>
        <div class="visual-index-header">
            <div class="header-title">
                <h2>Besoin d'un lieu pour vos événements?
                    <br>Réunions | séminaires | formations</h2>
                <h4>
                    <strong>[ L O K I S A L L E ]</strong>
                    <br> le service de location de salle qui simplifie l'organisation de tous vos événements</h4>
            </div>
        </div>
    </header>
    <!-- Fin du Header -->
    <!-- FORMULAIRE -->
    <div class="home-page">

        <?php include_once('view/search-room-form.php'); ?>

        <div class="main-container">

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
                            <h4 class="service-heading mt-3">Rapide et efficace</h4>
                            <p class="text-muted">Réservez votre espace de travail en 3 clics parmis plus de 500 lieux vérifiés.</p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="service-heading mt-3">Un service sur mesure</h4>
                            <p class="text-muted">A l'heure, à la journée ou à la semaine, trouvez la salle qui vous correspond.</p>
                        </div>
                        <div class="col-md-4">
                            <h4 class="service-heading mt-3">Des tarifs accessibles</h4>
                            <p class="text-muted">Accedez à des locaux professionnels à des tarifs compétitifs grâce à notre réseau Lokisalle</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include_once('view/room-slider.php'); ?>
        <?php include_once('view/footer.php'); ?>
    </div>