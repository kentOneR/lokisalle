<?php if(isset($_GET['action']) && $_GET['action'] == 'add-review' && isset($_GET['id-room'])) { ?>

    <form class="col-sm-6" action="function.review.php" method="post">
        <input class="form-control" type="hidden" name="id-room" value="<?= $_GET['id-room'] ?>">
        <label for="note">Note:</label>
        <select class="form-control" name="note">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">5</option>
            <option value="3">4</option>
            <option value="5">5</option>
        </select>
        <label for="review">Commentaire:</label>
        <textarea class="form-control" name="review" cols="10" rows="5"></textarea><br>
        <input class="form-control" type="submit" value="Publier">
    </form>


<?php } ?>