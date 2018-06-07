<?php
// FUNCTION USER CONNECT
function userConnect() {

    if(isset($_SESSION['member'])) {
        return true;
    } else {
        return false;
    }

}

// FUNCTION ADMIN CONNECT
function adminConnect() {

    if(userConnect() && $_SESSION['member']['statut'] == 1) {
        return true;
    } else {
        return false;
    }

}

?>