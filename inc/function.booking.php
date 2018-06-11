<?php

require_once('init.inc.php');

if(isset($_POST)) {

    if(isset($_POST['booking'])){
        if(roomAvailable($_POST['id-room'], $_POST['arrival-date'], $_POST['departure-date'])){
            // ADD TO SESSION
            addToBasket($_POST['id-room'], $_POST['arrival-date'], $_POST['departure-date']); ?>
            <div class="alert alert-success" role="alert">
                Cette salle est disponible, merci de <a href="booking.php?id-room=<?= $_POST['id-room'] ?>">confirmer la réservation.</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                Cette salle n'est plus disponible, merci de saisir de nouvelles dates ou de séletionner une <a href="show-room.php">autre salle.</a>
            </div>
        <?php }
    }

    if(isset($_POST['confirm'])){
        if(roomAvailable($_POST['id-room'], $_POST['arrival-date'], $_POST['departure-date'])){
        // ADD NEW ORDER IN DB
            try{
                $arrivalDate = date('Y-m-d', strtotime($_POST['arrival-date']));
                $departureDate = date('Y-m-d', strtotime($_POST['departure-date']));
                $bookReq = $pdo->prepare('INSERT INTO commande(id_membre, id_salle, date_arrivee, date_depart) VALUES (:id_membre, :id_salle, :date_arrivee, :date_depart)');
                $bookReq->execute(array(
                    "id_membre" => $_POST['id-member'], 
                    "id_salle" => $_POST['id-room'], 
                    "date_arrivee" => $arrivalDate, 
                    "date_depart" => $departureDate
                )); 
                dropFromBasket($_POST['id-room']);
                
                ?>
                <div class="alert alert-danger" role="alert">
                    Merci! Votre réservation est confirmé. <a href="profil.php">Mes réservation</a>
                </div>
            <?php } catch(Exception $e) {
                print_r($e);
            }
        } else { ?>
        <div class="alert alert-danger" role="alert">
            Cette salle n'est plus disponible, merci de saisir de nouvelles dates ou de séletionner une <a href="show-room.php">autre salle.</a>
        </div>
    <?php }
    }
}



?>