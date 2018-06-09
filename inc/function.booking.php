<?php

require_once('init.inc.php');

if(isset($_POST)) {
    $roomAvailable = false;
    $arrivalDate = date('Y-m-d', strtotime($_POST['arrival-date']));
    $departureDate = date('Y-m-d', strtotime($_POST['departure-date']));
    // CHECK IF ROOM AVAILABLE
    try{
        $checkReq = $pdo->prepare("SELECT * FROM commande WHERE id_salle= ? && date_depart >= ? && date_arrivee <= ? ");
        $checkReq->execute(array($_POST['id-room'], $arrivalDate, $departureDate));

        ($checkReq->rowCount() > 0) ? $roomAvailable = false : $roomAvailable = true;

    } catch(Exception $e) {
        print_r($e);
    }

    if($roomAvailable){
    // ADD NEW ORDER IN DB
        try{
            $bookReq = $pdo->prepare('INSERT INTO commande(id_membre, id_salle, date_arrivee, date_depart) VALUES (:id_membre, :id_salle, :date_arrivee, :date_depart)');
            $bookReq->execute(array(
                "id_membre" => $_POST['id-member'], 
                "id_salle" => $_POST['id-room'], 
                "date_arrivee" => $arrivalDate, 
                "date_depart" => $departureDate
            )); ?>
            <div class="alert alert-danger" role="alert">
                Merci! Votre réservation est confirmé. <a href="profil.php">Mes réservation</a>
            </div>
        <?php } catch(Exception $e) {
            print_r($e);
        }
    } else { ?>
        <div class="alert alert-danger" role="alert">
            Cette salle n'est plus disponible, merci de saisir de nouvelles dates ou de séletionner une <a href="show-room.php">autres salles.</a>
        </div>
    <?php }
}



?>