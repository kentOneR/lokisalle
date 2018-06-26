<?php if(isset($_GET['action']) && $_GET['action'] == 'add-review' && isset($_GET['id-room'])) { ?>

    <form class="col-sm-6" action="model/manage.review.php" method="post">
        <input class="form-control" type="hidden" name="id-room" value="<?= $_GET['id-room'] ?>">
        <label for="note">Note:</label>
        <select class="form-control" name="note">
            <?php for ($i=1; $i < 6; $i++) { ?>
                <option value="<?= $i ?>">
                    <?php for ($a=0; $a<3; $a++) { ?> <i class="fas fa-star"></i> <?php } ?>
                </option>
            <?php } ?>
        </select>
        <label for="review">Commentaire:</label>
        <textarea class="form-control" name="review" cols="10" rows="5"></textarea><br>
        <input class="form-control" type="submit" value="Publier">
    </form>


<?php } ?>