<?php

// FUNCTION USER CONNECT
function userConnect() {

    if(isset($_SESSION['membre'])) {
        return true;
    } else {
        return false;
    }

}

// FUNCTION ADMIN CONNECT

function adminConnect() {
    if(userConnect()) {
        $id_membre = $_SESSION['membre']['id_membre'];
        $userReq = $GLOBALS['pdo']->prepare("SELECT statut FROM membre WHERE id_membre= 1 ");
        $userReq->execute(array($id_membre));
        $membre = $userReq->fetch(PDO::FETCH_ASSOC);

        if($membre['statut'] == 1){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// FUNCTION CALCULATE PRICE

function calcNbOfDays($a, $b){
    $a = strtotime($a);
    $b = strtotime($b);
    $datediff = $b - $a;
    return round($datediff / (60 * 60 * 24));
}

// FUNCTION ROOM AVAILABLE
function roomAvailable ($id, $a, $b) {
    $arrivalDate = date('Y-m-d', strtotime($a));
    $departureDate = date('Y-m-d', strtotime($b));
    // CHECK IF ROOM AVAILABLE
    try{
        $checkReq = $GLOBALS['pdo']->prepare("SELECT * FROM commande WHERE id_salle= ? && date_depart >= ? && date_arrivee <= ? ");
        $checkReq->execute(array($id, $arrivalDate, $departureDate));
        if($checkReq->rowCount() > 0){
            return false;
        } else {
            return true;
        }

    } catch(Exception $e) {
        print_r($e);
    }
}

// FUNCTION CREATE BASKET

function createBasket() {
    if(!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
        $_SESSION['basket']['id_article'] = [];
        $_SESSION['basket']['quantity'] = [];
        $_SESSION['basket']['price'] = [];
    }
}

// FUNCTION ADD TO BASKET

function addToCart($idRoom, $arrival, $departure) {
    createBasket();
    $_SESSION['basket']['id-room'][] = $idRoom;
    $_SESSION['basket']['arrival'][] = $arrival;
    $_SESSION['basket']['departure'][] = $departure;
}

?>