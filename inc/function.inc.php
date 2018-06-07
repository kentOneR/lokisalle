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

?>