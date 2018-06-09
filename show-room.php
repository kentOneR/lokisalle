<?php require_once('inc/header.php'); 

$roomReq = $pdo->prepare("SELECT * FROM salle");
$roomReq->execute();
$roomReq = $roomReq->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="column-search">

  <form action="" method="post">

    <!-- CATEGORIE -->

    <div id="select-category">Categorie
      <input type="checkbox" name="category" value="réunion">
      <label for="category">Réunion</label>
      <input type="checkbox" name="category" value="séminaire">
      <label for="category">Séminaire</label>
      <input type="checkbox" name="category" value="formation">
      <label for="category">Formation</label>
    </div>

    <!-- VILLE -->

    <div id="select-city">Ville
      <input type="checkbox" name="city" value="paris">
      <label for="category">Paris</label>
      <input type="checkbox" name="city" value="lyon">
      <label for="category">Lyon</label>
      <input type="checkbox" name="city" value="marseille">
      <label for="category">Marseille</label>
    </div>

    <!-- CAPACITE -->

    <label for="room-capacity">Capacité (min)</label>
    <select name="room-capacity" id="room-capacity">
      <option value="10">10</option>
      <option value="20" selected>20</option>
      <option value="30">30</option>
      <option value="40">40</option>
      <option value="50">50</option>
      <option value="60">60</option>
      <option value="70">70</option>
      <option value="80">80</option>
      <option value="90">90</option>
      <option value="100">100</option>
    </select>

    <!-- PRIX -->
    <label for="amount">Prix</label>
    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">

    <div id="slider-range-min"></div>

    <!-- DATE PICKER -->

    <label for="from">Date d'arrivée</label>
    <br>
    <input type="text" id="search-from" name="from">
    <br>
    <label for="to">Date de départ</label>
    <br>
    <input type="text" id="search-to" name="to">


  </form>

</div>

<div id="room-container" class="room-container">
  <?php
    foreach ($roomReq as $key => $room) { ?>
    <a href="product-card.php?id-room=<?= $room['id_salle'] ?>">
      <div class="room-wrapper" data-room-id="<?= $room['id_salle'] ?>">
        <h2>
          <?= $room['titre'] ?>
        </h2>
        <img src="img/room/<?= $room['photo'] ?>" alt="salle <?= $room['titre'] ?>">
        <p class="room-description">
          <?= $room['description'] ?>
        </p>
        <span class="price">
          <?= $room['prix'] ?> €/jour </span>
        <p>En savoir +</p>
      </div>
    </a>
    <?php } ?>


</div>



<?php require_once('inc/footer.php'); ?>

<script>

  // SLIDER SELECTION PRIX

  $(function () {
    $("#slider-range-min").slider({
      range: "min",
      value: 37,
      min: 1,
      max: 1000,
      slide: function (event, ui) {
        $("#amount").val("€" + ui.value);
      }
    });
    $("#amount").val("€" + $("#slider-range-min").slider("value"));
  });

  // DATE PICKER

  $(function () {
    var dateFormat = "dd/mm/yy",
      from = $("#search-from")
        .datepicker({
          defaultDate: "+1w",
          dateFormat: "dd/mm/yy",
          minDate: 0,
          firstDay: 1,
          dayNames: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
          dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
          monthNamesShort: ["Jan", "Fev", "Mars", "Avr", "Mai", "Juin", "Juil", "Aôut", "Sep", "Oct", "Nov", "Dec"],
          changeMonth: true,
          numberOfMonths: 1
        })
        .on("change", function () {
          to.datepicker("option", "minDate", getDate(this));
        }),
      to = $("#search-to").datepicker({
        defaultDate: "+1w",
        dateFormat: "dd/mm/yy",
        minDate: 1,
        firstDay: 1,
        dayNames: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
        dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        monthNamesShort: ["Jan", "Fev", "Mars", "Avr", "Mai", "Juin", "Juil", "Aôut", "Sep", "Oct", "Nov", "Dec"],
        changeMonth: true,
        numberOfMonths: 1

      })
        .on("change", function () {
          from.datepicker("option", "maxDate", getDate(this));
        });

    function getDate(element) {
      var date;
      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }
  });

</script>