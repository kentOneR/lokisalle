<?php if(isset($_GET['action']) && $_GET['action'] == "show-room"):
    $r = $pdo->prepare("SELECT * FROM salle");
    $r->execute();
    $roomList = $r->fetchAll(PDO::FETCH_ASSOC);
    $columnRoomList = $r->columnCount();

    ?>
    <h2>Liste des membres</h2>
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