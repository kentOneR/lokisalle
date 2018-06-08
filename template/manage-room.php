<?php if(isset($_GET['action']) && $_GET['action'] == "show-room"):
    $r = $pdo->prepare("SELECT * FROM salle");
    $r->execute();
    $roomList = $r->fetchAll(PDO::FETCH_ASSOC);
    $columnRoomList = $r->columnCount();

    ?>
    <h2>Liste des salles</h2>
    <table border="1" cellpadding="5">
        <tr>
        <?php for ($i=0; $i < $columnRoomList  ; $i++) { 
            $column = $r->getColumnMeta($i); ?>
            <th><?=$column['name']?></th>
        <?php } ?>
            <th>Modification</th>
            <th>Suppression</th>
        </tr>
        <?php foreach ($roomList as $key => $room) { ?>
            <tr>
                <?php foreach ($room as $key => $value) { 
                    if($key == 'photo') {?>
                    <td><img src="img/room/<?= $value ?>" alt="<?= $room['titre'] ?>"> </td>
                    <?php } else { ?>
                        <td> <?= $value ?></td>
                    <?php }
                    } ?>
                <td><a href="?action=edit-room&id_room=<?= $room['id_salle'] ?>">Modif</a></td>
                <td><a href="?action=delete-room&id_room=<?= $room['id_salle'] ?>" onClick="confirm(\'En êtes vous sur?\')">Suppr</a></td>
            </tr>
        <?php } ?>
    </table>

<?php endif; ?>

<?php 

if(isset($_GET['action']) && ($_GET['action'] == "add-room" || $_GET['action'] == "edit-room")) :

    // récupération des membres
    if(isset($_GET['id_room'])) {
        $r = $pdo->prepare("SELECT * FROM salle WHERE id_salle = ? ");
        $r->execute(array($_GET['id_room']));
        $room = $r->fetch(PDO::FETCH_ASSOC);
    }

    $id_room = (isset($room['id_salle'])) ? $room['id_salle'] : '';
    $title = (isset($room['titre'])) ? $room['titre'] : '';
    $description = (isset($room['description'])) ? $room['description'] : '';
    $photo = (isset($room['photo'])) ? $room['photo'] : '';
    $country = (isset($room['pays'])) ? $room['pays'] : '';
    $city = (isset($room['ville'])) ? $room['ville'] : '';
    $address = (isset($room['adresse'])) ? $room['adresse'] : '';
    $cp = (isset($room['cp'])) ? $room['cp'] : '';
    $capacity = (isset($room['capacite'])) ? $room['capacite'] : '';
    $category = (isset($room['categorie'])) ? $room['categorie'] : '';


?>

<h2>Gestion des salles</h2>

<form class="col-sm-6" action="inc/function.room.php" method="post">
    <input type="hidden" class="form-control" name="id-room" id="id-room" value="<?= $id_room ?>">
    <label for="title">Titre</label><br>
    <input type="text" class="form-control" name="title" id="title" value="<?= $title ?>">
    <label for="description">Description</label><br>
    <input type="text" class="form-control" name="description" id="description" value="<?= $description ?>">
    <?php if($photo != '') { ?>
        <img src="img/room/<?= $photo ?>" alt="" width="80" height="80"><br>
        <input type="hidden" name="photo-old" id="photo-old" value="<?= $photo ?>">
    <?php } ?>
    <label for="photo">Photo</label>
    <input type="file" class="form-control" name="photo" id="photo" value="<?= $photo ?>">
    <label for="description">Pays</label><br>
    <input type="text" class="form-control" name="country" id="country" value="<?= $country ?>">
    <label for="city">Ville</label><br>
    <input type="text" class="form-control" name="city" id="city" value="<?= $city ?>">
    <label for="address">Adresse</label><br>
    <input type="text" class="form-control" name="address" id="address" value="<?= $address ?>">
    <label for="cp">CP</label><br>
    <input type="text" class="form-control" name="cp" id="cp" value="<?= $cp ?>">
    <label for="capacity">Capacité</label><br>
    <input type="text" class="form-control" name="capacity" id="capacity" value="<?= $capacity ?>">
    <label for="category">Categorie</label><br>
    <select class="form-control" name="category" id="category" value="<?= $category ?>">
        <option value="réunion" class="form-control">réunion</option>
        <option value="séminaire" class="form-control">séminaire</option>
        <option value="formation" class="form-control">formation</option>
    <select>
    <input type="submit" class="btn btn-default" name="managemember" id="managemember" value="Valider">
</form>

<?php endif; ?>