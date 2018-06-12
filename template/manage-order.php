<?php 
if(isset($_GET['action'])):

    if($_GET['action'] == "show-order" || $_GET['action'] == "delete-order"){
        $r = $pdo->prepare("SELECT * FROM commande");
        $r->execute();
        $columnReview = $r->columnCount();
        $orderReq = $r->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <h2>Liste des commandes</h2>
        <table border="1" cellpadding="5">
            <tr>
            <?php for ($i=0; $i < $columnReview  ; $i++) { 
                $column = $r->getColumnMeta($i); ?>
                <th><?=$column['name']?></th>
            <?php } ?>
                <th>action</th>
            </tr>
            <?php foreach ($orderReq as $key => $order) { ?>
                <tr>
                    <?php foreach ($order as $key => $value) { ?>
                            <td><?= $value ?></td>
                    <?php } ?>
                    <td>
                        <a href="?action=edit-order&id_order=<?= Crypting::crypt($order['id_commande']) ?>"><i class="far fa-edit"></i></a>
                        <a href="?action=delete-order&id_order=<?= Crypting::crypt($order['id_commande']) ?>" onClick="confirm(\'En êtes vous sur?\')"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    <?php } elseif($_GET['action'] == "delete-order"){
        $idOrder = Crypting::decrypt($_GET['id_order']);
        $deleteReviewReq = $pdo->prepare("DELETE FROM commande WHERE id_commande = ?");
        $deleteReviewReq->execute(array($idOrder));
        
    }
    elseif(isset($_GET['action']) && $_GET['action'] == "edit-review"){

        // Récupéation de l'avis
        if(isset($_GET['id_order'])) {
            $idOrder = Crypting::decrypt($_GET['id_order']);
            $r = $pdo->prepare("SELECT * FROM commande WHERE id_commande = ? ");
            $r->execute(array($idOrder));
            $thisReviewReq = $r->fetch(PDO::FETCH_ASSOC);
        }

    $idReview = (isset($thisReviewReq['id_commande'])) ? $thisReviewReq['id_commande'] : '';
    $idMember = (isset($thisReviewReq['id_membre'])) ? $thisReviewReq['id_membre'] : '';
    $idRoom = (isset($thisReviewReq['id_salle'])) ? $thisReviewReq['id_salle'] : '';
    $orderTxt = (isset($thisReviewReq['commentaire'])) ? $thisReviewReq['commentaire'] : '';
    $orderNote = (isset($thisReviewReq['note'])) ? $thisReviewReq['note'] : '';
    ?>

    <form class="col-sm-6" action="inc/function.review.php" method="post">
        <input type="hidden" class="form-control" name="id-review" value="<?= $idReview ?>">
        <label for="id-member">Id membre</label><br>
        <input class="form-control" type="text" name="id-member" value="<?= $idMember ?>">
        <label for="id-room">Id salle</label><br>
        <input class="form-control" type="text" name="id-room" value="<?= $idRoom ?>">
        <label for="note">Note</label><br>
        <select class="form-control" name="note">
            <option value="0" <?= ($orderNote == 0) ? ' selected' : '' ;?> >0</option>
            <option value="1" <?= ($orderNote == 1) ? ' selected' : '' ;?> >1</option>
            <option value="2" <?= ($orderNote == 2) ? ' selected' : '' ;?> >2</option>
            <option value="3" <?= ($orderNote == 3) ? ' selected' : '' ;?> >3</option>
            <option value="4" <?= ($orderNote == 4) ? ' selected' : '' ;?> >4</option>
            <option value="5" <?= ($orderNote == 5) ? ' selected' : '' ;?> >5</option>
        </select><br>
        <label for="review">Commentaire</label><br>
        <textarea name="review" class="form-control" cols="80" rows="5"><?= $orderTxt ?></textarea>
        <input type="submit" class="btn btn-default" name="edit-review" value="Valider">
    </form>

    <?php } ?>

<?php endif; ?>