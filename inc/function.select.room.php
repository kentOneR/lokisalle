<?php

require_once('init.inc.php');

if(isset($_POST)){
    $categories = json_decode($_POST["x"], false);
    var_dump($categories);

    

} else {

// if(isset($_POST)) {
//     if(isset($_POST['category'])){
//         $category = $_POST['category'];
//         $req = $pdo->prepare("SELECT * FROM salle WHERE categorie= ? ");
//         $req->execute(array($category));
//     } elseif(isset($_POST['city'])){
//         $city = $_POST['city'];
//         $req = $pdo->prepare("SELECT * FROM salle WHERE ville= ? ");
//         $req->execute(array($city));
//     }


    foreach ($req as $key => $room) { ?>
        <a href="product-card.php?id-room=<?= $room['id_salle'] ?>">
          <div class="room-wrapper" data-room-id="<?= $room['id_salle'] ?>">
              <h2> <?= $room['titre'] ?> </h2>
              <img src="img/room/<?= $room['photo'] ?>" alt="salle <?= $room['titre'] ?>">
              <p class="room-description"> <?= $room['description'] ?> </p>
              <span class="price"> <?= $room['prix'] ?> €/jour </span>
              <p>En savoir +</p>
          </div>
        </a>
    <?php }
}


?>