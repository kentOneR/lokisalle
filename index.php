<?php
    include_once('inc/header.php');

    $roomReq = $pdo->prepare("SELECT * FROM salle");
    $roomReq->execute();
    $roomReq = $roomReq->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Trouvez la salle qui vous convient</h1>

<div class="room-container">
    <?php
    foreach ($roomReq as $key => $room) { ?>
        <div class="room-wrapper" data-room-id="<?= $room['id_salle'] ?>">
            <h2> <?= $room['titre'] ?> </h2>
            <img src="img/room/<?= $room['photo'] ?>" alt="salle <?= $room['titre'] ?>">
            <p class="room-description"> <?= $room['description'] ?> </p>
            <span class="price"></span>
        </div>
    <?php } ?>

</div>

<?php include_once('inc/footer.php'); ?>