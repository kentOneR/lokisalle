<?php

require_once('init.inc.php');

if(isset($_POST)) {
    // ADD NEW ORDER IN DB
    try{
        $bookReq = $pdo->prepare('INSERT INTO commande(id_membre, id_salle, date_arrivee, date_depart) VALUES (:id_membre, :id_salle, :date_arrivee, :date_depart)');
        $arrivalDate = date('Y-m-d', strtotime($_POST['arrival-date']));
        $departureDate = date('Y-m-d', strtotime($_POST['departure-date']));
        $bookReq->execute(array(
            "id_membre" => $_POST['id-member'], 
            "id_salle" => $_POST['id-room'], 
            "date_arrivee" => $arrivalDate, 
            "date_depart" => $departureDate
        ));
        // header('location:../index.php');
    } catch(Exception $e) {
        print_r($e);
    }
}



?>