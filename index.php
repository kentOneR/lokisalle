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
                <div class="carousel-item active" style="background-image: url('img/room/slider01.jpg')">
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
    <div class="container-fluid">
        <div class="row tm-banner-row" id="tm-section-search">
            <form action="show-room.php" method="post" class="tm-search-form tm-section-pad-2">
                <div class="col-lg-12 text-center">
                    <h3 class="section-subheading text-muted">Trouvez la salle qui vous convient</h3>
                </div>
                <br>
                <div class="form-row tm-search-form-row">
                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                        <label for="category">Choisissez votre catégorie</label>
                        <select name="category" type="text" class="form-control" id="select-category" placeholder="..." required>
                            <option value="all" selected>Toutes les categories</option>
                            <option value="réunion">Réunion</option>
                            <option value="séminaire">Séminaire</option>
                            <option value="formation">formation</option>
                        </select>
                    </div>
                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                        <label for="city">Choisissez votre ville</label>
                        <select name="city" type="text" class="form-control" id="select-city" placeholder="..." required>
                            <option value="all" selected>Toutes les villes</option>
                            <option value="Paris">Paris</option>
                            <option value="Lyon">Lyon</option>
                            <option value="Marseille">Marseille</option>
                        </select>
                    </div>
                </div>
                <div class="form-row tm-search-form-row">
                    <div class="form-group tm-form-group tm-form-group-1">
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                            <label for="inputAdult">Capacité</label>
                            <select name="capacity" class="form-control tm-select" id="inputAdult" required>
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="form-group tm-form-group tm-form-group-pad col-9">
                            <label for="price">Prix</label>
                            <input type="text" id="price" name="price" readonly style="border:0;" required>
                            <div id="slider-range-min"></div>
                        </div>
                    </div>
                    <div class="form-group tm-form-group tm-form-group-1">
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                            <label for="arrival-date">Date d'arrivée</label>
                            <input name="arrival-date" type="text" class="form-control" id="inputCheckIn" placeholder="Check In">
                        </div>
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                            <label for="departure-date">Date de départ</label>
                            <input name="departure-date" type="text" class="form-control" id="inputCheckOut" placeholder="Check Out">
                        </div>
                    </div>
                </div>
                <!-- form-row -->
                <div class="form-row tm-search-form-row flex-row-reverse">
                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                        <label for="btnSubmit">&nbsp;</label>
                        <button type="submit" class="btn btn-primary tm-btn tm-btn-search text-uppercase" id="btnSubmit">Trouver une salle</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- row -->
    </div>



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