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
        $userReq = $GLOBALS['pdo']->prepare("SELECT statut FROM membre WHERE id_membre= ? ");
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

// FUNCTION CRYPT GET
class Crypting {

    // Algorithme utilisé pour le cryptage des blocs
    private static $cipher = MCRYPT_RIJNDAEL_128;
    
    // Clé de cryptage         
    private static $key = "MQWQWTerxSE4gJWZ";
    
    // Mode opératoire (traitement des blocs)
    private static $mode    = 'cbc';
     
    public static function crypt($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0, mcrypt_get_key_size(self::$cipher, self::$mode));
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode));
     
        $data = mcrypt_encrypt(self::$cipher, $key, $data, self::$mode, $iv);
        $data = base64_encode($data);
        $data = str_replace('+', '-', $data);
        
        return $data;
    }
     
    public static function decrypt($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
    
        $data = str_replace('-', '+', $data);
        $data = base64_decode($data);
        $data = mcrypt_decrypt(self::$cipher, $key, $data, self::$mode, $iv);
    
        return rtrim($data);
    }
}

// FUNCTION ROOM
function showAllRooms(){
    $req = $GLOBALS['pdo']->prepare("SELECT * FROM salle");
    $req->execute();
    return $req;
}

function getThisRoom($id){
    $req = $GLOBALS['pdo']->prepare("SELECT * FROM salle WHERE id_salle = ? ");
    $req->execute(array($id));
    return $req;
}

function getThisRoomReviews($id){
    $req = $GLOBALS['pdo']->prepare("SELECT a.commentaire, a.note, a.date_enregistrement, m.pseudo FROM avis a, membre m WHERE a.id_salle = ? && a.id_membre = m.id_membre");
    $req->execute(array($id));
    return $req;
}

// FUNCTION ORDER
function getAllOrders(){
    $req = $GLOBALS['pdo']->prepare("SELECT c.*, s.prix FROM commande c, salle s WHERE c.id_salle=s.id_salle");
    $req->execute();
    return $req;
}

function getThisOrder($id){
    $req = $GLOBALS['pdo']->prepare("SELECT * FROM commande WHERE id_commande = ? ");
    $req->execute(array(Crypting::decrypt($id)));
    return $req;
}

function deleteThisOrder($id){
    $req = $GLOBALS['pdo']->prepare("DELETE FROM commande WHERE id_commande = ?");
    $req->execute(array(Crypting::decrypt($id)));
    return $req;
}

// FUNCTION REVIEW
function showAllReviews(){
    $req = $GLOBALS['pdo']->prepare("SELECT * FROM avis");
    $req->execute();
    return $req;
}

function getThisReview($id){
    $req = $GLOBALS['pdo']->prepare("SELECT * FROM avis WHERE id_avis = ? ");
    $req->execute(array($id));
    return $req;
}

function deleteThisReview($id){
    $req = $GLOBALS['pdo']->prepare("DELETE FROM avis WHERE id_avis = ?");
    $req->execute(array($id));
    return $req;
}

// FUNCTION MEMBER
function getAllMembers(){
    $req = $GLOBALS['pdo']->prepare("SELECT * FROM membre");
    $req->execute();
    return $req;
}

function thisMemberInfo($id){
    $req = $GLOBALS['pdo']->prepare("SELECT * FROM membre WHERE id_membre = $id");
    $req->execute();
    return $req;
}

function deleteThisMember(){
    $req = $GLOBALS['pdo']->prepare("DELETE FROM membre WHERE id_membre = ?");
    $req->execute(array(Crypting::decrypt($id)));
    return $req;
}

// FUNCTION ROOM
function deleteThisRoom($id){
    $req = $GLOBALS['pdo']->prepare("DELETE FROM salle WHERE id_salle = ?");
    $req->execute(array(Crypting::decrypt($id)));
    return $req;
}


// FUNCTION CALCULATE PRICE
function calcNbOfDays($a, $b){
    $a = strtotime($a);
    $b = strtotime($b);
    $datediff = $b - $a;
    if ($datediff <= 0) {
        $datediff = 60 * 60 * 24;
    }
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
        $_SESSION['basket']['id-room'] = [];
        $_SESSION['basket']['arrival'] = [];
        $_SESSION['basket']['departure'] = [];
    }
}

// FUNCTION ADD TO BASKET

function addToBasket($idRoom, $arrival, $departure) {
    createBasket();
    $pos = array_search($idRoom, $_SESSION['basket']['id-room']);
    if($pos !== false) {
        $_SESSION['basket']['id-room'][$pos] = $idRoom;
        $_SESSION['basket']['arrival'][$pos] = $arrival;
        $_SESSION['basket']['departure'][$pos] = $departure;

    } else {
        $_SESSION['basket']['id-room'][] = $idRoom;
        $_SESSION['basket']['arrival'][] = $arrival;
        $_SESSION['basket']['departure'][] = $departure;
    }
}

// FUNCTION DROP ARTICLE FROM BASKET

function dropFromBasket($index){
    $pos = array_search($index, $_SESSION['basket']['id-room']);
    if($pos !== false) {
        array_splice($_SESSION['basket']['id-room'], $pos, 1);
        array_splice($_SESSION['basket']['arrival'], $pos, 1);
        array_splice($_SESSION['basket']['departure'], $pos, 1);
    }
}

// DELETE ALL BASKET

function deleteBasket($index){
    $pos = array_search($index, $_SESSION['basket']['id-room']);
    if($pos !== false) {
        array_splice($_SESSION['basket']['id-room'], $pos, 1);
        array_splice($_SESSION['basket']['arrival'], $pos, 1);
        array_splice($_SESSION['basket']['departure'], $pos, 1);
    }
}

?>