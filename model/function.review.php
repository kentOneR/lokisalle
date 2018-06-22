<?php

require_once('init.inc.php');

// AJOUT AVIS
if(isset($_POST) && !isset($_POST['edit-review'])) {
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

// MODIFICATION ADMIN AVIS
if(isset($_POST) && isset($_POST['edit-review'])){
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlentities(addslashes($value));
    }

$editReviewReq = $pdo->prepare("UPDATE avis SET id_membre = :id_membre, id_salle = :id_salle, commentaire = :commentaire, note = :note WHERE id_avis = :id_avis");
$editReviewReq->execute(array(
    'id_membre' => $_POST['id-member'],
    'id_salle' => $_POST['id-room'],
    'commentaire' => $_POST['review'],
    'note' => $_POST['note'],
    'id_avis' => $_POST['id-review']
));

header('location:../admin.php?action=show-review');

}


?>