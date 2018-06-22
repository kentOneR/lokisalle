    <?php 
    require_once('controller/frontend.php');
    require_once('view/header.php'); 
    ?>

    <header>
        <div class="visual-header d-none d-sm-block">
        </div>
    </header>
    <!-- FORMULAIRE -->
    <?php require_once('view/search-room-form.php'); ?>
    <div class="main-container">
        <section class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Lokisalle, la location sur demande</h1>
                    <p>Leader incontesté de la location de salles en France pour les particuliers et les entreprises, Lokisalle vous met à disposition des salles de réunion de haute qualité à Paris, Lyon, Marseille et dans toute la France.</p>
                    <p>Soucieux du bien être de vos collaborateurs, vous cherchez une solution efficace à la hauteur de vos exigences et de l'image de votre entreprise. N'attendez plus ! Inscrivez-vous sur notre site et réservez en quelques clics la salle qui répond à vos besoins.</p>
                </div>
            </div>
        </section>
    </div>
    <?php require_once('view/room-slider.php'); ?>
    <?php require_once('view/footer.php'); ?>