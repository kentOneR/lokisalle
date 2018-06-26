<?php

require_once('init.inc.php');

// TOP BEST ROOMS BY REVIEW
function topRoomsStat($y){
    $req = $GLOBALS['pdo']->prepare("SELECT a.id_salle, s.titre, ROUND(AVG(a.note), 1) as avg_note FROM avis a, salle s WHERE s.id_salle=a.id_salle GROUP BY id_salle ORDER BY avg_note DESC LIMIT $y");
    $req->execute();
    return $req;
}


// TOP BEST ROOMS BY NB ORDER
function topOrdersStat($y){
    $req = $GLOBALS['pdo']->prepare("SELECT c.id_salle, s.titre, COUNT(c.id_commande) as nb_order FROM commande c, salle s WHERE s.id_salle=c.id_salle GROUP BY id_salle ORDER BY nb_order DESC LIMIT $y");
    $req->execute();
    return $req;
}

// TOP BEST MEMBERS BY NB OF ORDER
function topMembersOrderStat($y){
    $req = $GLOBALS['pdo']->prepare("SELECT c.id_membre, m.pseudo, COUNT(c.id_commande) as nb_order FROM commande c, membre m WHERE c.id_membre=m.id_membre GROUP BY id_membre ORDER BY nb_order DESC LIMIT $y");
    $req->execute();
    return $req;
}

// TOP BEST MEMBERS BY PRICE
function topMembersOriceStat($y){
    $req = $GLOBALS['pdo']->prepare("SELECT c.id_membre, m.pseudo, SUM((DATEDIFF(c.date_depart, c.date_arrivee)*s.prix)) as total_price FROM commande c, salle s, membre m WHERE s.id_salle=c.id_salle && m.id_membre=c.id_membre GROUP BY id_membre ORDER BY total_price DESC LIMIT $y");
    $req->execute();
    return $req;
}

?>