<?php

require_once('init.inc.php');

if(isset($_POST)) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlentities(addslashes($value));
    }
    $idMembre = $_SESSION['membre']['id_membre'];
    $noteReview = $_POST['note'];
    ($noteReview > 5) ? $noteReview = 5 : (($noteReview < 0) ? $noteReview = 0 : $noteReview = $noteReview);
    $addReviewReq = $pdo->prepare("INSERT INTO avis (id_membre, id_salle, note, commentaire) VALUES (:id_membre, :id_salle, :note, :commentaire)");
    $addReviewReq->execute(array(
        'id_membre' => $idMembre,
        'id_salle' => $_POST['id-room'],
        'note' => $noteReview,
        'commentaire' => $_POST['review']
    ));

    header('location:../product-card.php?id-room='.$_POST['id-room']);
}


?>