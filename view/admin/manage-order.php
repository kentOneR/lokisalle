<?php 
if(isset($_GET['action'])):

    if($_GET['action'] == "show-order" || $_GET['action'] == "delete-order"){
        $r = $pdo->prepare("SELECT c.*, s.prix FROM commande c, salle s WHERE c.id_salle=s.id_salle");
        $r->execute();
        $columnReview = $r->columnCount();
        $orderReq = $r->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <h2>Liste des commandes</h2>
        <table border="1" cellpadding="5">
            <tr>
            <?php for ($i=0; $i < $columnReview  ; $i++) { 
                $column = $r->getColumnMeta($i); 
                if($column['name'] != 'prix') {?>
                <th><?=$column['name']?></th>
                <?php }
            } ?>
                <th>Prix total (€)</th>
                <th>action</th>
            </tr>
            <?php foreach ($orderReq as $key => $order) { ?>
                <tr>
                    <?php foreach ($order as $key => $value) { 
                        if($key != 'prix') {?>
                            <td><?= $value ?></td>
                        <?php }
                    } ?>
                    <td><?= calcNbOfDays($order['date_arrivee'], $order['date_depart']) * $order['prix'] ?></td>
                    <td>
                        <a href="?action=edit-order&id_order=<?= Crypting::crypt($order['id_commande']) ?>"><i class="far fa-edit"></i></a>
                        <a href="?action=delete-order&id_order=<?= Crypting::crypt($order['id_commande']) ?>" onClick="confirm(\'En êtes vous sur?\')"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    <?php } elseif($_GET['action'] == "delete-order"){
        $idOrder = Crypting::decrypt($_GET['id_order']);
        $deleteOrderReq = $pdo->prepare("DELETE FROM commande WHERE id_commande = ?");
        $deleteOrderwReq->execute(array($idOrder));
        
    }
    elseif(isset($_GET['action']) && $_GET['action'] == "edit-order"){

        // Récupéation de l'avis
        if(isset($_GET['id_order'])) {
            $idOrder = Crypting::decrypt($_GET['id_order']);
            $r = $pdo->prepare("SELECT * FROM commande WHERE id_commande = ? ");
            $r->execute(array($idOrder));
            $thisOrderReq = $r->fetch(PDO::FETCH_ASSOC);
        }

    ?>
    <h2>Modifier la commande id: <?= $thisOrderReq['id_commande'] ?></h2>
    <form class="col-sm-6" action="model/manage.review.php" method="post">
        <input type="hidden" class="form-control" name="id-order" value="<?= $thisOrderReq['id_commande'] ?>">
        <label for="id-member">Id membre</label><br>
        <input class="form-control" type="text" name="id-member" value="<?= $thisOrderReq['id_membre'] ?>">
        <label for="id-room">Id salle</label><br>
        <input class="form-control" type="text" name="id-room" value="<?= $thisOrderReq['id_salle'] ?>">
        <label for="arrival-date">Date arrivée</label><br>
        <input class="form-control" type="text" name="arrival-date" value="<?= $thisOrderReq['date_arrivee'] ?>">
        <label for="departure-date">Date arrivée</label><br>
        <input class="form-control" type="text" name="departure-date" value="<?= $thisOrderReq['date_depart'] ?>">
        <input type="submit" class="btn btn-default" name="edit-order" value="Valider">
    </form>

    <?php } ?>

<?php endif; ?>