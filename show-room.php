<?php require_once('inc/header.php');


if(isset($_POST) && isset($_POST['search-room'])){
  foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlentities(addslashes($value));
  }

  ($_POST['category'] == 'all') ? $category='%%' : $category=$_POST['category'];
  ($_POST['city'] == 'all') ? $city='%%' : $city=$_POST['city'];
  $price = $_POST['price'];
  $capacity = $_POST['capacity'];
  $arrivalDate = date('Y-m-d', strtotime($_POST['arrival-date']));
  $departureDate = date('Y-m-d', strtotime($_POST['departure-date']));

  $roomReq = $pdo->prepare("SELECT s.* FROM salle s WHERE s.categorie LIKE :categorie && s.ville LIKE :ville  && s.prix <= :prix && capacite >= :capacite && NOT EXISTS (SELECT c.id_salle FROM commande c WHERE s.id_salle=c.id_salle && c.date_depart >= :date_arrivee && c.date_arrivee <= :date_depart)");
  $roomReq->execute(array(
    'categorie' => $category, 
    'ville' => $city, 
    'prix' => $price,
    'capacite' => $capacity,
    'date_arrivee' => $arrivalDate, 
    'date_depart' => $departureDate));

  $roomReq = $roomReq->fetchAll(PDO::FETCH_ASSOC);

} else {
  // IF NO POST GET ALL ROOMS
  $roomReq = $pdo->prepare("SELECT * FROM salle");
  $roomReq->execute();
  $roomReq = $roomReq->fetchAll(PDO::FETCH_ASSOC);
}

?>
<header>
  <div class="visual-header"></div>
</header>
<!-- FORMULAIRE -->
<?php include_once('template/search-room-form.php'); ?>

<div id="room-container" class="room-container">
  <?php
    foreach ($roomReq as $key => $room) { ?>
      <div class="room-wrapper" data-room-id="<?= $room['id_salle'] ?>" data-category="<?= $room['categorie'] ?>" data-city="<?= $room['ville'] ?>">
        <a href="product-card.php?id-room=<?= $room['id_salle'] ?>">
        <h2>
          <?= $room['titre'] ?>
        </h2>
        <img src="img/room/<?= $room['photo'] ?>" alt="salle <?= $room['titre'] ?>">
        <p class="room-description">
          <?= $room['description'] ?>
        </p>
        <p><i class="fas fa-map-marker-alt"></i> <?= $room['adresse'].' '.$room['cp'].' '.$room['ville'] ?>
        </p>
        <span class="category"><i class="fas fa-tags"></i> <?= $room['categorie'] ?></span>
        <span class="capacity"><i class="fas fa-user-friends"></i> <?= $room['capacite'] ?> places</span>
        <span class="price"><i class="fas fa-euro-sign"></i> <?= $room['prix'] ?> €/jour </span>
        <p>En savoir +</p>
        </a>
      </div>
    <?php } ?>


</div>



<?php require_once('inc/footer.php'); ?>
