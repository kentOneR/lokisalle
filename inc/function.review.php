<?php

require_once('init.inc.php');

if(isset($_POST)) {
    $idMembre = $_SESSION['membre']['id_membre'];
    $addReviewReq = $pdo->prepare("INSERT INTO avis (id_membre, id_salle, note, commentaire) VALUES (:id_membre, :id_salle, :note, :commentaire)");
    $addReviewReq->execute(array(
        'id_membre' => $idMembre,
        'id_salle' => $_POST['id-room'],
        'note' => $_POST['note'],
        'commentaire' => $_POST['review']
    ));

    header('location:../product-card.php?id-room='.$_POST['id-room']);
}


?>