<?php require_once('inc/header.php'); 

$roomReq = $pdo->prepare("SELECT * FROM salle");
    $roomReq->execute();
    $roomReq = $roomReq->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="colonne">

  <div class="gauche">
  
  <!-- CATEGORIE -->

    <ul id="categorie">
    <li class="ui-widget-header"><div>Categorie</div></li>
    <li><div>Réunion</div></li>
    <li><div>Bureau</div></li>
    <li><div>Formation</div></li>
    </ul>

<!-- VILLE -->

    <ul id="ville">
    <li class="ui-widget-header"><div>Ville</div></li>
    <li><div>Réunion</div></li>
    <li><div>Bureau</div></li>
    <li><div>Formation</div></li>
    </ul>

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