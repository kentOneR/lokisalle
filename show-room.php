<?php require_once('inc/header.php'); 

$roomReq = $pdo->prepare("SELECT * FROM salle");
$roomReq->execute();
$roomReq = $roomReq->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="column-search">

  <div class="gauche">
  
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

<label for="number">Capacité</label>
    <select name="number" id="number">
      <option>1</option>
      <option selected="selected">2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
      <option>11</option>
      <option>12</option>
      <option>13</option>
      <option>14</option>
      <option>15</option>
      <option>16</option>
      <option>17</option>
      <option>18</option>
      <option>19</option>
    </select>

<!-- PRIX -->

<p>
  <label for="amount">Prix</label>
  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>
 
<div id="slider-range-min"></div>
<br>
 
<!-- DATE PICKER -->

<label for="from">Date d'arrivée</label>
<br>
<input type="text" id="from" name="from">
<br>
<label for="to">Date de départ</label>
<br>
<input type="text" id="to" name="to">


</div>
 
</div>

<div id="room-container" class="room-container">
    <?php
    foreach ($roomReq as $key => $room) { ?>
      <a href="product-card.php?id-room=<?= $room['id_salle'] ?>">
        <div class="room-wrapper" data-room-id="<?= $room['id_salle'] ?>">
            <h2> <?= $room['titre'] ?> </h2>
            <img src="img/room/<?= $room['photo'] ?>" alt="salle <?= $room['titre'] ?>">
            <p class="room-description"> <?= $room['description'] ?> </p>
            <span class="price"> <?= $room['prix'] ?> €/jour </span>
            <p>En savoir +</p>
        </div>
      </a>
    <?php } ?>


</div>



<?php require_once('inc/footer.php'); ?>

<script>
  $( function() {
    $( "#menu" ).menu({
      items: "> :not(.ui-widget-header)"
    });
  } );
 
 // SLIDER SELECTION PRIX

  $( function() {
    $( "#slider-range-min" ).slider({
      range: "min",
      value: 37,
      min: 1,
      max: 700,
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.value );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range-min" ).slider( "value" ) );
  } );

// DATE PICKER

$( function() {
    var dateFormat = "dd/mm/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
        
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );

  </script>