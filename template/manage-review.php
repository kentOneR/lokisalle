<?php 
if(isset($_GET['action'])):

    if($_GET['action'] == "show-review" || $_GET['action'] == "delete-review"){
        $r = $pdo->prepare("SELECT * FROM avis");
        $r->execute();
        $columnReview = $r->columnCount();
        $reviewReq = $r->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <h2>Liste des avis</h2>
        <table border="1" cellpadding="5">
            <tr>
            <?php for ($i=0; $i < $columnReview  ; $i++) { 
                $column = $r->getColumnMeta($i); ?>
                <th><?=$column['name']?></th>
            <?php } ?>
                <th>action</th>
            </tr>
            <?php foreach ($reviewReq as $key => $review) { ?>
                <tr>
                    <?php foreach ($review as $key => $value) { 
                        if($key != 'note'){ ?>
                            <td><?= $value ?></td>
                        <?php }else{ ?>
                            <td>
                                <?php for ($i=0; $i < $value; $i++) { ?>
                                    <i class="fas fa-star"></i>
                                <?php } ?>
                            </td>
                        <?php }
                        } ?>
                    <td>
                        <a href="?action=edit-review&id_review=<?= $review['id_avis'] ?>"><i class="far fa-edit"></i></a>
                        <a href="?action=delete-review&id_review=<?= $review['id_avis'] ?>" onClick="confirm(\'En êtes vous sur?\')"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    <?php } elseif($_GET['action'] == "delete-review"){
        $deleteReviewReq = $pdo->prepare("DELETE FROM avis WHERE id_avis = ?");
        $deleteReviewReq->execute(array($_GET['id_review']));
        
    }
    elseif(isset($_GET['action']) && $_GET['action'] == "edit-review"){

        // Récupéation de l'avis
        if(isset($_GET['id_review'])) {
            $r = $pdo->prepare("SELECT * FROM avis WHERE id_avis = ? ");
            $r->execute(array($_GET['id_review']));
            $thisReviewReq = $r->fetch(PDO::FETCH_ASSOC);
        }

    $idReview = (isset($thisReviewReq['id_avis'])) ? $thisReviewReq['id_avis'] : '';
    $idMember = (isset($thisReviewReq['id_membre'])) ? $thisReviewReq['id_membre'] : '';
    $idRoom = (isset($thisReviewReq['id_salle'])) ? $thisReviewReq['id_salle'] : '';
    $reviewTxt = (isset($thisReviewReq['commentaire'])) ? $thisReviewReq['commentaire'] : '';
    $reviewNote = (isset($thisReviewReq['note'])) ? $thisReviewReq['note'] : '';
    ?>

    <form class="col-sm-6" action="inc/function.review.php" method="post">
        <input type="hidden" class="form-control" name="id-review" value="<?= $idReview ?>">
        <label for="id-member">Id membre</label><br>
        <input class="form-control" type="text" name="id-member" value="<?= $idMember ?>">
        <label for="id-room">Id salle</label><br>
        <input class="form-control" type="text" name="id-room" value="<?= $idRoom ?>">
        <label for="note">Note</label><br>
        <select class="form-control" name="note">
            <option value="0" <?= ($reviewNote == 0) ? ' selected' : '' ;?> >0</option>
            <option value="1" <?= ($reviewNote == 1) ? ' selected' : '' ;?> >1</option>
            <option value="2" <?= ($reviewNote == 2) ? ' selected' : '' ;?> >2</option>
            <option value="3" <?= ($reviewNote == 3) ? ' selected' : '' ;?> >3</option>
            <option value="4" <?= ($reviewNote == 4) ? ' selected' : '' ;?> >4</option>
            <option value="5" <?= ($reviewNote == 5) ? ' selected' : '' ;?> >5</option>
        </select><br>
        <label for="review">Commentaire</label><br>
        <textarea name="review" class="form-control" cols="80" rows="5"><?= $reviewTxt ?></textarea>
        <input type="submit" class="btn btn-default" name="edit-review" value="Valider">
    </form>

    <?php } ?>

<?php endif; ?>