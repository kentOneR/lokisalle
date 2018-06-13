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
                    <div class="header-title">
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
                    <h4 class="service-heading">Rapide et efficace</h4>
                    <p class="text-muted">Réservez votre espace de travail en 3 clics
                        <br>parmis plus de 500 lieux vérifiés.</p>
                </div>
                <div class="col-md-4">
                    <h4 class="service-heading">Un service sur mesure</h4>
                    <p class="text-muted">A l'heure, à la journée ou à la semaine, trouvez la salle qui vous correspond.</p>
                </div>
                <div class="col-md-4">
                    <h4 class="service-heading">Des tarifs accessibles</h4>
                    <p class="text-muted">Accedez à des locaux professionnels à des tarifs compétitifs grâce à notre réseau Lokisalle</p>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include_once('template/room-slider.php'); ?>
<?php include_once('inc/footer.php'); ?>